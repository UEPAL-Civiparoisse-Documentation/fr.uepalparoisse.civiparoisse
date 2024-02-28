<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Import_Adresses',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Import_Adresses',
        'label' => 'Liste des Adresses',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'external_identifier',
            'id',
            'display_name',
            'Contact_Address_contact_id_01.id',
            'address_primary.street_address',
            'Contact_Address_contact_id_01.supplemental_address_1',
            'Contact_Address_contact_id_01.supplemental_address_2',
            'Contact_Address_contact_id_01.city',
            'Contact_Address_contact_id_01.postal_code',
            'Contact_Address_contact_id_01.country_id:label',
            'Contact_Address_contact_id_01.state_province_id:label',
           ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Household',
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
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Liste des Adresses des Foyers, pour utilisation lors des imports des donneés',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Import_Adresses_SearchDisplay_Civip_Liste_Import_Adresses_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Import_Adresses_Table',
        'label' => 'Liste des Adresses Table',
        'saved_search_id.name' => 'Civip_Liste_Import_Adresses',
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
            'download',
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
              'key' => 'external_identifier',
              'dataType' => 'String',
              'label' => 'Id. externe Foyer',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'id',
              'dataType' => 'Integer',
              'label' => 'Id. de contact Foyer',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'display_name',
              'dataType' => 'String',
              'label' => 'Nom du Foyer',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.id',
              'dataType' => 'Integer',
              'label' => "Id. de l'adresse",
              'sortable' => true,
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
              'key' => 'Contact_Address_contact_id_01.supplemental_address_1',
              'dataType' => 'String',
              'label' => "Complément d'adresse 1",
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01.supplemental_address_2',
              'dataType' => 'String',
              'label' => "Complément d'adresse 2",
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
              'key' => 'Contact_Address_contact_id_01.postal_code',
              'dataType' => 'String',
              'label' => 'Code postal',
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
              'key' => 'Contact_Address_contact_id_01.state_province_id:label',
              'dataType' => 'Integer',
              'label' => 'Subdivision de pays',
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