<?php

// Fichier devenus inutile depuis la version 1.46.
// Conservé pour les éventuels upgrades d'anciennes versions

class CRM_Civiparoisse_Reports_Config_SearchKitConfig0140
{

    public function run()
    {

        /****
         * RAPPORTS
         ****/
        /**
         * @var CRM_Civiparoisse_SavedSearch_BaseParameter[] $reportsParameters
         */
        $reportsParameters = [
            new CRM_Civiparoisse_Reports_Config_Parameters_ListeElectorale(),
            new CRM_Civiparoisse_Reports_Config_Parameters_FoyersParoissiens(),
            new CRM_Civiparoisse_Reports_Config_Parameters_AnniversairesMoins18Ans(),
            new CRM_Civiparoisse_Reports_Config_Parameters_AnniversairesPlus75Ans(),
            new CRM_Civiparoisse_Reports_Config_Parameters_NouveauxArrivants()
        ];

        foreach ($reportsParameters as $reportParameter) {
            $reportParameter->installSaveSearchAndDisplay();
        }

    }
}
