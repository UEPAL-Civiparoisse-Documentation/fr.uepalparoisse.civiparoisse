<?php
class CRM_Civiparoisse_MappingImport_SeraphinFoyersNotesTest 
extends \PHPUnit\Framework\TestCase 
{
protected function auxTestMethod($expected,$method)
{
$obj=new CRM_Civiparoisse_Parametres_MappingImport_SeraphinFoyersNotes();
$method=new ReflectionMethod($obj,$method);
$method->setAccessible(true);
$computed=$method->invoke($obj);
$this->assertEquals($expected,$computed);
}
public function testGetParametersMapping()
{
$this->auxTestMethod(
[
                        'name' => 'Seraphin-Foyers-Notes', 
        'description' => "Modèle d'import des notes des foyers extraits de Séraphin", 
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
        'name' => 'note', 
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
    ]
,'getParametersDisplay');
}
}
