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
 if($dao!=null && $dao->description!=null)
 {
   CRM_Civiparoisse_Logger::getStdoutLogger()->log('info',$dao->description,['dao'=>$dao]);

   if(strpos($dao->description,'Failure')!==FALSE)
   {
     CRM_Civiparoisse_Logger::getStderrLogger()->log('error',$dao->description,['dao'=>$dao]);
   }
 }
}

function civiparoisse_civicrm_postSave_civicrm_system_log($dao)
{
  if($dao!=null && $dao->message!=null && $dao->level!=null)
  {
    switch($dao->level)
    {
      case 'notice':
      case 'info':
      case 'debug':
        CRM_Civiparoisse_Logger::getStdoutLogger()->log($dao->level,$dao->message,['dao'=>$dao]);
        break;
      default:
        CRM_Civiparoisse_Logger::getStderrLogger()->log($dao->level,$dao->message,['dao'=>$dao]);
    }
  }
}

function civiparoisse_civicrm_angularModules(&$angularModules)
{
return;
    $filepath=implode(DIRECTORY_SEPARATOR,
              [__DIR__,
               'ang',
              'searchDisplayPaged',
              'searchAdminDisplayPaged.component.js']);
echo "FILEPATH : ".$filepath.PHP_EOL;
    if(array_key_exists('crmSearchAdmin',$angularModules) 
       && array_key_exists('js',$angularModules['crmSearchAdmin']))
    {
        $angularModules['crmSearchAdmin']['js'][]=$filepath;
    }
    else
    {
        throw new Exception('crmSearchAdmin not found');
    }
}
