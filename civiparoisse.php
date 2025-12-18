<?php
//QUBE_IGNORE_FILE
require_once 'civiparoisse.civix.php';

// phpcs:disable
use CRM_Civiparoisse_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function civiparoisse_civicrm_config(&$config)
{
  _civiparoisse_civix_civicrm_config($config);
  Civi::dispatcher()->addListener('hook_civicrm_navigationMenu','civiparoisse_relocate_civisolr_menu',-1000);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function civiparoisse_civicrm_install()
{
  _civiparoisse_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function civiparoisse_civicrm_enable()
{
  _civiparoisse_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */


function civiparoisse_civicrm_navigationMenu(&$menu)
{
  _civiparoisse_civix_insert_navigation_menu($menu, 'Administer/System Settings', array(
    'label' => ts('UEPAL Parameters Setting'),
    'name' => 'uepal_parameters_setting',
    'permission' => 'administer CiviCRM',
    'url' => 'civicrm/admin/setting/preferences/uepal_parametres'
  ));

    CRM_Civiparoisse_Pages_Page_ConfigurationSommaireCiviParoisse::buildMenuCiviParoisse($menu);


  _civiparoisse_civix_navigationMenu($menu);

}

function civiparoisse_relocate_civisolr_menu(Civi\Core\Event\GenericHookEvent $event)
{

  $menu=&$event->getHookValues()[0];
    $civisolrKey = null;
    $civiparoisseKey = null;

  /**
   * Attention : en PHP les tableaux sont passés (sauf exception en utilisant le "&") par copie.
   * Du coup il est plus simple de travailler avec les clefs et le tableau qui a été passé
   * par référence dans cette function
   */

  foreach ($menu as $key => $root) {
    if ($root['attributes']['name'] == "uepal_civisolraddr") {

      $civisolrKey = $key;
    }
    if ($root['attributes']['name'] == 'menu-civiparoisse') {

      $civiparoisseKey = $key;
    }
  }
  if (!is_null($civisolrKey) && !is_null($civiparoisseKey)) {

    $menu[$civiparoisseKey]['child'][] = $menu[$civisolrKey];
    unset($menu[$civisolrKey]);
  }


}

function civiparoisse_civicrm_dashboard_defaults($availableDashlets, &$defaultDashlets)
{
  // Affichage du Dashlet Sommaire Civiparoisse
  $contactID = CRM_Core_Session::singleton()->get('userID');
  $dashlets = [
    new CRM_Civiparoisse_Dashlets_ConfigSommaire(),
    new CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversairesMgd()
  ];
  foreach ($dashlets as $dashlet) {
    $defaults = $dashlet->computeDashletDefaults($contactID);
    if (is_array($defaults)) {
      $defaultDashlets[] = $defaults;
    }
  }
}

/**
 * Implements hook_civicrm_alterBundle().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterBundle/
 */
function civiparoisse_civicrm_alterBundle(CRM_Core_Resources_Bundle $bundle)
{
  if ($bundle->name === 'coreStyles') {
    $bundle->addStyleFile(E::LONG_NAME, 'css/surcharge-corestyles.css');
  }
}

function civiparoisse_civicrm_postSave_civicrm_job_log($dao)
{
  if ($dao != null && $dao->description != null) {
    CRM_Civiparoisse_Logger::getStdoutLogger()->log('info', $dao->description, ['dao' => $dao]);

    if (strpos($dao->description, 'Failure') !== FALSE) {
      CRM_Civiparoisse_Logger::getStderrLogger()->log('error', $dao->description, ['dao' => $dao]);
    }
  }
}

function civiparoisse_civicrm_postSave_civicrm_system_log($dao)
{
  if ($dao != null && $dao->message != null && $dao->level != null) {
    switch ($dao->level) {
      case 'notice':
      case 'info':
      case 'debug':
        CRM_Civiparoisse_Logger::getStdoutLogger()->log($dao->level, $dao->message, ['dao' => $dao]);
        break;
      default:
        CRM_Civiparoisse_Logger::getStderrLogger()->log($dao->level, $dao->message, ['dao' => $dao]);
    }
  }
}


/**
 * ajout de tâches classiques
 * @param string $objectType
 * @param array $tasks
 * @return void
 */
function civiparoisse_civicrm_searchTasks(string $objectType, array &$tasks)
{
  //ajout de l'action d'envoi de mail aux parents
  if($objectType==='contact'){
    $tasks[]=[
      'title' => E::ts('Parents : send mail'),
      'class' => 'CRM_Civiparoisse_Formulaires_Form_ParentMailingTask'
    ];
    $tasks[CRM_Core_Task::LABEL_CONTACTS]=[
      'title'=>E::ts('Prepare offseted/transposed labels'),
      'class'=>'CRM_Civiparoisse_Formulaires_Tasks_LabelOffset',
      'url'=>'civicrm/civiparoisse/contact/task/transpose-offset-label-print',
      'icon'=>'fa-print'
    ];
  }
}

function civiparoisse_civicrm_searchkitTasks(array &$tasks, bool $checkPermissions, ?int $userID)
{
  $tasks['Contact']['parentMailing']=[
    'module' => 'civiparoisseSearchTasks',
    'title' => E::ts('Parents : send mail'),
    'icon' => 'fa-paper-plane',
    'uiDialog' => ['templateUrl' => '~/civiparoisseSearchTasks/civiparoisseSearchTaskParentMailing.html']
    ];
}
