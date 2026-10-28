<?php
//QUBE_IGNORE_FILE
use CRM_Civiparoisse_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Civiparoisse_Upgrader extends CRM_Extension_Upgrader_Base
{

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).
  /**
   * function to install (not upgrade,really install) the module
   * as such, the code in this function must always be up-to-date against the upgrade functions
   * Up-to-date to 1.46 (0146)
   */
  public function install()
  {
    // instructions de lancement du paramétrage
    $config = new CRM_Civiparoisse_Parametres_Config();
    $config->checkConfig();

    // configuration des rapports - n'est pas utilisé dans la version 1.42 - conservé pour mémoire
    //    (new CRM_Civiparoisse_Reports_Config_Initial())->installReportTemplatesAndInstances();;

    // installation de l'upgrade_0140
    $this->aux_upgrade_0140();

    // installation de l'upgrade_0141
    $this->upgrade_0141();

    // installation de l'upgrade_0142 : plus nécessaire

    // installation de l'upgrade_0143
    $this->upgrade_0143();

    // installation de l'upgrade_0144
    $this->upgrade_0144();
    
    // installation de l'upgrade_0145
    $this->upgrade_0145();
    
    // installation de l'upgrade_0146
    $this->aux_upgrade_0146();

    // installation de l'upgrade_0147
    $this->upgrade_0147();
    //la 0148 permet simplement de relancer la 0147 qui n'a pas porté ses fruits

    //la 0149 contient la configuration cron, qui est déjà lancée dans la 0140,
    // donc pas besoin de la lancer
    //la 0150 n'apporte pas de nouveauté, donc pas besoin de la lancer

    // installation de l'upgrade_0151
    $this->upgrade_0151();

    //0152 : pas de modif installer
    //0153 : avorté (pb cv update afform_scanner)
    $this->upgrade_0154();
    // installation de l'upgrade_0156
    $this->upgrade_0156();

    // installation de l'upgrade_0157
    $this->upgrade_0157();



  }

// Fonctions aux_upgrade_xx sont communes à l'installation et à l'upgrade.
// Fonctions upgrade_xx sont appellés lors d'une montée de version

  protected function aux_upgrade_0140(){

      // paramétrage des travaux du Cron
      $config = new CRM_Civiparoisse_Parametres_ConfigCron();
      $config->checkConfigCron();

      // instructions d'installation du dashboard Sommaire CiviParoisse
      $dashboard = new CRM_Civiparoisse_Dashlets_ConfigSommaire();
      $dashboard->installDashlet();

      // création du Template Mosaico pour le modèle de mail
      $templateMail = new CRM_Civiparoisse_Parametres_ConfigMosaico();
      $templateMail->createTemplateMosaico();

  }


// Suppression des anciens SearchKit installés lors des upgrades précedents (suite mise en place nouveau système fin 2023)
// Supprime également les SearchDisplay et les Afform associés
  protected function deleteOldSearchKits ($liste){
      foreach ($liste as $nomASupprimer) {
          
          \Civi\Api4\SavedSearch::delete()
              ->setCheckPermissions(false)
              ->addWhere('name', '=', $nomASupprimer)
              ->execute();
      }
  }

  /**
   * This function only exists to put the version in place against manually installed
   * modules (former installations were by hand, through the web UI)
   */
  public function upgrade_0140()
  {

    $this->aux_upgrade_0140();
    
    // configuration des Search Kit - Qualité de la base
    // n'est plus nécessaire dans l'installation depuis la version 1.45
    $searchQualite = new CRM_Civiparoisse_Qualitebase_Config_SearchKitConfig0140();
    $searchQualite->run();

    // configuration des Search Kit - Reports
    // n'est plus nécessaire dans l'installation depuis la version 1.46
    $searchReports = new CRM_Civiparoisse_Reports_Config_SearchKitConfig0140();
    $searchReports->run();

    return true;

  }

  public function upgrade_0141()
  {

    // creation de la liste complète des paroisses de l'UEPAL
    CRM_Civiparoisse_Parametres_ConfigListeParoisses::createOrGetListeParoisse();

    // création du Groupe de Désabonnements pour l'envoi de mails en masse
    CRM_Civiparoisse_Parametres_Config0141::createDesabonnementGroup();

    // création du format d'impression de page Page A4 marges normales
    CRM_Civiparoisse_Parametres_Config0141::createFormatPageA4();

    // création du champ Mode de distribution du Journal dans la fiche Foyer
    CRM_Civiparoisse_Parametres_Config0141::getCustomFieldComplementsFoyerModeDistribution();

    // Création des mappings Séraphin pour l'importation des données
    CRM_Civiparoisse_Parametres_MappingImport_MappingConfig0141::run();

    // modification des Quartiers existants et création de nouveaux quartiers
    CRM_Civiparoisse_Parametres_ConfigQuartiers::modifyExistingQuartiers0140();
    CRM_Civiparoisse_Parametres_ConfigQuartiers::createNewQuartiers0140();

    return true;
  }

  public function upgrade_0142()
  {
    // création du formulaire et installation du dashboard Prochains anniversaires
    $formCreation = new CRM_Civiparoisse_Formulaires_Config_FormsConfig0142();
    $formCreation->run();
    $annivDashlet = new CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversaires();
    $annivDashlet->installDashlet();

    // configuration des Search Kit - Formulaires (Formulaire Quartier)
    // n'est plus nécessaire dans l'installation depuis la version 1.46
    $searchReportsF = new CRM_Civiparoisse_Formulaires_Config_SearchKitConfig0142();
    $searchReportsF->run();
    // configuration des Search Kit - Reports (Prochains Anniversaires)
    $searchReportsR = new CRM_Civiparoisse_Reports_Config_SearchKitConfig0142();
    $searchReportsR->run();

    return true;

  }

  public function upgrade_0143()
  {
    // modification des libellés des champs Paroisse de...
    $labelUpdate = new CRM_Civiparoisse_Parametres_Config0143();
    $labelUpdate->modifyIntituleParoisses();

    // Desactivation des Dashlets Blog et Ressources sur le DashBoard de la page d'accueil
    CRM_Civiparoisse_Parametres_Config0143::desactivateDashletsBlogRessources();

    // modification de la permission pour le lien Support (pour ne plus l'afficher aux utilisateurs)
    CRM_Civiparoisse_Parametres_Config0143::modifyPermissionLinkSupport();

    return true;

  }

  public function upgrade_0144()
  {
    // modification du libellé Lieu de mariage
    CRM_Civiparoisse_Parametres_Config0144::modifyIntituleParoisses();

    return true;

  }

  public function upgrade_0145() {
  
    // Suppression des SearchKit pour les pages Qualité et Amélioration (suite mise en place nouveau système)
    // Supprime également les SearchDisplay et les Afform associés
    // Vide les caches pour initialiser les nouvelles pages Qualité et Amélioration
    $listeSearchKitASupprimer = [
        'Civip_Individus_Sans_Civilite',
        'Civip_Individus_Sans_Genre',
        'Civip_Individus_Sans_Membre',
    ];
    $this->deleteOldSearchKits($listeSearchKitASupprimer);
    
    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    return true;
  }

  public function aux_upgrade_0146(){
  //installation du nouveau dashlet anniversaire

    $annivDashletMgd= new CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversairesMgd();
    $annivDashletMgd->installDashlet();
  }

  public function upgrade_0146() {
    // Suppression des SearchKit pour les pages Rapports / Listes (suite mise en place nouveau système)
    // Supprime également les SearchDisplay et les Afform associés
    // Vide les caches pour initialiser les nouvelles pages Listes

    $listeSearchKitASupprimer = [
      'Civip_Anniversaires_Moins_18_ans',
      'Civip_Anniversaires_Plus_75_ans',
      'Civip_Foyers_Paroissiens',
      'Civip_Liste_Electorale',
      'Civip_Nouveaux_Arrivants',
      'Prochains_Anniversaires',
      'Liste_des_Quartiers',
    ];
    $this->deleteOldSearchKits($listeSearchKitASupprimer);

    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    // Suppression du vieil dashlet anniversaire
    $annivDashlet = new CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversaires();
    $annivDashlet->uninstallDashlet();

    //en théorie, on aurait encore en plus désinstallé l'afform des anniversaires

    $this->aux_upgrade_0146();

    return true;

  }

    public function upgrade_0147(){
    // Ajout du groupe Désabonnement
    CRM_Civiparoisse_Parametres_ConfigDesabonnement::createDesabonnementGroup();

    // Création du Groupe Conseil Presbytéral
    CRM_Civiparoisse_Parametres_Config0147::createConseilPresbyteralGroup();

    // Vidage des caches pour installer les nouvelles listes (Conseil Presbytéral et Listes de naissance)
    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    return true;

  }

  public function upgrade_0148(){
      $this->upgrade_0147();
      return true;
  }

  public function upgrade_0149(){
      $config = new CRM_Civiparoisse_Parametres_ConfigCron();
      $config->checkConfigCron();
      return true;
  }

  public function upgrade_0151() {
  
    // Remplacement du préfixe Mlle par Mme
    $remplacementMlle = new CRM_Civiparoisse_Parametres_Config0151();
    $remplacementMlle->replacePrefixeMlle();
    // Création de nouvelles lignes dans la liste Religion
    $ajoutReligions = new CRM_Civiparoisse_Parametres_Config0151();
    $ajoutReligions->ajoutReligions0151();
      \Civi\Api4\System::flush()
      ->setCheckPermissions(false)
      ->execute();
    return true;
  }
  public function upgrade_0154() {
      CRM_Civiparoisse_Parametres_MappingImport_MappingConfig0153::run();
      return true;
  }


  public function upgrade_0156() {
  // L'upgrade 0156 reprend des upgrades prévus dans la 0153, qui a été avortée suite à un problème de mise à jour de l'afform scanner
    // Modification de la terminologie des religions et ajout de nouvelles religions
    $configReligion = new CRM_Civiparoisse_Parametres_ConfigInfoReligion();
    $configReligion->ajoutReligions0153();
    $configReligion->modificationTerminologieReligion0153();
    $configReligion->ordreAffichageReligions0153();
    
    // Ajout du nouveau champ Date de fin de catéchisme et du champ Lieu de fin de catéchisme dans la fiche Individu
    $configReligion->ajoutChampDateFinCatechisme0153();
    $configReligion->ajoutChampLieuFinCatechisme0153();

    // Ajout de nouveaux Instruments de musique (et réorganisation de la liste)
    $ajoutInstruments = new CRM_Civiparoisse_Parametres_Config0156();
    $ajoutInstruments->ajoutInstrumentsMusique0156();

    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    // Création du dashlet PageNews
    $civiparoisseNews=new CRM_Civiparoisse_Dashlets_PageNews();
    $civiparoisseNews->installDashlet();
    \Civi\Api4\System::flush()
      ->setCheckPermissions(false)
      ->execute();

    // Modification de l'orthographhe de certains noms de paroisses dans la liste des paroisses
    CRM_Civiparoisse_Parametres_ConfigListeParoisses::correctNomParoisses('Merckwiller', 'Merkwiller-Pechelbronn');
    CRM_Civiparoisse_Parametres_ConfigListeParoisses::correctNomParoisses('Hermeswiller', 'Hermerswiller');

 // Rajout de nouveaux types d'activités dans CiviCRM
    CRM_Civiparoisse_Parametres_ConfigActivites::ajoutTypes('Visite', 'Visite', '<p>Enregistrement des visites (pastorales ou autres)</p>', 'fa-people-arrows');

    // Création de nouveaux rôles de participants pour les événements
    CRM_Civiparoisse_Parametres_ConfigEvenement::ajoutRoles('Animateur', 'Animateur·rice', 'Participant animateur de l\'événement (camps, etc...');
    CRM_Civiparoisse_Parametres_ConfigEvenement::ajoutRoles('Directeur', 'Directeur·rice', 'Participant directeur de l\'événement (camps, etc...');

    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    return true;
}


public function upgrade_0157(){
      E::schema()->createEntityTable('upgrade/0156/bergerie.entityType.php');
      $config=new CRM_Civiparoisse_Parametres_Config();
      $config->checkConfig();
    \Civi\Api4\Managed::reconcile(false)
      ->setCheckPermissions(false)
      ->execute();
      return true;
}






}
