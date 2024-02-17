<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Distribution_Quartiers',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Distribution_Quartiers',
        'label' => 'Liste de Distribution par Quartiers',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'complements_foyer.quartier:label',
            'household_name',
            'Contact_Address_contact_id_01.street_address',
            'Contact_Address_contact_id_01.postal_code',
            'Contact_Address_contact_id_01.city',
            'Contact_Address_contact_id_01.country_id:label',
            'Contact_Phone_contact_id_01.phone',
           ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Household',
            ],
            [
              'complements_foyer.mode_distribution:name',
              '=',
              'Distribu_',
            ],
          ],
          'groupBy' => [],
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
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Liste des Foyers pour la Distribution par Quartiers',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Distribution_Quartiers_SearchDisplay_CivipCivip_Liste_Distribution_Quartiers_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Liste_Distribution_Quartiers_Table',
        'label' => 'Liste de Distribution par Quartiers Table',
        'saved_search_id.name' => 'Civip_Liste_Distribution_Quartiers',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'complements_foyer.quartier:label',
              'ASC',
            ],
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
              'key' => 'complements_foyer.quartier:label',
              'dataType' => 'String',
              'label' => 'Nom du Quartier',
              'sortable' => true,
              'cssRules' => [],
              'tally' => [
                'fn' => null,
              ],
            ],
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
              'key' => 'Contact_Address_contact_id_01.street_address',
              'dataType' => 'String',
              'label' => 'Rue',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.postal_code',
              'dataType' => 'String',
              'label' => 'Code postal',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.city',
              'dataType' => 'String',
              'label' => 'Ville',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.country_id:label',
              'dataType' => 'Integer',
              'label' => 'Pays',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Phone_contact_id_01.phone',
              'dataType' => 'String',
              'label' => 'Téléphone',
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