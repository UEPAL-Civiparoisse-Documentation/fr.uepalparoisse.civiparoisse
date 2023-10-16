<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyers extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    const NAME = 'Seraphin-Foyers';

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {

        return self::NAME;

    }

    /**
     * Create le mapping d'import depuis Séraphin, pour les foyers
     *
     * @return    array    $params Parameters for the creation of the mapping
     */
    protected function getParametersMapping(): array
    {

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
    protected function getParametersDisplay(): array
    {

        return [
            $this->computeCommonDisplayField('contact_source',0,'Household'),
            $this->computeCommonDisplayField('household_name',2,'Household'),
            $this->computeLocationDisplayField('email',3,'domicile','Household'),
            $this->computePhoneDisplayField('phone',4,'domicile','Phone','Household'),
            $this->computeCommonDisplayField(
                static::findCustomFieldId('quartier', 'Informations supplémentaires'),5,'Household'),
            $this->computeLocationDisplayField('street_address',6,'domicile','Household'),
            $this->computeLocationDisplayField('supplemental_address_1',7,'domicile','Household'),
            $this->computeLocationDisplayField('supplemental_address_2',8,'domicile','Household'),
            $this->computeLocationDisplayField('supplemental_address_3',9,'domicile','Household'),
            $this->computeLocationDisplayField('city',10,'domicile','Household'),
            $this->computeLocationDisplayField('postal_code',11,'domicile','Household'),
            $this->computeCommonDisplayField('external_identifier',1,'Household'),
            $this->computeLocationDisplayField('country',12,'domicile','Household'),
            $this->computeLocationDisplayField('state_province',13,'domicile','Household'),
            $this->computeCommonDisplayField(
                static::findCustomFieldId('mode_distribution', 'Informations supplémentaires'),14,'Household')

        ];

    }


}

