<?php

use CRM_Civiparoisse_ExtensionUtil as E;

abstract class CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    public const CG_INFO_RELIGION = 'Information Religion';
    public const CG_ETAT_CIVIL = 'Etat Civil';

    abstract protected function getName();

    abstract protected function getParametersMapping();

    abstract protected function getParametersDisplay();


    protected function computeCommonDisplayField(string $name, int $columnNumber, $contactType = 'Individual'): array
    {
        return [
            'name' => $name,
            'contact_type' => $contactType,
            'column_number' => $columnNumber,
            'location_type_id' => null,
            'phone_type_id' => null,
            'im_provider_id' => null,
            'website_type_id' => null,
            'relationship_type_id' => null,
            'relationship_direction' => null,
            'grouping' => 1,
            'operator' => null,
            'value' => null,
        ];
    }

    protected function computeRelationshipDisplayField(
        $name,
        $columnNumber,
        $relationTypeId,
        $relationShipDirection): array
    {
        $res = $this->computeCommonDisplayField($name, $columnNumber);
        $res['relationship_type_id'] = $relationTypeId;
        $res['relationship_direction'] = $relationShipDirection;
        return $res;
    }

    protected function computeLocationDisplayField($name, $columnNumber, $locationType,$contactType='Individual'): array
    {
        $res = $this->computeCommonDisplayField($name, $columnNumber,$contactType);
        $res['location_type_id'] = static::findLocationId($locationType);
        return $res;
    }

    protected function computePhoneDisplayField(
        $name, $columnNumber, $locationType, $phoneType,$contactType='Individual'): array
    {
        $res = $this->computeLocationDisplayField($name, $columnNumber, $locationType,$contactType);
        $res['phone_type_id'] = static::findPhoneTypeId($phoneType);
        return $res;
    }

    /**
     * Fonction pour installer les mapping
     *
     */
    public function installSaveMapping()
    {

        /** @var array $mappingParameters Liste des paramètres pour créer le Mapping */
        // récupération des paramètres du Mapping
        $mappingParameters = $this->getParametersMapping();

        /** @var array $resultMap Envoi vers la fonction createMappingImport pour créer le mapping */
        // création du Mapping
        self::createMappingImport($mappingParameters);

        /** @var array $mappingFieldParameters Liste des paramètres pour créer le Mapping Field */
        // récupération des paramètres du Mapping Field
        $mappingFieldParameters = $this->getParametersDisplay();

        /** @var array $resultMapFields Envoi vers la fonction createMappingFieldImport pour créer le mapping field */
        // création des Mapping Fields
        $this->createMappingFieldImport($mappingFieldParameters);
    }


    /**
     * Fonction de création du Mapping par l'API
     *
     * @param array $données Données pour la création du Mapping par l'API
     *
     * @var  array $result Code de création du Mapping par l'API
     *
     * @return  array  $result  Code de création du Mapping par l'API
     *
     */
    protected static function createMappingImport($donnees)
    {
        return \Civi\Api4\Mapping::create()
            ->setCheckPermissions(false)
            ->addValue('name', $donnees['name'])
            ->addValue('description', $donnees['description'])
            ->addValue('mapping_type_id:name', $donnees['mapping_type_id_name'])
            ->execute();
    }


    /**
     * Fonction de création du Mapping des champs par l'API
     *
     * @param array $données Données pour la création du Mapping par l'API
     *
     * @var  array $result Code de création du Mapping des champs par l'API
     *
     * @return  array  $result  Code de création du Mapping des champs par l'API
     *
     */

    protected function createMappingFieldImport($donnees)
    {

        foreach ($donnees as $value) {

            $params = [
                'checkPermissions' => false,
                'values' => $value,
            ];
            $params['values']['mapping_id.name'] = $this->getName();

            civicrm_api4('MappingField', 'create', $params);
        }
    }

    /**
     * Fonction pour récupérer l'ID du Location Type
     * @param string $données Données pour rechercher le nom de la Location Type
     * @return int $locationTypes  ID du Location Type demandé
     * @var array $locationTypes Résult de l'interrogation de l'API

     */
    protected static function findLocationId($donnees)
    {

        $locationTypes = \Civi\Api4\LocationType::get()
            ->setCheckPermissions(false)
            ->addSelect('id')
            ->addWhere('name', '=', $donnees)
            ->execute()
            ->first();

        return $locationTypes['id'];
    }

    /**
     * Fonction pour récupérer l'ID du Phone Type
     *
     * @param string $données Données pour rechercher le nom du Phone Type
     *
     * @return int $phoneTypes  ID du Phone Type demandé
     *
     * @var array $phoneTypes Résult de l'interrogation de l'API
     *
     */
    protected static function findPhoneTypeId($donnees)
    {

        $phoneTypes = \Civi\Api4\OptionValue::get()
            ->setCheckPermissions(false)
            ->addSelect('id')
            ->addWhere('option_group_id:name', '=', 'phone_type')
            ->addWhere('name', '=', $donnees)
            ->execute()
            ->first();

        return $phoneTypes['id'];
    }

    /**
     * Fonction pour récupérer l'ID du Custom Field
     *
     * @param string $name Données pour rechercher le nom du Custom Field
     * @param string $customGroup Nom du Custom Group associé au nom recherché
     *
     * @return string $customField  ID du Custom Field demandé
     *
     * @var array $customFieldId Résult de l'interrogation de l'API
     *
     */
    protected static function findCustomFieldId($name, $customGroup)
    {

        $customFieldId = \Civi\Api4\CustomField::get()
            ->setCheckPermissions(false)
            ->addSelect('id')
            ->addWhere('name', '=', $name)
            ->addWhere('custom_group_id:label', '=', $customGroup)
            ->execute()
            ->first();

        return 'custom_' . $customFieldId['id'];
    }

    /**
     * Fonction pour récupérer l'ID du Relationship Type
     *
     * @param string $name Données pour rechercher le nom de la Relation
     *
     * @return id $relationshipTypeId  ID de la Relation demandée
     *
     * @var array $relationshipTypeId Résult de l'interrogation de l'API
     *
     */
    protected static function findRelationshipTypeId($name)
    {

        $relationshipTypeId = \Civi\Api4\RelationshipType::get()
            ->setCheckPermissions(false)
            ->addSelect('id')
            ->addWhere('name_a_b', '=', $name)
            ->execute()
            ->first();

        return $relationshipTypeId['id'];

    }

}
