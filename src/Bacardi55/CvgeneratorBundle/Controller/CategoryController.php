<?php 

namespace Bacardi55\CvgeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bacardi55\CvgeneratorBundle\Entity\Category;
use Bacardi55\CvgeneratorBundle\Form\CategoryForm;
use Bacardi55\CvgeneratorBundle\Form\SubCategoryForm;
use Bacardi55\CvgeneratorBundle\Repository\CategoryRepository;

class CategoryController extends Controller{

  /* ******** */
  /* Category */
  /* ******** */
  public function addAction($id, $cat_id = null){
    $em = $this->getDoctrine()->getEntityManager();
    
    $category = $cat_id? $em->getRepository('Bacardi55CvgeneratorBundle:Category')->find($cat_id)
      : new Category();

    if(!$id){
      return $this->redirect('Bacardi55CvgeneratorBundle_homepage');
    }
    else{
      $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);
      $category->setCv($cv);

      if($category->getId()){
        $title = $this->get('translator')->trans('category.edit');
      }
      else{
        $title = $this->get('translator')->trans('category.add %cvTitle%', array('%cvTitle%' => $cv->getTitle()));
      }
    }

    $form = $this->createForm(new CategoryForm(), $category);
    
    if($this->get('request')->getMethod() == 'POST') {
      $form->bindRequest($this->get('request'));

      /* Si le formulaire est valide, on valide et on redirige vers la liste des genres */
      if($form->isValid()){
        // Add default weight (add category in last)
        $category->setWeight(count($cv->getCategories()));
        $em->persist($category);
        $em->flush();

        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));
      }
    }

  
    return $this->render('Bacardi55CvgeneratorBundle:Category:add.html.twig', 
      array('category' => $category, 'form' => $form->createView(), 'title' => $title, 'cv_id' => $id
    ));

  }

  public function deleteAction($id, $cat_id){
    if(!$id || !$cat_id)
      return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_homepage'));

    $em = $this->getDoctrine()->getEntityManager();
    $category = $em->getRepository('Bacardi55CvgeneratorBundle:Category')->find($cat_id);

    foreach($category->getElements() as $element){
      $em->remove($element);
    }

    foreach($category->getChildrenCategories() as $sub_category){
      foreach($sub_category->getElements() as $element){
        $em->remove($element);
      }
      $em->remove($sub_category);
    }

    $em->remove($category);
    $em->flush();
    return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));
  }

  /* *** ******** */
  /* Sub Category */
  /* *** ******** */
  public function addSubCatAction($id, $p_cat_id, $sub_cat_id = null){
    $em = $this->getDoctrine()->getEntityManager();
    $sub_cat = $sub_cat_id? $em->getRepository('Bacardi55CvgeneratorBundle:Category')->find($sub_cat_id) : new Category();

    if(!$id || !$p_cat_id){
      if($id)
        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));
      else
        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_homepage'));
    }
    else{
      $cv = $em->getRepository('Bacardi55CvgeneratorBundle:Cv')->find($id);
      $parent_cat = $em->getRepository('Bacardi55CvgeneratorBundle:Category')->find($p_cat_id);

      if(!$parent_cat || !$cv)
        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));

      if($sub_cat->getId()){
        $title = $this->get('translator')->trans('category.sub.edit');
      }
      else{
        $title = $this->get('translator')->trans('category.sub.add %catParentTitle%', array('%catParentTitle%' => $parent_cat->getTitle()));
      }
      
      $sub_cat->setParentCategory($parent_cat);
      $sub_cat->setCv($cv);
    }

    $form = $this->createForm(new CategoryForm(), $sub_cat);
    
    if($this->get('request')->getMethod() == 'POST') {
      $form->bindRequest($this->get('request'));

      /* Si le formulaire est valide, on valide et on redirige vers la liste des genres */
      if($form->isValid()){
        $em->persist($sub_cat);
        $em->flush();

        return $this->redirect($this->generateUrl('Bacardi55CvgeneratorBundle_cv', array('id' => $id)));
      }
    }

    $action = '';

    return $this->render('Bacardi55CvgeneratorBundle:Category:add.html.twig', 
      array('category' => $sub_cat, 'form' => $form->createView(), 'title' => $title, 'cv_id' => $id, 
            'action' => $action
    ));


    
  }

}
