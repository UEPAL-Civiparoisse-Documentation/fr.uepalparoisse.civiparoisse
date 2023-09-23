<?php

class CRM_Civiparoisse_Parametres_ConfigQuartiersTools extends CRM_Civiparoisse_Parametres_Config
{

 /**
   * Fonction pour modifier les valeurs des quartiers existants, pour les mettre au nouveau standard
   *
   * @param   string[]  $values     Valeurs des quartiers déjà existants
   * 
   */

  public static function modifyExistingQuartiers($values) {
  
    $results = \Civi\Api4\OptionValue::update()
      ->setCheckPermissions(FALSE)
      ->addValue('label', $values['labelNew'])
      ->addValue('value', $values['value'])
      ->addValue('name', $values['name'])
      ->addValue('description', $values['description'])
      ->addWhere('option_group_id:name', '=', 'quartier')
      ->addWhere('label', '=', $values['labelOld'])
      ->execute();
   

  }

 /**
   * Fonction pour créer les Quartiers manquants, pour se mettre au nouveau standard
   *
   * @param   string  $value     Valeurs des quartiers à créer
   * 
   */

  public static function createNewQuartiers($value){

    $results = \Civi\Api4\OptionValue::create()
      ->setCheckPermissions(FALSE)
      ->addValue('option_group_id.name', 'quartier')
      ->addValue('label', $value)
      ->addValue('value', $value)
      ->addValue('name', 'Quartier_'.$value)
      ->addValue('description', 'Quartier '.$value)
      ->addValue('is_active', TRUE)
      ->addValue('weight', $value)
      ->execute();
    


  }


}
