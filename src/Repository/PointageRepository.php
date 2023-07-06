<?php

namespace App\Repository;

use App\Entity\Pointage;
use DateTime;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method Pointage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointage[]    findAll()
 * @method Pointage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointageRepository extends ServiceEntityRepository
{
    /**
     * PointageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointage::class);
    }

    /**
     * @param $date
     * @return Criteria
     * @throws Exception
     */
    public static function semaineCriteria($date): Criteria
    {
        $date = new DateTime($date);
        $monday = clone $date->modify(('Sunday' == $date->format('l')) ? 'Monday last week' : 'Monday this week');
        $sunday = clone $date->modify('Sunday this week');
        return Criteria::create()
            ->andWhere(Criteria::expr()->gte('date',$monday))
            ->andWhere(Criteria::expr()->lte('date',$sunday))
            ->orderBy(['id' => 'DESC'])
            ;
    }

    /**
     * @param DateTimeInterface $date
     * @return Criteria
     */
    public static function jourCriteria(DateTimeInterface $date): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('date',$date))
            ->orderBy(['id' => 'DESC'])
            ;
    }
}