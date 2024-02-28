<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Electorale',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Electorale',
        'label' => 'Liste Electorale',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'result_row_num',
            'sort_name',
            'last_name',
            'etat_civil.nom_naissance',
            'first_name',
            'birth_date',
            'Contact_Address_contact_id_01.street_address',
            'Contact_Address_contact_id_01.postal_code',
            'Contact_Address_contact_id_01.city',
            'Contact_Address_contact_id_01.country_id:label',
            'Contact_Email_contact_id_01.email',
            'Contact_Phone_contact_id_01.phone',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Individual',
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
              'Membership AS Contact_Membership_contact_id_01',
              'INNER',
              [
                'id',
                '=',
                'Contact_Membership_contact_id_01.contact_id',
              ],
              [
                'Contact_Membership_contact_id_01.membership_type_id:name',
                '=',
                "'Electeur·trice'",
              ],
              [
                'Contact_Membership_contact_id_01.status_id:name',
                'IN',
                [
                  'New',
                  'Current',
                ],
              ],
            ],
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
              'Email AS Contact_Email_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Email_contact_id_01.contact_id',
              ],
              [
                'Contact_Email_contact_id_01.is_primary',
                '=',
                true,
              ],
            ],
            [
              'Phone AS Contact_Phone_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Phone_contact_id_01.contact_id',
              ],
              [
                'Contact_Phone_contact_id_01.is_primary',
                '=',
                true,
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Recherches de la Liste Electorale',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Electorale_SearchDisplay_Liste_Electorale_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Electorale_Table',
        'label' => 'Liste Electorale Table',
        'saved_search_id.name' => 'Civip_Liste_Electorale',
        'type' => 'table',
        'settings' => [
          'actions' => [
            'contact.9',
            'contact.mailing',
            'download',
            'export',
            'contact.2',
            'contact.3',
            'contact.16',
          ],
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
              'key' => 'result_row_num',
              'dataType' => 'Integer',
              'label' => 'Numéro',
              'sortable' => false,
            ],
            [
              'type' => 'field',
              'key' => 'last_name',
              'dataType' => 'String',
              'label' => 'Nom de famille',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'etat_civil.nom_naissance',
              'dataType' => 'String',
              'label' => 'Nom de naissance',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'first_name',
              'dataType' => 'String',
              'label' => 'Prénom',
              'sortable' => true,
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
              'key' => 'Contact_Address_contact_id_01.street_address',
              'dataType' => 'String',
              'label' => 'Rue',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.postal_code',
              'dataType' => 'String',
              'label' => 'Code postal',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.city',
              'dataType' => 'String',
              'label' => 'Ville',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.country_id:label',
              'dataType' => 'Integer',
              'label' => 'Pays',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Email_contact_id_01.email',
              'dataType' => 'String',
              'label' => 'Courriel',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Phone_contact_id_01.phone',
              'dataType' => 'String',
              'label' => 'Téléphone',
              'sortable' => true,
            ],
          ],
          'sort' => [
            [
              'sort_name',
              'ASC',
            ],
          ],
          'placeholder' => 5,
        ],
        'acl_bypass' => false,
      ],
    ],
  ],
];
