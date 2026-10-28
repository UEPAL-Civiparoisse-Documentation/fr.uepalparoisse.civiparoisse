<?php
namespace Civi\Api4\Action\Contact;
use Civi\Api4\Generic\BasicGetAction;
use Civi\Api4\Generic\BasicUpdateAction;


class SetBergerieFromGeom extends BasicUpdateAction
{
  /**
   * Field values to update.
   *
   * @var array
   */
  protected $values = [];

  protected function writeRecord($item)
  {
    $ret=[];
    if(is_array($item) && isset($item['id']))
    {
      $ret=\Civi\Api4\Contact::get($this->getCheckPermissions())
        ->addSelect('geomBergerie')
        ->addSelect('id')
        ->setWhere([['id','=',$item['id']]])
        ->addChain('geomUpdateChain',\Civi\Api4\Contact::update($this->getCheckPermissions())->setValues(['multiparoisse.bergerie'=>'$geomBergerie'])->addWhere('id','=','$id')->setReload(['*','multiparoisse.*']))
        ->execute();
    }
    return $ret;
  }

}
