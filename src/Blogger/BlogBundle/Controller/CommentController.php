<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Entity\CategComment;
use Blogger\BlogBundle\Form\CommentType;
use Blogger\BlogBundle\Form\CategCommentType;
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
     * @param $category_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getCategory($category_id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('BloggerBlogBundle:Category')->find($category_id);
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category.');
        }
        return $category;
    }	
	
	
    /**
     * Show new Comments
     */
    public function newAction($blog_id)
    {
		//if($blog_id<0){$blog_id = -$blog_id;}
        $blog = $this->getBlog($blog_id);
        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(new CommentType());
        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));	
    }
	
    public function new2Action($blog_id)
    {
		$category_id = $blog_id;
		//if($blog_id<0){$blog_id = -$blog_id;}
        $category = $this->getCategory($category_id);
        $comment = new CategComment();
        $comment->setCategory($category);
        $form   = $this->createForm(new CategCommentType());
        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));	
    }	
	
	
	
    /**
     * Create new Comments
     */
	 /*
    public function createAction(Request $request, $blog_id)
    {
        if ($request->isXmlHttpRequest()) {
			$em = $this->getDoctrine()->getEntityManager();
            $blog = $this->getBlog($blog_id);        
			$comment  = new Comment();
            $comment->setBlog($blog);
            $form    = $this->createForm(new CommentType(), $comment);
            $form->handleRequest($request);
			
            if ($form->isValid()) {
                /*Insert data and commit:/
				$em->persist($comment);
                $em->flush();
				/*Sending response:/
				$response = new Response();
				$myData = ("Adde successfull!");
				$data = json_encode($myData);
				$response->headers->set('Content-Type', 'application/json');
				$response->setContent($data);
				return $response;		
			}		
        }
        return new JsonResponse('no results found', Response::HTTP_NOT_FOUND);
    }
	*/
	    public function create2Action(Request $request, $blog_id)
    {
				
        if ($request->isXmlHttpRequest()) {
							/*Sending response:*/
	
			
			$em = $this->getDoctrine()->getEntityManager();
            $category = $this->getCategory($blog_id);        
			$comment  = new CategComment();
            $comment->setCategory($category);
            $form    = $this->createForm(new CategCommentType(), $comment);
            $form->handleRequest($request);
				
				$content = $comment->getContent();
				$author = $comment->getAuthor();
				$categ_id = $comment->getCategory()->getID();
				$create_at = $comment->getCreateAt();
				//$comment->setCreateAt(new \DateTime());
				$response = new Response();
				$myData = ("categ_id=".$categ_id.";".$content.";".$author."create_at=".$create_at->format('Y-m-d H:i:s'));
				$data = json_encode($myData);
				$response->headers->set('Content-Type', 'application/json');
				$response->setContent($data);
				
				
				
            if ($form->isValid()) {
				
			//return $response;
				
                /*Insert data and commit:*/
				$em->persist($comment);
                $em->flush();
				
				/*Sending response:*/
				//$response = new Response();
				//$myData = ($comment);
				//$data = json_encode($myData);
				//$response->headers->set('Content-Type', 'application/json');
				//$response->setContent($data);
				return $response;		
			}		
        }
        return new JsonResponse('no results found', Response::HTTP_NOT_FOUND);
    }
}

