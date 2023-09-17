<?php

class CRM_Civiparoisse_Reports_Config_Parameters_ProchainsAnniversaires extends CRM_Civiparoisse_SavedSearch_WithForm
{

    const NAME = 'Prochains_Anniversaires';

    const NAME_FORM = 'afsearchAnniversairesDesProchains7Jours';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @inheritDoc
     */
    public function getNameForm(): string
    {
        return self::NAME_FORM;
    }


    /**
     * Create la recherche Anniversaires des 7 prochains jours
     * @param text $name Name of the search
     * @return  array $params Parameters for the creation of the search
     */
    public function getParametersSearch(string $name): array
    {

        return [
            'values' => [
                'name' => $name,
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
        ];
    }

    /**
     * Create le Display Anniversaires des 7 prochains jours sous forme de Table
     * @param text $name Name of the search
     * @param int $searchId Number of the associated search
     * @return  array $params   Parameters for the creation of the display
     */
    public function getParametersDisplay(string $nameDisplay, int $searchId): array
    {

        return [
            'values' => [
                'name' => $nameDisplay,
                'label' => 'Anniversaires des prochains 7 jours (Dashboard)',
                'saved_search_id' => $searchId,
                'type' => 'table',
                'acl_bypass' => false,
                'settings' => [
                    'actions' => [
                        'contact.103',
                        'contact.9',
                        'contact.mailing',
                        'contact.107',
                        'contact.merge',
                        'download',
                        'export',
                        'contact.2',
                        'contact.3',
                        'update',
                        'contact.16',
                    ],
                    'description' => null,
                    'limit' => 0,
                    'classes' => [
                        'table',
                        'table-striped',
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
        ];
    }

    /**
     * Create le Formulaire Anniversaires des 7 prochains jours pour affichage dans le Dashboard
     *
     * @return  array $params   Parameters for the creation of the forms
     */
    protected function getParametersForms(): array
    {
        $text=['#text' => '
                '];

        return [
            'values' => [
                'name' => $this->getNameForm(),
                'title' => 'Anniversaires des prochains 7 jours',
                'requires' => [],
                'description' => 'Formulaire pour afficher les prochains anniversaires dans le DashBoard',
                'is_dashlet' => true,
                'is_public' => false,
                'is_token' => false,
                'permission' => 'access CiviCRM',
                'type' => 'search',
                'icon' => 'fa-list-alt',
                'server_route' => 'civicrm/prochains-anniversaires-dashboard',
                'layout' => [
                    [
                        '#tag' => 'div',
                        'af-fieldset' => '',
                        '#children' => [
                            $text,
                            [
                                '#tag' => 'crm-search-display-table',
                                'search-name' => self::getName(),
                                'display-name' => self::getNameDisplay(),
                            ],
                            $text,
                        ],
                    ],
                    $text,
                ],
                'entity_type' => null,
                'join_entity' => null,
                'contact_summary' => null,
                'summary_contact_type' => null,
                'redirect' => null,
                'create_submission' => null,
                'navigation' => null,
            ],
        ];
    }


}

