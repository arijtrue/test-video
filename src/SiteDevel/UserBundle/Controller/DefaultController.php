<?php

namespace SiteDevel\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@SiteDevelUser/Default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
