<?php 

namespace Bacardi55\CvgeneratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CategoryForm extends AbstractType{

  public function buildForm(FormBuilder $builder, array $options){ 
    $builder->add('title', 'text', array('label' => 'Title : '));
  }

  public function getName(){
    return 'Category';
  }

  public function getDefaultOptions(array $options){
    return array(
      'data_class' => 'Bacardi55\CvgeneratorBundle\Entity\Category',
    );
  }

}
