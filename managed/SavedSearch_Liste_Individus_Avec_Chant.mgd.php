<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Individus_Avec_Chant',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name',
      ],
      'values' => [
        'name' => 'Civip_Liste_Individus_Avec_Chant',
        'label' => E::ts('Liste des Individus avec Pupitre'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'competences.musique_chant:label',
            'birth_date',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Individual',
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
              'competences.musique_chant:name',
              'IS NOT EMPTY',
            ],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => E::ts('Affichage des Individus ayant une compétence Chant'),
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Individus_Avec_Chant_SearchDisplay_Civip_Liste_Individus_Avec_Chant_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Individus_Avec_Chant_Table',
        'label' => E::ts('Liste des Individus avec Pupitre Table'),
        'saved_search_id.name' => 'Civip_Liste_Individus_Avec_Chant',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'competences.musique_chant:label',
              'ASC',
            ],
            [
              'sort_name',
              'ASC',
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
            'parentMailing'
          ],
          'limit' => 50,
          'classes' => [
            'table',
            'table-striped',
            'table-bordered',
            'crm-sticky-header',
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
              'label' => E::ts('Nom et prénom'),
              'sortable' => true,
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => '',
                'target' => '_blank',
                'task' => '',
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
              'key' => 'competences.musique_chant:label',
              'dataType' => 'String',
              'label' => E::ts('Pupitre'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'birth_date',
              'dataType' => 'Date',
              'label' => E::ts('Date de naissance'),
              'sortable' => true,
            ],
          ],
          'placeholder' => 5,
          'headerCount' => true,
          'actions_display_mode' => 'menu',
          'editableRow' => [
            'full' => true,
          ],
        ],
        'acl_bypass' => false,
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];