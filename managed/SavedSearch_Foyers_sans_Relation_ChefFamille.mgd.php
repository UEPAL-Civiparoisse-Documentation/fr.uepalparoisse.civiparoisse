<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Foyers_sans_Relation_ChefFamille',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Foyers_sans_Relation_ChefFamille',
        'label' => 'Foyers sans relation Chef Famille',
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
              'Contact AS Contact_RelationshipCache_Contact_01',
              'EXCLUDE',
              'RelationshipCache',
              [
                'id',
                '=',
                'Contact_RelationshipCache_Contact_01.far_contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01.near_relation:name',
                '=',
                '"Head of Household for"',
              ],
              [
                "Contact_RelationshipCache_Contact_01.is_deleted",
                "=",
                false
              ]
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Recherche des Foyers n'ayant pas de Relation Chef de Famille",
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Foyers_sans_Relation_ChefFamille_SearchDisplay_Civip_Foyers_sans_Relation_ChefFamille_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Foyers_sans_Relation_Chef_Famille_Table',
        'label' => 'Foyers sans relation Chef Famille Table',
        'saved_search_id.name' => 'Civip_Foyers_sans_Relation_ChefFamille',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'actions' => [
            'contact.103',
            'contact.mailing',
            'download',
            'contact.2',
            'contact.3',
            'contact.16',
          ],
          'sort' => [
            [
              'sort_name',
              'ASC',
            ],
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
              'links' => [
                [
                  'path' => 'civicrm/contact/view/rel?cid=[id]&action=add&reset=1',
                  'icon' => 'fa-external-link',
                  'text' => 'Ajouter une relation',
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => 'crm-popup',
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
