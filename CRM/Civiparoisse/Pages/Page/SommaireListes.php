<?php
use CRM_Civiparoisse_ExtensionUtil as E;


/* TODO:
- Passer en Managed
  -+ Liste des Quartiers (nouvel Issue) VOIR comment récupérer le nom et pas la description poiur le filtre / Changer filtre forms (pas possible pour le moment) / Bouton Rajouter un Quartier
  - Foyers sans courriels
  - Prochains anniversaires
- Tester
  - Trombinoscope
- Rajouter un reset des Filtres
  - Prochains anniversaires ?
  - Foyers sans courriels
- Revoir les Actions pour chaque liste
  - Prochains anniversaires
  - Foyers sans courriels
- Rajouter la description du tableau dans le survol de la souris
*/


class CRM_Civiparoisse_Pages_Page_SommaireListes extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Listes CiviParoisse'));

// $arrayListes = Array (Type de Groupe, Type de Sous-Groupe, nom du SearchKit, icône associé au Search Kit)
    $arrayListes = [
      'Groupes' => [
        'Participants' => [
          // Liste participants
          // Trombinoscope
          'Civip_Liste_Dates_Anniversaires' => 'fa-birthday-cake',
        ],
        'Parents' => [
          // Liste des parents des participants
          // Trombinoscope des parents
        ],
        'Compétences' => [
          // Liste des compétences
          // Compétences musicales
          // Compétences chorale
          // Trombinoscope
        ]
      ],
      'Gestion' => [
        'Dons' => [
          // Liste des donateurs
          // Variation
        ],
        'Administration' => [
          // Liste des personnes ayant accès à CiviParoisse
          // Liste des personnes dans la corbeille
        ],

      ],
      'Paroisse' => [
        'Registre' => [
          // Liste des naissances
          // Liste des baptêmes
          // Listes des présentations
          // Liste des confirmations
          // Liste des mariages
          // Liste des décès
        ],
        'Elections' => [
          'Civip_Liste_Electorale' => 'fa-envelope-open',
        ],
        'Paroissiens' => [
          'Civip_Liste_Dates_Anniversaires' => 'fa-birthday-cake',
          'Civip_Liste_Nouveaux_arrivants' => 'fa-road',
          'Civip_Liste_Foyers_Paroissiens' => 'fa-envelope-open',
          // Liste des Grands Anniversaires
        ],
      ],
      'Communication' => [
        'Foyers' => [
          // Foyers ayant une adresse mail
          // Foyers n'ayant pas d'adresse mail
        ],
        'Individus' => [
          // Individus ayant une adresse mail
          // Individus n'ayant pas d'adresse mail

        ],
        //'Groupes'

        'Distribution' => [
          'Civip_Liste_Distribution_Quartiers' => 'fa-map-o',
          // Liste de distribution par la Poste
          'Civip_Liste_Quartiers' => 'fa-map-signs',
        ],
      ],
      // Evénements
        // Participants
          // Liste des participants à un événement
        // Parents
          // Liste des parents des participants
    ];

  foreach ($arrayListes as $typeGroupe => $arraySousGroupe) {
    
    foreach ($arraySousGroupe as $typeSousGroupe  => $listeListe) {

      $resultBoucleListes=[];

      foreach ($listeListe as $nameListe  => $nameIcone) {

// Rajout de la description du Saved Search, pour l'afficher à l'écran
      $labelSavedSearch = \Civi\Api4\SavedSearch::get()
        ->addSelect('label')
        ->addWhere('name', '=', $nameListe)
        ->setLimit(0)
        ->execute()
        ->first();

// Rajout du lien vers le formulaire, en allant rechercher le nom du Search Display, puis en trouvant le chemin vers le formulaire
      $nameSearchDisplays = \Civi\Api4\SearchDisplay::get()
        ->addSelect('name')
        ->addWhere('saved_search_id.name', '=', $nameListe)
        ->execute()
        ->first();

      $lienFormsDisplay = \Civi\Api4\Afform::get()
        ->addWhere('search_displays', '=', [$nameListe.".".$nameSearchDisplays['name']])
        ->addSelect('server_route')
        ->execute()
        ->first();

// $resultBoucleListes = Array (lien vers le document Forms, icone, description du Search Kit)
// Assignation des valeurs pour l'affichage dans le Smarty
      $resultBoucleListes[] = [$lienFormsDisplay['server_route'], $nameIcone, $labelSavedSearch['label']];
    }

    $resultListes[$typeGroupe][$typeSousGroupe] = $resultBoucleListes;
    }
  }

  $this->assign('ResultsDesListes', $resultListes); 

    parent::run();
  
  }
  
}
