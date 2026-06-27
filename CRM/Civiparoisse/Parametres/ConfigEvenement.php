<?php

/**
 * Classe gérant la configuration des événements dans CiviCRM.
 * 
 */

class CRM_Civiparoisse_Parametres_ConfigEvenement {

  // Ajoute un rôle de participant à CiviCRM.
  public static function ajoutRoles ($name, $label, $description): void {

    \Civi\Api4\OptionValue::create()
      ->setCheckPermissions(false)
        ->addValue('name', $name)
        ->addValue('label', $label)
        ->addValue('description', $description)
        ->addValue('option_group_id:name', 'participant_role')
        ->addValue('is_active', true)
        ->execute();
    }

}
