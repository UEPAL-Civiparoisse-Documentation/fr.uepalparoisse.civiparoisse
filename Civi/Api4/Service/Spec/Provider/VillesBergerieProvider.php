<?php
namespace Civi\Api4\Service\Spec\Provider;
/**
 * @service
 * @internal
 */

class VillesBergerieProvider extends AbstractBergerieProvider
{

  protected function getFieldName(): string
  {
    return 'villeBergerie';
  }

  public static function renderSQL(array $field): string
  {
    $alias=self::computeAlias($field);

    return <<<EOF
    (
    select min(ber.id)
    from
    civicrm_contact ct
    inner join civicrm_address addr on ct.id={$alias}id and addr.contact_id = ct.id and addr.is_primary=1
    inner join civicrm_location_type lt on addr.location_type_id = lt.id and lt.name='Home'
    inner join civicrm_banaddr ban on ban.addr_id=addr.id
    inner join civicrm_bergerie ber on find_in_set(ban.code_insee,ber.villes)>0
    )
    EOF;
  }

  protected function getLabel(): string
  {
    return 'villeBergerieLabel';
  }

}
