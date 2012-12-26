<?php

namespace Bacardi55\CvgeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bacardi55\CvgeneratorBundle\Entity\Cv;
use Bacardi55\CvgeneratorBundle\Form\CvForm;
use Bacardi55\CvgeneratorBundle\Repository\CvRepository;
use Symfony\Component\HttpFoundation\Response;

class CvController extends Controller{

  public function indexAction(){
    $em = $this->getDoctrine()->getEntityManager();
    $cvs = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->findAll();

    $is_admin = $this->get('security.context')->isGranted('ROLE_ADMIN');

    return $this->render('Bacardi55CvgeneratorBundle:Cv:index.html.twig',
      array(
        'cvs' => $cvs,
        'is_admin' => $is_admin
      ));
  }

  public function seeAction($id, $export = false){
    $cv = new Cv();

    $em = $this->getDoctrine()->getEntityManager();
    $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);

    $is_admin = $this->get('security.context')->isGranted('ROLE_ADMIN');

    $form = $this->generateOrderForm($cv, array());

    if ($export == 'pdf') {
      $html = $this->renderView('Bacardi55CvgeneratorBundle:Cv:see.html.twig',
        array('cv' => $cv, 'form' => $form->createView(), 'pdf' => true)
      );

      $u = $this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $cv->getId()));

      return new Response(
        $this->get('knp_snappy.pdf')->getOutput($this->getRequest()->getHost() . $u),
        200,
        array('Content-Type'          => 'application/pdf',
              'Content-Disposition'   => 'attachment; filename="'. $cv->getTitle() .'.pdf"'
        )
      );
    }
    else {
      return $this->render('Bacardi55CvgeneratorBundle:Cv:see.html.twig',
        array('cv' => $cv, 'form' => $form->createView(), 'is_admin' => $is_admin)
      );
    }
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

  public function reorderAction($id) {
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $status = false;

    if($this->get('request')->isXmlHttpRequest()) {
      $request = $this->get('request');
      $cv = new Cv();

      $em = $this->getDoctrine()->getEntityManager();
      $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);

      $form = $this->generateOrderForm($cv);
      $form->bindRequest($request);
      $data = $form->getData();

      // Set weight for each category
      foreach($cv->getCategories() as $category) {
        $field_name = 'category_' . $category->getId();
        $category->setWeight($data[$field_name]);
      }
      $em->persist($cv);
      $em->flush();
      $status = true;
    }

    $rep = json_encode(array('success' => $status));
    $response->setContent($rep);
    return $response;
  }

  /**
   * Create hidden form for reorder categories
   */
  private function generateOrderForm($cv, Array $defaultData = array()) {
    $form = $this->createFormBuilder($defaultData);

    foreach($cv->getCategories() as $cat){
      $form->add('category_' . $cat->getId(), 'hidden');
    }

    return $form->getForm();
  }
}
