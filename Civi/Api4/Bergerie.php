<?php
namespace Civi\Api4;
use Civi\Api4\Generic\DAOEntity;

/**
 * @package Civi\Api4
 */
class Bergerie extends DAOEntity{

public static function permissions() {
    return [
      'get' => ['access CiviCRM'],
    ];
  }

}
