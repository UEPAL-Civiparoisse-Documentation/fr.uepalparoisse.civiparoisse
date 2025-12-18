<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Confirmations',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Confirmations',
        'label' => E::ts('Confirmations'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'informations_religion.date_confirmation',
            'informations_religion.paroisse_confirmation:label',
            'informations_religion.verset_confirmation',
          ],
          'orderBy' => [],
          'where' => [
            [
              'informations_religion.date_confirmation',
              'IS NOT EMPTY',
            ],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => E::ts('Affichage des confirmations'),
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Confirmations_SearchDisplay_Civip_Liste_Confirmations_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Confirmations_Table',
        'label' => E::ts('Liste des confirmations Table'),
        'saved_search_id.name' => 'Civip_Liste_Confirmations',
        'type' => 'table',
        'acl_bypass' => false,
        'settings' => [
          'sort' => [
            [
              'informations_religion.date_confirmation',
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
            'parentMailing',
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
                'target' => '_blank',
              ],
              'title' => E::ts('Voir Contact'),
            ],
            [
              'type' => 'field',
              'key' => 'informations_religion.date_confirmation',
              'dataType' => 'Date',
              'label' => E::ts('Date de confirmation'),
              'sortable' => true,
              'cssRules' => [
                [
                  'font-bold',
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'informations_religion.paroisse_confirmation:label',
              'dataType' => 'String',
              'label' => E::ts('Lieu de confirmation'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'informations_religion.verset_confirmation',
              'dataType' => 'Text',
              'label' => E::ts('Verset de confirmation'),
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