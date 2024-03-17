<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Individus_sans_Statut_Membre',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_sans_Statut_Membre',
        'label' => 'Individus sans Lien avec la Paroisse',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Individual',
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
          ],
          'groupBy' => [],
          'join' => [
            [
              'Membership AS Contact_Membership_contact_id_01',
              'EXCLUDE',
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
        'description' => 'Recherche des Individus sans Statut Membre',
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Individus_sans_Statut_Membre_SearchDisplay_Civip_Individus_sans_Statut_Membre_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Individus_sans_Statut_Membre_Table',
        'label' => 'Individus sans Statut Membre Table',
        'saved_search_id.name' => 'Civip_Individus_sans_Statut_Membre',
        'type' => 'table',
        'settings' => [
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
                  'path' => 'civicrm/contact/view/membership?reset=1&action=add&cid=[id]&context=membership',
                  'icon' => 'fa-external-link',
                  'text' => 'Modifier le statut Membre',
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
