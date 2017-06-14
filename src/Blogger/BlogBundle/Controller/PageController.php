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
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $categoryes = $em->getRepository('BloggerBlogBundle:Category')
            ->getLatestCategoryes();

        return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
            'categoryes' => $categoryes
        ));
    }

  public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

}
?>