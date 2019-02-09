<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * CategoryRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @param string $pattern
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