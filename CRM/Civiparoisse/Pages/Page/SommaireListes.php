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

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Listes CiviParoisse'));

    // $arrayListes = Array (Type de Groupe, Type de Sous-Groupe, nom du SearchKit, icône associé au Search Kit)
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
      ],
      'Groupes' => [
        'Participants' => [
          'Civip_Liste_Participants_Groupe' => 'fa-users',
          // Trombinoscope fa-user-circle-o
          'Civip_Liste_Dates_Anniversaires' => 'fa-birthday-cake',
        ],
        'Parents' => [
          // Liste des parents des participants
          // Trombinoscope des parents fa-user-circle 
        ],
        'Compétences' => [
          // Liste des compétences
          // Compétences musicales
          // Compétences chorale
          // Trombinoscope
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
          // Liste des personnes ayant accès à CiviParoisse
          // Liste des personnes dans la corbeille
        ],
      ],

    ];

    foreach ($arrayListes as $typeGroupe => $arraySousGroupe) {

      foreach ($arraySousGroupe as $typeSousGroupe  => $listeListe) {

        $resultBoucleListes = [];

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
            ->addWhere('search_displays', '=', [$nameListe . "." . $nameSearchDisplays['name']])
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
