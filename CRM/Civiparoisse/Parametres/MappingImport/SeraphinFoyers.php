<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyers extends CRM_Civiparoisse_Parametres_ConfigMappingImport{

	const NAME='Seraphin-Foyers';

/**
  * @inheritDoc
  */
  protected function getName(): string {
   
    return self::NAME;
    
  }

/**
  * Create le mapping d'import depuis Séraphin, pour les foyers 
  *
  * @return 	array	$params Parameters for the creation of the mapping
  */
  protected  function getParametersMapping() :array {
    
		return [
			'name' => $this->getName(), 
    	'description' => "Modèle d'import des foyers extraits de Séraphin", 
    	'mapping_type_id_name' => "Import Contact",
    ];
  }

/**
   * Create le MappingField d'import depuis Séraphin, pour les Foyers
   *
   * @return  array $params   Parameters for the creation of the mapping fields
   */
  protected function getParametersDisplay() : array {

    return [
      [
        'name' => 'contact_source', 
        'contact_type' => 'Household', 
        'column_number' => 0, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'household_name', 
        'contact_type' => 'Household', 
        'column_number' => 2, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'email', 
        'contact_type' => 'Household', 
        'column_number' => 3, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'phone', 
        'contact_type' => 'Household', 
        'column_number' => 4, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => self::findPhoneTypeId('phone'), 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],
      [
        'name' => self::findCustomFieldId('quartier', 'Informations supplémentaires'), 
        'contact_type' => 'Household', 
        'column_number' => 5, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'street_address', 
        'contact_type' => 'Household', 
        'column_number' => 6, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'supplemental_address_1', 
        'contact_type' => 'Household', 
        'column_number' => 7, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'supplemental_address_2', 
        'contact_type' => 'Household', 
        'column_number' => 8, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'supplemental_address_3', 
        'contact_type' => 'Household', 
        'column_number' => 9, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'city', 
        'contact_type' => 'Household', 
        'column_number' => 10, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'postal_code', 
        'contact_type' => 'Household', 
        'column_number' => 11, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'external_identifier', 
        'contact_type' => 'Household', 
        'column_number' => 1, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'country', 
        'contact_type' => 'Household', 
        'column_number' => 12, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'state_province', 
        'contact_type' => 'Household', 
        'column_number' => 13, 
        'location_type_id' => self::findLocationId('domicile'), 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => self::findCustomFieldId('mode_distribution', 'Informations supplémentaires'), 
        'contact_type' => 'Household', 
        'column_number' => 14, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],
    ];

  }



}

