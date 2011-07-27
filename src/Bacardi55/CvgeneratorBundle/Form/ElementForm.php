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

    $builder->add('title', 'text', array('label' => 'Titre de l\'élément : ', 'required' => false));
    $builder->add('startDate', 'date', 
      array('label' => 'Date de début : ', 
            'required' => false, 
            'years' => $years, 
            'pattern' => $date_pattern
      ));
    $builder->add('endDate', 'date', array('label' => 'Date de fin : ', 'required' => false, 'years' => $years));
    $builder->add('text', 'textarea', array('label' => 'Texte : '));
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

