<?php

class CRM_Civiparoisse_Reports_Config_SearchKitConfig0142 {

  public function run() {

/****
* RAPPORTS
****/
        /**
         * @var CRM_Civiparoisse_SavedSearch_BaseParameter[] $reportsParameters
         */
        $reportsParameters = [
            new CRM_Civiparoisse_Reports_Config_Parameters_ProchainsAnniversaires(),
            
        ];
        
        foreach ($reportsParameters as $reportParameter) {
            $reportParameter->installSaveSearchAndDisplay();
        }
       
    }
}
