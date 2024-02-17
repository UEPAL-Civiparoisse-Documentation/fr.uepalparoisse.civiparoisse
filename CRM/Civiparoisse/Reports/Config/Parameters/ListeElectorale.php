<?php

// Fichier devenu inutile depuis la version 1.46.
// Conservé pour les éventuels upgrades d'anciennes versions

class CRM_Civiparoisse_Reports_Config_Parameters_ListeElectorale extends CRM_Civiparoisse_SavedSearch_BaseParameter
{

    const NAME = 'Civip_Liste_Electorale';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * Create la recherche Liste Electorale
     * @param string $name Name of the search
     * @return    array    $params Parameters for the creation of the search
     */
    public function getParametersSearch(string $name): array
    {

        return [
            'values' => [
                'name' => $name,
                'label' => 'Liste Electorale',
                'form_values' => null,
                'mapping_id' => null,
                'search_custom_id' => null,
                'description' => 'Recherches de la Liste Electorale',
                'api_entity' => 'Contact',
                'api_params' => [
                    'version' => 4,
                    'select' => [
                        'sort_name',
                        'last_name',
                        'first_name',
                        'birth_date',
                        'Contact_Address_contact_id_01.street_address',
                        'Contact_Address_contact_id_01.postal_code',
                        'Contact_Address_contact_id_01.city',
                        'Contact_Address_contact_id_01.country_id:label',
                        'Contact_Email_contact_id_01.email',
                        'Contact_Phone_contact_id_01.phone'
                    ],
                    'orderBy' => [],
                    'where' => [
                        [
                            'contact_type:name',
                            '=',
                            'Individual'
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
                    'join' => [
                        [
                            'Membership AS Contact_Membership_contact_id_01',
                            'INNER',
                            [
                                'id',
                                '=',
                                'Contact_Membership_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_Membership_contact_id_01.membership_type_id:name',
                                '=',
                                '\'Electeur·trice\''
                            ],
                            [
                                'Contact_Membership_contact_id_01.status_id:name',
                                'IN',
                                [
                                    'New',
                                    'Current'
                                ]
                            ]
                        ],
                        [
                            'Address AS Contact_Address_contact_id_01',
                            'LEFT',
                            [
                                'id',
                                '=',
                                'Contact_Address_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_Address_contact_id_01.is_primary',
                                '=',
                                true
                            ]
                        ],
                        [
                            'Email AS Contact_Email_contact_id_01',
                            'LEFT',
                            [
                                'id',
                                '=',
                                'Contact_Email_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_Email_contact_id_01.is_primary',
                                '=',
                                true
                            ]
                        ],
                        [
                            'Phone AS Contact_Phone_contact_id_01',
                            'LEFT',
                            [
                                'id',
                                '=',
                                'Contact_Phone_contact_id_01.contact_id'
                            ],
                            [
                                'Contact_Phone_contact_id_01.is_primary',
                                '=',
                                true
                            ]
                        ]
                    ],
                    'having' => []
                ],
            ],
        ];
    }

    /**
     * Create le Display Liste Electorale sous forme de Table
     * @param string $name Name of the search
     * @param int $searchId Number of the associated search
     * @return    array    $params    Parameters for the creation of the display
     */
    public function getParametersDisplay(string $nameDisplay, int $searchId): array
    {

        return [
            'values' => [
                'name' => $nameDisplay,
                'label' => 'Liste Electorale',
                'saved_search_id' => $searchId,
                'type' => 'table',
                'acl_bypass' => false,
                'settings' => [
                    'actions' => true,
                    'limit' => 0,
                    'classes' => [
                        'table',
                        'table-striped',
                        'table-bordered'
                    ],
                    'pager' => false,
                    'columns' => [
                        [
                            'type' => 'field',
                            'key' => 'sort_name',
                            'dataType' => 'String',
                            'label' => 'Nom trié',
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
                            'key' => 'last_name',
                            'dataType' => 'String',
                            'label' => 'Nom de famille',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'first_name',
                            'dataType' => 'String',
                            'label' => 'Prénom',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'birth_date',
                            'dataType' => 'Date',
                            'label' => 'Date de naissance',
                            'sortable' => true
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
                            'key' => 'Contact_Email_contact_id_01.email',
                            'dataType' => 'String',
                            'label' => 'Courriel',
                            'sortable' => true
                        ],
                        [
                            'type' => 'field',
                            'key' => 'Contact_Phone_contact_id_01.phone',
                            'dataType' => 'String',
                            'label' => 'Téléphone',
                            'sortable' => true
                        ]
                    ],
                    'sort' => [
                        [
                            'sort_name',
                            'ASC'
                        ]
                    ]
                ],
            ]
        ];
    }
}

