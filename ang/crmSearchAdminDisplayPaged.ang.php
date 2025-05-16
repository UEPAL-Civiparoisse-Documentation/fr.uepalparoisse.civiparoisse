<?php
// Module for rendering Table Search Displays.
return [
  'js' => [
    'ang/crmSearchAdminDisplayPaged.module.js',
    'ang/crmSearchAdminDisplayPaged/*.js'
  ],
  'partials' => [
    'ang/crmSearchAdminDisplayPaged',
  ],
  'css' => [
    'css/searchAdminDisplayPaged.css',
  ],
  'basePages' => ['civicrm/admin/search'],
  'requires' => ['crmSearchAdmin','crmSearchDisplay', 'crmUi', 'crmSearchTasks', 'ui.bootstrap', 'ui.sortable'],
  'bundles' => ['bootstrap3'],
  'exports' => [
    'crm-search-display-paged' => 'E',
  ],
];
