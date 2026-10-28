<?php
use \Civi\Api4\Bergerie;
use Civi\Core\Service\AutoService;

/**
 * @service multiparoisse
 */
class CRM_Civiparoisse_Multiparoisse extends AutoService {
  public function isMultiparoisse():bool
  {
    $cardBergerie=Bergerie::get(false)->selectRowCount()->execute()->count();
    return $cardBergerie > 1;
  }
}
