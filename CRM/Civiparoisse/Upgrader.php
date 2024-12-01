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
        
        /* Commentaires à enlever pour activer la prochaine version
            // installation de l'upgrade_0148
            $this->upgrade_0148();
        Fin ligne à enlever */

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

    // Vidage des caches pour installer les nouvelles listes
    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    return true;
  }

  public function upgrade_0147() {
    // Nouvelles listes : Conseil Presbytéral
    // création du Groupe Conseil Presbytéral
    CRM_Civiparoisse_Parametres_Config0147::createConseilPresbyteralGroup();

    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();

    return true;

  }

/* Fonction annexe pour l'upgrade XXXXXXX
    public function aux_upgrade_0148(){
    //installation
  
    }
Fin ligne à enlever */

/* Commentaires à enlever pour activer la prochaine version
  public function upgrade_0148() {

    \Civi\Api4\System::flush()
        ->setCheckPermissions(false)
        ->execute();


    $this->aux_upgrade_0148();

    return true;

  }
Fin ligne à enlever */


    /**
     * Example: Work with entities usually not available during the install step.
     *
     * This method can be used for any post-install tasks. For example, if a step
     * of your installation depends on accessing an entity that is itself
     * created during the installation (e.g., a setting or a managed entity), do
     * so here to avoid order of operation problems.
     */
    // public function postInstall() {
    //  $customFieldId = civicrm_api3('CustomField', 'getvalue', array(
    //    'return' => array("id"),
    //    'name' => "customFieldCreatedViaManagedHook",
    //  ));
    //  civicrm_api3('Setting', 'create', array(
    //    'myWeirdFieldSetting' => array('id' => $customFieldId, 'weirdness' => 1),
    //  ));
    // }

    /**
     * Example: Run an external SQL script when the module is uninstalled.
     */
    // public function uninstall() {
    //  $this->executeSqlFile('sql/myuninstall.sql');
    // }

    /**
     * Example: Run a simple query when a module is enabled.
     */
    // public function enable() {
    //  CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 1 WHERE bar = "whiz"');
    // }

    /**
     * Example: Run a simple query when a module is disabled.
     */
    // public function disable() {
    //   CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 0 WHERE bar = "whiz"');
    // }

    /**
     * Example: Run a couple simple queries.
     *
     * @return true on success
     * @throws Exception
     */
    // public function upgrade_4200() {
    //   $this->ctx->log->info('Applying update 4200');
    //   CRM_Core_DAO::executeQuery('UPDATE foo SET bar = "whiz"');
    //   CRM_Core_DAO::executeQuery('DELETE FROM bang WHERE willy = wonka(2)');
    //   return true;
    // }


    /**
     * Example: Run an external SQL script.
     *
     * @return true on success
     * @throws Exception
     */
    // public function upgrade_4201() {
    //   $this->ctx->log->info('Applying update 4201');
    //   // this path is relative to the extension base dir
    //   $this->executeSqlFile('sql/upgrade_4201.sql');
    //   return true;
    // }


    /**
     * Example: Run a slow upgrade process by breaking it up into smaller chunk.
     *
     * @return true on success
     * @throws Exception
     */
    // public function upgrade_4202() {
    //   $this->ctx->log->info('Planning update 4202'); // PEAR Log interface

    //   $this->addTask(E::ts('Process first step'), 'processPart1', $arg1, $arg2);
    //   $this->addTask(E::ts('Process second step'), 'processPart2', $arg3, $arg4);
    //   $this->addTask(E::ts('Process second step'), 'processPart3', $arg5);
    //   return true;
    // }
    // public function processPart1($arg1, $arg2) { sleep(10); return true; }
    // public function processPart2($arg3, $arg4) { sleep(10); return true; }
    // public function processPart3($arg5) { sleep(10); return true; }

    /**
     * Example: Run an upgrade with a query that touches many (potentially
     * millions) of records by breaking it up into smaller chunks.
     *
     * @return true on success
     * @throws Exception
     */
    // public function upgrade_4203() {
    //   $this->ctx->log->info('Planning update 4203'); // PEAR Log interface

    //   $minId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(min(id),0) FROM civicrm_contribution');
    //   $maxId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(max(id),0) FROM civicrm_contribution');
    //   for ($startId = $minId; $startId <= $maxId; $startId += self::BATCH_SIZE) {
    //     $endId = $startId + self::BATCH_SIZE - 1;
    //     $title = E::ts('Upgrade Batch (%1 => %2)', array(
    //       1 => $startId,
    //       2 => $endId,
    //     ));
    //     $sql = '
    //       UPDATE civicrm_contribution SET foobar = whiz(wonky()+wanker)
    //       WHERE id BETWEEN %1 and %2
    //     ';
    //     $params = array(
    //       1 => array($startId, 'Integer'),
    //       2 => array($endId, 'Integer'),
    //     );
    //     $this->addTask($title, 'executeSql', $sql, $params);
    //   }
    //   return true;
    // }

}
