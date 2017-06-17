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
use Blogger\BlogBundle\Entity\Category;
use Blogger\BlogBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Blog controller.
 */
class CategoryController extends Controller
{
    /**
     * Show a category entry
    */
    public function categoryshowAction($id)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $category = $em->getRepository('BloggerBlogBundle:Category')->find($id);
        $blogs = $em->getRepository('BloggerBlogBundle:Blog')
            ->getLatestBlogsByCategory($id);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BloggerBlogBundle:Category:show.html.twig', array(
            'category' => $category,
            'blogs' => $blogs
        ));
    }
    public function newAction()
    {
        $category = new Category();
        $form   = $this->createForm(new CategoryType(), $category);
        return $this->render('BloggerBlogBundle:Category:form.html.twig', array(
            'category' => $category,
            'form'   => $form->createView()
        ));
    }

    public function createAction(Request $request)
    {
        $category  = new Category();
        $form    = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect($this->generateUrl('BloggerBlogBundle_homepage')
            );
        }
        return $this->render('BloggerBlogBundle:Blog:create.html.twig', array(
            'category' => $category,
            'form'    => $form->createView()
        ));
    }

}