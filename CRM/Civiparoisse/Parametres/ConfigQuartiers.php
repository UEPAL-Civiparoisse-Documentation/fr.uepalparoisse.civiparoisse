<?php

class CRM_Civiparoisse_Parametres_ConfigQuartiers extends CRM_Civiparoisse_Parametres_ConfigQuartiersTools {

  public static function modifyExistingQuartiers0140() {

    $quartiersAModifier = [
      ['labelNew' => 1, 'value' => 1, 'name' => 'Quartier_01', 'description' => 'Quartier 01', 'labelOld' => 'Nord'],
      ['labelNew' => 2, 'value' => 2, 'name' => 'Quartier_02', 'description' => 'Quartier 02', 'labelOld' => 'Sud'],
      ['labelNew' => 3, 'value' => 3, 'name' => 'Quartier_03', 'description' => 'Quartier 03', 'labelOld' => 'Est'],
      ['labelNew' => 4, 'value' => 4, 'name' => 'Quartier_04', 'description' => 'Quartier 04', 'labelOld' => 'Ouest'],
    ];

    foreach ($quartiersAModifier as $key => $value) {
      CRM_Civiparoisse_Parametres_ConfigQuartiersTools::modifyExistingQuartiers($value);
    }

  }

  public static function createNewQuartiers0140() {
    for ($i=5; $i <= 50; $i++) { 
      CRM_Civiparoisse_Parametres_ConfigQuartiersTools::createNewQuartiers($i);
    }  
  }

}