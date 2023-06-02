<?php

class CRM_Civiparoisse_Formulaires_Config_SearchKitConfig0142 {

  public function run() {

    /**
     * @var CRM_Civiparoisse_SavedSearch_BaseParameter[] $reportParameters
     */
    $reportParameters=[
      new CRM_Civiparoisse_Formulaires_Form_FormulaireQuartier(),
      ];

    foreach($reportParameters as $reportParameter)
    {
        $reportParameter->installSaveSearchAndDisplay();
      }
  }
   



}
