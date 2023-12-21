<?php

// Fichier devenu inutile depuis la version 1.45.
// Conservé pour les éventuels upgrades d'anciennes versions

class CRM_Civiparoisse_Qualitebase_Config_Parameters_IndividusSansCivilite
    extends CRM_Civiparoisse_SavedSearch_BaseParameter
{

    const NAME = 'Civip_Individus_Sans_Civilite';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * Create la recherche Individus sans Civilité
     * @param string $name Name of the search
     * @return    array    $params Parameters for the creation of the search
     */
    public function getParametersSearch(string $name): array
    {

        return [
            'values' => [
                'name' => $name,
                'label' => 'Individus Sans Civilite',
                'form_values' => null,
                'mapping_id' => null,
                'search_custom_id' => null,
                'description' => 'Recherches des Individus sans Civilite',
                'api_entity' => 'Contact',
                'api_params' => [
                    'version' => 4,
                    'select' => [
                        'id',
                        'prefix_id:label',
                        'display_name'
                    ],
                    'orderBy' => [],
                    'where' => [
                        [
                            'contact_type:name',
                            '=',
                            'Individual'
                        ],
                        [
                            'prefix_id:name',
                            'IS EMPTY'
                        ],
                        [
                            'is_deceased',
                            '=',
                            false
                        ],
                        [
                            'is_deleted',
                            '=',
                            false
                        ]
                    ],
                    'groupBy' => [],
                    'join' => [],
                    'having' => [],
                ],
            ],
        ];

    }

    /**
     * Create le Display Individus sans Civilité sous forme de Table
     * @param string $name Name of the search
     * @param int $searchId Number of the associated search
     * @return    array    $params    Parameters for the creation of the display
     */
    public function getParametersDisplay(string $nameDisplay, int $searchId): array
    {

        return [
            'values' => [
                'name' => $nameDisplay,
                'label' => 'Individus Sans Civilite Table',
                'saved_search_id' => $searchId,
                'type' => 'table',
                'acl_bypass' => false,
                'settings' => [
                    'actions' => true,
                    'limit' => 50,
                    'classes' => [
                        'table',
                        'table-striped',
                        'table-bordered'
                    ],
                    'pager' => [
                        'show_count' => true,
                        'expose_limit' => true
                    ],
                    'columns' => [
                        [
                            'type' => 'field',
                            'key' => 'id',
                            'dataType' => 'Integer',
                            'label' => 'Identifiant de contact',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'prefix_id:label',
                            'dataType' => 'Integer',
                            'label' => 'Genre',
                            'sortable' => true,
                            'editable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'display_name',
                            'dataType' => 'String',
                            'label' => 'Nom affich\u00e9',
                            'sortable' => true,
                            'link' => [
                                'path' => '',
                                'entity' => 'Contact',
                                'action' => 'view',
                                'join' => '',
                                'target' => '_blank'
                            ],
                            'title' => 'Voir Contact'
                        ],
                    ],
                ],
            ]
        ];


    }


}
