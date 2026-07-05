<?php
use CRM_Civiparoisse_ExtensionUtil as E;
return [
  [
    'name' => 'SavedSearch_Membres_paroissiaux',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Membres_paroissiaux',
        'label' => E::ts('Numérations Membres paroissiaux'),
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'defaulted_bergerie.name',
            'Contact_Membership_contact_id_01.membership_type_id:label',
            'COUNT(DISTINCT id) AS COUNT_id',
          ],
          'orderBy' => [],
          'where' => [],
          'groupBy' => [
            'defaulted_bergerie.name',
            'Contact_Membership_contact_id_01.membership_type_id',
          ],
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
                'Contact_Membership_contact_id_01.status_id:name',
                'IN',
                [
                  'New',
                  'Current',
                  'Grace',
                ],
              ],
              [
                'contact_type:name',
                '=',
                '"Individual"',
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
                'is_deceased',
                '=',
                FALSE,
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
    'name' => 'SavedSearch_Membres_paroissiaux_SearchDisplay_Membres_paroissiaux_Table_1',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Membres_paroissiaux_Table_1',
        'label' => E::ts('Numérations membres paroissiaux Table'),
        'saved_search_id.name' => 'Membres_paroissiaux',
        'type' => 'table',
        'settings' => [
          'description' => NULL,
          'sort' => [
            [
              'defaulted_bergerie.name',
              'ASC',
            ],
            [
              'Contact_Membership_contact_id_01.membership_type_id:label',
              'ASC',
            ],
          ],
          'limit' => 0,
          'pager' => FALSE,
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'field',
              'key' => 'defaulted_bergerie.name',
              'label' => E::ts('DefaultedBergerieNameLabel'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Membership_contact_id_01.membership_type_id:label',
              'label' => E::ts('Contact Adhésions: Type de membre'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'COUNT_id',
              'label' => E::ts('(Nombre) Id. de contact'),
              'sortable' => TRUE,
            ],
          ],
          'actions' => FALSE,
          'classes' => [
            'table',
            'table-striped',
          ],
          'columnMode' => 'custom',
          'headerCount' => TRUE,
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];
