<?php
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversairesMgd extends CRM_Civiparoisse_Dashlets_ConfigBase {
    
    const DASHBOARD_ANNIVERSAIRE='afsearchListeProchainsAnniversaires';
    const DASHBOARD_COLUMN=1;
    const DASHBOARD_WEIGHT=0;
    const DASHBOARD_URL='civicrm/prochains_anniversaires';
    const DASHBOARD_FULLURL='';
    const DASHBOARD_PERMISSION='access CiviCRM';


    /**
     * @inheritDoc
     */
    protected function retrieveDashletColumn(): int
    {
        return self::DASHBOARD_COLUMN;
    }

    /**
     * @inheritDoc
     */
    protected function retrieveDashletWeight(): int
    {
        return self::DASHBOARD_WEIGHT;
    }

    /**
     * @inheritDoc
     */
    protected function retrieveDashboardLabel(): string
    {
        return 'Prochains Anniversaires';
    }

    /**
     * @inheritDoc
     */
    protected function retrieveDashboardURL(): string
    {
       return self::DASHBOARD_URL;
    }

    /**
     * @inheritDoc
     */
    protected function retrieveDashboardFullURL(): string
    {
        $url=$this->retrieveDashboardURL();
        return $url.'?reset=1&context=dashletFullscreen';

    }

    /**
     * @inheritDoc
     */
    protected function retrieveDashboardPermission(): string
    {
        return self::DASHBOARD_PERMISSION;
    }

    /**
     * @inheritDoc
     */
    public function retrieveDashletName(): string
    {
       return self::DASHBOARD_ANNIVERSAIRE;
    }

}
