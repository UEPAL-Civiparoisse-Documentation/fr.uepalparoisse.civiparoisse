<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Entreprises',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Entreprises',
        'label' => E::ts('Liste des Entreprises ou Organisations'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'sort_name',
            'contact_type:label',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.sort_name) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_sort_name',
            'address_primary.street_address',
            'address_primary.postal_code',
            'address_primary.city',
            'address_primary.country_id:label',
            'phone_primary.phone',
            'GROUP_CONCAT(DISTINCT Contact_EntityTag_Tag_01.label) AS GROUP_CONCAT_Contact_EntityTag_Tag_01_label',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Organization',
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
                '"Employee of"',
              ],
            ],
            [
              'Tag AS Contact_EntityTag_Tag_01',
              'LEFT',
              'EntityTag',
              [
                'id',
                '=',
                'Contact_EntityTag_Tag_01.entity_id',
              ],
              [
                'Contact_EntityTag_Tag_01.entity_table',
                '=',
                "'civicrm_contact'",
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Affichage de la liste des Entreprises ou Organisations',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Entreprises_SearchDisplay_Civip_Liste_Entreprises_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Entreprises_Table',
        'label' => E::ts('Liste des Entreprises ou Organisations Table'),
        'saved_search_id.name' => 'Civip_Liste_Entreprises',
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
            'crm-sticky-header',
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
              'label' => E::ts('Nom de l\'Entreprise ou de l\'Organisation'),
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
                'task' => '',
              ],
              'title' => E::ts('Voir Contact'),
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_sort_name',
              'dataType' => 'String',
              'label' => E::ts('Nom des contacts'),
              'sortable' => true,
              'icons' => [
                [
                  'field' => 'Contact_RelationshipCache_Contact_01.contact_type:icon',
                  'side' => 'left',
                ],
              ],
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => 'Contact_RelationshipCache_Contact_01',
                'target' => '_blank',
                'task' => '',
              ],
              'title' => E::ts('Voir le Contact'),
            ],
            [
              'type' => 'field',
              'key' => 'address_primary.street_address',
              'dataType' => 'String',
              'label' => E::ts('Rue'),
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
              'key' => 'address_primary.country_id:label',
              'dataType' => 'Integer',
              'label' => E::ts('Pays'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'phone_primary.phone',
              'dataType' => 'String',
              'label' => E::ts('Téléphone fixe'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_EntityTag_Tag_01_label',
              'dataType' => 'String',
              'label' => E::ts("Tags/Étiquettes"),
              'sortable' => TRUE,
            ],
          ],
          'placeholder' => 5,
          'actions_display_mode' => 'menu',
        ],
        'acl_bypass' => false,
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];
