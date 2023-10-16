<?php
class SeraphinFoyersStub extends CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyers
{
  static protected function findLocationId($donnees)
  {
    switch($donnees)
    {
      case 'domicile':
      case 'Domicile':
        return 1;
      default: 
        throw new Exception("Valeur non reconnue");
    }
  }
  static protected function findPhoneTypeId($donnees)
  {
    switch($donnees)
    {
      case 'Phone':
        return 317;
      default:
        throw new Exception("Valeur non reconnue");
    }
  }
 static protected function findCustomFieldId($name,$customGroup)
  {
    switch($customGroup)
    {
      case 'Informations supplémentaires':
        switch($name)
        {
          case 'mode_distribution':
            return 27;
          case 'quartier':
            return 26;
          default:
            throw new Exception("Valeur non reconnue");
        }
      default:
        throw new Exception("Valeur non reconnue");
    }
  }
}
class CRM_Civiparoisse_MappingImport_SeraphinFoyersTest 
extends \PHPUnit\Framework\TestCase 
{
protected function auxTestMethod($expected,$method)
{
$obj=new SeraphinFoyersStub();
$method=new ReflectionMethod($obj,$method);
$method->setAccessible(true);
$computed=$method->invoke($obj);
$this->assertEquals($expected,$computed);
}
public function testGetParametersMapping(){
$this->auxTestMethod(
[
                        'name' => 'Seraphin-Foyers', 
        'description' => "Modèle d'import des foyers extraits de Séraphin", 
        'mapping_type_id_name' => "Import Contact",
    ]
,'getParametersMapping');
}
public function testGetParametersDisplay()
{
$this->auxTestMethod(
[
      [
        'name' => 'contact_source', 
        'contact_type' => 'Household', 
        'column_number' => 0, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
    [
        'name' => 'household_name', 
        'contact_type' => 'Household', 
        'column_number' => 2, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'email', 
        'contact_type' => 'Household', 
        'column_number' => 3, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
    [
        'name' => 'phone', 
        'contact_type' => 'Household', 
        'column_number' => 4, 
        'location_type_id' => 1, 
        'phone_type_id' => 317, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],
      [
        'name' => 26, 
        'contact_type' => 'Household', 
        'column_number' => 5, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
    [
        'name' => 'street_address', 
        'contact_type' => 'Household', 
        'column_number' => 6, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'supplemental_address_1', 
        'contact_type' => 'Household', 
        'column_number' => 7, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
     [
        'name' => 'supplemental_address_2', 
        'contact_type' => 'Household', 
        'column_number' => 8, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
     [
        'name' => 'supplemental_address_3', 
        'contact_type' => 'Household', 
        'column_number' => 9, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'city', 
        'contact_type' => 'Household', 
        'column_number' => 10, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'postal_code', 
        'contact_type' => 'Household', 
        'column_number' => 11, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'external_identifier', 
        'contact_type' => 'Household', 
        'column_number' => 1, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
      [
        'name' => 'country', 
        'contact_type' => 'Household', 
        'column_number' => 12, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
 [
        'name' => 'state_province', 
        'contact_type' => 'Household', 
        'column_number' => 13, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
     [
        'name' => 27, 
        'contact_type' => 'Household', 
        'column_number' => 14, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],
    ]
,'getParametersDisplay');
}
}
