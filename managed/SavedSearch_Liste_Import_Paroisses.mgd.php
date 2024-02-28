<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Import_Paroisses',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Import_Paroisses',
        'label' => 'Liste des Paroisses',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'OptionValue',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'label',
            'value',
          ],
          'orderBy' => [],
          'where' => [
            [
              'option_group_id:name',
              '=',
              'liste_paroisses',
            ],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Liste des Paroisses, pour utilisation lors des imports de données',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Import_Paroisses_SearchDisplay_Civip_Liste_Import_Paroisses_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Import_Paroisses_Table',
        'label' => 'Liste des Paroisses',
        'saved_search_id.name' => 'Civip_Liste_Import_Paroisses',
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
            'download',
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
              'label' => 'Id. du choix',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'label',
              'dataType' => 'String',
              'label' => "Libellé de l'élément de liste de choix",
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'value',
              'dataType' => 'String',
              'label' => 'Élément de liste de choix',
              'sortable' => true,
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