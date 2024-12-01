<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Foyers_Sans_Mails',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Foyers_Sans_Mails',
        'label' => 'Foyers sans Adresses Mails',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.display_name) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_display_name',
            'address_primary.street_address',
            'address_primary.postal_code',
            'address_primary.city',
            'address_primary.country_id:label',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.email) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01_email',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01.title) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01_title',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01.membership_type_id:label) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01_membership_type_id_label',
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
          'groupBy' => [
            'id',
          ],
          'join' => [
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
                '"Head of Household for"',
              ],
              [
                'Contact_RelationshipCache_Contact_01.is_deceased',
                '=',
                false,
              ],
              [
                'Contact_RelationshipCache_Contact_01.is_deleted',
                '=',
                false,
              ],
            ],
            [
              'Email AS Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01',
              'LEFT',
              [
                'Contact_RelationshipCache_Contact_01.id',
                '=',
                'Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01.is_primary',
                '=',
                true,
              ],
            ],
            [
              'Membership AS Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01',
              'LEFT',
              [
                'Contact_RelationshipCache_Contact_01.id',
                '=',
                'Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01.contact_id',
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
          ],
          'having' => [
            [
              'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01_email',
              'IS EMPTY',
            ],
          ],
        ],
        'expires_date' => null,
        'description' => 'Affichage de la liste des Foyers sans Adresses Mails',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Foyers_Sans_Mails_SearchDisplay_Civip_Liste_Foyers_Sans_Mails_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Foyers_Sans_Mails_Table',
        'label' => 'Foyers sans Adresses Mails Table',
        'saved_search_id.name' => 'Civip_Liste_Foyers_Sans_Mails',
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
              'key' => 'id',
              'dataType' => 'Integer',
              'label' => 'Identifiant',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'display_name',
              'dataType' => 'String',
              'label' => 'Nom du foyer',
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
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_display_name',
              'dataType' => 'String',
              'label' => 'Chefs de famille du foyer',
              'sortable' => true,
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => 'Contact_RelationshipCache_Contact_01',
                'target' => '_blank',
              ],
              'title' => 'Voir Contact Contacts liés',
              'icons' => [
                [
                  'field' => 'Contact_RelationshipCache_Contact_01.contact_type:icon',
                  'side' => 'left',
                ],
              ],
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
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_Email_contact_id_01_email',
              'dataType' => 'String',
              'label' => 'Courriels',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_GroupContact_Group_01_title',
              'dataType' => 'String',
              'label' => 'Groupes',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_Contact_Membership_contact_id_01_membership_type_id_label',
              'dataType' => 'Integer',
              'label' => 'Liens paroissiaux',
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
