<?php

use CRM_Civiparoisse_ExtensionUtil as E;
use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaires as F;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Civiparoisse_Formulaires_Form_FormulaireFoyer extends CRM_Core_Form {
	public function buildQuickForm() {

	// NomFoyer
		F::addNomFoyer($this);
		
	// BlocAdresse
		F::addAdresse($this);

	// TelephoneFixe (Domicile)
		$varType = 'Téléphone Fixe Domicile';
		F::addTelephoneFixe($this, $varType);
			
	// Quartier
		F::addQuartier($this);

	// Mode Distruibution du Journal
		F::addModeDistribution($this);

	// Bouton Envoyer
		$this->addButtons(array(
			array(
				'type' => 'submit',
				'name' => E::ts('Save'),
				'isDefault' => TRUE,
			),
		));

    // export form elements
		$this->assign('elementNames', $this->getRenderableElementNames());
		parent::buildQuickForm();
	}

/**
   * Function to add validation condition rules (overrides parent function)
   * 
   * @param void
   *
   * @access public
   * 
   * @return void
   */
	public function addRules() {
	  $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateNomFoyer'));// Vérification de la saisie du nom du Foyer

		$this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateVille'));// Vérification de la saisie du Foyer
	}

// TRAITEMENT DU FORMULAIRE
 	public function postProcess() {

		$this->controller->_destination = CRM_Utils_System::url('civicrm/formulaire-individu', 'reset=1'); // Destination après validation du formulaire

	  $values = $this->exportValues(); // récupération des valeurs envoyés par le formulaire

		$ignores = array('entryURL', 'qfKey'); // suppression des valeurs inutiles dans le array
		foreach ($values as $key => $data) {
			if (substr($key, 0, 1) != "_" && !in_array($key, $ignores)) {
	        $params[$key] = $data; // création du tableau avec les valeurs à créer
	      }
	    }

// création du Foyer

	  /* Récupération des ID des Custom Fields */
	  $listCustomFieldsHousehold = array();	

    $getListCustomFieldsHousehold = civicrm_api3('CustomField', 'get', [
    	'sequential' => 1,
    	'return' => ["name"],
    	'options' => ['limit' => 0],
    ]); 

    /* transformation de la liste pour avoir le nom en premier et l'id derrière */
    for($i=0; $i<($getListCustomFieldsHousehold['count']);$i++) {
    	$j = $getListCustomFieldsHousehold['values'][$i]['name'];
    	$listCustomFieldsHousehold[$j] = 'custom_'.$getListCustomFieldsHousehold['values'][$i]['id'];
    } 

    /* Création du Foyer dans l'API */
    try {
    	$newHousehold = civicrm_api3('Contact', 'create', [
    		'contact_type' => "Household",
    		'household_name' => $params['household_name'],
    		$listCustomFieldsHousehold["quartier"] => $params['quartier'],
    	]);
    	CRM_Core_Session::setStatus(' Household in database saved', ' Household saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
    	CRM_Core_Session::setStatus('Error saving Household in database', 'NOT Saved Household', 'error');
    }	

    $newHousehold_id = $newHousehold['id'];
    $famille['household_id'] = $newHousehold['id'];

	// création de l'adresse du Foyer
    try {
    	$newHouseholdAdress = civicrm_api3('Address', 'create', [
    		'contact_id' => $newHousehold_id,
    		'location_type_id' => 'Domicile',
    		'is_primary' => 1,
    		'street_address' => $params['street_address'],
    		'supplemental_address_1' => $params['supplemental_address_1'],
    		'supplemental_address_2' => $params['supplemental_address_2'],
    		'postal_code' => $params['postal_code'],
    		'city' => $params['city'],
    		'state_province_id' => $params['state_province_id'],
    		'country_id' => $params['country_id'],
    	]);
    	CRM_Core_Session::setStatus(' Household adresse in database saved', ' Adresse saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
    	CRM_Core_Session::setStatus('Error saving Household adresse in database', 'NOT Saved Adresse', 'error');
    }	

    $famille['household_adress_id'] = $newHouseholdAdress['id'];

	// création du téléphone fixe du Foyer
    try {
    	$newHouseholdPhone = civicrm_api3('Phone', 'create', [
    		'contact_id' => $newHousehold_id,
    		'location_type_id' => 'Domicile',
    		'is_primary' => 1,
    		'phone_type_id' => 'Phone',
    		'phone' => $params['phone'],
    	]);
    	CRM_Core_Session::setStatus(' Household Phone in database saved', ' Phone saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
    	CRM_Core_Session::setStatus('Error saving Household Phone in database', 'NOT Saved Phone', 'error');
    }	

    $famille['household_phone_id'] = $newHouseholdPhone['id'];


    parent::postProcess();
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
	// NOTHING TO CHANGE IN THIS FUNCTION
  	$elementNames = array();
  	foreach ($this->_elements as $element) {
  		/** @var HTML_QuickForm_Element $element */
  		$label = $element->getLabel();
  		if (!empty($label)) {
  			$elementNames[] = $element->getName();
  		}
  	}
  	return $elementNames;
  }

}
