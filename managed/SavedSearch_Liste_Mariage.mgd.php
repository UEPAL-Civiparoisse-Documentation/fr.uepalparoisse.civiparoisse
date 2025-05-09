<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Mariages',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Mariages',
        'label' => E::ts('Bénédictions Nuptiales'),
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.near_contact_id.sort_name) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_near_contact_id_sort_name',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.etat_civil.nom_naissance) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_nom_naissance',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.etat_civil.date_mariage) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_date_mariage',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.etat_civil.date_benediction_nuptiale) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_date_benediction_nuptiale',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.etat_civil.paroisse_mariage:label) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_paroisse_mariage_label',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.etat_civil.verset_mariage) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_verset_mariage',
            'sort_name',
            'address_primary.street_address',
            'address_primary.city',
            'address_primary.postal_code',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.email_primary.email) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_email_primary_email',
            'GROUP_CONCAT(DISTINCT Contact_RelationshipCache_Contact_01.phone_primary.phone) AS GROUP_CONCAT_Contact_RelationshipCache_Contact_01_phone_primary_phone',
          ],
          'orderBy' => [],
          'where' => [
            [
              'Contact_RelationshipCache_Contact_01.etat_civil.date_mariage',
              'IS NOT EMPTY',
            ],
            [
              'Contact_RelationshipCache_Contact_01.is_deceased',
              '=',
              FALSE,
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
            ],
            [
              'Contact AS Contact_RelationshipCache_Contact_01_Contact_RelationshipCache_Contact_01',
              'INNER',
              'RelationshipCache',
              [
                'Contact_RelationshipCache_Contact_01.id',
                '=',
                'Contact_RelationshipCache_Contact_01_Contact_RelationshipCache_Contact_01.far_contact_id',
              ],
              [
                'Contact_RelationshipCache_Contact_01_Contact_RelationshipCache_Contact_01.near_relation:name',
                '=',
                '"Spouse of"',
              ],
            ],
          ],
          'having' => [],
      ],
      'expires_date' => null,
      'description' => 'Affichage des mariages',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Mariages_SearchDisplay_Civip_Liste_Mariages_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Mariages_Table',
        'label' => E::ts('Liste des mariages Table'),
        'saved_search_id.name' => 'Civip_Liste_Mariages',
        'type' => 'table',
        'acl_bypass' => false,
        'settings' => [
          'sort' => [
            [
              'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_date_benediction_nuptiale',
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
          'description' => null,
          'limit' => 50,
          'classes' => [
            'table',
            'table-striped',
            'table-bordered',
          ],
          'pager' => [
            'show_count' => true,
            'expose_limit' => true,
          ],
          'columns' => [
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_near_contact_id_sort_name',
              'dataType' => 'String',
              'label' => E::ts('Noms et prénoms'),
              'sortable' => true,
              'link' => [
                'path' => '',
                'entity' => 'Contact',
                'action' => 'view',
                'join' => '',
                'target' => '_blank',
              ],
              'title' => E::ts('Voir Contact'),
              'icons' => [
                [
                  'field' => 'Contact_RelationshipCache_Contact_01.contact_type:icon',
                  'side' => 'left',
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_nom_naissance',
              'dataType' => 'String',
              'label' => E::ts('Noms de naissance'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_date_mariage',
              'dataType' => 'Date',
              'label' => E::ts('Date de mariage'),
              'sortable' => true,
              'cssRules' => [],
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_date_benediction_nuptiale',
              'dataType' => 'Date',
              'label' => E::ts('Date de la bénédiction nuptiale'),
              'sortable' => true,
              'cssRules' => [
                [
                  'font-bold',
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_paroisse_mariage_label',
              'dataType' => 'String',
              'label' => E::ts('Lieu de la bénédiction nuptiale'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_etat_civil_verset_mariage',
              'dataType' => 'Text',
              'label' => E::ts('Verset de mariage'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'sort_name',
              'dataType' => 'String',
              'label' => E::ts('Nom du Foyer'),
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
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_email_primary_email',
              'dataType' => 'String',
              'label' => E::ts('Courriels'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'GROUP_CONCAT_Contact_RelationshipCache_Contact_01_phone_primary_phone',
              'dataType' => 'String',
              'label' => E::ts('Téléphones'),
              'sortable' => true,
            ],
          ],
          'actions' => true,
          'classes' => [
            'table',
            'table-striped',
          ],
          'placeholder' => 3,
          'headerCount' => true,
          'actions_display_mode' => 'menu',
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];