<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Baptemes',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Baptemes',
        'label' => E::ts('Baptêmes'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'informations_religion.date_bapteme',
            'informations_religion.paroisse_bapteme:label',
            'informations_religion.verset_bapteme',
            'age_years',
          ],
          'orderBy' => [],
          'where' => [
            [
              'informations_religion.date_bapteme',
              'IS NOT EMPTY',
            ],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => E::ts('Affichage des baptêmes'),
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Baptemes_SearchDisplay_Civip_Liste_Baptemes_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Baptemes_Table',
        'label' => E::ts('Liste des baptêmes Table'),
        'saved_search_id.name' => 'Civip_Liste_Baptemes',
        'type' => 'table',
        'acl_bypass' => false,
        'settings' => [
          'sort' => [
            [
              'informations_religion.date_bapteme',
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
              'key' => 'informations_religion.date_bapteme',
              'dataType' => 'Date',
              'label' => E::ts('Date de baptême'),
              'sortable' => true,
              'cssRules' => [
                [
                  'font-bold',
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'informations_religion.paroisse_bapteme:label',
              'dataType' => 'String',
              'label' => E::ts('Lieu de baptême'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'informations_religion.verset_bapteme',
              'dataType' => 'Text',
              'label' => E::ts('Verset de baptême'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'age_years',
              'dataType' => 'Integer',
              'label' => E::ts('Age (actuel)'),
              'sortable' => TRUE,
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