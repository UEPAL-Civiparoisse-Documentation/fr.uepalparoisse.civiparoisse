<?php
use CRM_Civiparoisse_ExtensionUtil as E;

return [
    [
        'name' =>'SearchDisplayPaged',
        'entity'=> 'OptionValue',
        'cleanup'=> 'always',
        'update'=> 'always',
        'params'=> [
            'version'=>4,
            'values' => [
                'option_group_id.name'=>'search_display_type',
                'label'=>'Paged',
                'value'=>'paged',
                'name'=>'search-display-paged',
                'weight'=>10
            ],
            'match'=> [
                'option_group_id.name',
                'name'
            ]
        ]
    ]
];
