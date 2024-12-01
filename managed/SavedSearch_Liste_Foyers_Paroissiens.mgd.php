<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Foyers_Paroissiens',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Foyers_Paroissiens',
        'label' => 'Foyers Paroissiens',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'household_name',
            'address_primary.street_address',
            'address_primary.postal_code',
            'address_primary.city',
            'address_primary.country_id:label',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.display_name) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_display_name',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01.title) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01_title',
           ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Household',
            ],
          ],
          'groupBy' => [
            'id',
          ],
          'join' => [
            [
              'Address AS Contact_Address_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Address_contact_id_01.contact_id',
              ],
              [
                'Contact_Address_contact_id_01.is_primary',
                '=',
                true,
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
                '"Household Member of"',
              ],
            ],
            [
              'Group AS Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01',
              'LEFT',
              'GroupContact',
              [
                'Contact_RelationshipCache_Contact_01.id',
                '=',
                'Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01.contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01.status:name',
                '=',
                '"Added"',
              ],
              [
                'Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01.is_hidden', 
                '=', 
                FALSE,
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Affichage de la composition des Foyers Paroissiens',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Foyers_Paroissiens_SearchDisplay_Civip_Liste_Foyers_Paroissiens_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Foyers_Paroissiens_Table',
        'label' => 'Foyers Paroissiens Table',
        'saved_search_id.name' => 'Civip_Liste_Foyers_Paroissiens',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'household_name',
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
              'key' => 'household_name',
              'dataType' => 'String',
              'label' => 'Nom du foyer',
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
              'type' => 'field',
              'key' => 'address_primary.street_address',
              'dataType' => 'String',
              'label' => 'Rue',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.postal_code',
              'dataType' => 'String',
              'label' => 'Code postal',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.city',
              'dataType' => 'String',
              'label' => 'Ville',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.country_id:label',
              'dataType' => 'Integer',
              'label' => 'Pays',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_display_name',
              'dataType' => 'String',
              'label' => 'Nom et prénom',
              'sortable' => true,
              'title' => 'Voir Contact',
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01_title',
              'dataType' => 'String',
              'label' => 'Groupes',
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
