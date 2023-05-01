<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdhesions extends CRM_Civiparoisse_Parametres_ConfigMappingImport{

	const NAME='Seraphin-Contacts-Adhesion';

/**
  * @inheritDoc
  */
  protected function getName(): string {
   
    return self::NAME;
    
  }

/**
  * Create le mapping d'import depuis Séraphin, pour les adhésions des Individus 
  *
  * @return 	array	$params Parameters for the creation of the mapping
  */
  protected function getParametersMapping() :array {
    
		return [
			'name' => $this->getName(), 
    	'description' => "Modèle d'import des adhésions extraites de Séraphin", 
    	'mapping_type_id_name' => "Import Membership",
    ];
  }

/**
   * Create le MappingField d'import depuis Séraphin, pour les adhésions des Individus
   *
   * @return  array $params   Parameters for the creation of the mapping fields
   */
  protected function getParametersDisplay() : array {

    return [
      [
        'name' => 'external_identifier', 
        'contact_type' => NULL, 
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
        'name' => 'do_not_import', 
        'contact_type' => NULL, 
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
        'name' => 'do_not_import', 
        'contact_type' => NULL, 
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
        'contact_type' => NULL, 
        'column_number' => 3, 
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
        'name' => 'membership_source', 
        'contact_type' => NULL, 
        'column_number' => 4, 
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
        'name' => 'membership_type_id', 
        'contact_type' => NULL, 
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
        'name' => 'membership_join_date', 
        'contact_type' => NULL, 
        'column_number' => 6, 
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
        'name' => 'membership_start_date', 
        'contact_type' => NULL, 
        'column_number' => 7, 
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

