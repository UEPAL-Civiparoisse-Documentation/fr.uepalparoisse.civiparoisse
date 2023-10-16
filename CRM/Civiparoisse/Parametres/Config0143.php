<?php

class CRM_Civiparoisse_Parametres_Config0143 extends CRM_Civiparoisse_Parametres_Config
{

// Modification des intitulés Paroisses dans la fiche Individu
    public static function modifyIntituleParoisses()
    {

        // Liste des libellés à corriger
        $labelsParoissesAModifier = array(
            'paroisse_mariage' => 'Lieu de mariage',
            'paroisse_enterrement' => 'Lieu d\'enterrement',
            'paroisse_presentation' => 'Lieu de présentation',
            'paroisse_bapteme' => 'Lieu de baptême',
            'paroisse_confirmation' => 'Lieu de confirmation',
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

// Desactivation des Dashlets Blog et Ressources sur le DashBoard de la page d'accueil
    public static function desactivateDashletsBlogRessources()
    {

        $listeDashBoardADesactiver = array('blog', 'getting-started');

        foreach ($listeDashBoardADesactiver as $name) {
            \Civi\Api4\Dashboard::update()
                ->setCheckPermissions(false)
                ->addValue('is_active', false)
                ->addWhere('name', '=', $name)
                ->execute();
        }
    }

// Modification de la permission pour le menu Support,
// pour ne plus l'afficher aux utilisateurs autres qu'administrateurs
    public static function modifyPermissionLinkSupport()
    {
        \Civi\Api4\Navigation::update()
            ->setCheckPermissions(false)
            ->addValue('permission', ['administer CiviCRM',])
            ->addWhere('name', '=', 'Support')
            ->execute();
    }


}
