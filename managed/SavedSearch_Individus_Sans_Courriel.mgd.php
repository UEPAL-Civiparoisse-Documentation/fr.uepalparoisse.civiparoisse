<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Individus_sans_Courriel',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_sans_Courriel',
        'label' => E::ts('Individus sans courriel'),
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'Contact_Email_contact_id_01.email',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Individual',
              null,
            ],
            [
              'email_primary.email',
              'IS EMPTY',
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
            [
              'do_not_email',
              '=',
              false,
            ],
          ],
          'groupBy' => [],
          'join' => [
            [
              'Email AS Contact_Email_contact_id_01',
              'EXCLUDE',
              [
                'id',
                '=',
                'Contact_Email_contact_id_01.contact_id',
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
    'name' => 'SavedSearch_Civip_Individus_sans_Courriel_SearchDisplay_Civip_Individus_sans_Courriel_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_sans_Courriel_Table',
        'label' => E::ts('Individus sans courriel Table'),
        'saved_search_id.name' => 'Civip_Individus_sans_Courriel',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'created_date',
              'DESC',
            ],
          ],
          'actions' => [
            'contact.103',
            'contact.mailing',
            'download',
            'contact.2',
            'contact.3',
            'contact.16',
          ],
          'limit' => 50,
          'classes' => [
            'table',
            'table-striped',
            'table-bordered',
          ],
          'pager' => [
            'show_count' => false,
            'expose_limit' => true,
          ],
          'columns' => [
            [
              'type' => 'field',
              'key' => 'id',
              'dataType' => 'Integer',
              'label' => E::ts('Id. de contact'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'sort_name',
              'dataType' => 'String',
              'label' => E::ts('Nom trié'),
              'sortable' => true,
              'icons' => [
                [
                  'field' => 'contact_type:icon',
                  'side' => 'left',
                ],
              ],
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => '',
                'target' => '',
                'task' => '',
              ],
              'title' => E::ts('Voir Contact'),
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Email_contact_id_01.email',
              'dataType' => 'String',
              'label' => E::ts('Contact Courriels: Courriel'),
              'sortable' => true,
              'editable' => true,
              'cssRules' => [
                [
                  'bg-warning',
                  'Contact_Email_contact_id_01.email',
                  '=',
                ],
              ],
            ],
          ],
          'placeholder' => 5,
          'actions_display_mode' => 'menu',
          'editableRow' => [
            'full' => true,
          ],
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];
