<?php
// Module for rendering Table Search Displays.
return [
  'js' => [
    'ang/searchAdminDisplayPaged.module.js',
    'ang/searchAdminDisplayPaged/*.js'
  ],
  'partials' => [
    'ang/searchAdminDisplayPaged',
  ],
  'css' => [
    'css/searchAdminDisplayPaged.css',
  ],
  'basePages' => ['civicrm/admin/search'],
  'requires' => ['crmSearchAdmin','crmSearchDisplay', 'crmUi', 'crmSearchTasks', 'ui.bootstrap', 'ui.sortable'],
  'bundles' => ['bootstrap3'],
  'exports' => [
    'search-display-paged' => 'E',
  ],
];
