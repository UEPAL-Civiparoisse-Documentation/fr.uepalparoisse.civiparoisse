<?php



class CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdresses
    extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    const NAME = 'Seraphin-Contacts-Adresses';

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {

        return self::NAME;

    }

    /**
     * Create le mapping d'import depuis Séraphin, pour les adresses des Individus
     *
     * @return     array    $params Parameters for the creation of the mapping
     */
    protected function getParametersMapping(): array
    {

        return [
            'name' => $this->getName(),
            'description' => "Modèle d'import des adresses extraites de Séraphin",
            'mapping_type_id_name' => "Import Contact",
        ];
    }

    /**
     * Create le MappingField d'import depuis Séraphin, pour les adresses des Individus
     *
     * @return  array $params   Parameters for the creation of the mapping fields
     */
    protected function getParametersDisplay(): array
    {

        return [
            $this->computeCommonDisplayField('external_identifier', 0),
            $this->computeCommonDisplayField('last_name', 1),
            $this->computeCommonDisplayField('first_name', 2),
            $this->computeLocationDisplayField('email', 3, 'Domicile'),
            $this->computeCommonDisplayField('do_not_import', 4),
            $this->computeLocationDisplayField('master_id', 5, 'Domicile'),
            $this->computeLocationDisplayField('street_address', 6, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_1', 7, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_2', 8, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_3', 9, 'Domicile'),
            $this->computeLocationDisplayField('city', 10, 'Domicile'),
            $this->computeLocationDisplayField('postal_code', 11, 'Domicile'),
            $this->computeLocationDisplayField('country', 12, 'Domicile'),
            $this->computeLocationDisplayField('state_province', 13, 'Domicile')
        ];

    }


}

