<?php

/**
 * Classe gérant la configuration des activités dans CiviCRM.
 * 
 */

class CRM_Civiparoisse_Parametres_ConfigActivites {

  // Ajoute un type d'activité à CiviCRM.
  public static function ajoutTypes ($name, $label, $description, $icone): void {

    \Civi\Api4\OptionValue::create()
      ->setCheckPermissions(false)
        ->addValue('name', $name)
        ->addValue('label', $label)
        ->addValue('description', $description)
        ->addValue('option_group_id:name', 'activity_type')
        ->addValue('is_active', true)
        ->addValue('icon', $icone)
        ->execute();
    }

}