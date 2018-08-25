<?php

namespace AppBundle\Controller\Post;


use AppBundle\Entity\FavoriteVote;
use AppBundle\Entity\LikeVote;
use AppBundle\Entity\Post;
use AppBundle\Extension\Twig\NumberResizeExtension;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VotingController extends Controller
{
    public function voteLikePostAction(Request $request, Post $post, NumberResizeExtension $extension)
    {
        $this->get('app.business.request')->allowAjaxRequestOnly();

        $vote = new LikeVote();
        $vote
            ->setPost($post)
            ->setUser($this->getUser())
            ->setUserIp($request->getClientIp());

        if(!$this->get('app.business.vote')->isVoteValid($vote)) {
            return new JsonResponse('Already voted', 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($vote);
        $em->flush();

        return new JsonResponse(array(
            'votes' => $extension->resizeNumber(count($post->getLikeVotes())),
        ));
    }

    public function voteFavoritePostAction(Request $request, Post $post, NumberResizeExtension $extension)
    {
        $this->get('app.business.request')->allowAjaxRequestOnly();

        $vote = new FavoriteVote();
        $vote
            ->setPost($post)
            ->setUser($this->getUser())
            ->setUserIp($request->getClientIp());

        if(!$this->get('app.business.vote')->isVoteValid($vote)) {
            return new JsonResponse('Already voted to this post', 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($vote);
        $em->flush();

        return new JsonResponse(array(
            'votes' => $extension->resizeNumber(count($post->getFavoriteVotes())),
        ));
    }

    public function removeVoteFavoritePostAction(Request $request, Post $post, NumberResizeExtension $extension)
    {
        $this->get('app.business.request')->allowAjaxRequestOnly();

        $vote = $this->get('app.business.vote')->getUserFavoriteVotePost($post);

        if(!$vote) {
            return new JsonResponse('Not voted yet', 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($vote);
        $em->flush();

        return new JsonResponse(array(
            'votes' => $extension->resizeNumber(count($post->getFavoriteVotes())),
        ));
    }

    public function removeVoteLikePostAction(Request $request, Post $post, NumberResizeExtension $extension)
    {
        $this->get('app.business.request')->allowAjaxRequestOnly();

        $vote = $this->get('app.business.vote')->getUserLikeVotePost($post);

        if(!$vote) {
            return new JsonResponse('Not voted yet', 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($vote);
        $em->flush();

        return new JsonResponse(array(
            'votes' => $extension->resizeNumber(count($post->getLikeVotes())),
        ));
    }
}
