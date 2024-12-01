<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Naissance',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Naissance',
        'label' => 'Liste de Naissance',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'age_years',
            'birth_date',
            'address_primary.street_address',
            'address_primary.postal_code',
            'address_primary.city',
            'address_primary.country_id:label',
            'phone_primary.phone',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.sort_name ORDER BY Contact_RelationshipCache_Contact_01.sort_name ASC) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_sort_name',
          ],
          'orderBy' => [],
          'where' => [
            [
              'birth_date',
              'IS NOT EMPTY',
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
              'LEFT',
              'RelationshipCache',
              [
                'id',
                '=',
                'Contact_RelationshipCache_Contact_01.far_contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01.near_relation:name',
                '=',
                '"Parent of"',
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Affichage des nouveaux nés',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Naissance_SearchDisplay_Civip_Liste_Naissance_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Naissance_Table',
        'label' => 'Liste de Naissance Table',
        'saved_search_id.name' => 'Civip_Liste_Naissance',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'birth_date',
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
              'label' => 'Nom et Prénom',
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
              'key' => 'age_years',
              'dataType' => 'Integer',
              'label' => 'Age (années)',
              'sortable' => true,
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
              'key' => 'address_primary.street_address',
              'dataType' => 'String',
              'label' => 'Adresse',
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
              'key' => 'phone_primary.phone',
              'dataType' => 'String',
              'label' => 'Téléphone',
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_sort_name',
              'dataType' => 'String',
              'label' => 'Nom des parents',
              'sortable' => true,
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
