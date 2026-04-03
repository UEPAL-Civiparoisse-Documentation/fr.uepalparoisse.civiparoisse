<?php
 
class CRM_Civiparoisse_Parametres_ConfigInfoReligion extends CRM_Civiparoisse_Parametres_Config
{

// Rajouts dans la liste Religion
  public function ajoutReligions0153() {

    $newReligions = [
      'Sans religion',
      'Autres religions',
    ];

    foreach ($newReligions as $label) {

      $results = civicrm_api4('OptionValue', 'create', [
        'checkPermissions'=>false,
        'values' => [
          'label' => $label,
          'option_group_id.name' => 'religion',
          'is_active' => true,
        ],
      ]);
    }
    
    return;
  }

  // Modification du libellé de la religion "Bahisme" en "Bahiste"
  public function modificationTerminologieReligion0153() {

    $results = civicrm_api4('OptionValue', 'update', [
      'checkPermissions'=>false,
      'values' => [
        'label' => 'Bahïste',
      ],
      'where' => [
        ['option_group_id.name', '=', 'religion'],
        ['name', '=', 'Baha_sme'],
      ],
    ]);

    return;
  }

// Modifier l'ordre d'affichage des religions
  public function ordreAffichageReligions0153() {

    $ordreAffichage = [
      'Protestante' => 1,
      'Catholique' => 2,
      'Juive' => 3,
      'Musulmane' => 4,
      'Orthodoxe' => 5,
      'Bouddhiste' => 6,
      'Hindouiste' => 7,
      'Bahïste' => 8,
      'Autres religions' => 9,
      'Sans religion' => 10,
    ];

    foreach ($ordreAffichage as $label => $weight) {

      $results = civicrm_api4('OptionValue', 'update', [
        'checkPermissions'=>false,
        'values' => [
          'weight' => $weight,
        ],
        'where' => [
          ['option_group_id.name', '=', 'religion'],
          ['label', '=', $label],
        ],
      ]);
    }

    return;
  }

// rajout d'un champ personnalisé Date et lieu de Bénédiction de fin de catéchisme
  public function ajoutChampDateFinCatechisme0153() {

    $paramsDate = [
        'custom_group_id' => $this->getCustomGroupInformationsReligion()['id'],
        'name' => 'date_benediction_fin_catechisme',
        'label' => 'Date de bénédiction de fin de catéchisme',
        'data_type' => 'Date',
        'html_type' => 'Select Date',
        'is_searchable' => '1',
        'is_search_range' => '1',
        'weight' => '10',
        'is_active' => '1',
        'text_length' => '255',
        'start_date_years' => '120',
        'end_date_years' => '5',
        'date_format' => 'dd/mm/yy',
        'note_columns' => '60',
        'note_rows' => '4',
        'column_name' => 'date_benediction_fin_catechisme',
        'in_selector' => '0',
    ];

    return self::createOrGetCustomField($paramsDate);
  }

  public function ajoutChampLieuFinCatechisme0153() {

    $paramsLieu = [
      'custom_group_id' => $this->getCustomGroupInformationsReligion()['id'],
      'name' => 'paroisse_benediction_fin_catechisme',
      'label' => 'Lieu de bénédiction de fin de catéchisme',
      'data_type' => 'String',
      'html_type' => 'Select',
      'is_searchable' => '1',
      'is_search_range' => '0',
      'weight' => '11',
      'is_active' => '1',
      'text_length' => '255',
      'note_columns' => '60',
      'note_rows' => '4',
      'column_name' => 'paroisse_benediction_fin_catechisme',
      'option_group_id' => $this->getOptionGroupListeParoisses()['id'],
      'in_selector' => '0'
    ];

    return self::createOrGetCustomField($paramsLieu);
  }


}