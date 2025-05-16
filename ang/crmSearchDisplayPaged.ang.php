<?php
// Module for rendering Table Search Displays.
return [
  'js' => [
    'ang/crmSearchDisplayPaged.module.js',
    'ang/crmSearchDisplayPaged/*.js'
  ],
  'partials' => [
    'ang/crmSearchDisplayPaged',
  ],
  'css' => [
    'css/searchDisplayPaged.css',
  ],
  'basePages' => ['civicrm/search', 'civicrm/admin/search'],
  'requires' => ['crmSearchDisplay', 'crmUi', 'crmSearchTasks', 'ui.bootstrap', 'ui.sortable'],
  'bundles' => ['bootstrap3'],
  'exports' => [
    'crm-search-display-paged' => 'E',
  ],
];
