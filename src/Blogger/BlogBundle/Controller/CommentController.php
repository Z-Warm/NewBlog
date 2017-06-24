<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    /**
     * @param $blog_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }
    /**
     * Show new Comments
     */
    public function newAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);
        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(new CommentType(), $comment);
        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }
    /**
     * Create new Comments
     */
    public function createAction(Request $request, $blog_id)
    {
        return new JsonResponse('no results found', Response::HTTP_NOT_FOUND);
        if ($request->isXmlHttpRequest()) {
            $response = new Response();
            $myData = array("ddd", "ddd2", $blog_id);
            $data = json_encode($myData);

            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($data);

            /*$blog = $this->getBlog($blog_id);
            $comment  = new Comment();
            $comment->setBlog($blog);
            $form    = $this->createForm(new CommentType(), $comment);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()
                ->getManager();
                $em->persist($comment);
                $em->flush();

            return $this->redirect($this->generateUrl('BloggerBlogBundle_blog_show', array(
                    'id' => $comment->getBlog()->getId())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('BloggerBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
         ));
            */
        }
        return new JsonResponse('no results found', Response::HTTP_NOT_FOUND);
    }

    public function ajaxcreateAction(Request $request){
       //$output=array();
        $em = $this->getDoctrine()->getEntityManager();
        if ($request->isXmlHttpRequest()) {
         //   $themes = $em->getRepository('WebSiteBackBundle:theme');
          //  $themes = $themes->findAll();
          //  foreach ($themes as $theme){
//
            //    $output[]=array($theme->getId(),$theme->getName());
           // }
            /*   var_dump($themes);
               $json = json_encode($themes);

               $response = new Response();*/
            //            return $response->setContent($json);
            //$blog_id = $request->request->get('blogId');
            $blog_id = 10;
            //$requestform = $request->request->get('form');
            //$blog_id = 10;
            //$blog = $this->getBlog($blog_id);
            /*

            */
            $blog = $this->getBlog($blog_id);

            $comment  = new Comment();
            $comment->setBlog($blog);
            $form    = $this->createForm(new CommentType(), $comment);
           // $form->handleRequest($request->get('form'));
            $validform = false;

            if ($form->isValid()) {
                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($comment);
                $em->flush();
                $validform = true;

            }

            $response = new Response();
            $myData = array("ddd", "ddd2", $blog_id, $validform,$_POST);
            $data = json_encode($myData);

            $response->headers->set('Content-Type', 'application/json');
            $response->setContent($data);

            return $response;

        }
        return new JsonResponse('no results found', Response::HTTP_NOT_FOUND);
    }
}

