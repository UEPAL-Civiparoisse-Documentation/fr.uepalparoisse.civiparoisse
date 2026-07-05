<?php
use CRM_Civiparoisse_ExtensionUtil as E;
return [
  [
    'name' => 'SavedSearch_Membres_paroissiaux_traiter',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Membres_paroissiaux_traiter',
        'label' => E::ts('Membres paroissiaux à traiter'),
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'Contact_Address_contact_id_01.street_address',
            'Contact_Address_contact_id_01.city',
            'geomBergerie_name',
            'villeBergerie_name',
          ],
          'orderBy' => [],
          'where' => [
            [
              'bergerieCardinal',
              '>',
              1,
            ],
            [
              'multiparoisse.bergerie',
              'IS NULL',
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
                TRUE,
              ],
              [
                'Contact_Address_contact_id_01.location_type_id:name',
                '=',
                '"Home"',
              ],
            ],
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
                'IN',
                [
                  'Electeur·trice',
                  'Inscrit·e Enfant',
                ],
              ],
              [
                'Contact_Membership_contact_id_01.status_id:name',
                'IN',
                [
                  'New',
                  'Current',
                  'Grace',
                ],
              ],
              [
                'is_deceased',
                '=',
                FALSE,
              ],
              [
                'contact_type:name',
                '=',
                '"Individual"',
              ],
            ],
          ],
          'having' => [],
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Membres_paroissiaux_traiter_SearchDisplay_Membres_sans_bergerie_table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Membres_sans_bergerie_table',
        'label' => E::ts('Membres_sans_bergerie_table'),
        'saved_search_id.name' => 'Membres_paroissiaux_traiter',
        'type' => 'table',
        'settings' => [
          'description' => NULL,
          'sort' => [
            [
              'sort_name',
              'ASC',
            ],
          ],
          'limit' => 0,
          'pager' => FALSE,
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'field',
              'key' => 'id',
              'label' => E::ts('Id. de contact'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'sort_name',
              'label' => E::ts('Nom trié'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.street_address',
              'label' => E::ts('Contact Adresses: Rue'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.city',
              'label' => E::ts('Contact Adresses: Ville'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'geomBergerie_name',
              'label' => E::ts('geomBergerie_name'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'villeBergerie_name',
              'label' => E::ts('villeBergerie_name'),
              'sortable' => TRUE,
            ],
          ],
          'actions' => [
            'download',
            'update',
            'setBergerieFromCity',
            'setBergerieFromGeom',
            'export',
          ],
          'classes' => [
            'table',
            'table-striped',
          ],
          'columnMode' => 'custom',
          'actions_display_mode' => 'menu',
          'headerCount' => TRUE,
          'editableRow' => [
            'disable' => TRUE,
          ],
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];
