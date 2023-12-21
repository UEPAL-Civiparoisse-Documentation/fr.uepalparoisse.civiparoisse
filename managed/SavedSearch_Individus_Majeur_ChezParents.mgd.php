<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Individus_Majeur_ChezParents',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_Majeur_ChezParents',
        'label' => 'Individus Majeur chez leurs Parents',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'birth_date',
            'Contact_RelationshipCache_Contact_02.display_name',
          ],
          'orderBy' => [],
          'where' => [],
          'groupBy' => [],
          'join' => [
            [
              'Contact AS Contact_RelationshipCache_Contact_01',
              'EXCLUDE',
              'RelationshipCache',
              [
                'id',
                '=',
                'Contact_RelationshipCache_Contact_01.far_contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01.far_relation:name',
                '=',
                '"Head of Household for"',
              ],
            ],
            [
              'Contact AS Contact_RelationshipCache_Contact_02',
              'INNER',
              'RelationshipCache',
              [
                'id',
                '=',
                'Contact_RelationshipCache_Contact_02.far_contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_02.far_relation:name',
                '=',
                '"Household Member of"',
              ],
              [
                'contact_type:name',
                '=',
                '"Individual"',
              ],
              [
                'is_deleted',
                '=',
                false,
              ],
              [
                'is_deceased',
                '=',
                false,
              ],
              [
                'age_years',
                '>=',
                27,
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Recherche des Individus Majeurs toujours rattachés au Foyer de leurs Parents",
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Individus_Majeur_ChezParents_SearchDisplay_Civip_Individus_Majeur_ChezParents_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_Majeur_ChezParents_Table',
        'label' => 'Individus Majeurs Chez leurs Parents',
        'saved_search_id.name' => 'Civip_Individus_Majeur_ChezParents',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'sort_name',
              'ASC',
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
              'label' => 'Nom et prénom',
              'sortable' => true,
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => '',
                'target' => '_blank',
              ],
              'title' => 'Voir Contact',
              'icons' => [
                [
                  'field' => 'contact_type:icon',
                  'side' => 'left',
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'birth_date',
              'dataType' => 'Date',
              'label' => 'Date de naissance',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_02.display_name',
              'dataType' => 'String',
              'label' => 'Nom du foyer',
              'sortable' => true,
              'icons' => [
                [
                  'field' => 'Contact_RelationshipCache_Contact_02.contact_type:icon',
                  'side' => 'left',
                ],
              ],
            ],
            [
              'links' => [
                [
                  'entity' => 'Contact',
                  'action' => 'view',
                  'join' => '',
                  'target' => '_blank',
                  'icon' => 'fa-external-link',
                  'text' => 'Modifier le Contact',
                  'style' => 'default',
                  'path' => '',
                  'condition' => [],
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
    ],
  ],
];
