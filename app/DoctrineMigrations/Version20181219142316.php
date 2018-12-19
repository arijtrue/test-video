<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use SiteDevel\VideoBundle\Entity\Video;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20181219142316 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface|null $container
     */
    private $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function up(Schema $schema)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $users = $em->getRepository('SiteDevelUserBundle:User')->findAll();

        for ($i = 1; $i <= 20; $i++) {
            $videoTitle = 'Video ' . $i;
            $video = new Video();
            $video
                ->setTitle($videoTitle)
                ->setDescription($videoTitle . ' description')
                ->setYear(sprintf('19%02d', rand(20, 99)))
                ->setAddedBy($users[rand(0, count($users)-1)]);
            ;
            $em->persist($video);
        }

        $em->flush();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DELETE FROM `user_video_favourited`');
        $this->addSql('DELETE FROM `video`');
    }
}
