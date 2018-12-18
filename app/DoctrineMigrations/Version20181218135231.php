<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManager;
use SiteDevel\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20181218135231 extends AbstractMigration implements ContainerAwareInterface
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
        $em = $this->getEntityManager();

        for ($i = 1; $i <= $this->container->getParameter('test_user_amount'); $i++) {
            $userName = sprintf('user%d', $i);
            $user = new User();
            $user
                ->setUsername($userName)
                ->setEmail(sprintf('%s@gmail.com', $userName))
                ->setEnabled(true)
                ->setPlainPassword('111')
            ;
            $em->persist($user);
        }

        $em->flush();
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function down(Schema $schema)
    {
        $em = $this->getEntityManager();

        foreach ($em->getRepository('SiteDevelUserBundle:User')->findAll() as $user) {
            $em->remove($em);
        }

        $em->flush();
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->container->get('doctrine.orm.default_entity_manager');
    }
}
