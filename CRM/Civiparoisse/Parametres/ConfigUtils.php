<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_ConfigUtils {

  protected function __construct()
  {
  }


/**********************/
/* UTILS POUR LE CRON */
/**********************/

/**
 * Fonction de GESTION des Jobs du Cron (uniquement pour les activer ou les désactiver)
 * 
 * @param   string  $JobAction  Nom de l'action API
 * @param   string  $JobFrequency Fréquence du Job
 * @param   string  $JobParameters  Paramètres du Job, si besoin
 * @param   string  $JobEntity  Entité d'appartemance du Job
 * @param   int     $JobActive  Activation (=1) ou pas (=0) du Job
 * @param   string  $JobName  Nom Civi du Job
 * 
 * @var     int     $JobId  Numéro du JOb dans la base Civi
 * @var     array   $JobUpdate  Paramètres pour l'utilisation de l'APIv3
 * 
 */ 
 
  static function getCronChange($JobAction, $JobFrequency, $JobParameters, $JobEntity, $JobActive, $JobName) {
    try {
      $JobId = CRM_Civiparoisse_Parametres_ConfigUtils::getIdNumberJob($JobAction, $JobName);
    
      $JobUpdate = civicrm_api3('Job', 'create', [
        'id' => $JobId,
        'is_active' => $JobActive,
        'run_frequency' => $JobFrequency,
        'parameters' => $JobParameters,
        'api_entity' => $JobEntity,
        'name' => $JobName,
        ]);
    }
    
    catch (CiviCRM_API3_Exception $ex){
      CRM_Core_Session::setStatus('Error updating '.$JobAction.' in database', 'Job NOT updated', 'error');
    }
  
  }

/**
 * Fonction de CREATION des Jobs du Cron (en particulier pour les dupliquer)
 * 
 * @param   string  $JobAction  Nom de l'action API
 * @param   string  $JobFrequency Fréquence du Job
 * @param   string  $JobParameters  Paramètres du Job, si besoin
 * @param   string  $JobEntity  Entité d'appartemance du Job
 * @param   int     $JobActive  Activation (=1) ou pas (=0) du Job
 * @param   string  $JobName  Nom Civi du Job
 * 
 * @var     array   $JobCreate  Paramètres pour l'utilisation de l'APIv3
 * 
 */ 
 
  static function getCronCreate($JobAction, $JobFrequency, $JobParameters, $JobEntity, $JobActive,$JobName) {
    try {
      $ExisteOuPas = civicrm_api3('Job', 'getsingle', [
        'name' => $JobName,
      ]);
      
    } 
    catch (Exception $e) {
      $JobCreate = civicrm_api3('Job', 'create', [
        'name' => $JobName,
        'is_active' => $JobActive,
        'run_frequency' => $JobFrequency,
        'parameters' => $JobParameters,
        'api_entity' => $JobEntity,
        'api_action' => $JobAction,
        ]);
    }
  }

/**
 * Fonction de récupération de l'ID de chaque Job via l'API v3
 * 
 * @param   string  $JobAction  Nom de l'action API
 * @param   string  $JobName  Nom Civi du Job
 * 
 * @var     array   $resultat  Paramètres pour l'utilisation de l'APIv3
 * 
 * @return  int     Valeur de l'ID du Job
 * 
 */ 

  static function getIdNumberJob($JobAction, $JobName) {
    $result = civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'return' => ["id"],
      'api_action' => $JobAction,
      'name' => $JobName,
    ]);

    return $result["id"];
  }

 






}
