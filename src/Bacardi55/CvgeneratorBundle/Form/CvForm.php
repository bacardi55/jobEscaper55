<?php 

namespace Bacardi55\CvgeneratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CvForm extends AbstractType{

  public function buildForm(FormBuilder $builder, array $options){
    $builder->add('title', 'text', array('label' => 'cv.titre'));
    $builder->add('isTitleDisplayed', 'checkbox', array('required' => false, 'label' => 'cv.afficher'));
  }

  public function getName(){
    return 'Cv';
  }

  public function getDefaultOptions(array $options){
    return array(
      'data_class' => 'Bacardi55\CvgeneratorBundle\Entity\Cv',
    );
  }

}
