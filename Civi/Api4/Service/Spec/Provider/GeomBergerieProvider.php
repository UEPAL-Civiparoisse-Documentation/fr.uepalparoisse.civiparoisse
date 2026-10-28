<?php
namespace Civi\Api4\Service\Spec\Provider;
/**
 * @service
 * @internal
 */
class GeomBergerieProvider extends AbstractBergerieProvider
{
  protected function getFieldName(): string
  {
    return 'geomBergerie';
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
    inner join civicrm_bergerie ber on  ber.wkt is not null and ber.wkt<>'' and ST_Contains(ST_GeomFromText(ber.wkt,2154),ST_GeomFromText(CONCAT('POINT(',ban.proj_leg_x,' ',ban.proj_leg_y,')'),2154))=1
    )
    EOF;
  }

  protected function getLabel(): string
  {
    return 'geomBergerieLabel';
  }

}
