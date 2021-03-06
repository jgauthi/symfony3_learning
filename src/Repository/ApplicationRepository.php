<?php
namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * ApplicationRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    // Retrieve the last X applications with their associated adverts
    public function getApplicationsWithAdvert(int $limit): array
    {
        $qb = $this->createQueryBuilder('app');

        $qb->innerJoin('app.advert', 'adv')->addSelect('adv');

        $qb->orderBy('app.date', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }
}
