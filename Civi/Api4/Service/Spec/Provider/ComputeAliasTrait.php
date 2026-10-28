<?php
namespace Civi\Api4\Service\Spec\Provider;
trait ComputeAliasTrait{
  public static function computeAlias(array $field):string
  {
    $alias='';
    $exploded=explode('.',$field['sql_name'],-1);
    if(count($exploded)==1)
    {
      $alias=$exploded[0];
      $alias.='.';
    }
    return $alias;
  }
}
