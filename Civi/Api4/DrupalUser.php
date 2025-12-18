<?php

namespace Civi\Api4;

use Civi\Api4\Action\DrupalUser\Get;
use CRM_Utils_Type;

class DrupalUser extends Generic\AbstractEntity {

  public static function getFields($checkPermissions = TRUE) {
    return (new \Civi\Api4\Generic\BasicGetFieldsAction(__CLASS__, __FUNCTION__, function($getFieldsAction) {
      return [
        [ 'name' => 'uid', 'data_type' => 'Integer', 'description' => 'Drupal User ID' ],
        [ 'name' => 'user_name', 'data_type' => 'String','description' => 'User name' ],
        [ 'name' => 'created', 'data_type' => 'Date', 'description' => 'Date of creation' ],
        [ 'name' => 'access', 'data_type' => 'Date', 'description' => 'Last access date' ],
        [ 'name' => 'roles', 'data_type' => 'Array','description' => 'User roles' ],
        [ 'name' => 'status', 'data_type' => 'Integer', 'description' => 'User status'],
        [ 'name' => 'mail', 'data_type' => 'String', 'description' => 'User email']

      ];
    }))->setCheckPermissions($checkPermissions);
  }

  public static function get($checkPermissions = TRUE) {
    return (new Action\DrupalUser\Get(__CLASS__, __FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  public static function permissions() {
    return [
      'get' => ['access CiviCRM']
    ];
  }
}
