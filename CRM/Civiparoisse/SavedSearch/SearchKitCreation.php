<?php

use Civi\Api4\Generic\Result;

/**
 * Setup des rapports
 * La classe Base est la classe mère pour les setups ultérieurs
 */
class CRM_Civiparoisse_SavedSearch_SearchKitCreation
{

    /**
     * Create Saved Search for the Search Kit
     * @param array $params parameters for the creation of the Saved Search
     * @throws CiviCRM_API4_Exception
     */
    public static function createSavedSearch(array $params): Result
    {
        return civicrm_api4('SavedSearch', 'create', $params);
    }

    /**
     * Create Search Display for the Search Kit
     * @param array $params parameters for the creation of the Seach Display
     * @throws CiviCRM_API4_Exception
     */
    public static function createSearchDisplay(array $params): Result
    {
        return civicrm_api4('SearchDisplay', 'create', $params);
    }

    /**
     * Renvoi le numéro Id associé au nom de la recherche donnée en entrée
     * @param text $name Name of the search
     * @return  int   $savedSearches  Id of the search given
     */
    public static function findSearchId(string $name): int
    {

        $savedSearches = civicrm_api4('SavedSearch', 'get', [
            'checkPermissions' => false,
            'select' => [
                'id',
            ],
            'where' => [
                ['name', '=', $name],
            ],
        ]);

        return $savedSearches->first()['id'];

    }


}
