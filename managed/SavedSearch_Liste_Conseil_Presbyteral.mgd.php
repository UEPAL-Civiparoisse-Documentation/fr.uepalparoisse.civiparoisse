<?php

/* TODO 
- Trouver les Relations dont le far_contact ID est le contact_id de la paroisse (celui dans Domain)
*/

use CRM_Civiparoisse_ExtensionUtil as E;

return [
    [
      'name' => 'SavedSearch_Civip_Liste_Conseil_Presbyteral',
      'entity' => 'SavedSearch',
      'cleanup' => 'always',
      'update' => 'always',
      'params' => [
        'version' => 4,
        'values' => [
          'name' => 'Civip_Liste_Conseil_Presbyteral',
          'label' => 'Conseil Presbytéral',
          'form_values' => null,
          'mapping_id' => null,
          'search_custom_id' => null,
          'api_entity' => 'Contact',
          'api_params' => [
            'version' => 4,
            'select' => [
              'id',
              'display_name',
              'Contact_RelationshipCache_Contact_01.relationship_type_id.label_a_b',
              'Contact_RelationshipCache_Contact_01.display_name',
              'Contact_RelationshipCache_Contact_01.start_date',
              'Contact_RelationshipCache_Contact_01.end_date',
              'email_primary.email',
              'phone_primary.phone',
              'address_primary.street_address',
              'address_primary.postal_code',
              'address_primary.city',
              'birth_date',
              'Contact_RelationshipCache_Contact_01.is_current',
              'Contact_RelationshipCache_Contact_01.near_contact_id',
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
              ],
            ],
            'having' => [],
          ],
          'expires_date' => null,
          'description' => 'Liste du Conseil Presbytéral',
        ],
      ],
    ],
    [
      'name' => 'SavedSearch_Civip_Liste_Conseil_Presbyteral_SearchDisplay_Civip_Liste_Conseil_Presbyteral_Table',
      'entity' => 'SearchDisplay',
      'cleanup' => 'always',
      'update' => 'always',
      'params' => [
        'version' => 4,
        'values' => [
          'name' => 'Civip_Liste_Conseil_Presbyteral_Table',
          'label' => 'Conseil Presbytéral Table',
          'saved_search_id.name' => 'Civip_Liste_Conseil_Presbyteral',
          'type' => 'table',
          'settings' => [
            'description' => null,
            'sort' => [
              [
                'Contact_RelationshipCache_Contact_01.is_current',
                'DESC',
              ],
              [
                'Contact_RelationshipCache_Contact_01.relationship_type_id.label_a_b',
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
              'export',
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
                'key' => 'display_name',
                'dataType' => 'String',
                'label' => 'Nom et Prénom',
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
                'type' => 'field',
                'key' => 'Contact_RelationshipCache_Contact_01.relationship_type_id.label_a_b',
                'dataType' => 'String',
                'label' => 'Fonction',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'Contact_RelationshipCache_Contact_01.display_name',
                'dataType' => 'String',
                'label' => 'Paroisse',
                'sortable' => true,
                'icons' => [
                  [
                    'field' => 'Contact_RelationshipCache_Contact_01.contact_type:icon',
                    'side' => 'left',
                  ],
                ],
              ],
              [
                'type' => 'field',
                'key' => 'Contact_RelationshipCache_Contact_01.start_date',
                'dataType' => 'Date',
                'label' => 'Date de début du mandat actuel',
                'sortable' => true,
                'cssRules' => [
                  [
                    'bg-success',
                    'Contact_RelationshipCache_Contact_01.is_current',
                    '=',
                    true,
                  ],
                  [
                    'bg-warning',
                    'Contact_RelationshipCache_Contact_01.is_current',
                    '=',
                    false,
                  ],
                ],
              ],
              [
                'type' => 'field',
                'key' => 'Contact_RelationshipCache_Contact_01.end_date',
                'dataType' => 'Date',
                'label' => 'Date de fin du mandat actuel',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'email_primary.email',
                'dataType' => 'String',
                'label' => 'Courriel',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'phone_primary.phone',
                'dataType' => 'String',
                'label' => 'Téléphone',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'address_primary.street_address',
                'dataType' => 'String',
                'label' => 'Adresse',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'address_primary.postal_code',
                'dataType' => 'String',
                'label' => 'Code postal',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'address_primary.city',
                'dataType' => 'String',
                'label' => 'Ville',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'birth_date',
                'dataType' => 'Date',
                'label' => 'Date de naissance',
                'sortable' => true,
              ],
              [
                'type' => 'field',
                'key' => 'Contact_RelationshipCache_Contact_01.is_current',
                'dataType' => 'Boolean',
                'label' => 'Mandat en cours ?',
                'sortable' => true,
              ],
             ],
            'placeholder' => 5,
            'headerCount' => true,
            'noResultsText' => 'Pas de résultats : vérifier que vous avez bien sélectionné un groupe',
          ],
          'acl_bypass' => false,
        ],
      ],
    ],
  ];
