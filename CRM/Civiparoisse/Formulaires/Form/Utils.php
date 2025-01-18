<?php
use CRM_Civiparoisse_Formulaires_Form_LocationTypeEnum as LocationType;
class CRM_Civiparoisse_Formulaires_Form_Utils
{
public static function retrieveNameByType(LocationType $location) : ?string
{
  $ret=null;
  $terms=[
    LocationType::Facturation->value=> ['Facturation','Billing'],
    LocationType::Autre->value=>['Autre','Other'],
    LocationType::Principal->value=>['Principal','Main'],
    LocationType::Domicile->value=>['Domicile','Home'],
    LocationType::Travail->value=>['Travail','Work']
  ];
  if(array_key_exists($location->value,$terms))
  {
    $elems=$terms[$location->value];
    $ret=Civi\Api4\LocationType::get(false)->addSelect('name')
      ->addWhere('name','IN',$elems)
      ->execute()->first()['name'];
  }
  return $ret;
}
}
