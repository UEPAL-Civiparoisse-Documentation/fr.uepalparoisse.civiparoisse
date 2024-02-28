<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
    [
        'name' => 'SavedSearch_Civip_Liste_ProchainsAnniversaires',
        'entity' => 'SavedSearch',
        'cleanup' => 'always',
        'update' => 'always',
        'params' => [
            'version' => 4,
            'match' => [
                'name'
            ],
            'values' => [
                'name' => 'Civip_Liste_ProchainsAnniversaires',
                'label' => 'Anniversaires des prochains 7 jours',
                'form_values' => null,
                'mapping_id' => null,
                'search_custom_id' => null,
                'description' => 'Affichage des anniversaires des prochains 7 jours',
                'api_entity' => 'Contact',
                'api_params' => [
                    'version' => 4,
                    'select' => [
                        'id',
                        'display_name',
                        'birth_date',
                        'age_years',
                        'email_primary.email',
                        'address_primary',
                        'Contact_Address_contact_id_01.postal_code',
                        'Contact_Address_contact_id_01.city',
                        'Contact_Address_contact_id_01.country_id:label',
                        'Contact_Membership_contact_id_01.membership_type_id:label',
                    ],
                    'orderBy' => [],
                    'where' => [
                        [
                            'contact_type:name',
                            '=',
                            'Individual',
                        ],
                        [
                            'next_birthday',
                            '<=',
                            7,
                        ],
                        [
                            'is_deceased',
                            '=',
                            false,
                        ],
                        [
                            'is_deleted',
                            '=',
                            false,
                        ],
                    ],
                    'groupBy' => [],
                    'join' => [
                        [
                            'Address AS Contact_Address_contact_id_01',
                            'LEFT',
                            [
                                'id',
                                '=',
                                'Contact_Address_contact_id_01.contact_id',
                            ],
                            [
                                'Contact_Address_contact_id_01.is_primary',
                                '=',
                                true,
                            ],
                        ],
                        [
                            'Membership AS Contact_Membership_contact_id_01',
                            'LEFT',
                            [
                                'id',
                                '=',
                                'Contact_Membership_contact_id_01.contact_id',
                            ],
                        ],
                    ],
                    'having' => []
                ],
            ],
        ]
    ],
    [
        'name' => 'SavedSearch_Civip_Liste_ProchainsAnniversaires_Table',
        'entity' => 'SearchDisplay',
        'cleanup' => 'always',
        'update' => 'always',
        'params' => [
            'version' => 4,
            'match' => [
                'name'
            ],
            'values' => [
                'name' => 'Civip_Liste_ProchainsAnniversaires_Table',
                'label' => 'Anniversaires des prochains 7 jours (Dashboard)',
                'saved_search_id.name' => 'Civip_Liste_ProchainsAnniversaires',
                'type' => 'table',
                'acl_bypass' => false,
                'settings' => [
                    'actions' => [
                        'contact.103',
                        'contact.mailing',
                        'download',
                        'export',
                        'contact.2',
                        'contact.3',
                        'contact.16',
                    ],
                    'description' => null,
                    'limit' => 0,
                    'classes' => [
                        'table',
                        'table-striped',
                        'table-bordered',
                    ],
                    'pager' => false,
                    'columns' => [
                        [
                            'type' => 'field',
                            'key' => 'display_name',
                            'dataType' => 'String',
                            'label' => 'Nom',
                            'sortable' => true,
                            'link' => [
                                'path' => '',
                                'entity' => 'Contact',
                                'action' => 'view',
                                'join' => '',
                                'target' => '_blank',
                            ],
                            'title' => 'Voir Contact',
                            'icons' => [
                                [
                                  'field' => 'contact_type:icon',
                                  'side' => 'left',
                                ],
                              ],
                        ],
                        [
                            'type' => 'field',
                            'key' => 'birth_date',
                            'dataType' => 'Date',
                            'label' => 'Date de naissance',
                            'sortable' => true,
                        ],
                        [
                            'type' => 'field',
                            'key' => 'age_years',
                            'dataType' => 'Integer',
                            'label' => 'Age (ans)',
                            'sortable' => true,
                        ],
                    ],
                    'sort' => [
                        [
                            'next_birthday',
                            'ASC',
                        ],
                    ],
                    'placeholder' => 3,
                    'noResultsText' => "Pas d'anniversaires prévus dans les prochains jours",
                ],
            ]
        ]

    ]
];
