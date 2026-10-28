<?php

use Civi\Api4\Event\AuthorizeRecordEvent;

class CRM_Civiparoisse_BAO_Bergerie extends CRM_Civiparoisse_DAO_Bergerie implements Civi\Core\HookInterface
{
  /**
   * Required by older versions of CiviCRM (<5.74).
   * @var string
   */
  public static $_tableName = 'civicrm_bergerie';

  /**
   * Adaptation de CRM_Contact_AccessTrait
   * Le but est d'interdire les modifications sur la Bergerie DEFAULT
   * @see \Civi\Api4\Utils\CoreUtil::checkAccessRecord*
   */
  public static function self_civi_api4_authorizeRecord(AuthorizeRecordEvent $e): void
  {
    $record = $e->getRecord();
    //$userId = $e->getUserID();
    $action = $e->getActionName();
    $shouldDeny = ($action != "create" && $record['name'] == 'DEFAULT');
    if (!$shouldDeny && array_key_exists('id', $record) && !empty($record['id'])) {
      $count = Civi\Api4\Bergerie::get(false)->addWhere('id', '=', $record['id'])
        ->addWhere('name', '=', 'DEFAULT')->selectRowCount()->execute()->count();
      $shouldDeny = ($count === 1);
    }
    if ($shouldDeny) {
      $e->setAuthorized(false);
      $e->stopPropagation();
    }

  }
}
