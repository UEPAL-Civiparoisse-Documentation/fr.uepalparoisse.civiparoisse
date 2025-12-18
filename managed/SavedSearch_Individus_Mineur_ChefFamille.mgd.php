<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Individus_Enfants_avec_Statut_Chef_Famille',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_Enfants_avec_Statut_Chef_Famille',
        'label' => 'Individus Enfants avec Statut Chef Famille',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'Contact_RelationshipCache_Contact_01.display_name',
          ],
          'orderBy' => [],
          'where' => [
            [
              'OR',
              [
                [
                  'Contact_Membership_contact_id_01.membership_type_id:name',
                  '=',
                  'Inscrit·e Enfant',
                ],
                [
                  'age_years',
                  '<=',
                  18,
                ],
              ],
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
                'Contact_RelationshipCache_Contact_01.far_relation:name',
                '=',
                '"Head of Household for"',
              ],
              [
                'contact_type:name',
                '=',
                '"Individual"',
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
              [
                'Contact_RelationshipCache_Contact_01.is_deleted',
                '=',
                false,
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
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Recherche des Individus ayant un statut Enfant et une Relation Chef de Famille',
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Individus_Enfants_avec_Statut_Chef_Famille_SearchDisplay_Individus_Enfants_avec_Statut_Chef_Famille_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_Enfants_avec_Statut_Chef_Famille_Table',
        'label' => 'Individus Enfants avec Statut Chef Famille Table',
        'saved_search_id.name' => 'Civip_Individus_Enfants_avec_Statut_Chef_Famille',
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
          'sort' => [
            [
              'sort_name',
              'ASC',
            ],
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
                  'target' => 'crm-popup',
                ],
                [
                  'path' => 'civicrm/contact/view/rel?action=update&reset=1&id=[Contact_RelationshipCache_Contact_01.relationship_id]&cid=[id]&rtype=a_b',
                  'icon' => 'fa-external-link',
                  'text' => 'Modifier la relation',
                  'style' => 'default',
                  'condition' => [],
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => 'crm-popup',
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
