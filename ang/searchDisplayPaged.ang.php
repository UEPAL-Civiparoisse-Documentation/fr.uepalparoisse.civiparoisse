<?php
// Module for rendering Table Search Displays.
return [
  'js' => [
    'ang/searchDisplayPaged.module.js',
    'ang/searchDisplayPaged/*.js'
  ],
  'partials' => [
    'ang/searchDisplayPaged',
  ],
  'css' => [
    'css/searchDisplayPaged.css',
  ],
  'basePages' => ['civicrm/search', 'civicrm/admin/search'],
  'requires' => ['crmSearchDisplay', 'crmUi', 'crmSearchTasks', 'ui.bootstrap', 'ui.sortable'],
  'bundles' => ['bootstrap3'],
  'exports' => [
    'search-display-paged' => 'E',
  ],
];
