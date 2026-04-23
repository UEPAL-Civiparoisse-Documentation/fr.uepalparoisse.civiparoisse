<?php
use CRM_Civiparoisse_ExtensionUtil as E;

return [
  'type' => 'search',
  'title' => E::ts('Memberships'),
  'placement' => [
    'contact_summary_tab',
  ],
  'placement_filters' => [
    ['contact_type' => 'Individual', 'Household'],
  ],
  'placement_weight' => 40,//dans civicrm : 30 : on peut plus pour passer après : order by placement_weight asc
  'icon' => 'fa-id-badge',
  'permission' => [
    'access CiviCRM',
    'access CiviMember',
  ],
];
