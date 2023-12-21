<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Qualitebase_Page_BaseQualiteParoisse extends CRM_Core_Page
{

  /**
   * @param array $listeQualite
   * @return array $resultQualite
   */

  public function calculQualite($listeQualite): array
  {

    foreach ($listeQualite as $typeContact => $value) {

      $resultBoucleQualite = [];

      foreach ($value as $nameSavedSearch) {

        // Décompte du nombre de résultats fournis par le Search Display
        $valeurTrouveQualite = \Civi\Api4\SearchDisplay::run()
          ->setReturn('row_count')
          ->setLimit(0)
          ->setSavedSearch($nameSavedSearch)
          ->execute()
          ->count();

        // Rajout de la description du Saved Search, pour l'afficher à l'écran
        $labelSavedSearch = \Civi\Api4\SavedSearch::get()
          ->addSelect('label')
          ->addWhere('name', '=', $nameSavedSearch)
          ->setLimit(0)
          ->execute()
          ->first();

        // Rajout du lien vers le formulaire, en allant rechercher le nom du Search Display, puis en trouvant le chemin vers le formulaire
        $nameSearchDisplays = \Civi\Api4\SearchDisplay::get()
          ->addSelect('name')
          ->addWhere('saved_search_id.name', '=', $nameSavedSearch)
          ->execute()
          ->first();

        $lienFormsDisplay = \Civi\Api4\Afform::get()
          ->addWhere('search_displays', '=', [$nameSavedSearch . "." . $nameSearchDisplays['name']])
          ->addSelect('server_route')
          ->execute()
          ->first();

        // Assignation des valeurs pour l'affichage dans le Smarty
        // $resultBoucleQualite = Array incluant : lien vers le document Forms, nombre de résultats obtenus, description du Search Kit
        $resultBoucleQualite[] = [$lienFormsDisplay['server_route'], $valeurTrouveQualite, $labelSavedSearch['label']];
      }

      $resultQualite[$typeContact] = $resultBoucleQualite;
    }

    return $resultQualite;
  }
}
