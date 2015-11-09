<?php
/**
 * Created by PhpStorm.
 * User: kendoctor
 * Date: 15/11/1
 * Time: 上午6:41
 */

namespace Kendoctor\Bundle\AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class GroupRepository extends EntityRepository {
    /**
     * @param $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createIndexQueryBuilder($criteria)
    {
        $qb = $this->createQueryBuilder('o');


        return $qb;
    }

    public function getById($id)
    {
        $qb = $this->createQueryBuilder('o');

        $qb
            ->where('o.id = :id')
            ->setParameter('id' , $id)
        ;
        return $qb->getQuery()->getOneOrNullResult();
    }
}