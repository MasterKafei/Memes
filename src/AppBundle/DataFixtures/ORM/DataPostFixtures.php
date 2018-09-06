<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\File;
use AppBundle\Entity\Image;
use AppBundle\Entity\Post;
use AppBundle\Service\Util\Downloader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Filesystem\Filesystem;

class DataPostFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        $this->removeUploadFolder();

        for($i = 1; $i <= 18; ++$i) {
            $post = $this->createPost("https://craaftx.github.io/Memes/assets/img/$i.jpg");
            $manager->persist($post);
        }

        $manager->flush();
    }

    private function removeUploadFolder()
    {
        $fileSystem = new Filesystem();
        $fileSystem->remove($this->container->getParameter('upload.file.directory'));
    }

    public function getOrder()
    {
        return 0;
    }

    private function createPost($imageUrl)
    {
        $extension = pathinfo($imageUrl)['extension'];
        $name = Downloader::downloadFileFromUrl($imageUrl, $this->container->getParameter('upload.file.directory'), $extension);

        $post = new Post();
        $content = new Image();
        $content->setFile((new File())->setPath($name . '.' . $extension));
        $post
            ->setContent($content)
            ->setPublished(true);

        return $post;
    }
}
