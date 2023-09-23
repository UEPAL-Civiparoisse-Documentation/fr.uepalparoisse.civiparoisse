<?php
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Pages_Page_SommaireCiviparoisse extends CRM_Core_Page {

  public function run() {
    CRM_Utils_System::setTitle(E::ts('Sommaire Civiparoisse'));

    // Récupération de toutes les données du menu Paroisse
    $dataMenuParoisse = CRM_Civiparoisse_Pages_Page_ConfigurationSommaireCiviParoisse::subMenuParoisse();

    // Sélection des données nécessaires pour la page SommaireCiviParoisse
    foreach ($dataMenuParoisse as $key => $value) {
      if ($value['name'] <> 'menu-parametres') {
        $menuCiviParoisse[$value['name']] = $this->addMenuCiviParoisse($value['image'], $value['label'], $value['url']);
      }
      else {
        continue; // boucle d'évitement pour ne pas afficher le menu Paramètres sur la page de menu ou Dashboard
      }
    }

    // Assignation des variables pour la création de la page SommaireCiviParoisse.tpl
    $this->assign('PageSommaireCiviParoisse', $menuCiviParoisse);

    parent::run();
  }

/**
 * Renvoie les variables nécessaires à la création de la page SommaireCiviParoisse.tpl
 * 
 * @param string  $lienLogo   URL vers le Logo
 * @param string  $titre      Titre du menu
 * @param string  $lienURL    URL vers la page de menu
 * 
 * @return array $content  
 * 
 */
  function addMenuCiviParoisse ($lienLogo, $titre, $lienURL) {
  /** @var array $content */

    $content = array(
      "Logo" => $lienLogo,
      "Titre"=> $titre,
      "URL" => $lienURL
    );

    return $content;
  }

}
