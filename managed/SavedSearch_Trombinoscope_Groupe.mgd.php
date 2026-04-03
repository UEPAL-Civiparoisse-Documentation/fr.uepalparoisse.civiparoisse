<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Trombinoscope_Groupes',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Trombinoscope_Groupes',
        'label' => E::ts('Trombinoscope des Participants'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'image_URL',
          ],
          'orderBy' => [],
          'where' => [
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
        'description' => E::ts('Affichage du Trombinoscope des Groupes'),
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Trombinoscope_Groupes_SearchDisplay_Civip_Trombinoscope_Groupes_Grid',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Trombinoscope_Groupes_Grid',
        'label' => E::ts('Civip Trombinoscope Groupes Grid'),
        'saved_search_id.name' => 'Civip_Trombinoscope_Groupes',
        'type' => 'grid',
        'settings' => [
          'description' => null,
          'colno' => '5',
          'limit' => 50,
          'sort' => [
            [
              'sort_name',
              'ASC',
            ],
          ],
          'pager' => [
            'expose_limit' => false,
          ],
          'columns' => [
            [
              'type' => 'image',
              'key' => 'image_URL',
              'dataType' => 'Text',
              'image' => [
                'alt' => 'Image',
                'width' => 150,
                'height' => null,
              ],
              'break' => true,
              'rewrite' => '',
            ],
            [
              'type' => 'field',
              'key' => 'sort_name',
              'dataType' => 'String',
              'break' => true,
              'rewrite' => '',
              'icons' => [],
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
          ],
          'placeholder' => 5,
          'button' => 'Rechercher',
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];