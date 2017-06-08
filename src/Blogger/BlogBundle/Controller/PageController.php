<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    //public function indexAction()
    //{
   //     return $this->render('BloggerBlogBundle:Page:index.html.twig');
   // }

    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $blogs = $em->createQueryBuilder()
            ->select('b')
            ->from('BloggerBlogBundle:Blog',  'b')
            ->addOrderBy('b.name', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }
}
?>