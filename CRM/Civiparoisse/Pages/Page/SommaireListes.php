<?php

use CRM_Civiparoisse_ExtensionUtil as E;


/* TODO:
- Passer en Managed
  -+ Liste des Quartiers (nouvel Issue) VOIR comment récupérer le nom et pas la description poiur le filtre / Changer filtre forms (pas possible pour le moment) / Bouton Rajouter un Quartier
- Tester
  - Trombinoscope
- Rajouter la description du tableau dans le survol de la souris
*/


class CRM_Civiparoisse_Pages_Page_SommaireListes extends CRM_Core_Page {

  public function run(){
    CRM_Utils_System::setTitle(E::ts('Listes CiviParoisse'));
    $arrayListes = [
      'Paroisse' => [
        'Paroissiens' => [
          'Civip_Liste_Dates_Anniversaires' => 'fa-birthday-cake',
          'Civip_Liste_Nouveaux_arrivants' => 'fa-road',
          'Civip_Liste_Foyers_Paroissiens' => 'fa-envelope-open',
          // Liste des Grands Anniversaires
        ],
        'Registre' => [
          'Civip_Liste_Naissance' => 'fa-baby',
          'Civip_Liste_Baptemes' => 'fa-hand-holding-water',
          'Civip_Liste_Presentations' => 'fa-child',
          'Civip_Liste_Confirmations' => 'fa-bible',
          'Civip_Liste_Mariages' => 'fa-ring',
          'Civip_Liste_Deces' => 'fa-cross',
        ],
        'Elections' => [
          'Civip_Liste_Electorale' => 'fa-person-booth',
          'Civip_Liste_Conseil_Presbyteral' => 'fa-users',
        ],
      ],
      'Communication' => [
        'Foyers' => [
          // Foyers ayant une adresse mail
          'Civip_Liste_Foyers_Sans_Mails' => 'fa-window-close-o',
        ],
        'Individus' => [
          // Individus ayant une adresse mail
          // Individus n'ayant pas d'adresse mail

        ],
        //'Groupes'

        'Distribution' => [
          'liste_distribution_foyer' => 'fa-compass',
          'Civip_Liste_Distribution_Quartiers' => 'fa-map-o',
          // Liste de distribution par la Poste
          'Civip_Liste_Quartiers' => 'fa-map-signs',
        ],
        'Entreprises' => [
          'Civip_Liste_Entreprises' => 'fa-building-o',
        ],

      ],
      'Groupes' => [
        'Participants' => [
          'Civip_Liste_Participants_Groupe' => 'fa-users',
          'Civip_Trombinoscope_Groupes' => 'fa-user-circle-o',
          'Civip_Liste_Dates_Anniversaires' => 'fa-birthday-cake',
        ],
        'Parents' => [
          // Liste des parents des participants
          // Trombinoscope des parents fa-user-circle
        ],
        'Compétences' => [
          'Civip_Liste_Individus_Avec_Chant' => 'fa-microphone-lines',
          'Civip_Trombinoscope_Chants' => 'fa-microphone',
          'Civip_Liste_Individus_Avec_Instrument' => 'fa-guitar',
           'Civip_Trombinoscope_Instruments' => 'fa-music',
          // Liste des compétences
          // Compétences chorale
        ]
      ],
      'Evénements' => [
        'Participants' => [
          'Civip_Liste_Participants_Evenement' => 'fa-users',
        ],
        // Parents
        // Liste des parents des participants
      ],
      'Gestion' => [
        'Dons' => [
          // Liste des donateurs
          // Variation
        ],
        'Administration' => [
          'Civip_Liste_Utilisateurs' => 'fa-users',// Liste des personnes ayant accès à CiviParoisse
          // Liste des personnes dans la corbeille
        ],
      ],

    ];
    $flattenSavedSearchArray=[];
    $this->walk_keys($flattenSavedSearchArray,$arrayListes);
    $flattenSavedSearchNames=array_keys($flattenSavedSearchArray);

    $labelSavedSearches = \Civi\Api4\SavedSearch::get()
      ->addSelect('label')
      ->addSelect('name')
      ->addSelect('id')
      ->addWhere('name', 'IN', $flattenSavedSearchNames)
      ->setLimit(0)
      ->execute()
      ->getArrayCopy();

    $savedSearchLabels=[];
    foreach($labelSavedSearches as $labelSavedSearch)
    {
      $savedSearchLabels[$labelSavedSearch['name']]=$labelSavedSearch['label'];
    }



    // Rajout du lien vers le formulaire, en allant rechercher le nom du Search Display, puis en trouvant le chemin vers le formulaire
    $nameSearchDisplays = \Civi\Api4\SearchDisplay::get()
      ->addSelect('name')
      ->addSelect('saved_search_id')
      ->addSelect('saved_search_id.name')
      ->addWhere('saved_search_id.name', 'IN', $flattenSavedSearchNames)
      ->execute()
      ->getArrayCopy();

    $fullSearchDisplayNames=array_map(function($displayName){
      return [$displayName['saved_search_id.name'].".".$displayName['name']];},$nameSearchDisplays);


    $lienFormsDisplays = \Civi\Api4\Afform::get()
      ->addWhere('search_displays', 'IN', $fullSearchDisplayNames)
      ->addSelect('server_route')
      ->addSelect('search_displays')
      ->execute()
      ->getArrayCopy();

    $flattenFormDisplays=[];
    foreach($lienFormsDisplays as $lienFormsDisplay)
    {
      $components=explode('.',$lienFormsDisplay['search_displays'][0]);
      $savedSearch=$components[0];
      $flattenFormDisplays[$savedSearch]=$lienFormsDisplay['server_route'];

    }

    // A ce moment, on a les clefs feuilles qui indexent les structures de données

    foreach ($arrayListes as $typeGroupe => $arraySousGroupe) {

      foreach ($arraySousGroupe as $typeSousGroupe => $listeListe) {

        $resultBoucleListes = [];

        foreach ($listeListe as $nameListe => $nameIcone) {

          // $resultBoucleListes = Array (lien vers le document Forms, icone, description du Search Kit)
          // Assignation des valeurs pour l'affichage dans le Smarty


          $resultBoucleListes[] = [$flattenFormDisplays[$nameListe], $nameIcone, $savedSearchLabels[$nameListe]];
        }
        $resultListes[$typeGroupe][$typeSousGroupe] = $resultBoucleListes;
      }
    }
    $this->assign('ResultsDesListes', $resultListes);
    parent::run();

  }

  protected function walk_keys(array &$res,$arrayListes)
  {

    foreach($arrayListes as $key=>$value)
    {
     if(is_array($value))
     {
       $this->walk_keys($res,$value);

     }
     else
     {
       $res[$key]=$value;
     }
    }
  }
  
}
