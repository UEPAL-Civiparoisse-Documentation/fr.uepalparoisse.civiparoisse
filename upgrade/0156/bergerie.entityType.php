<?php

use CRM_Civiparoisse_ExtensionUtil as E;

return [
  'name' => 'Bergerie',
  'table' => 'civicrm_bergerie',
  'class' => 'CRM_Civiparoisse_DAO_Bergerie',
  'getInfo'=> fn() => [
     'title' => E::ts('Bergerie'),
    'title_plural' => E::ts('Bergeries'),
    'description' => E::ts('Bergeries'),
    'log' => TRUE,
    'label_field'=>'name'
  ],
  'getFields'=> fn() =>[
    'id'=> [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required'=> TRUE,
      'description'=> E::ts('Unique Bergerie ID'),
      'primary_key' => TRUE,
      'auto_increment'=>TRUE,
    ],
    'name'=>[
      'title' => E::ts('Name'),
      'sql_type' => 'varchar(255)',
      'input_type'=> 'text',
      'required'=> TRUE,
      'description'=> E::ts('Name (pseudo primary key)'),
    ],
    'description'=>[
      'title' => E::ts('Description'),
      'sql_type' => 'varchar(255)',
      'input_type'=> 'text',
      'required'=> TRUE,
      'description'=> E::ts('Label / Description')
    ],
    'villes'=>[
      'title' => E::ts('Aide à la décision : villes'),
      'sql_type'=> 'text',
      'input_type'=> 'Select',
      'required'=> FALSE,
      'description' => E::ts('Villes liées à la Bergerie'),
      'serialize'=>CRM_Core_DAO::SERIALIZE_COMMA,
      'pseudoconstant' =>[
        'callback'=> ['CRM_Civiparoisse_Parametres_BergerieConfig','getCommunes']
      ]
    ],
    'wkt'=>[
      'title'=> E::ts('Description géographique texte WKT'),
      'sql_type'=> "longtext",
      'input_type'=>'textarea',
      'required'=>false,
      'description'=>E::ts('Description géographique sous forme Well Known Text')
    ],
//PB : tables de log qui ne passent pas dessus
//    'geom'=>[
//      'title'=> E::ts('Géométrie'),
//      'sql_type'=>"geometry GENERATED ALWAYS AS (IF(COALESCE(wkt,'')<>'',ST_GeomFromText(wkt,2154),ST_GeomFromText('POINT(0 0)',2154))) STORED",
//      'input_type'=>'hidden',
//      'data_type'=>'Blob',
//      'required'=>false,
//      'readonly'=>true
//    ]
    ],
    'getIndices' => fn() => [
      'idx_bergerie_name' => ['fields'=>['name'=>TRUE],'unique'=>TRUE],
    ]


];
