<?php

namespace AppBundle\Controller\Admin\Post;

use AppBundle\Entity\Post;
use AppBundle\Form\Type\Admin\Image\Creation\CreationImageType;
use AppBundle\Form\Type\Admin\Post\Creation\CreationPostType;
use AppBundle\Form\Type\Admin\Video\Creation\CreationVideoType;
use AppBundle\Form\Type\Admin\YoutubeLink\Creation\CreationYoutubeLinkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreationController extends Controller
{
    public function createImagePostAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(CreationPostType::class, $post, array('content_form_type' => CreationImageType::class));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_admin_post_listing_list_post');
        }

        return $this->render('@Page/Admin/Post/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createVideoPostAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(CreationPostType::class, $post, array('content_form_type' => CreationVideoType::class));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_admin_post_listing_list_post');
        }

        return $this->render('@Page/Admin/Post/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createYoutubeLinkAction(Request $request)
    {

        $post = new Post();

        $form = $this->createForm(CreationPostType::class, $post, array('content_form_type' => CreationYoutubeLinkType::class));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_admin_post_listing_list_post');
        }

        return $this->render('@Page/Admin/Post/Creation/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
