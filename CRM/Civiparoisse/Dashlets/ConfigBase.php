<?php

abstract class CRM_Civiparoisse_Dashlets_ConfigBase
{
    /**
     * Récupère Colonne d'affichage du Dashlet
     * @return int
     */
    abstract protected function retrieveDashletColumn(): int;

    /**
     * Récupère Position du Dashlet dans la colonne choisie
     * @return int
     */
    abstract protected function retrieveDashletWeight(): int;

    /**
     * Récupère le Nom affiché du Dashboard
     * @return string
     */
    abstract protected function retrieveDashboardLabel(): string;

    /**
     * Récupère URL de la page à afficher dans le Dashboard
     * @return string
     */
    abstract protected function retrieveDashboardURL(): string;

    /**
     * Récupère l'URL de la page en plein écran
     * @return string URL de la page en plein écran
     */
    abstract protected function retrieveDashboardFullURL(): string;

    /**
     * Récupère la permission d'accès au Dashboard
     * @return string
     */
    abstract protected function retrieveDashboardPermission(): string;


    /**
     * Récupère Durée du cache en minutes
     * @return int
     */
    protected function retrieveDashboardCache(): int
    {
        return 1000;
    }

    /**
     * Récupère l'Activation ou pas du Dashboard
     * @return int
     */
    protected function retrieveDashboardActive(): int
    {
        return 1;
    }

    /**
     * Récupère l'Indication de la protection du Dashboard
     * @return int
     */
    protected function retrieveDashboardReserved(): int
    {
        return 1;
    }


    /**
     * retrieve the name of the dashlet
     * @return string Nom interne du Dashboard
     */
    abstract public function retrieveDashletName(): string;

    /**
     * retrieve the id of the dashlet
     * @return int
     */
    public function retrieveDashletId(): int
    {
        $dashboard = civicrm_api3('Dashboard', 'get', [
            'return' => ['id'],
            'name' => $this->retrieveDashletName(),
        ]);
        return $dashboard['id'];
    }

    /**
     * Fonction qui créée l'entrée Menu CiviParoisse en tant que Dashlet sur le Dashboard de la page d'accueil
     *
     *
     * @return array   $CreateOrGetDashboard   Résultat de la requête APIv3
     *
     */
    public function createOrGetDashboard()
    {
        /** @var string $dashboardURL URL de la page à afficher dans le Dashboard */
        $dashboardURL = $this->retrieveDashboardURL();
        /** @var string $dashboardName Nom interne du Dashboard */
        $dashboardName = $this->retrieveDashletName();
        /** @var  string $dashboardLabel Nom affiché du Dashboard */
        $dashboardLabel = $this->retrieveDashboardLabel();
        /** @var string $dashboardFullURL URL de la page en plein écran */
        $dashboardFullURL = $this->retrieveDashboardFullURL();
        /** @var int $dashboardCache Durée du cache en minutes */
        $dashboardCache = $this->retrieveDashboardCache();
        /** @var int $dashBoardActive Activation ou pas du Dashboard */
        $dashBoardActive = $this->retrieveDashboardActive();
        /** @var int $dashBoardReserved Indication de la protection du Dashboard */
        $dashBoardReserved = $this->retrieveDashboardReserved();
        /** @var string $dashBoardPermission Permission d'accès au Dashboard */
        $dashBoardPermission = $this->retrieveDashboardPermission();
        try {
            $createDashboard = civicrm_api3('Dashboard', 'getsingle', [
                'url' => $dashboardURL,
                'name' => $dashboardName,
            ]);
        } catch (Exception $e) {
            $createDashboard = civicrm_api3('Dashboard', 'create', [
                'name' => $dashboardName,
                'label' => $dashboardLabel,
                'url' => $dashboardURL,
                'fullscreen_url' => $dashboardFullURL,
                'cache_minutes' => $dashboardCache,
                'is_active' => $dashBoardActive,
                'is_reserved' => $dashBoardReserved,
                'permission' => $dashBoardPermission,
            ]);
        }
        return $createDashboard;
    }

    /**
     * installe le Dashlet comme dashboard et dans les réglages des dashboards des utilisateurs
     * @return void
     */
    public function installDashlet(): void
    {
        $this->createOrGetDashboard();
        $this->createIfNotExistsDashboardContacts();
    }

    /**
     * Fonction de suppression de dashlet
     *
     */
    public function uninstallDashlet(): void
    {
        $name=$this->retrieveDashletName();
        civicrm_api4('Dashboard','delete',[
           'where' =>[
                ['name','=',$name]
             ],
           'checkPermissions'=>false
           ]);

    }
    /**
     * Fonction qui affiche le Dashlet CiviParoisse dans les Dashboard
     *
     */
    protected function createIfNotExistsDashboardContacts(): void
    {
        $dashletID = $this->retrieveDashletId();
        $dashboardName = $this->retrieveDashletName();
        $dashletActive = $this->retrieveDashboardActive();
        $dashletColumn = $this->retrieveDashletColumn();
        $dashletWeight = $this->retrieveDashletWeight();
        $users = civicrm_api3('UFMatch', 'get', [
            'check_permissions' => 0,
            'return' => ['contact_id'],
            'sequential' => 1,
            'options' => ['limit' => 0]]);

        if ($users['is_error'] == 0 && !empty($users['values'])) {
            foreach ($users['values'] as $user) {
                if (array_key_exists('contact_id', $user)
                    && is_numeric($user['contact_id'])
                    && $user['contact_id'] > 0) {
                    self::createIfNotExistsDashboardContact($dashletID,
                        $dashboardName,
                        $dashletActive,
                        $dashletColumn,
                        $dashletWeight,
                        $user['contact_id']);
                }
            }
        }
    }

    /**
     * Fonction qui enregistre  le Dashlet CiviParoisse dans le Dashboard de chaque utilisateur, en vue de l'affichage
     *
     * @param int $dashletID ID du Dashlet Menu
     * @param string $dashboardName Nom interne du Dashboard
     * @param int $dashletColumn Colonne d'affichage du Dashlet
     * @param int $dashletActive Indication d'activation du Dashlet
     * @param int $dashletWeight Position du Dashlet dans la colonne choisie
     * @param int $contactId Id du contact
     */
    protected function createIfNotExistsDashboardContact(int $dashletID,
                                                         string $dashboardName,
                                                         int $dashletActive,
                                                         int $dashletColumn,
                                                         int $dashletWeight,
                                                         int $contactId): void
    {
        try {
            civicrm_api3('DashboardContact', 'getsingle', [
                'dashboard_id' => $dashletID,
                'contact_id' => $contactId,
                'name' => $dashboardName,
            ]);
        } catch (Exception $e) {
            civicrm_api4('DashboardContact', 'create', [
                'checkPermissions' => false,
                'values' => [
                    'dashboard_id' => $dashletID,
                    'contact_id' => $contactId,
                    'is_active' => $dashletActive,
                    'column_no' => $dashletColumn,
                    'weight' => $dashletWeight,
                ]
            ]);
        }
    }

    public function computeDashletDefaults($contactID): array
    {
        return [
            'dashboard_id' => $this->retrieveDashletId(),
            'is_active' => $this->retrieveDashboardActive(),
            'column_no' => $this->retrieveDashletColumn(),
            'weight' => $this->retrieveDashletWeight(),
            'contact_id' => $contactID,
        ];
    }


}
