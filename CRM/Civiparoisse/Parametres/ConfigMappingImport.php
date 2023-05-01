<?php

use CRM_Civiparoisse_ExtensionUtil as E;

abstract class CRM_Civiparoisse_Parametres_ConfigMappingImport {

  abstract protected function getName();
  
  abstract protected function getParametersMapping();
    
  abstract protected function getParametersDisplay();
  
 /**
  * Fonction pour installer les mapping
  * 
  */
  public function installSaveMapping() {

    /** @var array $mappingParameters Liste des paramètres pour créer le Mapping */
    // récupération des paramètres du Mapping
    $mappingParameters = $this->getParametersMapping();

    /** @var array $resultMap Envoi vers la fonction createMappingImport pour créer le mapping */
    // création du Mapping
    $resultMap = self::createMappingImport($mappingParameters);

    /** @var array $mappingFieldParameters Liste des paramètres pour créer le Mapping Field */
    // récupération des paramètres du Mapping Field
    $mappingFieldParameters = $this->getParametersDisplay();

    /** @var array $resultMapFields Envoi vers la fonction createMappingFieldImport pour créer le mapping field */
    // création des Mapping Fields
    $resultMapFields = $this->createMappingFieldImport($mappingFieldParameters);

  return;

  }



  /**
   * Fonction de création du Mapping par l'API
   * 
   * @param array $données  Données pour la création du Mapping par l'API
   * 
   * @var  array  $result  Code de création du Mapping par l'API 
   * 
   * @return  array  $result  Code de création du Mapping par l'API
   *
   */ 
  static protected function createMappingImport($donnees) {

    $createMapping = \Civi\Api4\Mapping::create()
      ->setCheckPermissions(FALSE)
      ->addValue('name', $donnees['name'])
      ->addValue('description', $donnees['description'])
      ->addValue('mapping_type_id:name', $donnees['mapping_type_id_name'])
      ->execute();

    return $createMapping;

  }


  /**
   * Fonction de création du Mapping des champs par l'API
   * 
   * @param array $données  Données pour la création du Mapping par l'API
   * 
   * @var  array  $result  Code de création du Mapping des champs par l'API 
   * 
   * @return  array  $result  Code de création du Mapping des champs par l'API
   *
   */ 

  protected function createMappingFieldImport($donnees) {

    foreach ($donnees as $key => $value) {

      $params = [
        'checkPermissions' => FALSE,
        'values' => $value,
      ];
      $params['values']['mapping_id.name'] = $this->getName();

      $createMappingField = civicrm_api4('MappingField', 'create', $params);
    }

    return;
  }

  /**
   * Fonction pour récupérer l'ID du Location Type
   * 
   * @param string $données  Données pour rechercher le nom de la Location Type
   * 
   * @var array $locationTypes  Résult de l'interrogation de l'API 
   * 
   * @return int $locationTypes  ID du Location Type demandé
   *
   */   
  static protected function findLocationId($donnees) {

    $locationTypes = \Civi\Api4\LocationType::get()
      ->setCheckPermissions(FALSE)
      ->addSelect('id')
      ->addWhere('name', '=', $donnees)
      ->execute()
      ->first();

    return $locationTypes['id'];
  }

  /**
   * Fonction pour récupérer l'ID du Phone Type
   * 
   * @param string $données  Données pour rechercher le nom du Phone Type
   * 
   * @var array $phoneTypes  Résult de l'interrogation de l'API 
   * 
   * @return int $phoneTypes  ID du Phone Type demandé
   *
   */ 
  static protected function findPhoneTypeId($donnees) {

    $phoneTypes = \Civi\Api4\OptionValue::get()
      ->setCheckPermissions(FALSE)
      ->addSelect('id')
      ->addWhere('option_group_id:label', '=', 'Type de numéro de téléphone')
      ->addWhere('name', '=', $donnees)
      ->execute()
      ->first();

    return $phoneTypes['id'];
  }

  /**
   * Fonction pour récupérer l'ID du Custom Field
   * 
   * @param string $name  Données pour rechercher le nom du Custom Field
   * @param string $customGroup Nom du Custom Group associé au nom recherché
   * 
   * @var array $customFieldId  Résult de l'interrogation de l'API 
   * 
   * @return string $customField  ID du Custom Field demandé
   *
   */ 
  static protected function findCustomFieldId($name, $customGroup) {

    $customFieldId = \Civi\Api4\CustomField::get()
      ->setCheckPermissions(FALSE)
      ->addSelect('id')
      ->addWhere('name', '=', $name)
      ->addWhere('custom_group_id:label', '=', $customGroup)
      ->execute()
      ->first();

    $customField = 'custom_'.$customFieldId['id'];

    return $customField;

  }

  /**
   * Fonction pour récupérer l'ID du Relationship Type
   * 
   * @param string $name  Données pour rechercher le nom de la Relation
   * 
   * @var array $relationshipTypeId  Résult de l'interrogation de l'API 
   * 
   * @return id $relationshipTypeId  ID de la Relation demandée
   *
   */ 
  static protected function findRelationshipTypeId($name) {

    $relationshipTypeId = \Civi\Api4\RelationshipType::get()
      ->setCheckPermissions(FALSE)
      ->addSelect('id')
      ->addWhere('name_a_b', '=', $name)
      ->execute()
      ->first();

    return $relationshipTypeId['id'];

  }

}
