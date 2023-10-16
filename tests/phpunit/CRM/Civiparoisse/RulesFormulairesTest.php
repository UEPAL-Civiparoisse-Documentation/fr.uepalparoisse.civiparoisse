<?php

/**
 * This is a generic test class for the extension (implemented with PHPUnit).
 */
class CRM_Civiparoisse_RulesFormulairesTest extends \PHPUnit\Framework\TestCase {

  /**
   * The setup() method is executed before the test is executed (optional).
   */
  public function setUp():void {
    parent::setUp();
  }

  /**
   * The tearDown() method is executed after the test was executed (optional).
   *
   * This can be used for cleanup.
   */
  public function tearDown():void {
    parent::tearDown();
  }

protected function assertTrueExpected($trueExpected,$valueComputed)
{
$isTrueComputed=($valueComputed===true);
$this->assertEquals($trueExpected,$isTrueComputed);

}

public static function validateNomIndividuDataProvider():array
{
return [
['toto',false],
[['last_name'=>'tutu'],true],
];
}

/**
* @dataProvider validateNomIndividuDataProvider
*/
public function testValidateNomIndividu($fields,$trueExpected)
{
$computed=CRM_Civiparoisse_Formulaires_Form_RulesFormulaires::validateNomIndividu($fields);
$this->assertTrueExpected($trueExpected,$computed);
}


public static function validateNomOrganizationDataProvider():array
{
return [
//['toto',false],
[['organization_name'=>'tutu'],true]
];
}

/**
* @dataProvider validateNomOrganizationDataProvider
*/
public function testValidateNomOrganization($fields,$trueExpected)
{
$computed=CRM_Civiparoisse_Formulaires_Form_RulesFormulaires::validateNomOrganization($fields);
$this->assertTrueExpected($trueExpected,$computed);
}


public static function validateNomFoyerDataProvider():array
{
return [
//['toto',false],
[['household_name'=>'Mon Foyer'],true]
];
}
/**
* @dataProvider validateNomFoyerDataProvider
*/
public function testValidateNomFoyer($fields,$trueExpected)
{
$computed=CRM_Civiparoisse_Formulaires_Form_RulesFormulaires::validateNomFoyer($fields);
$this->assertTrueExpected($trueExpected,$computed);
}


public static function validateVilleDataProvider():array
{
return [
//['toto',false],
[['city'=>'Strasbourg'],true],
[['city'=>'Engelthal-Le-Bas'],true]
];
}
/**
* @dataProvider validateVilleDataProvider
*/
public function testValidateVille($fields,$trueExpected)
{
$computed=CRM_Civiparoisse_Formulaires_Form_RulesFormulaires::validateVille($fields);
$this->assertTrueExpected($trueExpected,$computed);
}

public static function validateCourrielIndividuDataProvider():array
{
return [
//['toto',false],
[['email_home'=>'tututest'],false],
[['email_home'=>'tutu@titi.test'],true]
];
}
/**
* @dataProvider validateCourrielIndividuDataProvider
*/
public function testValidateCourrielIndividu($fields,$trueExpected)
{
$computed=CRM_Civiparoisse_Formulaires_Form_RulesFormulaires::validateCourrielIndividu($fields);
$this->assertTrueExpected($trueExpected,$computed);
}
}
