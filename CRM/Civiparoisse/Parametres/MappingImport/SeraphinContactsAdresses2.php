<?php



class CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdresses2
    extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    const NAME = 'Seraphin-Contacts-Adresses2';

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
            $this->computeCommonDisplayField('id', 1),
            $this->computeCommonDisplayField('do_not_import', 2),
            $this->computeCommonDisplayField('do_not_import', 3),
            $this->computeCommonDisplayField('do_not_import', 4),
            $this->computeCommonDisplayField('do_not_import', 5),
            $this->computeLocationDisplayField('street_address', 6, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_1', 7, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_2', 8, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_3', 9, 'Domicile'),
            $this->computeLocationDisplayField('postal_code', 10, 'Domicile'),
            $this->computeLocationDisplayField('city', 11, 'Domicile'),
            $this->computeLocationDisplayField('country', 12, 'Domicile'),
            $this->computeLocationDisplayField('state_province', 13, 'Domicile'),
            $this->computeLocationDisplayField('master_id', 14, 'Domicile'),
            ];

    }


}

