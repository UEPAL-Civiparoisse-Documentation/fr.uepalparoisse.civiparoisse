<?php
use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    "name"=> "SavedSearch_Bergerie_Search_by_admin_example_org",
    "entity"=> "SavedSearch",
    "cleanup"=> "always",
    "update"=> "always",
    "params"=> [
      "version"=> 4,
      "values"=> [
        "name"=> "Bergerie_Search_by_admin_example_org",
        "label"=> "Gestion des bergeries",
        "api_entity"=> "Bergerie",
        "api_params"=> [
          "version"=> 4,
          "select"=> [
            "id",
            "name",
            "description",
            "villes:label",
            "wkt"
          ],
          "orderBy"=> [],
          "where"=> [],
          "groupBy"=> [],
          "join"=> [],
          "having"=> []
        ]
      ],
      "match"=> [
        "name"
      ]
    ]
  ],
  [
    "name"=> "SavedSearch_Bergerie_Search_by_admin_example_org_SearchDisplay_Bergerie_Search_by_admin_example_org_Table_1",
    "entity"=> "SearchDisplay",
    "cleanup"=> "always",
    "update"=> "always",
    "params"=> [
      "version"=> 4,
      "values"=> [
        "name"=> "Bergerie_Search_by_admin_example_org_Table_1",
        "label"=> "Table Gestion des bergeries",
        "saved_search_id.name"=> "Bergerie_Search_by_admin_example_org",
        "type"=> "table",
        "settings"=> [
          "description"=> null,
          "sort"=> [
            [
              "name",
              "ASC"
            ]
          ],
          "limit"=> 50,
          "pager"=> [],
          "placeholder"=> 5,
          "columns"=> [
            [
              "type"=> "field",
              "key"=> "id",
              "dataType"=> "Integer",
              "label"=> "ID",
              "sortable"=> true
            ],
            [
              "type"=> "field",
              "key"=> "name",
              "dataType"=> "String",
              "label"=> "Nom",
              "sortable"=> true,
              "editable"=> true
            ],
            [
              "type"=> "field",
              "key"=> "description",
              "dataType"=> "String",
              "label"=> "Libellé",
              "sortable"=> true,
              "editable"=> true
            ],
            [
              "type"=> "field",
              "key"=> "villes:label",
              "dataType"=> "Text",
              "label"=> "Aide à la décision : villes",
              "sortable"=> true,
              "editable"=> true
            ],
            [
              "type"=> "field",
              "key"=> "wkt",
              "dataType"=> "TextArea",
              "label"=> "Description géographique texte WKT",
              "sortable"=> true,
              "editable"=> true
            ]
          ],
          "actions"=> true,
          "classes"=> [
            "table",
            "table-striped"
          ],
          "actions_display_mode"=> "menu",
          "editableRow"=> [
            "create"=> true,
            "createLabel"=> "Ajouter"
          ]
        ]
      ],
      "match"=> [
        "name"
      ]
    ]
  ]
];
