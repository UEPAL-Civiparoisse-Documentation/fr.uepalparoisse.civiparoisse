<?php

use CRM_Civiparoisse_ExtensionUtil as E;

/**
 * 
 */
class CRM_Civiparoisse_Formulaires_Form_ChampsFormulaires {

// Default constructor pour ne pas permettre une instanciation de la classe depuis l'extérieur
	protected function __construct() {
	}
	
/**
 * Function addNomFoyer, appelée par le Formulaire Foyer
 * Permet de renseigner
 * 	le nom du Foyer
 * 
 * @param CRM_Core_Form $form 
 * @access public
 * @return void
 * 
 */ 
	public static function addNomFoyer(CRM_Core_Form $form) {
		$form->add(
			'text',
			'household_name',
			ts('Nom du foyer'),
			TRUE);
	}
	
/**
 * Function addNomOrganisation, appelée par le Formulaire Organisation
 * Permet de renseigner
 * 	le nom de l'Entreprise ou de l'Organisation
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 	
	public static function addNameOrganisation(CRM_Core_Form $form) {
    	$form->add(
			'text',
			'organization_name',
			ts('Nom de l\'entreprise ou organisation'),
			TRUE);
	}

/**
 * Function addAdresse, appelée par le Formulaire Foyer et le Formulaire Organisation
 * Permet de renseigner
 * 	l'adresse (en 3 lignes)
 * 	le code Postal
 * 	la ville
 * 	le département
 * 	le pays
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addAdresse(CRM_Core_Form $form) {
	// Adresses
		$form->add(
			'text',
			'street_address',
			ts('Adresse ligne 1'));

		$form->add(
			'text',
			'supplemental_address_1',
			ts('Adresse ligne 2'));

		$form->add(
			'text',
			'supplemental_address_2',
			ts('Adresse ligne 3'));

	// Code Postal
		$form->add(
			'text',
			'postal_code',
			ts('Code Postal'));

	// Ville
		$form->add(
			'text',
			'city',
			ts('Ville'));

	//Departement
		$stateProvince = array('' => ts('- any state/province -')) + CRM_Core_PseudoConstant::stateProvince( );
		$form->add(
			'select',
			'state_province_id',
			ts('Departement'),
			$stateProvince);

	//Pays
		$country = array('' => ts('- any country -')) + CRM_Core_PseudoConstant::country( );
		$form->add(
			'select',
			'country_id',
			ts('Pays'),
			$country);
	}

/**
 * Function addTelephoneFixe, appelée par le Formulaire Foyer et Organisation
 * Permet de renseigner
 * 	le numéro de téléphone Fixe (privé ou professionnel selon le formulaire)
 * 
 * @param string	$telephoneType	Texte indiquant le côté privé ou professionnel
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addTelephoneFixe(CRM_Core_Form $form, $telephoneType) {
		$form->add(
			'text',
			'phone',
			ts($telephoneType)
		);
	}

/**
 * Function addTelephonePortable, appelée par le Formulaire Individu
 * Permet de renseigner
 * 	le numéro de téléphone Portable
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addTelephonePortable(CRM_Core_Form $form) {
		$form->add(
			'text',
			'phone_mobile',
			ts('Téléphone Portable Personnel')
		);
	}

/**
 * Function addTelephoneProfessionnel, appelée par le Formulaire Individu
 * Permet de renseigner
 * 	le numéro de téléphone Professionnel
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addTelephoneProfessionnel(CRM_Core_Form $form) {
		$form->add(
			'text',
			'phone_work',
			ts('Téléphone Professionnel')
		);
	}

/**
 * Function addFax, appelée par le Formulaire Organisation
 * Permet de renseigner
 * 	le numéro de fax de l'entreprise
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addFax(CRM_Core_Form $form) {
		$form->add(
			'text',
			'fax',
			ts('Fax Professionnel')
		);
	}

/**
 * Function addMailPersonnel, appelée par le Formulaire Individu 
 * Permet de renseigner
 * 	le mail personnel
 *
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 *   
 */ 
	public static function addMailPersonnel(CRM_Core_Form $form) {
		$form->add(
			'text',
			'email_home',
			ts('Courriel Personnel'));
	}

/**
 * Function addMailProfessionnel, appelée par le Formulaire Individu et le Formulaire Entreprise
 * Permet de renseigner
 * 	le mail professionnel
 *
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 *   
 */ 
	public static function addMailProfessionnel(CRM_Core_Form $form) {
		$form->add(
			'text',
			'email_work',
			ts('Courriel Professionnel'));
	}

/**
 * Function addWebsite, appelée par le Formulaire Entreprise
 * Permet de renseigner
 * 	le site Internet professionnel
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addWebsite(CRM_Core_Form $form) {
		$form->add(
			'text',
			'web_site',
			ts('Site Internet'));
	}

/**
 * Function addEtiquette, appelée par le Formulaire Entreprise et le formulaire Individu
 * Permet de renseigner
 * 	les Etiquettes (tags)
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addEtiquette(CRM_Core_Form $form) {
		$form->addEntityRef(
			'tags',
			ts('Etiquette(s)'),
			[
				'entity' => 'tag',
				'select' => ['minimumInputLength' => 0],
				'multiple' => TRUE,
			]);	
	}

/**
 * Bloc Quartier, appelée par le Formulaire Foyer 
 * Permet de renseigner
 * 	le quartier (distribution, visiteurs, ...)
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addQuartier(CRM_Core_Form $form) {
		$form->addEntityRef(
			'quartier',
			ts('Quartier (distribution, visiteurs, ...)'),
			['entity' => 'option_value',
			'api' => [
				'params' => ['option_group_id' => 'quartier'],
			],
			'select' => ['minimumInputLength' => 0],
		]);
	}

/**
 * Bloc ModeDistribution, appelée par le Formulaire Foyer 
 * Permet de renseigner
 * 	le mode de distribution du journal
 * 
 * @param CRM_Core_Form $form
 * @access public
 * @return void
 * 
 */ 
	public static function addModeDistribution(CRM_Core_Form $form) {
		$form->addEntityRef(
			'mode_distribution',
			ts('Mode de distribution du journal'),
			['entity' => 'option_value',
			'api' => [
				'params' => ['option_group_id' => 'mode_distribution'],
			],
			'select' => ['minimumInputLength' => 0],
		]);
	}


}


