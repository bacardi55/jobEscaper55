<?php

namespace Bacardi55\CvgeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bacardi55\CvgeneratorBundle\Entity\Cv;
use Bacardi55\CvgeneratorBundle\Form\CvForm;
use Bacardi55\CvgeneratorBundle\Repository\CvRepository;

class CvController extends Controller{

  public function indexAction(){
    $em = $this->getDoctrine()->getEntityManager();
    $cvs = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->findAll();

    return $this->render('Bacardi55CvgeneratorBundle:Cv:index.html.twig', array('cvs' => $cvs));
  }

  public function seeAction($id){
    $cv = new Cv();

    $em = $this->getDoctrine()->getEntityManager();
    $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);
    //$cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->getCv($id);

    return $this->render('Bacardi55CvgeneratorBundle:Cv:see.html.twig', array('cv' => $cv));
  }

  public function addAction($id = null){
    $cv = new Cv();
    $em = $this->getDoctrine()->getEntityManager();

    if($id){
      $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);
      $title = $this->get('translator')->trans('cv.edit');
    }
    else{
      $title = $this->get('translator')->trans('cv.new');
    }

    $form = $this->createForm(new CvForm(), $cv);
    
    if($this->get('request')->getMethod() == 'POST') {
      $form->bindRequest($this->get('request'));

      /* Si le formulaire est valide, on valide et on redirige vers la liste des genres */
      if($form->isValid()){
        $em->persist($cv);
        $em->flush();

        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $cv->getId())));
      }
    }

    return $this->render('Bacardi55CvgeneratorBundle:Cv:add.html.twig', 
      array('cv' => $cv, 'form' => $form->createView(), 'title' => $title)
    );
  }

  public function deleteAction($id){
    if(!$id)
      return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_homepage'));

    $em = $this->getDoctrine()->getEntityManager();
    $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);

    foreach($cv->getCategories() as $category){
      foreach($category->getElements() as $element){
        $em->remove($element);
      }

      foreach($category->getChildrenCategories() as $sub_category){
        $em->remove($sub_category);
      }
      $em->remove($category);
    }

    $em->remove($cv);
    $em->flush();

    return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_homepage'));
  }
}
