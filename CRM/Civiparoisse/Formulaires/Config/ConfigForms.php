<?php

class CRM_Civiparoisse_Formulaires_Config_ConfigForms
{

    /**
     * Création d'un AFForm
     * @param array $values paramètres de l'AFForm
     * @return mixed
     */
    public static function createFormulaire($values)
    {

        $params = $values;
        $params['checkPermissions'] = false;

        return civicrm_api4('Afform', 'create', $params);

    }
}
