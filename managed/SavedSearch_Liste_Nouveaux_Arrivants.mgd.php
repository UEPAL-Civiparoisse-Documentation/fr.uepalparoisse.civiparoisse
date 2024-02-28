<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Nouveaux_arrivants',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Nouveaux_arrivants',
        'label' => 'Nouveaux arrivants',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'last_name',
            'first_name',
            'birth_date',
            'DATE(created_date) AS DATE_created_date',
            'address_primary.street_address',
            'address_primary.postal_code',
            'address_primary.city',
            'address_primary.country_id:label',
            'Contact_Email_contact_id_01.email',
            'Contact_Phone_contact_id_01.phone',
            'GROUP_CONCAT(DISTINCT Contact_GroupContact_Group_01.title) AS GROUP_CONCAT_Contact_GroupContact_Group_01_title',
            'Contact_Membership_contact_id_01.membership_type_id:label',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Individual',
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
          ],
          'groupBy' => [
            'id',
          ],
          'join' => [
            [
              'Email AS Contact_Email_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Email_contact_id_01.contact_id',
              ],
              [
                'Contact_Email_contact_id_01.is_primary',
                '=',
                true,
              ],
            ],
            [
              'Phone AS Contact_Phone_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Phone_contact_id_01.contact_id',
              ],
              [
                'Contact_Phone_contact_id_01.is_primary',
                '=',
                true,
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
            [
              'Membership AS Contact_Membership_contact_id_01',
              'LEFT',
              [
                'id',
                '=',
                'Contact_Membership_contact_id_01.contact_id',
              ],
              [
                'Contact_Membership_contact_id_01.status_id:name',
                'IN',
                [
                  'New',
                  'Current',
                  'Grace',
                ],
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Affichage des Nouveaux Arrivants",
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Nouveaux_arrivants_SearchDisplay_Civip_Liste_Nouveaux_arrivants_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Nouveaux_arrivants_Table',
        'label' => 'Nouveaux arrivants Table',
        'saved_search_id.name' => 'Civip_Liste_Nouveaux_arrivants',
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
              'key' => 'last_name',
              'dataType' => 'String',
              'label' => 'Nom de famille',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'first_name',
              'dataType' => 'String',
              'label' => 'Prénom',
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
              'key' => 'Contact_Email_contact_id_01.email',
              'dataType' => 'String',
              'label' => 'Courriel',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Phone_contact_id_01.phone',
              'dataType' => 'String',
              'label' => 'Téléphone',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_GroupContact_Group_01_title',
              'dataType' => 'String',
              'label' => 'Groupes',
              'sortable' => true,
              'rewrite' => '',
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
              'key' => 'DATE_created_date',
              'dataType' => 'Date',
              'label' => "Date d'inscription",
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
