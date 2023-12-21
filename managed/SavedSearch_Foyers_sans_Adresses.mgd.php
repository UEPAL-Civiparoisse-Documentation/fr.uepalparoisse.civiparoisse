<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Foyers_sans_Adresses',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Foyers_sans_Adresses',
        'label' => 'Foyers sans Adresses',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Household',
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
              'EXCLUDE',
              [
                'id',
                '=',
                'Contact_Address_contact_id_01.contact_id',
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Recherche des Foyers n'ayant pas d'adresses",
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Foyers_sans_Adresses_SearchDisplay_Civip_Foyers_sans_Adresses_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Foyers_sans_Adresses_Table',
        'label' => 'Foyers sans Adresses Table',
        'saved_search_id.name' => 'Civip_Foyers_sans_Adresses',
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
              'label' => 'Id. de contact',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'display_name',
              'dataType' => 'String',
              'label' => 'Nom du Foyer',
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
              'title' => 'Voir Contact',
            ],
            [
              'links' => [
                [
                  'entity' => 'Contact',
                  'action' => 'view',
                  'join' => '',
                  'target' => '_blank',
                  'icon' => 'fa-external-link',
                  'text' => "Modifier l'adresse",
                  'style' => 'default',
                  'path' => '',
                ],
              ],
              'type' => 'links',
              'alignment' => 'text-center',
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
