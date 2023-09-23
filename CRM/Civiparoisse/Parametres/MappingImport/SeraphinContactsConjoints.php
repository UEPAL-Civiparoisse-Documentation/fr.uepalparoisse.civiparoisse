<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsConjoints
    extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    const NAME = 'Seraphin-Contacts-Conjoints';

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {

        return self::NAME;

    }

    /**
     * Create le mapping d'import depuis Séraphin, pour les conjoints des Individus
     *
     * @return    array    $params Parameters for the creation of the mapping
     */
    protected function getParametersMapping(): array
    {

        return [
            'name' => $this->getName(),
            'description' => "Modèle d'import des conjoints extraits de Séraphin",
            'mapping_type_id_name' => "Import Contact",
        ];
    }

    /**
     * Create le MappingField d'import depuis Séraphin, pour les conjoints des Individus
     *
     * @return  array $params   Parameters for the creation of the mapping fields
     */
    protected function getParametersDisplay(): array
    {

        return [
            $this->computeCommonDisplayField('external_identifier',0),
            $this->computeCommonDisplayField('last_name',1),
            $this->computeCommonDisplayField('first_name',2),
            $this->computeLocationDisplayField('email',3,'Domicile'),
            $this->computeRelationshipDisplayField(
                'external_identifier',4,self::findRelationshipTypeId('Spouse of'),'a_b'),
            $this->computeRelationshipDisplayField(
                'external_identifier',5,self::findRelationshipTypeId('Partner of'),'a_b')

        ];

    }


}

