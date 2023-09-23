<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyersNotes
    extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    const NAME = 'Seraphin-Foyers-Notes';

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {

        return self::NAME;

    }

    /**
     * Create le mapping d'import depuis Séraphin, pour les notes sur les foyers
     *
     * @return    array    $params Parameters for the creation of the mapping
     */
    protected function getParametersMapping(): array
    {

        return [
            'name' => $this->getName(),
            'description' => "Modèle d'import des notes des foyers extraits de Séraphin",
            'mapping_type_id_name' => "Import Contact",
        ];
    }

    /**
     * Create le MappingField d'import depuis Séraphin, pour les notes sur les Foyers
     *
     * @return  array $params   Parameters for the creation of the mapping fields
     */
    protected function getParametersDisplay(): array
    {

        return [
            $this->computeCommonDisplayField('external_identifier',0,'Household'),
            $this->computeCommonDisplayField('household_name',1,'Household'),
            $this->computeCommonDisplayField('note',2,'Household')
        ];

    }


}

