<?php

// Fichier devenu inutile depuis la version 1.46.
// Conservé pour les éventuels upgrades d'anciennes versions

class CRM_Civiparoisse_Formulaires_Form_FormulaireQuartier extends CRM_Civiparoisse_SavedSearch_BaseParameter
{

    const NAME = 'Liste_des_Quartiers';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * Create la recherche Liste des Quartiers
     * @param string $name Name of the search
     * @return  array $params Parameters for the creation of the search
     */
    public function getParametersSearch(string $name): array
    {

        return [
            'values' => [
                'name' => $name,
                'label' => 'Liste des Quartiers',
                'form_values' => null,
                'mapping_id' => null,
                'search_custom_id' => null,
                'description' => 'Liste des Quartiers, pour modifications',
                'api_entity' => 'OptionValue',
                'api_params' => [
                    'version' => 4,
                    'select' => [
                        'id',
                        'label',
                        'is_active',
                    ],
                    'orderBy' => [],
                    'where' => [
                        [
                            'option_group_id:name',
                            '=',
                            'quartier',
                        ],
                    ],
                    'groupBy' => [],
                    'join' => [],
                    'having' => [],
                ],
            ],
        ];
    }

    /**
     * Create le Display Liste des Quartiers sous forme de Table
     * @param string $nameDisplay Name of the search
     * @param int $searchId Number of the associated search
     * @return  array $params   Parameters for the creation of the display
     */
    public function getParametersDisplay(string $nameDisplay, int $searchId): array
    {

        return [
            'values' => [
                'name' => $nameDisplay,
                'label' => 'Liste des Quartiers',
                'saved_search_id' => $searchId,
                'type' => 'table',
                'acl_bypass' => false,
                'settings' => [
                    'description' => 'Liste des Quartiers pour modifications.'
                        .' Voir le mode d\'emploi de CiviParoisse pour plus de détails.',
                    'actions' => [
                        'enable',
                        'download',
                        'disable',
                        'update',
                    ],
                    'limit' => 0,
                    'placeholder' => 3,
                    'classes' => [
                        'table',
                        'table-striped',
                    ],
                    'pager' => false,
                    'columns' => [
                        [
                            'type' => 'field',
                            'key' => 'label',
                            'dataType' => 'String',
                            'label' => 'Nom du Quartier',
                            'sortable' => true,
                            'editable' => true,
                        ],
                        [
                            'type' => 'field',
                            'key' => 'is_active',
                            'dataType' => 'Boolean',
                            'label' => 'Visible ? (Oui/Non)',
                            'sortable' => true,
                            'editable' => true,
                        ],
                    ],
                    'sort' => [
                        [
                            'weight',
                            'ASC',
                        ]
                    ]
                ],
            ]
        ];
    }


}

