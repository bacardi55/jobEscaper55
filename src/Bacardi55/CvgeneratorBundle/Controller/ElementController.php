<?php

namespace Bacardi55\CvgeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bacardi55\CvgeneratorBundle\Entity\Element;
use Bacardi55\CvgeneratorBundle\Form\ElementForm;
use Bacardi55\CvgeneratorBundle\Repository\CvRepository;

class ElementController extends Controller{

  public function addAction($id, $cat_id, $element_id = null){
    $em = $this->getDoctrine()->getEntityManager();
    
    $element = $element_id? $em->getRepository('Bacardi55CvgeneratorBundle:Element')->find($element_id) : new Element();

    if(!$id || !$cat_id){
      return $this->redirect('Bacardi55CvgeneratorBundle_homepage');
    }
    else{
      $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);
      $category = $em->getRepository('Bacardi55CvgeneratorBundle:Category')->find($cat_id);

      if(!$cv || !$category)
        return $this->redirect('Bacardi55CvgeneratorBundle_homepage');

      $title = 'Add an entry to the cv «'. $cv->getTitle() .'», in the category «'. $category->getTitle() .'»';

      $element->setCategory($category);
    }

    $form = $this->createForm(new ElementForm(), $element);
    
    if($this->get('request')->getMethod() == 'POST'){
      $form->bindRequest($this->get('request'));

      /* Si le formulaire est valide, on valide et on redirige vers la liste des genres */
      if($form->isValid()){
        $em->persist($element);
        $em->flush();

        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));
      }
    }

    return $this->render('Bacardi55CvgeneratorBundle:Element:add.html.twig', 
      array('element' => $element, 'form' => $form->createView(), 'title' => $title, 'cv_id' => $id)
    );
  }

  public function deleteAction($id, $cat_id, $element_id){
    if(!$id || !$cat_id || !$element_id)
      return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_homepage'));

    $em = $this->getDoctrine()->getEntityManager();
    $element = $em->getRepository('Bacardi55CvgeneratorBundle:Element')->find($element_id);

    $em->remove($element);
    $em->flush();

    return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));
  }

}
