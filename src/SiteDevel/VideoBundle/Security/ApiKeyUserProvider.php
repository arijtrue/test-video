<?php

namespace SiteDevel\VideoBundle\Security;

use Doctrine\ORM\EntityManagerInterface;
use SiteDevel\UserBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $token
     * @return string|null
     */
    public function getUsernameForApiKey($token)
    {
        $entity = $this->em->getRepository('SiteDevelUserBundle:User')->findOneBy(['password' => $token]);

        if (!$entity) {
            return null;
        }

        return $entity->getUsername();
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function loadUserByUsername($username)
    {
        return $this->em->getRepository('SiteDevelUserBundle:User')->findOneBy(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $class === User::class;
    }

}
