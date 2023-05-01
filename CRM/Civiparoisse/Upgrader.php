<?php
use CRM_Civiparoisse_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Civiparoisse_Upgrader extends CRM_Civiparoisse_Upgrader_Base {

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).
  /**
   * function to install (not upgrade,really install) the module
   * as such, the code in this function must always be up-to-date against the upgrade functions
   * Up-to-date to 1.40 (0140)
   */
  public function install()
  {
    // instructions de lancement du paramétrage
    $config = new CRM_Civiparoisse_Parametres_Config();
    $config->checkConfig();

    // instructions de lancement des exceptions
    $exceptions = new CRM_Civiparoisse_Parametres_Exceptions();
    $exceptions->setExceptions();

    // configuration des rapports - n'est pas utilisé dans la version 1.42 - conservé pour mémoire
//    (new CRM_Civiparoisse_Reports_Config_Initial())->installReportTemplatesAndInstances();;

    // installation de l'upgrade_0140
    $this->upgrade_0140();

    // installation de l'upgrade_0141
    $this->upgrade_0141();

  }

  /**
   * This function only exists to put the version in place against manually installed
   * modules (former installations were by hand, through the web UI)
   */
  public function upgrade_0140()
  {
    // paramétrage des travaux du Cron
    $config = new CRM_Civiparoisse_Parametres_ConfigCron(); 
    $config->checkConfigCron();

    // configuration des Search Kit - Reports
    $searchReports = new CRM_Civiparoisse_Reports_Config_SearchKitConfig0140();
    $searchReports->run();

    // configuration des Search Kit - Qualité de la base
    $searchQualite = new CRM_Civiparoisse_Qualitebase_Config_SearchKitConfig0140();
    $searchQualite->run();

    // instructions d'installation du dashboard
    $dashboard = new CRM_Civiparoisse_Dashlets_ConfigSommaire();
    $dashboard->createAndConfigDashletSommaire();

    // création du Template Mosaico pour le modèle de mail
    $templateMail = new CRM_Civiparoisse_Parametres_ConfigMosaico();
    $templateMail->createTemplateMosaico();

    return TRUE;

  }

  public function upgrade_0141() {

    // creation de la liste complète des paroisses de l'UEPAL
    CRM_Civiparoisse_Parametres_ConfigListeParoisses::createOrGetListeParoisse();

    // création du Groupe de Désabonnements pour l'envoi de mails en masse
    CRM_Civiparoisse_Parametres_Config0141::createDesabonnementGroup();

    // création du format d'impression de page Page A4 marges normales
    CRM_Civiparoisse_Parametres_Config0141::createFormatPageA4();    

    // création du champ Mode de distribution du Journal dans la fiche Foyer
    CRM_Civiparoisse_Parametres_Config0141::getCustomField_complements_foyerModeDistribution();

    // Création des mappings Séraphin pour l'importation des données
    CRM_Civiparoisse_Parametres_MappingImport_MappingConfig0141::run();




    return TRUE;

  }



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
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4200() {
  //   $this->ctx->log->info('Applying update 4200');
  //   CRM_Core_DAO::executeQuery('UPDATE foo SET bar = "whiz"');
  //   CRM_Core_DAO::executeQuery('DELETE FROM bang WHERE willy = wonka(2)');
  //   return TRUE;
  // }


  /**
   * Example: Run an external SQL script.
   *
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4201() {
  //   $this->ctx->log->info('Applying update 4201');
  //   // this path is relative to the extension base dir
  //   $this->executeSqlFile('sql/upgrade_4201.sql');
  //   return TRUE;
  // }


  /**
   * Example: Run a slow upgrade process by breaking it up into smaller chunk.
   *
   * @return TRUE on success
   * @throws Exception
   */
  // public function upgrade_4202() {
  //   $this->ctx->log->info('Planning update 4202'); // PEAR Log interface

  //   $this->addTask(E::ts('Process first step'), 'processPart1', $arg1, $arg2);
  //   $this->addTask(E::ts('Process second step'), 'processPart2', $arg3, $arg4);
  //   $this->addTask(E::ts('Process second step'), 'processPart3', $arg5);
  //   return TRUE;
  // }
  // public function processPart1($arg1, $arg2) { sleep(10); return TRUE; }
  // public function processPart2($arg3, $arg4) { sleep(10); return TRUE; }
  // public function processPart3($arg5) { sleep(10); return TRUE; }

  /**
   * Example: Run an upgrade with a query that touches many (potentially
   * millions) of records by breaking it up into smaller chunks.
   *
   * @return TRUE on success
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
  //   return TRUE;
  // }

}
