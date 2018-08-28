<?php

namespace AppBundle\Controller\Comment;


use AppBundle\Entity\Comment;
use AppBundle\Entity\Commentable;
use AppBundle\Form\Type\Comment\Creation\CreationCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createCommentAction(Request $request, Commentable $commentable)
    {
        $comment = new Comment();
        $form = $this->createForm(CreationCommentType::class, $comment,
            array(
                'action' => $this->get('router')->generate('app_comment_creation_create_comment',
                    array(
                        'id' => $commentable->getId()
                    )
                )
            ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTarget($commentable);
            $comment->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        if ($this->get('app.business.request')->isMasterRequest()) {
            return $this->redirect($this->get('app.business.request')->getSourceUrl());
        }

        return $this->render('@Page/Comment/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
