<?php

namespace Blogger\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    public function getCommentsForBlog($blogId, $approved = true)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.blog = :blog_id')
            ->addOrderBy('c.create_at')
            ->setParameter('blog_id', $blogId);

        return $qb->getQuery()
            ->getResult();
    }
}