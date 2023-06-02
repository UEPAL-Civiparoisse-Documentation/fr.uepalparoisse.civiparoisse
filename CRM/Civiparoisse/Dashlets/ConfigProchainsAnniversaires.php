<?php
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversaires extends CRM_Civiparoisse_Dashlets_ConfigBase {
    
  const DASHBOARD_ANNIVERSAIRE='anniversaires';
  const DASHBOARD_COLUMN=1;
  const DASHBOARD_WEIGHT=0;
  const DASHBOARD_URL='';
    const DASHBOARD_FULLURL='civicrm/sommaire-civiparoisse?reset=1&context=dashletFullscreen';
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
        return (new CRM_Civiparoisse_Reports_Config_Parameters_ProchainsAnniversaires())->getNameDisplay();
    }

    /**
     * @inheritDoc
     */
    protected function retrieveDashboardURL(): string
    {
        $config=new CRM_Civiparoisse_Reports_Config_Parameters_ProchainsAnniversaires();
        $name=$config->getName();
        $displayName=$config->getNameDisplay();
        return 'civicrm/search/'.$name.'/'.$displayName;


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
        return (new CRM_Civiparoisse_Reports_Config_Parameters_ProchainsAnniversaires())->getNameForm();
    }

    public function installDashlet():void
    {
        $this->createIfNotExistsDashboardContacts();
    }



}
