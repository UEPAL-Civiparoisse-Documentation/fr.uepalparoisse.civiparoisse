<?php

class SeraphinContactsAdressesStub extends CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsAdresses
{
static protected function findLocationId($donnees)
{
switch($donnees)
{
case 'Domicile':
  return 1;
default: throw Exception("Valeur non reconnue");
}
}
}

class CRM_Civiparoisse_MappingImport_SeraphinContactsAdressesTest 
extends \PHPUnit\Framework\TestCase 
{
protected function auxTestMethod($expected,$method)
{
$obj=new SeraphinContactsAdressesStub();
$method=new ReflectionMethod($obj,$method);
$method->setAccessible(true);
$computed=$method->invoke($obj);
$this->assertEquals($expected,$computed);

}
public function testGetParametersMapping()
{
$this->auxTestMethod(
[
                        'name' => 'Seraphin-Contacts-Adresses',
        'description' => "Modèle d'import des adresses extraites de Séraphin", 
        'mapping_type_id_name' => "Import Contact",
    ],
'getParametersMapping');
}



public function testGetParametersDisplay()
{
$this->auxTestMethod(
[
      [
        'name' => 'external_identifier', 
        'contact_type' => 'Individual', 
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
        'name' => 'last_name', 
        'contact_type' => 'Individual', 
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
        'name' => 'first_name', 
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
        'name' => 'do_not_import', 
        'contact_type' => 'Individual', 
        'column_number' => 4, 
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
        'name' => 'master_id', 
        'contact_type' => 'Individual', 
        'column_number' => 5, 
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
        'name' => 'street_address', 
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
        'name' => 'country', 
        'contact_type' => 'Individual', 
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
        'contact_type' => 'Individual', 
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
    ]
,'getParametersDisplay');
}
}
