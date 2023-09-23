<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdhesions
    extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    const NAME = 'Seraphin-Contacts-Adhesion';

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {

        return self::NAME;

    }

    /**
     * Create le mapping d'import depuis Séraphin, pour les adhésions des Individus
     *
     * @return    array    $params Parameters for the creation of the mapping
     */
    protected function getParametersMapping(): array
    {

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
    protected function getParametersDisplay(): array
    {

        return [
            $this->computeCommonDisplayField('external_identifier', 0, null),
            $this->computeCommonDisplayField('do_not_import', 1, null),
            $this->computeCommonDisplayField('do_not_import', 2, null),
            $this->computeCommonDisplayField('email', 3, null),
            $this->computeCommonDisplayField('membership_source', 4, null),
            $this->computeCommonDisplayField('membership_type_id', 5, null),
            $this->computeCommonDisplayField('membership_join_date', 6, null),
            $this->computeCommonDisplayField('membership_start_date', 7, null)
        ];

    }


}

