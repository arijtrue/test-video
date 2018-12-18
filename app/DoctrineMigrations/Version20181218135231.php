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
     */
    public function up(Schema $schema)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        for ($i = 1; $i <= $this->container->getParameter('test_user_amount'); $i++) {
            $userName = sprintf('user%d', $i);
            $user = $userManager->createUser();
            $user
                ->setUsername($userName)
                ->setEmail(sprintf('%s@gmail.com', $userName))
                ->setEnabled(true)
                ->setPlainPassword('111')
            ;
            $userManager->updateUser($user);
        }
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function down(Schema $schema)
    {
        $this->addSql('DELETE FROM `fos_user`');
    }
}
