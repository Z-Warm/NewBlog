<?php

/**
 * Created by PhpStorm.
 * User: YZub
 * Date: 09.06.2017
 * Time: 11:31
 */
namespace Blogger\BlogBundle\Entity\Repository;

class BlogRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLatestBlogs($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->addOrderBy('b.name', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }
}
