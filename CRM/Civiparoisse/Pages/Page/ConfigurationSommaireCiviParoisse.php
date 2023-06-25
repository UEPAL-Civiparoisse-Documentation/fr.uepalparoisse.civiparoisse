<?php
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Pages_Page_ConfigurationSommaireCiviParoisse {

/* TO DO
 * changer les images en .svg
 */


/**
 * Construction du menu Paroisse
 * 
 * @param array   $menu   Données de la barre de menu
 */ 
  static function buildMenuCiviParoisse (&$menu) {
 /** @var int     $maxKey                     Rang du menu Paroisse dans les entrées du menu */
 /** @var array   $dataMenuPrincipalParoisse  Construction de l'entrée de menu Paroisse */
 /** @var string  $dataSubMenuParoisse        Construction du détail du menu, par appel à la fonction subMenuParoisse */

    $maxKey = ( max( array_keys($menu) ) );

    $dataMenuPrincipalParoisse = array(
      'label' => E::ts('Paroisse'),
      'name' => 'menu-civiparoisse',
      'navID' => $maxKey+1,
      'url' => 'civicrm/sommaire-civiparoisse',
      'separator' => null,
      'active' => 1,
      'icon' => 'crm-i fa-handshake-o',
      'permission' => 'access CiviCRM',
    );

 /* Appel aux données composant le menu */
    $dataSubMenuParoisse = self::subMenuParoisse();
  
/* Création de la première ligne du menu */
    _civiparoisse_civix_insert_navigation_menu($menu, NULL, $dataMenuPrincipalParoisse); 

/* Création des lignes suivantes du menu */    
    foreach ($dataSubMenuParoisse as $key => $value) {
      _civiparoisse_civix_insert_navigation_menu($menu, 'menu-civiparoisse', $value); // Création des lignes suivantes du menu
    }

  }





/**
 * Fonction qui crée chaque ligne du menu Paroisse
 * 
 * @return array  $data       Ensemble des détails (par ligne) du menu Paroisse
 *  
 */
  static public function subMenuParoisse(){
  /** @var int     $indexMenu  Variable de rang de chaque ligne du menu Paroisse */
  /** @var string  $data       Détail de chaque ligne du menu Paroisse */

    $indexMenu = 1;

    $data = [
        [
          'label' => E::ts('Nouveau Foyer'),
          'name' => 'menu-formulaire-foyer',
          'url' => 'civicrm/formulaire-foyer',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => null,
          'icon' => 'crm-i fa-address-card',
          'permission' => 'access CiviCRM',
          'image' => 'images/form_foyer.png',
        ],
        [
          'label' => E::ts('Nouvel Individu'),
          'name' => 'menu-formulaire-individu',
          'url' => 'civicrm/formulaire-individu',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => null,
          'icon' => 'crm-i fa-user-plus',
          'permission' => 'access CiviCRM',
          'image' => 'images/form_particulier.png',
        ],
        [
          'label' => E::ts('Nouvelle Entreprise ou Organisation'),
          'name' => 'menu-formulaire-organisation',
          'url' => 'civicrm/formulaire-entreprise',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => 'crm-i fa-building-o',
          'permission' => 'access CiviCRM',
          'image' => 'images/form_entreprise.png',
        ],
        [
          'label' => E::ts('Anniversaires'),
          'name' => 'menu-anniversaires',
          'url' => 'civicrm/prochains-anniversaires-dashboard',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => 'crm-i fa-birthday-cake',
          'permission' => 'access CiviCRM',
          'image' => 'images/anniversaires.png',
        ],
        [
          'label' => E::ts('Listes'),
          'name' => 'menu-listes',
          'url' => 'civicrm/sommaire-listes',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => null,
          'icon' => 'crm-i fa-list-alt',
          'permission' => 'access CiviCRM',
          'image' => 'images/listes.png',
        ],
        [
          'label' => E::ts('Contrôles'),
          'name' => 'menu-controles',
          'url' => 'civicrm/controle-qualite',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => 'crm-i fa-check-square',
          'permission' => 'access CiviCRM',
          'image' => 'images/controles.png',
        ],
        [
          'label' => E::ts('Aide en ligne'),
          'name' => 'menu-aide',
          'url' => 'civicrm/modes-emploi',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => 'crm-i fa-question-circle-o',
          'permission' => 'access CiviCRM',
          'image' => 'images/aide.png',
        ],
        [
          'label' => E::ts('Paramètres'),
          'name' => 'menu-parametres',
          'url' => 'civicrm/sommaire-parametres',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => 'crm-i fa-cog',
          'permission' => 'access CiviCRM',
          'image' => null,
        ],
      ];
      return $data;
  }


}
