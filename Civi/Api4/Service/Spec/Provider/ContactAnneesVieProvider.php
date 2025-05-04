<?php

namespace Civi\Api4\Service\Spec\Provider;
use Civi\Api4\Service\Spec\FieldSpec;
use Civi\Api4\Service\Spec\RequestSpec;
use CRM_Civiparoisse_ExtensionUtil as E;

/**
 * @service
 * @internal
 */
class ContactAnneesVieProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface
{
  public function modifySpec(RequestSpec $spec)
  {
    $anneesVie=new FieldSpec('annees_vie','Contact','Integer');
    $anneesVie->setColumnName('id')
      ->setLabel(E::ts('annees_vie'))
      ->setReadonly(true)
      ->setSqlRenderer([__CLASS__,'renderAnneesVie']);
    $spec->addFieldSpec($anneesVie);
  }

  public function applies(string $entity, string $action)
  {
    return $entity === 'Contact' && $action ==='get';
  }

  public static function renderAnneesVie(array $field): string
  {

    $alias='';
    $exploded=explode('.',$field['sql_name'],-1);
    if(count($exploded)==1)
    {
      $alias=$exploded[0];
      $alias.='.';
    }


    return "IF({$alias}contact_type='Individual' and {$alias}birth_date is not null,
     IF({$alias}is_deceased=0,
         TIMESTAMPDIFF(YEAR,{$alias}birth_date,CURDATE()),
         IF({$alias}deceased_date is not null, TIMESTAMPDIFF(YEAR,{$alias}birth_date,{$alias}deceased_date),NULL)),
     NULL)";
  }

}
