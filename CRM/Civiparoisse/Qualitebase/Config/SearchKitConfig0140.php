<?php

class CRM_Civiparoisse_Qualitebase_Config_SearchKitConfig0140 {

	public function run() {

        /**
         * @var CRM_Civiparoisse_SavedSearch_BaseParameter[] $reportParameters
         */
        $reportParameters=[new CRM_Civiparoisse_Qualitebase_Config_Parameters_IndividusSansGenre(),
           new CRM_Civiparoisse_Qualitebase_Config_Parameters_IndividusSansCivilite(),
            new CRM_Civiparoisse_Qualitebase_Config_Parameters_IndividusSansMembre()
            ];

        foreach($reportParameters as $reportParameter)
        {
            $reportParameter->installSaveSearchAndDisplay();
        }
	}
	 



}
