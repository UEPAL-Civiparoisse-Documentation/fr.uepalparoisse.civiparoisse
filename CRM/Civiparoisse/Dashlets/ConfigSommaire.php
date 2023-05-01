<?php
use CRM_Civiparoisse_ExtensionUtil as E;
use CRM_Civiparoisse_Dashlets_ConfigUtils as CU;

class CRM_Civiparoisse_Dashlets_ConfigSommaire {
    const DASHBOARD_SOMMAIRE='sommaire-civiparoisse';

    public static function retrieveSommaireDashletId(){
        $dashboard = civicrm_api3('Dashboard', 'get', [
            'return' => ['id'],
            'name' => self::DASHBOARD_SOMMAIRE,
        ]);
        return $dashboard['id'];
    }

	public function createAndConfigDashletSommaire() {
		CU::CreateOrGetDashboard('civicrm/sommaire-civiparoisse', self::DASHBOARD_SOMMAIRE, 'Menu CiviParoisse', 'civicrm/sommaire-civiparoisse?reset=1&context=dashletFullscreen',1000, 1, 1, 'access CiviCRM');
	}

}