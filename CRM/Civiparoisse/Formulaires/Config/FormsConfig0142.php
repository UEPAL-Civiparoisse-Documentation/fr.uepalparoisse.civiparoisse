<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Formulaires_Config_FormsConfig0142 {

  public function run() {

    // création des formulaires
     $annivForm=new CRM_Civiparoisse_Reports_Config_Parameters_ProchainsAnniversaires();
     $annivForm->createSavedForm();

  }


}