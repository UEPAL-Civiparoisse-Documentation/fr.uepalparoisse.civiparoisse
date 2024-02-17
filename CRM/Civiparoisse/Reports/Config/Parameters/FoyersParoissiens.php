<?php

// Fichier devenu inutile depuis la version 1.46.
// Conservé pour les éventuels upgrades d'anciennes versions

class CRM_Civiparoisse_Reports_Config_Parameters_FoyersParoissiens extends CRM_Civiparoisse_SavedSearch_BaseParameter
{

    const NAME = 'Civip_Foyers_Paroissiens';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * Create la recherche FoyersParoissiens
     * @param string $name Name of the search
     * @return     array    $params Parameters for the creation of the search
     */
    public function getParametersSearch(string $name): array
    {

        return [
            'values' => [
                'name' => $name,
                'label' => 'Foyers Paroissiens',
                'form_values' => null,
                'mapping_id' => null,
                'search_custom_id' => null,
                'description' => 'Recherche des Foyers Paroissiens',
                'api_entity' => 'Contact',
                'api_params' => [
                    'version' => 4,
                    'select' => [
                        'id', 'household_name', 'Contact_Address_contact_id_01.street_address',
                        'Contact_Address_contact_id_01.postal_code', 'Contact_Address_contact_id_01.city',
                        'Contact_Address_contact_id_01.country_id:label',
                        'Contact_RelationshipCache_Contact_01.display_name',
                        'Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.email',
                        'Contact_RelationshipCache_Contact_01_Contact_Phone_contact_id_01.phone',
                        'Contact_Phone_contact_id_01.phone',
                        'Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01.membership_type_id'
                        . ':label',
                        'Contact_RelationshipCache_Contact_01.age_years',
                        'Contact_RelationshipCache_Contact_01.birth_date'
                    ],
                    'orderBy' => [],
                    'where' => [
                        [
                            'contact_type:name', '=', 'Household'
                        ]
                    ],
                    'groupBy' => [],
                    'join' => [
                        [
                            'Address AS Contact_Address_contact_id_01', 'LEFT',
                            [
                                'id', '=', 'Contact_Address_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_Address_contact_id_01.is_primary', '=', true
                            ]
                        ],
                        [
                            'Contact AS Contact_RelationshipCache_Contact_01', 'LEFT', 'RelationshipCache',
                            [
                                'id', '=', 'Contact_RelationshipCache_Contact_01.far_contact_id'
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01.near_relation:name',
                                '=',
                                '\'Membre du foyer\''
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01.is_deleted', '=', false
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01.is_active', '=', true
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01.is_deceased', '=', false
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01.is_deleted', '=', false
                            ]
                        ],
                        [
                            'Email AS Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01', 'LEFT',
                            [
                                'Contact_RelationshipCache_Contact_01.id',
                                '=',
                                'Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.is_primary',
                                '=',
                                true
                            ]
                        ],
                        [
                            'Phone AS Contact_RelationshipCache_Contact_01_Contact_Phone_contact_id_01', 'LEFT',
                            [
                                'Contact_RelationshipCache_Contact_01.id',
                                '=',
                                'Contact_RelationshipCache_Contact_01_Contact_Phone_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01_Contact_Phone_contact_id_01.is_primary',
                                '=',
                                true
                            ]
                        ],
                        [
                            'Phone AS Contact_Phone_contact_id_01', 'LEFT',
                            [
                                'id', '=', 'Contact_Phone_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_Phone_contact_id_01.is_primary', '=', true
                            ]
                        ],
                        [
                            'Membership AS Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01',
                            'INNER',
                            [
                                'Contact_RelationshipCache_Contact_01.id',
                                '=',
                                'Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01_Contact_'
                                . 'Membership_contact_id_01.membership_type_id:name',
                                'IN',
                                [
                                    'Electeur·trice', 'Inscrit·e Enfant'
                                ]
                            ],
                            [
                                'Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01.status_id:name',
                                'IN',
                                [
                                    'New', 'Current'
                                ]
                            ]
                        ]
                    ],
                    'having' => []
                ],
            ],
        ];
    }

    /**
     * Create le Display Foyers Paroissiens sous forme de Table
     * @param string $name Name of the search
     * @param int $searchId Number of the associated search
     * @return     array    $params     Parameters for the creation of the display
     */
    public function getParametersDisplay(string $nameDisplay, int $searchId): array
    {

        return [
            'values' => [
                'name' => $nameDisplay,
                'label' => 'Foyers Paroissiens',
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
                            'key' => 'household_name',
                            'dataType' => 'String',
                            'label' => 'Nom du foyer',
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
                        [
                            'type' => 'field',
                            'key' => 'Contact_Address_contact_id_01.street_address',
                            'dataType' => 'String',
                            'label' => 'Rue',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_Address_contact_id_01.postal_code',
                            'dataType' => 'String',
                            'label' => 'Code postal',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_Address_contact_id_01.city',
                            'dataType' => 'String',
                            'label' => 'Ville',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_Address_contact_id_01.country_id:label',
                            'dataType' => 'Integer',
                            'label' => 'Pays',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_RelationshipCache_Contact_01.display_name',
                            'dataType' => 'String',
                            'label' => 'Nom et prénom',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.email',
                            'dataType' => 'String',
                            'label' => 'Courriel',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_RelationshipCache_Contact_01_Contact_Phone_contact_id_01.phone',
                            'dataType' => 'String',
                            'label' => 'Téléphone fixe',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_Phone_contact_id_01.phone',
                            'dataType' => 'String',
                            'label' => 'Téléphone portable',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' =>
                                'Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01'
                                .'.membership_type_id:label',
                            'dataType' => 'Integer',
                            'label' => 'Type de membre',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_RelationshipCache_Contact_01.age_years',
                            'dataType' => 'Integer',
                            'label' => 'Age (années)',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_RelationshipCache_Contact_01.birth_date',
                            'dataType' => 'Date',
                            'label' => 'Date de naissance',
                            'sortable' => true,
                            'title' => null
                        ]
                    ],
                    'sort' => [
                        [
                            'household_name',
                            'ASC'
                        ]
                    ]
                ],
            ]
        ];
    }

}

