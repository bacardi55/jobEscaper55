<?php

namespace Bacardi55\CvgeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name = null)
    {
        return $this->render('Bacardi55CvgeneratorBundle:Default:index.html.twig', array('name' => $name));
    }
}
