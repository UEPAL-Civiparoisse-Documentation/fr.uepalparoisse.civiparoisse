<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_MappingConfig0141 {

 /**
  * @var array $mappingsToCreate Liste des mapping à créer
  */
  public static function run() {

    $mappingsToCreate = [
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyers(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyersNotes(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContacts(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsNotes(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdhesions(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsConjoints(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsParents(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsFratries(),
      new CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdresses(),
    ];
    
    foreach ($mappingsToCreate as $mapToCreate) {
      $mapToCreate->installSaveMapping();
    }

  }




}
