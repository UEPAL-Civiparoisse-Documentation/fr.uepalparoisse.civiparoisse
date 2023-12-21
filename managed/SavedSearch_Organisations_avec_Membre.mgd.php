<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Organisation_avec_statut_Membre',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Organisation_avec_statut_Membre',
        'label' => 'Organisation avec statut Adhésion',
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
                'contact_type:name',
                '=',
                '"Organization"',
              ],
              [
                'is_deleted',
                '=',
                false,
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Recherche des Organisations ayant un statut Membre',
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Organisation_avec_statut_Membre_SearchDisplay_Civip_Organisation_avec_statut_Adhesion_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Organisation_avec_statut_Adhesion_Table',
        'label' => 'Organisation avec statut Adhésion Table',
        'saved_search_id.name' => 'Civip_Organisation_avec_statut_Membre',
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
              'label' => "Nom de l'Organisation",
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
              'key' => 'Contact_Membership_contact_id_01.membership_type_id:label',
              'dataType' => 'Integer',
              'label' => 'Statut Adhésion',
              'sortable' => true,
              'editable' => false,
            ],
            [
              'links' => [
                [
                  'entity' => 'Membership',
                  'action' => 'delete',
                  'join' => 'Contact_Membership_contact_id_01',
                  'target' => 'crm-popup',
                  'icon' => 'fa-trash',
                  'text' => 'Supprimer le statut Adhésion',
                  'style' => 'danger',
                  'path' => '',
                  'condition' => [],
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
