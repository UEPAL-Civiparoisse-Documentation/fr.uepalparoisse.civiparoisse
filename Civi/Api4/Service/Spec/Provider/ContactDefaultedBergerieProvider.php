<?php
namespace Civi\Api4\Service\Spec\Provider;
use Civi\Api4\Service\Spec\RequestSpec;
use Civi\Api4\Service\Spec\FieldSpec;
use CRM_Civiparoisse_ExtensionUtil as E;
/**
 * @service
 * @internal
 */
class ContactDefaultedBergerieProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface
{
  use ComputeAliasTrait;
  public function modifySpec(RequestSpec $spec)
  {
    $fieldSpec=new FieldSpec('defaulted_bergerie','Contact','Integer');
    $fieldSpec
      ->setLabel(E::ts('DefaultedBergerieLabel'))
      ->setInputType('EntityRef')
      ->setInputAttr('autoOpen','true')
      ->setFkEntity('Bergerie')
      ->setFkColumn('id')
      ->setReadonly(true)
      ->setSqlRenderer([__CLASS__,'renderSQL']);
    $spec->addFieldSpec($fieldSpec);

    $fieldSpecInferedName=new FieldSpec('defaulted_bergerie.name','Contact','String');
    $fieldSpecInferedName
      ->setLabel(E::ts('DefaultedBergerieNameLabel'))
      ->setFkEntity('Bergerie')
      ->setFKColumn('name')
      ->setReadonly(true)
      ->setSqlRenderer([static::class,'renderSQLName']);
    $spec->addFieldSpec($fieldSpecInferedName);
  }

  public function applies(string $entity, string $action)
  {
    return $entity === 'Contact' && $action === 'get';
  }

  public static function renderSQLName(array $field): string{
    $fieldExpr=static::renderSQL($field);
    return <<<EOF
(select ber.name from civicrm_bergerie ber where id={$fieldExpr})
EOF;

  }

  public static function renderSQL(array $field): string
  {
    $alias=self::computeAlias($field);
    return <<<EOF
    (coalesce((select multi.bergerie from civicrm_value_multiparoisse multi where multi.entity_id={$alias}id),(select ber.id from civicrm_bergerie ber where name='DEFAULT')))
EOF;


  }

}
