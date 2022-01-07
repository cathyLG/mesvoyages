<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests;

use App\Entity\Visite;
use PHPUnit\Framework\TestCase;
use App\Entity\Environnement;

/**
 * Description of VisiteTest
 *
 * @author Xiaoxiao
 */
class VisiteTest extends TestCase {

    public function testGetDatecreationString() {
        $visite = new Visite();
        $visite->setDatecreation(new \DateTime('1992-02-13'));
        $this->assertEquals('13/02/1992', $visite->getDatecreationString());
    }
    
    public function testAddEnvironnement(){
        $environnement = new Environnement();
        $environnement->setNom("plage");
        $visite = new Visite();
        $visite->addEnvironnement($environnement);
        $nbEnvironnementAvant = $visite->getEnvironnements()->count();
        $visite->addEnvironnement($environnement);
        $nbEnvironnementApres = $visite->getEnvironnements()->count();
        $this->assertEquals($nbEnvironnementAvant, $nbEnvironnementApres, "ajout même environnement devrait échouer");
    }

}
