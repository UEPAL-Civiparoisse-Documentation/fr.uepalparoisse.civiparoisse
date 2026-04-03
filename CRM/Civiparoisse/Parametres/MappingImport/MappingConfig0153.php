<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_MappingConfig0153 {

 /**
  * @var array $mappingsToCreate Liste des mapping à créer
  */
  public static function run() {

    $mappingsToCreate = [
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdresses2(),
    ];
    
    foreach ($mappingsToCreate as $mapToCreate) {
      $mapToCreate->installSaveMapping();
    }

  }




}
