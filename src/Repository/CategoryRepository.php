<?php
namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * CategoryRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @param string $pattern
     *
     * @return QueryBuilder
     */
    public function getLikeQueryBuilder(string $pattern): QueryBuilder
    {
        return $this
            ->createQueryBuilder('cat')
            ->where('cat.name LIKE :pattern')
            ->setParameter('pattern', $pattern);
    }
}
