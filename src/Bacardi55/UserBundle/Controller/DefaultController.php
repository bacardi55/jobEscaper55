<?php

namespace Bacardi55\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('Bacardi55UserBundle:Default:index.html.twig', array('name' => $name));
    }
}
