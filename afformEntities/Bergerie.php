<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  'type' => 'primary',
  'defaults' => "{}",
  'boilerplate' => [
    ['#tag' => 'af-field', 'name' => 'name','defn'=>"{input_type: 'Text', input_attrs: {}}"],
    ['#tag' => 'af-field', 'name' => 'label','defn'=>"{input_type: 'Text', input_attrs: {}}"],
    ['#tag' => 'af-field', 'name' => 'villes'],
    ['#tag' => 'af-field', 'name' => 'wkt','defn'=>"{input_type: 'TextArea', input_attrs: {}}"],
  ],
];
