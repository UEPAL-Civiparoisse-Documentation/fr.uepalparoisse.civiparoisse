<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Participants_Groupe',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Participants_Groupe',
        'label' => E::ts('Participants à un Groupe'),
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
            'address_primary.postal_code',
            'address_primary.city',
            'email_primary.email',
            'phone_primary.phone',
            'Contact_RelationshipCache_Contact_01.phone_primary.phone',
            'age_years',
            'birth_date',
          ],
          'orderBy' => [],
          'where' => [
            [
              'Contact_GroupContact_Group_01.is_hidden',
              '=',
              false,
            ],
          ],
          'groupBy' => [
            'id',
          ],
          'join' => [
            [
              'Group AS Contact_GroupContact_Group_01',
              'INNER',
              'GroupContact',
              [
                'id',
                '=',
                'Contact_GroupContact_Group_01.contact_id',
              ],
              [
                'Contact_GroupContact_Group_01.status:name',
                '=',
                '"Added"',
              ],
            ],
            [
              'Contact AS Contact_RelationshipCache_Contact_01',
              'INNER',
              'RelationshipCache',
              [
                'id',
                '=',
                'Contact_RelationshipCache_Contact_01.far_contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01.near_relation:name',
                '=',
                '"Household Member is"',
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Affichage des Participants à un groupe",
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Participants_Groupe_SearchDisplay_Civip_Liste_Participants_Groupe_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Participants_Groupe_Table',
        'label' => E::ts('Participants à un groupe Table'),
        'saved_search_id.name' => 'Civip_Liste_Participants_Groupe',
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
            'export',
            'contact.1',
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
              'key' => 'phone_primary.phone',
              'dataType' => 'String',
              'label' => E::ts('Téléphone portable'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.phone_primary.phone',
              'dataType' => 'String',
              'label' => E::ts('Téléphone fixe'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'email_primary.email',
              'dataType' => 'String',
              'label' => E::ts('Courriel'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.street_address',
              'dataType' => 'String',
              'label' => E::ts('Adresse'),
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
              'key' => 'age_years',
              'dataType' => 'Integer',
              'label' => E::ts('Âge (année)'),
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
          'actions_display_mode' => 'menu',
          'button' => 'Rechercher',
          'headerCount' => true,
          'noResultsText' => 'Sélectionner un ou des groupes, et cliquer sur Rechercher',
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];