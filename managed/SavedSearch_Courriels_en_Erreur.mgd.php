<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_E_mails_en_erreur',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_E_mails_en_erreur',
        'label' => 'E-mails en erreur',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'Contact_Email_contact_id_01.email',
            'Contact_Email_contact_id_01.hold_date',
            'Contact_Email_contact_id_01.on_hold:label',
          ],
          'orderBy' => [],
          'where' => [],
          'groupBy' => [],
          'join' => [
            [
              'Email AS Contact_Email_contact_id_01',
              'INNER',
              [
                'id',
                '=',
                'Contact_Email_contact_id_01.contact_id',
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
                'Contact_Email_contact_id_01.on_hold:name',
                'IN',
                [
                  '1',
                  '2',
                ],
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => 'Recherches des adresses mails en erreur',
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_E_mails_en_erreur_SearchDisplay_Civip_E_mails_en_erreur_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_E_mails_en_erreur_Table',
        'label' => 'E-mails en erreur Table',
        'saved_search_id.name' => 'Civip_E_mails_en_erreur',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'Contact_Email_contact_id_01.hold_date',
              'ASC',
            ],
            [
              'display_name',
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
              'label' => 'Nom (et prénom)',
              'sortable' => true,
              'cssRules' => [],
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
              'key' => 'Contact_Email_contact_id_01.email',
              'dataType' => 'String',
              'label' => 'Courriel',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Email_contact_id_01.hold_date',
              'dataType' => 'Timestamp',
              'label' => "Date d'invalidation",
              'sortable' => true,
              'rewrite' => '',
              'cssRules' => [],
            ],
            [
              'type' => 'field',
              'key' => 'Contact_Email_contact_id_01.on_hold:label',
              'dataType' => 'Integer',
              'label' => 'Raison du blocage',
              'sortable' => true,
              'editable' => true,
              'cssRules' => [
                [
                  'bg-danger',
                  'Contact_Email_contact_id_01.on_hold:label',
                  '=',
                  '2',
                ],
              ],
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
