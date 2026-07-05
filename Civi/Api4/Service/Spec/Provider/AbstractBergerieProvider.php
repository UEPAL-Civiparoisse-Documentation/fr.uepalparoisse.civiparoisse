<?php

namespace Civi\Api4\Service\Spec\Provider;

use Civi\Api4\Service\Spec\RequestSpec;
use Civi\Api4\Service\Spec\FieldSpec;
use CRM_Civiparoisse_ExtensionUtil as E;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class AbstractBergerieProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface
{
  use ComputeAliasTrait;
  protected abstract function getFieldName(): string;

  public abstract static function renderSQL(array $field): string;

  protected abstract function getLabel(): string;

  public static function renderSQLName(array $field): string
  {
    $fieldExpr = static::renderSQL($field);
    $expr = <<<EOF
(select bname.name from civicrm_bergerie bname where bname.id={$fieldExpr})
EOF;
    return $expr;
  }


  /**
   * @param string $entity
   * @param string $action
   * @return bool
   */
  public function applies(string $entity, string $action)
  {
    return $entity === 'Contact' && $action === 'get';
  }

  public function modifySpec(RequestSpec $spec)
  {
    $fieldName = $this->getFieldName();
    $fieldSpec = new FieldSpec($fieldName, 'Contact', 'Integer');
    $fieldSpec
      ->setLabel(E::ts($this->getLabel()))
      ->setReadonly(true)
      ->setSqlRenderer([static::class, 'renderSQL'])
      ->setColumnName($this->getFieldName());
    $spec->addFieldSpec($fieldSpec);

    $name=$fieldName."_name";
    $nameSpec=new FieldSpec($name,'Contact','String');
    $nameSpec->setLabel(E::ts($name))
      ->setReadonly(true)
      ->setSqlRenderer([static::class,'renderSQLName'])
      ->setColumnName($name);
    $spec->addFieldSpec($nameSpec);


  }
}
