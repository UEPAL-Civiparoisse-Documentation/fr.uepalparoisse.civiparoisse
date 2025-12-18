<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Civip_Liste_Utilisateurs',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'match' => [
        'name'
      ],
      'values' => [
        'name' => 'Civip_Liste_Utilisateurs',
        'label' => E::ts('Liste des Utilisateurs'),
        'api_entity' => 'DrupalUser',
        'api_params' => [
          'version' => 4,
          'select' => [
            'uid',
            'user_name',
            'mail',
            'created',
            'access',
            'roles',
            'status',
          ],
          'orderBy' => [],
          'where' => [],
        ],
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Civip_Liste_Utilisateurs_SearchDisplay_Civip_Liste_Utilisateurs_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Civip_Liste_Utilisateurs_Table',
        'label' => E::ts('Liste des utilisateurs Table'),
        'saved_search_id.name' => 'Civip_Liste_Utilisateurs',
        'type' => 'table',
        'settings' => [
          'description' => null,
          'sort' => [
            [
              'user_name',
              'ASC',
            ],
          ],
          'actions' => true,
          'limit' => 100,
          'classes' => [
            'table',
            'table-striped',
            'table-bordered',
            'crm-sticky-header',
          ],
          'pager' => [
            'show_count' => false,
            'expose_limit' => false,
          ],
          'columns' => [
            [
              'type' => 'field',
              'key' => 'user_name',
              'dataType' => 'String',
              'label' => E::ts("Nom de l'utilisateur"),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'mail',
              'dataType' => 'String',
              'label' => E::ts('Mail'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'roles',
              'dataType' => 'String',
              'label' => E::ts('Rôles'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'created',
              'dataType' => 'Date',
              'label' => E::ts('Date de création'),
              'sortable' => true,
            ],
            [
              'type' => 'field',
              'key' => 'access',
              'dataType' => 'Date',
              'label' => E::ts('Dernière connexion'),
              'sortable' => true,
              'cssRules' => [
                [
                  'bg-danger',
                  'access',
                  '<',
                  'now - 9 month',
                ],
                [
                  'bg-danger',
                  'access',
                  'IS EMPTY',
                ],
              ],
              'rewrite' => '{capture assign="DateConnexion"}[access]{/capture}
                {capture assign="DateConnexionFormate"}{$access|date_format:"%Y-%m-%d"|string_format:"%s"}{/capture}
                {capture assign="DateTroisMois"}{($smarty.now-7776000)|date_format:"%Y-%m-%d"|string_format:"%s"}{/capture}
                {capture assign="DateNeufMois"}{($smarty.now-23328000)|date_format:"%Y-%m-%d"|string_format:"%s"}{/capture}
                {if !$DateConnexion}
                Jamais connecté
                {elseif $DateConnexionFormate gte $DateTroisMois}
                Inférieur à 3 mois
                {elseif $DateConnexionFormate gte $DateNeufMois}
                Entre 3 et 9 mois
                {else}
                Supérieur à 9 mois
                {/if}
                ',
            ],
            [
              'type' => 'field',
              'key' => 'status',
              'dataType' => 'Integer',
              'label' => E::ts('Status'),
              'sortable' => true,
              'cssRules' => [
                [
                  'bg-warning',
                  'status',
                  'LIKE',
                  'Bloqué',
                ],
              ],
            ],
            [
              'links' => [
                [
                  'path' => 'user/[uid]/edit',
                  'icon' => 'fa-external-link',
                  'text' => E::ts('Modifier'),
                  'style' => 'default',
                  'conditions' => [],
                  'task' => '',
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
          'actions_display_mode' => 'menu',
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