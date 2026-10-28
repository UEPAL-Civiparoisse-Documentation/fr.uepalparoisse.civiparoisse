<?php
namespace Civi\Api4\Action\Contact;
use Civi\Api4\Generic\BasicGetAction;
use Civi\Api4\Generic\BasicUpdateAction;


class SetBergerieFromCity extends BasicUpdateAction
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
        ->addSelect('villeBergerie')
        ->addSelect('id')
        ->setWhere([['id','=',$item['id']]])
        ->addChain('villeUpdateChain',\Civi\Api4\Contact::update($this->getCheckPermissions())->setValues(['multiparoisse.bergerie'=>'$villeBergerie'])->addWhere('id','=','$id')->setReload(['*','multiparoisse.*']))
        ->execute();
    }
    return $ret;
  }

}
