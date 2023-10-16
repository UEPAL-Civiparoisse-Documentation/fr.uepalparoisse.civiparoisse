<?php
class SeraphinContactsStub extends CRM_Civiparoisse_Parametres_MappingImport_SeraphinContacts
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
       case 'Household Member of':
         return 8;
       case 'Employee of':
         return 5;
       case 'Head of Household for':
         return 7;
       default: 
         throw new Exception("Valeur non reconnue");
    }
  }

  static protected function findCustomFieldId($name,$customGroup)
  {
    switch($customGroup)
    {
       case 'Etat Civil':
         switch($name)
         {
           case 'nom_naissance':
             return 1;
           case 'lieu_naissance':
             return 2;
           case 'date_mariage':
             return 3;
           case 'date_benediction_nuptiale':
             return 4;
           case 'paroisse_mariage':
             return 5;
           case 'verset_mariage':
             return 6;
           case 'divorce':
             return 7;
           case 'date_divorce':
             return 8;
           case 'date_veuvage':
             return 9;
           case 'date_obseques':
             return 10;
           case 'paroisse_enterrement':
             return 11;
           case 'securite_sociale':
             return 12;
           case 'fonctionnaire':
             return 14;
           default:
             throw new Exception("Valeur non reconnue");
         }
       case 'Information Religion':
         switch($name)
         {
           case 'religion':
             return 15;
           case 'date_bapteme':
             return 18;
           case 'paroisse_bapteme':
             return 19;
           case 'verset_bapteme':
             return 20;
           case 'date_confirmation':
             return 21;
           case 'paroisse_confirmation':
             return 22;
           case 'verset_confirmation':
             return 23;

           default:
           throw new Exception("Valeur non reconnue");
         }
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
}


class CRM_Civiparoisse_MappingImport_SeraphinContactsTest 
extends \PHPUnit\Framework\TestCase 
{
protected function auxTestMethod($expected,$method)
{
$obj=new SeraphinContactsStub();
$method=new ReflectionMethod($obj,$method);
$method->setAccessible(true);
$computed=$method->invoke($obj);
$this->assertEquals($expected,$computed);
}

public function testGetParametersMapping()
{
$this->auxTestMethod(
[
                        'name' => 'Seraphin-Contacts', 
        'description' => "Modèle d'import des contacts extraits de Séraphin", 
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
      ],     [
        'name' => 'external_identifier', 
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
        'name' => 'household_name', 
        'contact_type' => 'Individual', 
        'column_number' => 2, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => 8,
        'relationship_direction' => 'a_b', 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],       [
        'name' => 'prefix_id', 
        'contact_type' => 'Individual', 
        'column_number' => 3, 
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
      ],      [
        'name' => 'first_name', 
        'contact_type' => 'Individual', 
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
        'name' => 'middle_name', 
        'contact_type' => 'Individual', 
        'column_number' => 6, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],      [
        'name' => 'organization_name', 
        'contact_type' => 'Individual', 
        'column_number' => 7, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => 5, 
        'relationship_direction' => 'a_b', 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],     [
        'name' => 'job_title', 
        'contact_type' => 'Individual', 
        'column_number' => 8, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],       [
        'name' => 'email', 
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
        'name' => 'phone', 
        'contact_type' => 'Individual', 
        'column_number' => 10, 
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
        'name' => 1,
        'contact_type' => 'Individual', 
        'column_number' => 11, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],      [
        'name' => 2, 
        'contact_type' => 'Individual', 
        'column_number' => 12, 
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
        'name' => 'birth_date', 
        'contact_type' => 'Individual', 
        'column_number' => 13, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],      [
        'name' => 'gender_id', 
        'contact_type' => 'Individual', 
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
      ],      [
        'name' => 3, 
        'contact_type' => 'Individual', 
        'column_number' => 15, 
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
        'name' => 4, 
        'contact_type' => 'Individual', 
        'column_number' => 16, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],      [
        'name' => 5,
        'contact_type' => 'Individual', 
        'column_number' => 17, 
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
        'name' => 6,
        'contact_type' => 'Individual', 
        'column_number' => 18, 
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
        'name' => 7,
        'contact_type' => 'Individual', 
        'column_number' => 19, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],       [
        'name' => 8, 
        'contact_type' => 'Individual', 
        'column_number' => 20, 
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
        'name' => 9, 
        'contact_type' => 'Individual', 
        'column_number' => 21, 
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
        'name' => 10,  
        'contact_type' => 'Individual', 
        'column_number' => 22, 
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
        'name' => 11, 
        'contact_type' => 'Individual', 
        'column_number' => 23, 
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
        'name' => 'is_deceased', 
        'contact_type' => 'Individual', 
        'column_number' => 24, 
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
        'name' => 12,  
        'contact_type' => 'Individual', 
        'column_number' => 25, 
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
        'name' => 14,  
        'contact_type' => 'Individual', 
        'column_number' => 26, 
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
        'name' => 15, 
        'contact_type' => 'Individual', 
        'column_number' => 27, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],       [
        'name' => 18, 
        'contact_type' => 'Individual', 
        'column_number' => 28, 
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
        'name' => 19, 
        'contact_type' => 'Individual', 
        'column_number' => 29, 
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
        'name' => 20, 
        'contact_type' => 'Individual', 
        'column_number' => 30, 
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
        'name' => 21, 
        'contact_type' => 'Individual', 
        'column_number' => 31, 
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
        'name' => 22, 
        'contact_type' => 'Individual', 
        'column_number' => 32, 
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
        'name' => 23, 
        'contact_type' => 'Individual', 
        'column_number' => 33, 
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
        'contact_type' => 'Individual', 
        'column_number' => 34, 
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
        'column_number' => 35, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],      [
        'name' => 'supplemental_address_2', 
        'contact_type' => 'Individual', 
        'column_number' => 36, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],       [
        'name' => 'supplemental_address_3', 
        'contact_type' => 'Individual', 
        'column_number' => 37, 
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
        'column_number' => 38, 
        'location_type_id' => 1, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => NULL, 
        'relationship_direction' => NULL, 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],      [
        'name' => 'postal_code', 
        'contact_type' => 'Individual', 
        'column_number' => 39, 
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
        'column_number' => 40, 
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
        'column_number' => 41, 
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
        'name' => 'is_opt_out', 
        'contact_type' => 'Individual', 
        'column_number' => 42, 
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
        'contact_type' => 'Individual', 
        'column_number' => 43, 
        'location_type_id' => NULL, 
        'phone_type_id' => NULL, 
        'im_provider_id' => NULL, 
        'website_type_id' => NULL, 
        'relationship_type_id' => 7, 
        'relationship_direction' => 'a_b', 
        'grouping' => 1, 
        'operator' => NULL, 
        'value' => NULL,
      ],
    ]
,'getParametersDisplay');
}
}
