<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertSkill.
 *
 * @ORM\Table(name="advert_skill")
 * @ORM\Entity(repositoryClass="App\Repository\AdvertSkillRepository")
 */
class AdvertSkill
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Advert")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $advert;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * Get name (for EasyAdminBundle)
     */
    public function __toString(): string
    {
        return sprintf('%s (%s)', $this->getSkill(), $this->getLevel());
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set level.
     *
     * @param string $level
     *
     * @return AdvertSkill
     */
    public function setLevel($level): AdvertSkill
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level.
     *
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * Set advert.
     *
     * @param \App\Entity\Advert $advert
     *
     * @return AdvertSkill
     */
    public function setAdvert(Advert $advert): AdvertSkill
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert.
     *
     * @return \App\Entity\Advert
     */
    public function getAdvert(): Advert
    {
        return $this->advert;
    }

    /**
     * Set skill.
     *
     * @param \App\Entity\Skill $skill
     *
     * @return \App\Entity\AdvertSkill
     */
    public function setSkill(Skill $skill): AdvertSkill
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill.
     *
     * @return \App\Entity\Skill
     */
    public function getSkill(): Skill
    {
        return $this->skill;
    }
}