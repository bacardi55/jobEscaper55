<?php

namespace Bacardi55\CvgeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bacardi55\CvgeneratorBundle\Entity\Cv;

class CvController extends Controller{

  public function indexAction(){
    $cvs = $this->getDoctrine()->getRepository('Bacardi55CvgeneratorBundle:Cv')->findAll();
    return $this->render('Bacardi55CvgeneratorBundle:Cv:index.html.twig', array('cvs' => $cvs));
  }

  public function seeAction($id){
    $cv = new Cv();

    return $this->render('Bacardi55CvgeneratorBundle:Cv:see.html.twig', array('cv' => $cv));
  }

}
