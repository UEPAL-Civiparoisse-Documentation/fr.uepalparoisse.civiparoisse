<?php

return [
  'js' => [
    'ang/civiparoisseSearchTasks.module.js',
    'ang/civiparoisseSearchTasks/*.js',
    'ang/civiparoisseSearchTasks/*/*.js',
  ],
  'partials' => [
    'ang/civiparoisseSearchTasks',
  ],
  'css' => [
    'css/civiparoisseSearchTasks.css',
  ],
  'basePages' => ['civicrm/search', 'civicrm/admin/search'],
  'requires' => ['crmUi', 'crmUtil', 'dialogService', 'api4', 'checklist-model', 'crmDialog','crmSearchTasks'],

];
