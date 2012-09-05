<?php 
# Fichier cv_generator/src/Bacardi55/CvGeneratorBundle/DataFixtures/ORM/LoadingFixtures.php

namespace Bacardi55\CvgeneratorBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;

use Bacardi55\CvgeneratorBundle\Entity\Cv;
use Bacardi55\CvgeneratorBundle\Entity\Category;
use Bacardi55\CvgeneratorBundle\Entity\Element;

class LoadingFixtures implements FixtureInterface{

  public function load($manager){

    // FORMATION
    $bac = new Element();
    $bac->setStartDate(new \Datetime());
    $bac->setEndDate(new \Datetime());
    $bac->setText('BAC');
    
    $manager->persist($bac);

    $efrei = new Element();
    $efrei->setStartDate(new \Datetime());
    $efrei->setEndDate(new \Datetime());
    $efrei->setText('EFREI');
    
    $manager->persist($efrei);
    //$manager->flush();

    $formation  = new Category();
    $formation->setTitle('Formation');
    $formation->addElements($bac);
    $formation->addElements($efrei);
    
    $manager->persist($formation);
    $manager->flush();

    $bac->setCategory($formation);
    $efrei->setCategory($formation);

    $manager->flush();
    
    // EXPERIENCE
    $alti = new Element();
    $alti->setStartDate(new \Datetime());
    $alti->setEndDate(new \Datetime());
    $alti->setText('ALTI');
 
    $manager->persist($alti);
  
    $iac = new Element();
    $iac->setStartDate((new \Datetime));
    $iac->setEndDate(new \Datetime());
    $iac->setText('IAC');
    
    $manager->persist($iac);
   
    $linagora = new Element();
    $linagora->setStartDate(new \Datetime());
    $linagora->setEndDate(new \Datetime());
    $linagora->setText('LINAGORA');
    
    $manager->persist($linagora);
    $manager->flush();

    $experience = new Category();
    $experience->setTitle('EXPERIENCE');
    $experience->addElements($alti);
    $experience->addElements($iac);
    $experience->addElements($linagora);
    
    $manager->persist($experience);
    $manager->flush();
    
    $alti->setCategory($experience);
    $iac->setCategory($experience);
    $linagora->setCategory($experience);
    
    $anglais = new Element();
    $anglais->setStartDate(new \Datetime());
    $anglais->setEndDate(new \Datetime());
    $anglais->setTitle('ANGLAIS');
    $anglais->setText('Courant');
    
    $manager->persist($anglais);
    $manager->flush();

    $langue = new Category();
    $langue->setTitle('LANGUE');
    $langue->addElements($anglais);

    $manager->persist($langue);
    $manager->flush();

    $anglais->setCategory($langue);
    $manager->flush();

    $cv = new Cv();
    $cv->setTitle('Mon Beau CV');
    $cv->setIsTitleDisplayed(false);
    $cv->addCategories($experience);
    $cv->addCategories($formation);
    $cv->addCategories($langue);

    $manager->persist($cv);
    $manager->flush();

    $langue->setCv($cv);
    $experience->setCv($cv);
    $formation->setCv($cv);

    $manager->flush();
  }

}
