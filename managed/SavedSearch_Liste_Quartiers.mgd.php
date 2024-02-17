<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Quartiers',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Quartiers',
        'label' => 'Liste des Quartiers',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'OptionValue',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'label',
            'is_active',
          ],
          'orderBy' => [],
          'where' => [
            [
              'option_group_id:name',
              '=',
              'quartier',
            ],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Liste des Quartiers, pour modifications',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Quartiers_SearchDisplay_Civip_Liste_Quartiers_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Quartiers_Table',
        'label' => 'Liste des Quartiers',
        'saved_search_id.name' => 'Civip_Liste_Quartiers',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'weight',
              'ASC',
            ],
          ],
          'actions' => [
            'enable',
            'download',
            'disable',
          ],
          'limit' => 100,
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
              'key' => 'label',
              'dataType' => 'String',
              'label' => 'Nom du Quartier',
              'sortable' => true,
              'editable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'is_active',
              'dataType' => 'Boolean',
              'label' => 'Visible ? (Oui/Non)',
              'sortable' => true,
              'editable' => true,
            ],

          ],
          'placeholder' => 5,
          'headerCount' => true,
        ],
        'acl_bypass' => false,
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];