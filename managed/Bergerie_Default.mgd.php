<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  [
    'name'=> 'Bergerie_DEFAULT',
    'entity'=>'Bergerie',
    'cleanup'=>'never',
    'update'=>'always',
    'params'=>[
      'version' => 4,
      'values' => [
        'name'=> 'DEFAULT',
        'description'=> E::ts('Bergerie par défaut')
      ],
      'match' => [ 'name']
    ]
  ]

];
