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
        'label' => E::ts('Liste de distribution par quartier'),
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
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.numero',
            'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.validation:name',
            'Contact_GroupContact_Group_01.title',
          ],
          'orderBy' => [],
          'where' => [],
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
                'complements_foyer.mode_distribution:name',
                '=',
                '"Distribu_"',
              ],
              [
                'complements_foyer.quartier:name',
                'IS NOT EMPTY',
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
              'label' => E::ts('Quartier'),
              'sortable' => TRUE,
              'icons' => [
                [
                  'icon' => 'fa-triangle-exclamation',
                  'side' => 'left',
                  'if' => [
                    'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.validation:name',
                    '!=',
                    'valid',
                  ],
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.numero',
              'dataType' => 'Integer',
              'label' => E::ts('Numéro'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.rep',
              'dataType' => 'String',
              'label' => E::ts('Suffixe'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_voie',
              'dataType' => 'String',
              'label' => E::ts('Rue'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.nom_commune',
              'dataType' => 'String',
              'label' => E::ts('Ville'),
              'sortable' => TRUE,
            ],
            [
              'links' => [
                [
                  'entity' => 'Household',
                  'action' => 'view',
                  'join' => '',
                  'target' => '',
                  'icon' => 'fa-house-chimney',
                  'text' => E::ts('[sort_name]'),
                  'style' => 'default',
                  'path' => '',
                  'task' => '',
                  'conditions' => [],
                ],
              ],
              'type' => 'links',
              'label' => E::ts('Foyer'),
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.is_even',
              'dataType' => 'Integer',
              'label' => E::ts('Est pair'),
              'sortable' => TRUE,
              'cssRules' => [
                [
                  'hidden',
                ],
              ],
              'cssClass' => 'hidden',
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Address_contact_id_01_Address_Banaddr_addr_id_01.neg_numero_even',
              'dataType' => 'Integer',
              'label' => E::ts('numéro pair négatif'),
              'sortable' => TRUE,
              'cssRules' => [
                [
                  'hidden',
                ],
              ],
              'cssClass' => 'hidden',
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
