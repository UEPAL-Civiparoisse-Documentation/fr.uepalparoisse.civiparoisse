<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Dashlets_ConfigUtils
{

    /**
     * Fonction qui créée l'entrée Menu CiviParoisse en tant que Dashlet sur le Dashboard de la page d'accueil
     *
     * @param string $dashboardURL URL de la page à afficher dans le Dashboard
     * @param string $dashboardName Nom interne du Dashboard
     * @param string $dashboardLabel Nom affiché du Dashboard
     * @param string $dashboardFullURL URL de la page en plein écran
     * @param string $dashboardCache Durée du cache en minutes
     * @param int $dashBoardActive Activation ou pas du Dashboard
     * @param int $dashBoardReserved Indication de la protection du Dashboard
     * @param string $dashBoardPermission Permission d'accès au Dashboard
     *
     * @return array   $CreateOrGetDashboard   Résultat de la requête APIv3
     *
     */
    static function CreateOrGetDashboard($dashboardURL, $dashboardName, $dashboardLabel, $dashboardFullURL, $dashboardCache, $dashBoardActive, $dashBoardReserved, $dashBoardPermission)
    {

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
     * Fonction qui affiche le Dashlet CiviParoisse dans le Dashboard de l'utilisateur
     *
     * @param int $dashletID ID du Dashlet Menu
     * @param string $dashboardName Nom interne du Dashboard
     * @param int $dashletColumn Colonne d'affichage du Dashlet
     * @param int $dashletActive Indication d'activation du Dashlet
     * @param int $dashletWeight Position du Dashlet dans la colonne choisie
     */
    public static function createIfNotExistsDashboardContacts(int $dashletID,string $dashboardName,int $dashletActive,int $dashletColumn,int $dashletWeight)
    {
        $users = civicrm_api3('UFMatch', 'get', ['check_permissions' => 0, 'return'=>['contact_id'],'sequential'=>1,'options'=>['limit' => 0]]);
        var_dump($users);
        if($users['is_error']==0 && !empty($users['values'])) {
            foreach ($users['values'] as $user) {
                self::createIfNotExistsDashboardContact($dashletID, $dashboardName, $dashletActive, $dashletColumn, $dashletWeight, $user['contact_id']);
            }
        }
    }

    /**
     * Fonction qui affiche le Dashlet CiviParoisse dans le Dashboard de l'utilisateur
     *
     * @param int $dashletID ID du Dashlet Menu
     * @param string $dashboardName Nom interne du Dashboard
     * @param int $dashletColumn Colonne d'affichage du Dashlet
     * @param int $dashletActive Indication d'activation du Dashlet
     * @param int $dashletWeight Position du Dashlet dans la colonne choisie
     * @param int $contactId Id du contact
     */
    public static function createIfNotExistsDashboardContact(int $dashletID, string $dashboardName, int $dashletActive,int $dashletColumn,int $dashletWeight,int $contactId)
    {

        try {
            $createDashboardContact = civicrm_api3('DashboardContact', 'getsingle', [
                'dashboard_id' => $dashletID,
                'contact_id' => $contactId,
                'name' => $dashboardName,
            ]);
        } catch (Exception $e) {
            $createDashboardContact = civicrm_api4('DashboardContact', 'create', [
                'checkPermissions' => FALSE,
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


}