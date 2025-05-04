<?php

class CRM_Civiparoisse_Parametres_Config0151 extends CRM_Civiparoisse_Parametres_Config
{


// Remplacement du préfixe Mlle par Mme
  public function replacePrefixeMlle() {
    
    // Remplacement des préfixes existants
    // Recherche de la valeur du préfixe Mlle
    $valuePrefixMlle = \Civi\Api4\OptionValue::get()
      ->setCheckPermissions(false)
      ->addSelect('value')
      ->addSelect('id')
      ->addWhere('option_group_id:name', '=', 'individual_prefix')
      ->addWhere('name', '=', 'Ms.')
      ->execute();

    // Recherche de la valeur du préfixe Mme
    $valuePrefixMme = \Civi\Api4\OptionValue::get()
      ->setCheckPermissions(false)
      ->addSelect('value')
      ->addSelect('id')
      ->addWhere('option_group_id:name', '=', 'individual_prefix')
      ->addWhere('name', '=', 'Mrs.')
      ->execute();

    // Remplacement du préfixe Mlle par Mme dans les contacts
    $values = \Civi\Api4\Contact::update()
      ->setCheckPermissions(false)
      ->addValue('prefix_id', $valuePrefixMme->single()['value'])
      ->addWhere('prefix_id', '=', $valuePrefixMlle->single()['value'])
      ->execute();
    
      // Désactivation du préfixe Mlle
    $results = \Civi\Api4\OptionValue::update()
      ->setCheckPermissions(false)
      ->addValue('is_active', false)
      ->addWhere('option_group_id:name', '=', 'individual_prefix')
      ->addWhere('id', '=', $valuePrefixMlle->single()['id'])
      ->execute();
  
    return;
  }


// Rajouts dans la liste Religion
  public function ajoutReligions0151() {

    $newReligions = [
      'Orthodoxe',
      'Bouddhiste',
      'Bahaïsme',
      'Hindouiste'
    ];

    foreach ($newReligions as $label) {

      $results = civicrm_api4('OptionValue', 'create', [
        'checkPermissions'=>false,
        'values' => [
          'label' => $label,
          'option_group_id.name' => 'religion',
          'is_active' => true,
        ],
      ]);
    }

    return;

  }


}
