<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_liste_distribution_foyer',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'liste_distribution_foyer',
        'label' => E::ts('liste distribution foyer'),
        'api_entity' => 'Household',
        'api_params' => [
          'version' => 4,
          'select' => [
            'complements_foyer.quartier:label',
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_commune',
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_voie',
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.is_even',
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.neg_numero_even',
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.rep',
            'sort_name',
          ],
          'orderBy' => [],
          'where' => [
            [
              'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.validation:name',
              '=',
              'valid',
            ],
          ],
          'groupBy' => [],
          'join' => [
            [
              'Address AS Contact_Address_contact_id_01',
              'INNER',
              [
                'id',
                '=',
                'Contact_Address_contact_id_01.contact_id',
              ],
              [
                'Contact_Address_contact_id_01.is_primary',
                '=',
                TRUE,
              ],
            ],
            [
              'Banaddr AS Contact_Address_contact_id_01_Address_Banaddr_addr_id_01',
              'INNER',
              [
                'Contact_Address_contact_id_01.id',
                '=',
                'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.addr_id',
              ],
            ],
          ],
          'having' => [],
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_liste_distribution_foyer_SearchDisplay_liste_distribution_foyer',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'liste_distribution_foyer',
        'label' => E::ts('liste distribution foyer paged display'),
        'saved_search_id.name' => 'liste_distribution_foyer',
        'type' => 'paged',
        'settings' => [
          'description' => NULL,
          'sort' => [
            [
              'complements_foyer.quartier:label',
              'ASC',
            ],
            [
              'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_commune',
              'ASC',
            ],
            [
              'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_voie',
              'ASC',
            ],
            [
              'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.is_even',
              'ASC',
            ],
            [
              'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.neg_numero_even',
              'ASC',
            ],
            [
              'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.rep',
              'ASC',
            ],
          ],
          'limit' => 500,
          'pager' => [],
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'field',
              'key' => 'complements_foyer.quartier:label',
              'dataType' => 'String',
              'label' => E::ts('Informations supplémentaires: Quartier (distribution, visiteurs, ...)'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_commune',
              'dataType' => 'String',
              'label' => E::ts('Contact Adresses - Adresse Banaddrs: Nom commune'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_voie',
              'dataType' => 'String',
              'label' => E::ts('Contact Adresses - Adresse Banaddrs: Nom voie'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.is_even',
              'dataType' => 'Integer',
              'label' => E::ts('Contact Adresses - Adresse Banaddrs: is_even'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.neg_numero_even',
              'dataType' => 'Integer',
              'label' => E::ts('Contact Adresses - Adresse Banaddrs: neg_numero_even'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.rep',
              'dataType' => 'String',
              'label' => E::ts('Contact Adresses - Adresse Banaddrs: Répéteur'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'sort_name',
              'dataType' => 'String',
              'label' => E::ts('Nom trié'),
              'sortable' => TRUE,
            ],
          ],
          'actions' => TRUE,
          'classes' => [
            'table',
            'table-striped',
          ],
          'maxsortgroup' => 1,
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];



