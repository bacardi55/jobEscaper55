<?php 

namespace Bacardi55\CvgeneratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ElementForm extends AbstractType{

  public function buildForm(FormBuilder $builder, array $options){ 
    $date_pattern = 'd-M-y';
    $years = array();
    for($i = 0; $i < 40; $i++)
      $years[] = date('Y') - $i;

    $builder->add('title', 'text', array('label' => 'element.title', 'required' => false));
    $builder->add('startDate', 'date', 
      array('label' => 'element.startDate', 
            'required' => false, 
            'years' => $years, 
            'pattern' => $date_pattern
      ));
    $builder->add('endDate', 'date', array('label' => 'element.endDate', 'required' => false, 'years' => $years));
    $builder->add('text', 'textarea', array('label' => 'element.text'));
  }

  public function getName(){
    return 'Element';
  }

  public function getDefaultOptions(array $options){
    return array(
      'data_class' => 'Bacardi55\CvgeneratorBundle\Entity\Element',
    );
  }

}

