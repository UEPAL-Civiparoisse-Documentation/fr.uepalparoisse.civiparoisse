<?php
class SeraphinContactsFratrieStub extends CRM_Civiparoisse_Parametres_MappingImport_SeraphinContactsFratries
{
  static protected function findLocationId($donnees)
  {
    switch($donnees)
    {
      case 'Domicile':
        return 1;
      default: 
        throw new Exception("Valeur non reconnue");
    }
  }

  static protected function findRelationshipTypeId($name) 
  {
    switch($name)
    {
       case 'Sibling of':
         return 4;
       default: 
         throw new Exception("Valeur non reconnue");
    }
  }

}


class CRM_Civiparoisse_MappingImport_SeraphinContactsFratrieTest 
extends \PHPUnit\Framework\TestCase 
{
protected function auxTestMethod($expected,$method)
{
$obj=new SeraphinContactsFratrieStub();
$method=new ReflectionMethod($obj,$method);
$method->setAccessible(true);
$computed=$method->invoke($obj);
$this->assertEquals($expected,$computed);

}

public function testGetParametersMapping()
{
$this->auxTestMethod(
[
                        'name' =>'Seraphin-Contacts-Fratries',
        'description' => "Modèle d'import des fratries extraits de Séraphin",
        'mapping_type_id_name' => "Import Contact",
    ]
,'getParametersMapping');
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
        'name' => 'external_identifier', 
        'contact_type' => 'Individual', 
        'column_number' => 4, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => 4, 
        'relationship_direction' => 'a_b', 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ], 
    ]
,'getParametersDisplay');
}

}
