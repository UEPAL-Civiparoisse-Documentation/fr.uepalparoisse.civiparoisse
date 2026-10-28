<?php

namespace Civi\Api4\Service\Spec\Provider;
use Civi\Api4\Service\Spec\FieldSpec;
use Civi\Api4\Service\Spec\RequestSpec;
use CRM_Civiparoisse_ExtensionUtil as E;

/**
 * @service
 * @internal
 */
class BergerieCardinalProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface
{
  public function modifySpec(RequestSpec $spec)
  {
    $fieldSpec=new FieldSpec('bergerieCardinal','Contact','Integer');
    $fieldSpec->setReadonly(true)
      ->setSqlRenderer([__CLASS__,'renderSQL'])
      ->setLabel(E::ts('cardinal des bergeries'));
    $spec->addFieldSpec($fieldSpec);
  }

  public function applies(string $entity, string $action)
  {
    return $entity === 'Contact' && $action === 'get';
  }

  public static function renderSQL(array $field): string
  {
    return <<<EOF
     (select count(distinct ber.id) from civicrm_bergerie ber)

EOF;

  }

}
