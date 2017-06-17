<?php
/**
 * Created by PhpStorm.
 * User: YZub
 * Date: 08.06.2017
 * Time: 9:13
 */
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Blog controller.
 */
class CategoryesController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BloggerBlogBundle:Categoryes')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Categoryes.');
        }

        return $this->render('BloggerBlogBundle:Categoryes:show.html.twig', array(
            'blog'      => $categoryes,
        ));
    }
}