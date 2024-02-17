<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // A SUPPRIMER EN MÊME TEMPS QUE LE SQL

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Qualitebase_Page_ControleQualiteParoisse extends CRM_Civiparoisse_Qualitebase_Page_BaseQualiteParoisse {

    public function run() {
    // Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Corrections des données de la base CiviParoisse'));

    // Liste des pages SearchKit à afficher
    $listeControles = array(
      'Individus' => array(
        'Civip_Individus_Sans_Genre',
        'Civip_Individus_Sans_Civilite',
        'Civip_Individus_sans_Statut_Membre',
        'Civip_Individus_sans_lien_avec_Foyer_ou_Organisation',
        'Civip_Individus_Majeurs_avec_Statut_Enfant',
        'Civip_Individus_Enfants_avec_Statut_Chef_Famille',
        'Civip_Individus_Majeur_ChezParents',
      ),
      'Foyers' => array(
        'Civip_Foyers_avec_Statut_Membre',
        'Civip_Foyers_sans_Relation_ChefFamille',
        'Civip_Foyer_sans_Relation_Membre_du_Foyer',
        'Civip_Foyers_sans_Mode_de_Distribution_Journal',
      ),
      'Organisations' => array(
        'Civip_Organisation_avec_statut_Membre',
      ),
      'E-mails' => array(
        'Civip_E_mails_en_erreur',
      ),
    );

    $resultControle = parent::calculQualite($listeControles);
 
    $this->assign('ResultsDesControles', $resultControle);
    
    parent::run();
  }
}
