<?php

use CRM_Civiparoisse_ExtensionUtil as E;
use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaires as F;
use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividu as FI;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Civiparoisse_Formulaires_Form_FormulaireIndividu extends CRM_Core_Form {
  public function buildQuickForm() {


/////////////////////////
// Champs pour Individu /
/////////////////////////
	// Foyer ou Organisation de rattachement
  	FI::addChoixOrganisationFoyer($this);
	
	// Statut
  	FI::addStatut($this);
	
	// Lien Paroisse
  	FI::addLienParoisse($this);
	
	// Nom des parents (en cas d'enfants)
  	FI::addParents($this);
		
	// Nom des frères et soeurs
  	FI::addFreresSoeurs($this);
	
	// Civilité
  	FI::addCivilite($this);

	// Genre
  	FI::addGenre($this);

	// Prénom
  	FI::addPrenom($this);
 		
	// Nom
  	FI::addNomIndividu($this);

	// Nom de Jeune fille
  	FI::addNomNaissance($this);
 	
	// Date de naissance
  	FI::addDateNaissance($this);
 	
	// Lieu de naissance
  	FI::addLieuNaissance($this);
 		
 	// Date des obsèques
  	FI::addDateObseques($this);

 	// Paroisse des obsèques
  	FI::addParoisseObseques($this);

	// Nom Conjoint / Partenaire
  	FI::addNomConjoint($this);

	// Lien Conjoint / Partenaire
  	FI::addLienConjoint($this);
	
	// Date du mariage
  	FI::addDateMariage($this);

	// Date de la bénédiction nuptiale
  	FI::addDateBénédictionNuptiale($this);
 	
	// Paroisse de mariage
  	FI::addParoisseMariage($this);

 	// Verset de mariage
  	FI::addVersetMariage($this);
 	
	// Divorcé ?
  	FI::addDivorce($this);
	
	// Date de divorce
  	FI::addDateDivorce($this);
 
	// Date de veuvage
  	FI::addDateVeuvage($this);
 	
	// Téléphone portable
  	F::addTelephonePortable($this);
	
	// Téléphone travail
  	F::addTelephoneProfessionnel($this);
	
	// Courriel Domicile
		F::addMailPersonnel($this);

	// Courriel Travail
		F::addMailProfessionnel($this);
	
	// Métier
		FI::addMetier($this);

	// Musicien du Choeur (information non stocké dans la base, sert à l'affichage)
	$this->addYesNo('customfield8', ts('Musicien du Choeur ?'));		
	// Numéro de Sécurité Sociale
		FI::addSecuriteSociale($this);
 	
	// Numéro Guso
		FI::addGuso($this);
 	
	// Fonctionnaire?
		FI::addFonctionnaire($this);
		
	// Groupes
		FI::addGroupes($this);
		
	// Etiquettes
		F::addEtiquette($this);

	// Compétence Musique Instrument
		FI::addInstruments($this);

	// Compétence Musique Voix
		FI::addVoix($this);

	// Religion
		FI::addReligion($this);

	// Date de présentation
		FI::addDatePresentation($this);
 
	// Paroisse de présentation
		FI::addParoissePresentation($this);
		
	// Date de baptême
		FI::addDateBapteme($this);
 	
	// Paroisse de baptême
		FI::addParoisseBapteme($this);
		
	// Verset de baptême
		FI::addVersetBapteme($this);
 	
	// Date de confirmation
		FI::addDateConfirmation($this);
 		
	// Paroisse de confirmation
		FI::addParoisseConfirmation($this);
		
	// Verset de confirmation
		FI::addVersetConfirmation($this);
 		
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
		$this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateLienConjoint'));// Vérification de la saisie du Type de Relation Concubin si présence d'un nom dans le champ Nom Conjoint, ou l'inverse.
	    
		$this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateLienEnfant'));// Vérification de la saisie du nom des parents si le Statut Individu est Enfant

		$this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateLienFonctionnaire'));// Vérification de la saisie du lien Fonctionnaire si présence d'un numéro Guso
		
		$this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateCourrielIndividu'));// Vérification de la cohérence de l'adresse mail personnelle, si elle est saisie

		$this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateCourrielOrganization'));// Vérification de la cohérence de l'adresse mail professionnelle, si elle est saisie
  }


// TRAITEMENT DU FORMULAIRE
  public function postProcess() {

		$this->controller->_destination = CRM_Utils_System::url('civicrm/formulaire-individu', 'reset=1'); // Destination après validation du formulaire

	  $values = $this->exportValues(); // récupération des valeurs envoyées par le formulaire

		$ignores = array('entryURL', 'qfKey'); // suppression des valeurs inutiles dans le array
	    foreach ($values as $key => $data) {
	      if (substr($key, 0, 1) != "_" && !in_array($key, $ignores)) {
	        $params[$key] = $data; // création du tableau avec les valeurs à créer
	      }
    	}
	

///////////////////////////////////////
// CREATION DE L'INDIVIDU DANS L'API //
///////////////////////////////////////


// création de l'Individu //
////////////////////////////

			/* Récupération des ID des Custom Fields */
		$listCustomFields = array();	

		$getListCustomFields = civicrm_api3('CustomField', 'get', [
			'sequential' => 1,
			'return' => ["name"],
			'options' => ['limit' => 0],
			]); 
		
		/* transformation de la liste pour avoir le nom en premier et l'id derrière */
		for($i=0; $i<($getListCustomFields['count']);$i++) {
			$j = $getListCustomFields['values'][$i]['name'];
			$listCustomFields[$j] = 'custom_'.$getListCustomFields['values'][$i]['id'];
		} 

		/* Création du contenu pour API3 Contact (contenu de base) */
		$createIndividual = array (
			'contact_type' => "Individual",
			'prefix_id' => $params['prefix_id'],
			'gender_id' => $params['gender_id'],
			'first_name' => $params['first_name'],
			'last_name' => $params['last_name'],
			'birth_date' => $params['birth_date'],
			'job_title' => $params['job_title'],
			// Rajouter Source "Formulaire de saisie"
			); 
		/* Rajout du contenu pour API3 Contact (contenu Custom Fields) */
		$createIndividual += array(
			$listCustomFields["nom_naissance"] => $params['nom_naissance'],
			$listCustomFields["lieu_naissance"] => $params['lieu_naissance'],
			$listCustomFields["date_mariage"] => $params['date_mariage'],
			$listCustomFields["date_benediction_nuptiale"] => $params['date_benediction_nuptiale'],
			$listCustomFields["paroisse_mariage"] => $params['paroisse_mariage'],
			$listCustomFields["verset_mariage"] => $params['verset_mariage'],
			$listCustomFields["date_divorce"] => $params['date_divorce'],
			$listCustomFields["divorce"] => $params['divorce'],
			$listCustomFields["date_veuvage"] => $params['date_veuvage'],
			$listCustomFields["date_obseques"] => $params['date_obseques'],
			$listCustomFields["paroisse_enterrement"] => $params['paroisse_enterrement'],
			$listCustomFields["securite_sociale"] => $params['securite_sociale'],
			$listCustomFields["guso"] => $params['guso'],
			$listCustomFields["fonctionnaire"] => $params['fonctionnaire'],
			$listCustomFields["musique_chant"] => $params['musique_chant'],
			$listCustomFields["religion"] => $params['religion'],
			$listCustomFields["date_presentation"] => $params['date_presentation'],
			$listCustomFields["paroisse_presentation"] => $params['paroisse_presentation'],
			$listCustomFields["date_bapteme"] => $params['date_bapteme'],
			$listCustomFields["paroisse_bapteme"] => $params['paroisse_bapteme'],
			$listCustomFields["verset_bapteme"] => $params['verset_bapteme'],
			$listCustomFields["date_confirmation"] => $params['date_confirmation'],
			$listCustomFields["paroisse_confirmation"] => $params['paroisse_confirmation'],
			$listCustomFields["verset_confirmation"] => $params['verset_confirmation'],	
		); 

	/* Injection des données dans l'API */
	try {
		$newIndividual = civicrm_api3('Contact', 'create', $createIndividual);
		CRM_Core_Session::setStatus(' Individual in database saved', ' Individual saved', 'success');
		}
	catch (CiviCRM_API3_Exception $ex) {
    CRM_Core_Session::setStatus('Error saving Individual in database', 'NOT Saved Individual', 'error');
			}	

	/* Récupération du nouveau numéro ID pour utilisation dans les autres API */
	$newIndividual_id = $newIndividual['id'];

  /* Détermination du type d'entité d'appartenance (pour gérer les relations) */
	$entiteAppartenance = \Civi\Api4\Contact::get()
 		->addWhere('id', '=', $params['entity_link'])
 	  ->execute();

	/* Récupération des données Adresse de l'entité de rattachement (Foyer ou Entreprise/Organisation) */
	$addressEntiteRattachement = \Civi\Api4\Address::get()
	  ->addWhere('contact_id', '=', $params['entity_link'])
  	->execute();

// création de l'adresse de l'Individu //
/////////////////////////////////////////

	try {
		$newIndividualAdress = \Civi\Api4\Address::create()
			->addValue('contact_id', $newIndividual_id)
			->addValue('master_id', $addressEntiteRattachement->first()['id'])
			->addValue('street_address', $addressEntiteRattachement->first()['street_address'])
			->addValue('supplemental_address_1', $addressEntiteRattachement->first()['supplemental_address_1'])
			->addValue('supplemental_address_2', $addressEntiteRattachement->first()['supplemental_address_2'])
			->addValue('postal_code', $addressEntiteRattachement->first()['postal_code'])
			->addValue('city', $addressEntiteRattachement->first()['city'])
			->addValue('state_province_id', $addressEntiteRattachement->first()['state_province_id'])
			->addValue('country_id', $addressEntiteRattachement->first()['country_id'])
			->addValue('location_type_id', $addressEntiteRattachement->first()['location_type_id'])
			->addValue('is_primary', 1)
			->execute();

		CRM_Core_Session::setStatus(' Individual adresse in database saved', ' Adresse saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Individual adresse in database', 'NOT Saved Adresse', 'error');
    }	


// création du téléphone portable de l'Individu //
//////////////////////////////////////////////////
	
	if(!empty($params['phone_mobile'])) {
    try {
      $newIndividualMobilePhone = civicrm_api3('Phone', 'create', [
        'contact_id' => $newIndividual_id,
        'phone' => $params['phone_mobile'], 
        'is_primary' => 1,
        'location_type_id' => $localisationAdresseEntite,
        'phone_type_id' => 'Mobile',
      ]);
      CRM_Core_Session::setStatus(' Individual Mobile Phone in database saved', ' Phone saved', 'success');
    }
    catch (CiviCRM_API3_Exception $ex) {
      CRM_Core_Session::setStatus('Error saving Individual mobile phone in database', 'NOT Saved Phone', 'error');
    }	
  }

	// création du téléphone professionel de l'Individu //
	//////////////////////////////////////////////////////
		
		if(!empty($params['phone_work'])) {
			try {
				$newIndividualWorkPhone = civicrm_api3('Phone', 'create', [
					'contact_id' => $newIndividual_id,
					'phone' => $params['phone_work'], 
					'is_primary' => 0,
					'location_type_id' => 'Travail',
					'phone_type_id' => 'Phone',
				]);
				CRM_Core_Session::setStatus(' Individual Work Phone in database saved', ' Phone saved', 'success');
			}
			catch (CiviCRM_API3_Exception $ex) {
			  CRM_Core_Session::setStatus('Error saving Individual Work phone in database', 'NOT Saved Phone', 'error');
			}	
		}

	// création du courriel privé de l'Individu //
	//////////////////////////////////////////////
		
		if (!empty($params['email_home'])) {
			try {
				$newIndividualHomeMail = civicrm_api3('Email', 'create', [
					'contact_id' => $newIndividual_id,
					'email' => $params['email_home'], 
					'is_primary' => 1,
					'location_type_id' => 'Domicile',
				]);
				CRM_Core_Session::setStatus(' Individual Home Mail in database saved', ' Mail saved', 'success');
			}
			catch (CiviCRM_API3_Exception $ex) {
			  CRM_Core_Session::setStatus('Error saving Individual Home Mail in database', 'NOT Saved Mail', 'error');
			}
		}		


	// création du courriel professionnel de l'Individu //
	//////////////////////////////////////////////////////
		
		if (!empty($params['email_work'])) {
			try {
				$newIndividualHomeWork = civicrm_api3('Email', 'create', [
					'contact_id' => $newIndividual_id,
					'email' => $params['email_work'], 
					'is_primary' => 0,
					'location_type_id' => 'Travail',
				]);
				CRM_Core_Session::setStatus(' Individual Work Mail in database saved', ' Mail saved', 'success');
			}
			catch (CiviCRM_API3_Exception $ex) {
			  CRM_Core_Session::setStatus('Error saving Individual Work Mail in database', 'NOT Saved Mail', 'error');
			}
		}

	// création des instruments de musique //
	/////////////////////////////////////////
		if (!empty($params['musique_instrument'])){
			$getInstruments = explode( ',', $params['musique_instrument']);
			
				$idInputMusique = $listCustomFields["musique_instrument"];
			
			/* Création de l'instrument */
			$setInstrument = civicrm_api3('Contact', 'create', [
				'id' => $newIndividual_id,
				$idInputMusique => $getInstruments,
				]);
		}

	// création des groupes de l'individu //
	////////////////////////////////////////	
		if (!empty($params['groups'])) {
		
			$getoptionsGroups = explode( ',', $params['groups']);
			
			try {
				$newIndividualGroups = civicrm_api3('GroupContact', 'create', [
					'contact_id' => $newIndividual_id,
					'group_id' => $getoptionsGroups,
					]);
				CRM_Core_Session::setStatus('Groups in database saved', 'Groups saved', 'success');
			}
			catch (CiviCRM_API3_Exception $ex) {
			  CRM_Core_Session::setStatus('Error saving Groups in database', 'NOT Saved Groups', 'error');
			}
		}

	// création des etiquettes de l'individu //
	///////////////////////////////////////////
		if (!empty($params['tags'])) {
		
			$getoptionsTags = explode( ',', $params['tags']);
			
			try {
				$newIndividualTags = civicrm_api3('EntityTag', 'create', [
					'entity_table' => 'civicrm_contact',
					'entity_id' => $newIndividual_id,
					'tag_id' => $getoptionsTags,
					]);
				CRM_Core_Session::setStatus('Tags in database saved', 'Tags saved', 'success');
			}
			catch (CiviCRM_API3_Exception $ex) {
			  CRM_Core_Session::setStatus('Error saving Tags in database', 'NOT Saved Tags', 'error');
			}
		}

	// création de l'adhésion de l'individu //
	//////////////////////////////////////////
		try {
			$newIndividualMembership = civicrm_api3('Membership', 'create', [
				'contact_id' => $newIndividual_id,
				'membership_type_id' => $params['membership'], 
			]);
			CRM_Core_Session::setStatus('Membership in database saved', ' Membership saved', 'success'); 
	    }
	    catch (CiviCRM_API3_Exception $ex) {
	      CRM_Core_Session::setStatus('Error saving Membership in database', 'NOT Saved Membership', 'error'); 
	    }	

	// création des relations de l'individu //
	//////////////////////////////////////////

		/* Récupération des ID des relations*/
		$getListRelationTypes = civicrm_api3('RelationshipType', 'get', [
			'return' => ["name_a_b"],
			'options' => ['limit' => 0],
		]);

		/* transformation de la liste pour avoir le nom en premier et l'id derrière */
		for($i=0; $i<($getListRelationTypes['count']);$i++) {
			if (!empty($getListRelationTypes['values'][$i])) {
				$j = $getListRelationTypes['values'][$i]['name_a_b'];
				$listRelationTypes[$j] = $getListRelationTypes['values'][$i]['id'];
			}
		} 
		
		/* Mise en place des relations pour les adultes */
		if($params['statutIndividu'] == 'adulte'){

			switch ($entiteAppartenance->first()['contact_type']) {
				
				case 'Household':
					/* Relation Chef de Foyer*/
					$typeRelationEntite = $listRelationTypes['Head of Household for'];

					$setRelationshipChefFoyer = civicrm_api3('Relationship', 'create', [
						'contact_id_a' => $newIndividual_id,
						'contact_id_b' => $params['entity_link'],
						'relationship_type_id' => $typeRelationEntite,
					]);

					break;  // Household

				case 'Organization':
					/* Relation Employeur - Employé */			
					$setRelationshipEmployeur = civicrm_api3('Contact', 'create', [
						'contact_type' => "Individual",
						'id' => $newIndividual_id,
						'employer_id' => $params['entity_link'],
					]);	

					break; // Organisation

				default:
					$typeRelationEntite = $listRelationTypes['Head of Household for'];
					
					$setRelationshipChefFoyer = civicrm_api3('Relationship', 'create', [
						'contact_id_a' => $newIndividual_id,
						'contact_id_b' => $params['entity_link'],
						'relationship_type_id' => $typeRelationEntite,
					]);

					break;  // Household (par défaut si besoin)
			}

			/* Détermination de la Relation Conjoint */
			if (!empty($params['relationConjoint'])) {
			
				switch ($params['relationConjoint']){
					case "conjoint":
						$flagRelationTypeConjoint = $listRelationTypes['Spouse of'];
						break;
					case "partenaire":
						$flagRelationTypeConjoint = $listRelationTypes['Partner of'];
						break;
					default:
						break;
				}		
				/* Relation au Conjoint */
				$setRelationshipConjoint = civicrm_api3('Relationship', 'create', [
					'contact_id_a' => $newIndividual_id,
					'contact_id_b' => $params['nom_conjoint'],
					'relationship_type_id' => $flagRelationTypeConjoint,
				]);		
			}
		}
		/* Mise en place des relations pour les enfants */
		elseif($params['statutIndividu'] == 'enfant') {
			/* Relation Enfants de / Parents de */
			$getIdParent = explode( ',', $params['parents']);
			foreach ($getIdParent as $id_b_parent) {
				$setRelationshipParents = civicrm_api3('Relationship', 'create', [
					'contact_id_a' => $newIndividual_id,
					'contact_id_b' => $id_b_parent,
					'relationship_type_id' => $listRelationTypes['Child of'],
				]);
			}
			
			/* Relation Freres/Soeurs de*/
			if (!empty($params['freres_soeurs'])){
				$getIdFreresSoeurs = explode( ',', $params['freres_soeurs']);
				foreach ($getIdFreresSoeurs as $id_b_freres_soeurs) {
					$setRelationshipFreresSoeurs = civicrm_api3('Relationship', 'create', [
						'contact_id_a' => $newIndividual_id,
						'contact_id_b' => $id_b_freres_soeurs,
						'relationship_type_id' => $listRelationTypes['Sibling of'],
					]);
				}
			}
			
		}
	

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
	// RIEN A CHANGER DANS CETTE FUNCTION
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
