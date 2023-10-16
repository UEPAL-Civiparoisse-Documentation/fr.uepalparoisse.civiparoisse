<?php

class CRM_Civiparoisse_Parametres_Config0144 extends CRM_Civiparoisse_Parametres_Config
{

// Modification des intitulés Paroisses dans la fiche Individu
    public static function modifyIntituleParoisses()
    {

        // Liste des libellés à corriger
        $labelsParoissesAModifier = array(
            'paroisse_mariage' => 'Lieu de la bénédiction nuptiale',
        );

        foreach ($labelsParoissesAModifier as $name => $label) {

            // modification du libellé du champ
            \Civi\Api4\CustomField::update()
                ->setCheckPermissions(false)
                ->addValue('label', $label)
                ->addWhere('name', '=', $name)
                ->execute();

        }
    }
}
