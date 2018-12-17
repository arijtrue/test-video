<?php

namespace SiteDevel\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteDevelVideoBundle:Default:index.html.twig');
    }
}
