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
class CategoryController extends Controller
{
    /**
     * Show a blog entry
     */
    public function showAction($category)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('BloggerBlogBundle:Category')->find($category);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category.');
        }

        return $this->render('BloggerBlogBundle:Category:show.html.twig', array(
            'categoryes' => $category,
        ));
    }
}