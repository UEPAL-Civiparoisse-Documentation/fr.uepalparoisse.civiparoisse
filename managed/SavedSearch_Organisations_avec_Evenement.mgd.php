<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Organisation_avec_Evenement',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Organisation_avec_Evenement',
        'label' => 'Organisation avec Evénement',
        'form_values' => null,
        'mapping_id' => null,
        'search_custom_id' => null,
        'api_entity' => 'Contact',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'display_name',
            'Contact_Participant_contact_id_01.event_id.title',
            'DATE(Contact_Participant_contact_id_01_Participant_Event_event_id_01.start_date) AS DATE_Contact_Participant_contact_id_01_Participant_Event_event_id_01_start_date',
            'DATE(Contact_Participant_contact_id_01_Participant_Event_event_id_01.end_date) AS DATE_Contact_Participant_contact_id_01_Participant_Event_event_id_01_end_date',
          ],
          'orderBy' => [],
          'where' => [
            [
              'contact_type:name',
              '=',
              'Organization',
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
              'Participant AS Contact_Participant_contact_id_01',
              'INNER',
              [
                'id',
                '=',
                'Contact_Participant_contact_id_01.contact_id',
              ],
            ],
            [
              'Event AS Contact_Participant_contact_id_01_Participant_Event_event_id_01',
              'INNER',
              [
                'Contact_Participant_contact_id_01.event_id',
                '=',
                'Contact_Participant_contact_id_01_Participant_Event_event_id_01.id',
              ],
            ],
          ],
          'having' => [],
        ],
        'expires_date' => null,
        'description' => "Recherche des Organisations ayant participé à un Evénement",
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Organisation_avec_Evenement_SearchDisplay_Civip_Organisation_avec_Evenement_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Organisation_avec_Evenement_Table',
        'label' => 'Organisation avec Evénement Table',
        'saved_search_id.name' => 'Civip_Organisation_avec_Evenement',
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
              'key' => 'Contact_Participant_contact_id_01.event_id.title',
              'dataType' => 'String',
              'label' => "Nom de l'événement",
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'DATE_Contact_Participant_contact_id_01_Participant_Event_event_id_01_start_date',
              'dataType' => 'Date',
              'label' => 'Date de début',
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'DATE_Contact_Participant_contact_id_01_Participant_Event_event_id_01_end_date',
              'dataType' => 'Date',
              'label' => 'Date de fin',
              'sortable' => true,
            ],
            [
              'links' => [
                [
                  'entity' => 'Participant',
                  'action' => 'delete',
                  'join' => 'Contact_Participant_contact_id_01',
                  'target' => 'crm-popup',
                  'icon' => 'fa-trash',
                  'text' => "Supprimer l'inscription à l'Evénement",
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
