<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // A SUPPRIMER EN MÊME TEMPS QUE LE SQL

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Qualitebase_Page_AmeliorationQualiteParoisse extends CRM_Civiparoisse_Qualitebase_Page_BaseQualiteParoisse
{

  public function run() {
    // Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Améliorations des données de la base CiviParoisse'));

    // Liste des pages SearchKit à afficher
    $listeAmeliorations = array(
      'Individus' => array(
        'Civip_Individus_sans_Date_de_Naissance',
      ),
      'Foyers' => array(
        'Civip_Foyers_sans_Adresses',
        'Civip_Foyers_avec_Evenement',
        'Civip_Foyers_avec_Distribution_Inconnu',
      ),
      'Organisations' => array(
        'Civip_Organisations_sans_Adresses',
        'Civip_Organisation_sans_Relations',
        'Civip_Organisation_avec_Evenement',
      ),
    );

    $resultAmeliorations = parent::calculQualite($listeAmeliorations);

    $this->assign('ResultsDesAmeliorations', $resultAmeliorations);
   
    parent::run();
  }
}
