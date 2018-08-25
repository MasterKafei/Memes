<?php

namespace AppBundle\Controller\Post;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListingController extends Controller
{
    const NEWS_CATEGORY_NAME = 'news';
    const HOT_CATEGORY_NAME = 'hot';
    const RISE_CATEGORY_NAME = 'rise';
    const FAVORITE_CATEGORY_NAME = 'favorite';

    const ALL_TIME_PERIOD_KEY = 'all_time';
    const THIS_YEAR_PERIOD_KEY = 'this_year';
    const THIS_MONTH_PERIOD_KEY = 'this_month';
    const THIS_WEEK_PERIOD_KEY = 'this_week';
    const TODAY_PERIOD_KEY = 'today';

    const PERIOD_KEY = 'period';
    const DEFAULT_PERIOD_KEY = self::ALL_TIME_PERIOD_KEY;
    const DEFAULT_CATEGORY_KEY_NAME = self::NEWS_CATEGORY_NAME;

    public function listMostLatestPostAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostLatestPublished();

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
            'category' => self::NEWS_CATEGORY_NAME,
        ));
    }

    public function listMostLikedPostAction()
    {
        $request = $this->get('request_stack')->getMasterRequest();

        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostLikedPublished(array(
            'period' => $request->query->get(self::PERIOD_KEY, self::DEFAULT_PERIOD_KEY),
        ));

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
            'category' => self::HOT_CATEGORY_NAME,
        ));
    }

    public function listMostFavoritePostAction()
    {
        $request = $this->get('request_stack')->getMasterRequest();

        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostFavoritePublished(array(
            'period' => $request->query->get(self::PERIOD_KEY, self::DEFAULT_PERIOD_KEY),
        ));

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
            'category' => self::FAVORITE_CATEGORY_NAME,
        ));
    }

    public function listMostRisingPostAction()
    {
        $request = $this->get('request_stack')->getMasterRequest();

        $posts = $this->getDoctrine()->getRepository(Post::class)->findMostRisingPublished(array(
            'period' => $request->query->get(self::PERIOD_KEY, self::DEFAULT_PERIOD_KEY),
        ));

        return $this->render('@Page/Post/Listing/published.html.twig', array(
            'posts' => $posts,
            'category' => self::RISE_CATEGORY_NAME,
        ));
    }
}