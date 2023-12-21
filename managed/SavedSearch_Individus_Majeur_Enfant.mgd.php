<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Individus_Majeurs_avec_Statut_Enfant',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_Majeurs_avec_Statut_Enfant',
        'label' => 'Individus Majeurs avec Statut Enfant',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'Contact_Membership_contact_id_01.membership_type_id:label',
            'Contact_Membership_contact_id_01.start_date',
          ],
          'orderBy' => [],
          'where' => [],
          'groupBy' => [],
          'join' => [
            [
              'Membership AS Contact_Membership_contact_id_01',
              'INNER',
              [
                'id',
                '=',
                'Contact_Membership_contact_id_01.contact_id',
              ],
              [
                'Contact_Membership_contact_id_01.membership_type_id:name',
                '=',
                '"Inscrit·e Enfant"',
              ],
              [
                'OR',
                [
                  [
                    'birth_date',
                    '<',
                    '"now - 18 year"',
                  ],
                  [
                    'Contact_Membership_contact_id_01.start_date',
                    '<',
                    '"now - 18 year"',
                  ],
                  [
                    'created_date',
                    '<',
                    '"now - 18 year"',
                  ],
                ],
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
              [
                'contact_type:name',
                '=',
                '"Individual"',
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Recherche des Individus de plus de 18 ans ayant encore le statut Inscrit Enfant',
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Individus_Majeurs_avec_Statut_Enfant_SearchDisplay_Civip_Individus_Majeurs_avec_Statut_Enfant_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_Majeurs_avec_Statut_Enfant_Table',
        'label' => 'Individus Majeurs avec Statut Enfant Table',
        'saved_search_id.name' => 'Civip_Individus_Majeurs_avec_Statut_Enfant',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'actions' => [
            'contact.103',
            'contact.mailing',
            'download',
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
              'label' => 'Id. de contact',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'display_name',
              'dataType' => 'String',
              'label' => 'Nom et prénom',
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
              'links' => [
                [
                  'path' => 'civicrm/contact/view/membership?reset=1&force=1&cid=[id]',
                  'icon' => 'fa-external-link',
                  'text' => "Modifier l'adhésion",
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '_blank',
                ],
              ],
              'type' => 'links',
              'alignment' => 'text-center',
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
