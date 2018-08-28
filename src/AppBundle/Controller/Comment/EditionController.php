<?php

namespace AppBundle\Controller\Comment;


use AppBundle\Entity\Comment;
use AppBundle\Form\Type\Comment\Edition\EditionCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EditionController extends Controller
{
    public function editCommentAction(Request $request, Comment $comment)
    {
        $form = $this->createForm(EditionCommentType::class, $comment,
            array(
                'action' => $this->get('router')->generate('app_comment_edition_edit_comment',
                    array(
                        'id' => $comment->getId(),
                    )
                )
            ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        if ($this->get('app.business.request')->isMasterRequest()) {
            $this->redirect($this->get('app.business.request')->getSourceUrl());
        }

        return $this->render('@Page/Comment/Edition/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
