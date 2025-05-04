<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Deces',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Deces',
        'label' => E::ts('Décès'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'address_primary.street_address',
            'address_primary.city',
            'address_primary.postal_code',
            'deceased_date',
            'etat_civil.date_obseques',
            'etat_civil.paroisse_enterrement:label',
            'birth_date',
            'annees_vie',
          ],
          'orderBy' => [],
          'where' => [
            [
              'is_deceased',
              '=',
              true,
            ],
            [
              'contact_type:name',
              '=',
              'Individual',
            ],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Affichage des décès',

      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Deces_SearchDisplay_Civip_Liste_Deces_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Deces_Table',
        'label' => E::ts('Liste des Personnes décédées Table'),
        'saved_search_id.name' => 'Civip_Liste_Deces',
        'type' => 'table',
        'acl_bypass' => false,
        'settings' => [
          'sort' => [
            [
              'deceased_date',
              'DESC',
            ],
          ],
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
          'limit' => 50,
          'classes' => [
            'table',
            'table-striped',
            'table-bordered',
          ],
          'pager' => [
            'show_count' => true,
            'expose_limit' => true,
          ],
          'columns' => [
            [
              'type' => 'field',
              'key' => 'sort_name',
              'dataType' => 'String',
              'label' => E::ts('Nom et Prénom'),
              'sortable' => true,
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => '',
                'target' => '_blank',
              ],
              'title' => E::ts('Voir Contact'),
              'icons' => [
                [
                  'field' => 'contact_type:icon',
                  'side' => 'left',
                ],
              ],

            ],
            [
              'type' => 'field',
              'key' => 'address_primary.street_address',
              'dataType' => 'String',
              'label' => E::ts('Rue'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.postal_code',
              'dataType' => 'String',
              'label' => E::ts('Code postal'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.city',
              'dataType' => 'String',
              'label' => E::ts('Ville'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'deceased_date',
              'dataType' => 'Date',
              'label' => E::ts('Date du décès'),
              'sortable' => true,
              'rewrite' => '',
              'cssRules' => [
                [
                  'font-bold',
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'etat_civil.date_obseques',
              'dataType' => 'Date',
              'label' => E::ts('Date des obsèques'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'etat_civil.paroisse_enterrement:label',
              'dataType' => 'String',
              'label' => E::ts("Lieu d'enterrement"),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'annees_vie',
              'dataType' => 'Integer',
              'label' => E::ts('Âge au décès'),
              'sortable' => true,
            ],
          ],
          'placeholder' => 3,
          'headerCount' => true,
          'actions_display_mode' => 'menu',
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];