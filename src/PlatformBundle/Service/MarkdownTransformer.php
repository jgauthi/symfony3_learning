<?php
namespace PlatformBundle\Service;

use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, Cache $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse(string $str): string
    {
        $cacheKey = md5($str);

        // Use symfony cache system
        if(!$this->cache->contains($cacheKey))
        {
            $str = $this->markdownParser->transformMarkdown($str);
            sleep(1); // fake how slow this could be
            $this->cache->save($cacheKey, $str);
        }
        else $str = $this->cache->fetch($cacheKey);

        return $str;
    }
}
