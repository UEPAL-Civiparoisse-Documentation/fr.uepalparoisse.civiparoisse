<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_ConfigUtils
{

    protected function __construct()
    {
        //as the constructor is protected, the class cannot be instanciated.
    }


    /**********************/
    /* UTILS POUR LE CRON */
    /**********************/

    /**
     * Fonction de GESTION des Jobs du Cron (uniquement pour les activer ou les désactiver)
     *
     * @param string $jobAction Nom de l'action API
     * @param string $jobFrequency Fréquence du Job
     * @param string $jobParameters Paramètres du Job, si besoin
     * @param string $jobEntity Entité d'appartemance du Job
     * @param int $jobActive Activation (=1) ou pas (=0) du Job
     * @param string $jobName Nom Civi du Job
     *
     * @var     int $JobId Numéro du JOb dans la base Civi
     * @var     array $JobUpdate Paramètres pour l'utilisation de l'APIv3
     *
     */

    public static function getCronChange($jobAction, $jobFrequency, $jobParameters, $jobEntity, $jobActive, $jobName)
    {
        try {
            $jobId = CRM_Civiparoisse_Parametres_ConfigUtils::getIdNumberJob($jobAction, $jobName);
            civicrm_api3('Job', 'create', [
                'id' => $jobId,
                'is_active' => $jobActive,
                'run_frequency' => $jobFrequency,
                'parameters' => $jobParameters,
                'api_entity' => $jobEntity,
                'name' => $jobName,
            ]);
        } catch (CiviCRM_API3_Exception $ex) {
            CRM_Core_Session::setStatus('Error updating ' . $jobAction . ' in database', 'Job NOT updated', 'error');
        }

    }

    /**
     * Fonction de CREATION des Jobs du Cron (en particulier pour les dupliquer)
     *
     * @param string $jobAction Nom de l'action API
     * @param string $jobFrequency Fréquence du Job
     * @param string $jobParameters Paramètres du Job, si besoin
     * @param string $jobEntity Entité d'appartemance du Job
     * @param int $jobActive Activation (=1) ou pas (=0) du Job
     * @param string $jobName Nom Civi du Job
     *
     * @var     array $JobCreate Paramètres pour l'utilisation de l'APIv3
     *
     */

    public static function getCronCreate($jobAction, $jobFrequency, $jobParameters, $jobEntity, $jobActive, $jobName)
    {
        try {
            civicrm_api3('Job', 'getsingle', [
                'name' => $jobName,
            ]);

        } catch (Exception $e) {
            civicrm_api3('Job', 'create', [
                'name' => $jobName,
                'is_active' => $jobActive,
                'run_frequency' => $jobFrequency,
                'parameters' => $jobParameters,
                'api_entity' => $jobEntity,
                'api_action' => $jobAction,
            ]);
        }
    }

    /**
     * Fonction de récupération de l'ID de chaque Job via l'API v3
     *
     * @param string $jobAction Nom de l'action API
     * @param string $jobName Nom Civi du Job
     *
     * @var     array $resultat Paramètres pour l'utilisation de l'APIv3
     *
     * @return  int     Valeur de l'ID du Job
     *
     */

    public static function getIdNumberJob($jobAction, $jobName)
    {
        $result = civicrm_api3('Job', 'get', [
            'sequential' => 1,
            'return' => ["id"],
            'api_action' => $jobAction,
            'name' => $jobName,
        ]);

        return $result["id"];
    }


}
