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
    $resultQualite = [];
    $flattenSavedsearches = [];
    $flattenTrouveQualite = [];
    $flattenLabelSavedSearch = [];
    $flattenNameSearchDisplays=[];
    $flattenFormDisplays=[];
    foreach ($listeQualite as $typeContact => $value) {
      foreach ($value as $nameSavedSearch) {
        $flattenSavedsearches[] = $nameSavedSearch;
        // Décompte du nombre de résultats fournis par le Search Display
        $flattenTrouveQualite[$nameSavedSearch] = \Civi\Api4\SearchDisplay::run()
          ->setReturn('row_count')
          ->setLimit(0)
          ->setSavedSearch($nameSavedSearch)
          ->execute()
          ->count();
        // Rajout de la description du Saved Search, pour l'afficher à l'écran
        $flattenLabelSavedSearch[$nameSavedSearch] = \Civi\Api4\SavedSearch::get()
          ->addSelect('label')
          ->addWhere('name', '=', $nameSavedSearch)
          ->setLimit(0)
          ->execute()
          ->first()['label'];
        $flattenNameSearchDisplays[$nameSavedSearch] = [$nameSavedSearch.".".\Civi\Api4\SearchDisplay::get()
          ->addSelect('name')
          ->addWhere('saved_search_id.name', '=', $nameSavedSearch)
          ->execute()
          ->first()['name']];

      }
    }
    //en un coup, récupérer tout ce qu'il faut, car l'appel à Afform est particulièrement coûteux
    // Rajout du lien vers le formulaire, en allant rechercher le nom du Search Display, puis en trouvant le chemin vers le formulaire
    $rawFormDisplays= \Civi\Api4\Afform::get()
      ->addWhere('search_displays', 'IN',  $flattenNameSearchDisplays)
      ->addSelect('server_route')
      ->addSelect('search_displays')
      ->execute()
      ->getArrayCopy();
    foreach($rawFormDisplays as $formDisplay)
    {
      $index=explode(".",$formDisplay['search_displays'][0])[0];
      $flattenFormDisplays[$index]=$formDisplay['server_route'];
    }

    foreach ($listeQualite as $typeContact => $value) {
      $resultBoucleQualite = [];
      foreach ($value as $nameSavedSearch) {
        // Assignation des valeurs pour l'affichage dans le Smarty
        // $resultBoucleQualite = Array incluant : lien vers le document Forms, nombre de résultats obtenus, description du Search Kit
        $resultBoucleQualite[] = [$flattenFormDisplays[$nameSavedSearch], $flattenTrouveQualite[$nameSavedSearch],
          $flattenLabelSavedSearch[$nameSavedSearch]];
      }

      $resultQualite[$typeContact] = $resultBoucleQualite;
    }

    return $resultQualite;
  }
}
