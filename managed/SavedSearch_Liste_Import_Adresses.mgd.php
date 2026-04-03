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
        'label' => E::ts('Liste des Adresses'),
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'external_identifier',
            'id',
            'last_name',
            'first_name',
            'sort_name',
            'Contact_RelationshipCache_Contact_01.id',
            'address_primary.street_address',
            'address_primary.supplemental_address_1',
            'Contact_RelationshipCache_Contact_01.address_primary.postal_code',
            'Contact_RelationshipCache_Contact_01.address_primary.city',
            'Contact_RelationshipCache_Contact_01.address_primary.country_id:label',
            'Contact_RelationshipCache_Contact_01.address_primary.state_province_id:label',
            'Contact_RelationshipCache_Contact_01.address_primary',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Individual',
            ],
          ],
          'groupBy' => [],
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
                '"Household Member is"',
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
        'label' => E::ts('Liste des Adresses Table'),
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
            'crm-sticky-header',
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
              'label' => E::ts('Individus : Id. externe'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'id',
              'dataType' => 'Integer',
              'label' => E::ts('Individu : Id. de contact'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'last_name',
              'dataType' => 'String',
              'label' => E::ts('Nom de famille'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'first_name',
              'dataType' => 'String',
              'label' => E::ts('Prénom'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'sort_name',
              'dataType' => 'String',
              'label' => E::ts('Nom trié'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.id',
              'dataType' => 'Integer',
              'label' => E::ts('Foyer : Id. de contact'),
              'sortable' => true,
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
              'key' => 'address_primary.supplemental_address_1',
              'dataType' => 'String',
              'label' => E::ts("Complément d'adresse 1"),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.address_primary.postal_code',
              'dataType' => 'String',
              'label' => E::ts('Code postal'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.address_primary.city',
              'dataType' => 'String',
              'label' => E::ts('Ville'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.address_primary.country_id:label',
              'dataType' => 'Integer',
              'label' => E::ts('Pays'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.address_primary.state_province_id:label',
              'dataType' => 'Integer',
              'label' => E::ts('Subdivision de pays'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_RelationshipCache_Contact_01.address_primary',
              'dataType' => 'Integer',
              'label' => E::ts('Foyer : ID Adresse'),
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