<?php

class CRM_Civiparoisse_Dashlets_ConfigSommaire extends CRM_Civiparoisse_Dashlets_ConfigBase {
    const DASHBOARD_SOMMAIRE='sommaire-civiparoisse';
    const DASHBOARD_URL='civicrm/sommaire-civiparoisse';
    const DASHBOARD_LABEL='Menu CiviParoisse';
    const DASHBOARD_FULLURL='civicrm/sommaire-civiparoisse?reset=1&context=dashletFullscreen';
    const DASHBOARD_PERMISSION='access CiviCRM';
    const DASHBOARD_COLUMN=0;
    const DASHBOARD_WEIGHT=0;
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
    public function retrieveDashletName(): string
{
    return self::DASHBOARD_SOMMAIRE;
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
    protected function retrieveDashboardLabel(): string
    {
        return self::DASHBOARD_LABEL;
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
        return self::DASHBOARD_FULLURL;
    }

}