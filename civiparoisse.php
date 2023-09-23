<?php

require_once 'civiparoisse.civix.php';
// phpcs:disable
use CRM_Civiparoisse_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function civiparoisse_civicrm_config(&$config) {
  _civiparoisse_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function civiparoisse_civicrm_xmlMenu(&$files) {
  _civiparoisse_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function civiparoisse_civicrm_install() {
  _civiparoisse_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function civiparoisse_civicrm_postInstall() {
  _civiparoisse_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function civiparoisse_civicrm_uninstall() {
  _civiparoisse_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function civiparoisse_civicrm_enable() {
  _civiparoisse_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function civiparoisse_civicrm_disable() {
  _civiparoisse_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function civiparoisse_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civiparoisse_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function civiparoisse_civicrm_managed(&$entities) {
  _civiparoisse_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function civiparoisse_civicrm_caseTypes(&$caseTypes) {
  _civiparoisse_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function civiparoisse_civicrm_angularModules(&$angularModules) {
  _civiparoisse_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function civiparoisse_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civiparoisse_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function civiparoisse_civicrm_entityTypes(&$entityTypes) {
  _civiparoisse_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function civiparoisse_civicrm_themes(&$themes) {
  _civiparoisse_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function parametres_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */

 
function civiparoisse_civicrm_navigationMenu(&$menu) {
  _civiparoisse_civix_insert_navigation_menu($menu,'Administer/System Settings',array(
    'label'=>ts('UEPAL Parameters Setting'),
    'name'=>'uepal_parameters_setting',
    'permission'=>'administer CiviCRM',
    'url'=>'civicrm/admin/setting/preferences/uepal_parametres'
  ));

CRM_Civiparoisse_Pages_Page_ConfigurationSommaireCiviParoisse::buildMenuCiviParoisse($menu);


  _civiparoisse_civix_navigationMenu($menu);

}
//function parametres_civicrm_navigationMenu(&$menu) {
//  _parametres_civix_insert_navigation_menu($menu, 'Mailings', array(
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ));
//  _parametres_civix_navigationMenu($menu);
//}

function civiparoisse_civicrm_dashboard_defaults($availableDashlets, &$defaultDashlets)
{
    // Affichage du Dashlet Sommaire Civiparoisse
    $contactID = CRM_Core_Session::singleton()->get('userID');
    $dashlets=[
      new CRM_Civiparoisse_Dashlets_ConfigSommaire(),
      new CRM_Civiparoisse_Dashlets_ConfigProchainsAnniversaires()
    ];
    foreach($dashlets as $dashlet)
    {
      $defaults=$dashlet->computeDashletDefaults($contactID);
      if(is_array($defaults))
      {
        $defaultDashlets[]=$defaults;
      }
    }
}

/**
 * Implements hook_civicrm_alterBundle().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterBundle/
 */
function civiparoisse_civicrm_alterBundle(CRM_Core_Resources_Bundle $bundle) {
  if ($bundle->name === 'coreStyles') {
    $bundle->addStyleFile(E::LONG_NAME, 'css/surcharge-corestyles.css');
  }
}
