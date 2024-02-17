<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Dates_Anniversaires',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Dates_Anniversaires',
        'label' => "Dates d'anniversaires",
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
            'age_years',
            'address_primary.street_address',
            'address_primary.postal_code',
            'address_primary.city',
            'address_primary.country_id:label',
            'email_primary.email',
            'phone_primary.phone',
            'Contact_Membership_contact_id_01.membership_type_id:label',
            'GROUP_CONCAT(DISTINCT Contact_GroupContact_Group_01.title) AS GROUP_CONCAT_Contact_GroupContact_Group_01_title',
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
          ],
          'groupBy' => [
            'id',
          ],
          'join' => [
            [
              'Membership AS Contact_Membership_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Membership_contact_id_01.contact_id',
              ],
            ],
            [
              'Group AS Contact_GroupContact_Group_01',
              'LEFT',
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
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Affichage des dates d'anniversaires",
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Dates_Anniversaires_SearchDisplay_Civip_Liste_Dates_Anniversaires_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Dates_Anniversaires_Table',
        'label' => "Dates d'anniversaires Table",
        'saved_search_id.name' => 'Civip_Liste_Dates_Anniversaires',
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
              'key' => 'display_name',
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
              'key' => 'birth_date',
              'dataType' => 'Date',
              'label' => 'Date de naissance',
              'sortable' => true,
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
              'key' => 'email_primary.email',
              'dataType' => 'String',
              'label' => 'Courriel',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'phone_primary.phone',
              'dataType' => 'String',
              'label' => 'Téléphone',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Membership_contact_id_01.membership_type_id:label',
              'dataType' => 'Integer',
              'label' => 'Statut paroissial',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_GroupContact_Group_01_title',
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
    ],
  ],
];
