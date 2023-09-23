<?php

setlocale (LC_TIME, 'fr_FR.utf8','fra');

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Qualitebase_Page_AmeliorationQualiteParoisse extends CRM_Core_Page {

	public function run() {
		// Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
		CRM_Utils_System::setTitle(E::ts('Améliorations des données de la base (Paroisses)'));

		// Assign variables for use in a template
		// Fiches Individus
		$this->assign('IndividuSansBirthday', $this->getIndividuSansBirthdayTable());
		
		
		// Fiches Foyers
		$this->assign('FoyerSansAdresse', $this->getFoyerSansAdresse());
		$this->assign('FoyerEvenement', $this->getFoyerEvenementTable());
		$this->assign('FoyerDistributionInconnu', $this->getFoyerDistributionInconnuTable());


		// Fiches Organisations
		$this->assign('OrganisationEvenement', $this->getOrganisationEvenementTable());
		$this->assign('OrganisationSansAdresse', $this->getOrganisationSansAdresse());
		$this->assign('OrganisationSansRelation', $this->getOrganisationSansRelation());		

		
		parent::run();
	}

///////////////
// INDIVIDUS //
///////////////

/**
 * Recherche des Individus n'ayant pas de Date de naissance
 * 
 * @return array Résultat de la requête
 */
	private function getIndividuSansBirthdayTable() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];

		$sql = "
			SELECT 
				c.id,
				c.display_name
			FROM 
				civicrm_contact AS c
			WHERE (( 
				(c.contact_type = 'Individual')
				AND (c.is_deceased = '0')
				AND (c.is_deleted = '0')
				AND (c.birth_date IS NULL)
				))
			ORDER BY c.created_date DESC
		";

		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name];
		}
		
		return $t;
	}




////////////
// FOYERS //
////////////

/**
 * Recherche des Foyers n'ayant pas d'adresses
 * 
 * @return array Résultat de la requête
 */
	private function getFoyerSansAdresse() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name
		FROM civicrm_contact AS c
		LEFT OUTER JOIN civicrm_address AS a ON c.id = a.contact_id
		WHERE 
			c.contact_type = 'Household'
			AND c.is_deleted = 0
			AND a.contact_id IS NULL
		";
		
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name];
		}
		
		return $t;
	}

/**
 * Recherche des Foyers n'ayant pas de relation
 * 
 * @return array Résultat de la requête
 */
	private function getFoyerSansRelation() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name
		FROM civicrm_contact AS c
		LEFT JOIN civicrm_relationship AS r_B ON c.id = r_B.contact_id_b 
		WHERE 
			(r_B.contact_id_b IS NULL OR r_B.relationship_type_id NOT IN ('7', '8'))
			AND c.contact_type = 'Household'
			AND c.is_deleted = 0
		";
		
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name];
		}
		
		return $t;
	}

/**
 * Recherche des Foyers ayant participée à un Evenement
 * 
 * @return array Résultat de la requête
 */
	private function getFoyerEvenementTable() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name, nom de l'événement */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name,
			e.title
		FROM civicrm_contact AS c
		LEFT JOIN civicrm_participant AS p ON c.id = p.contact_id
		LEFT JOIN civicrm_event AS e ON p.event_id = e.id
		WHERE 
			c.contact_type = 'Household'
			AND c.is_deleted = 0
			AND p.event_id IS NOT NULL
		";
	
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name, $dao->title];
		}
		
		return $t;
	}

/**
 * Recherche des Foyers dont le mode de distribution est indiqué Inconnu
 * 
 * @return array Résultat de la requête
 */
	private function getFoyerDistributionInconnuTable() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name, nom de l'événement */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name
           		
		FROM civicrm_contact AS c
		
		INNER JOIN  civicrm_value_complements_foyer AS cf
		ON c.id = cf.entity_id
		
		WHERE 
			c.contact_type = 'Household'
			AND c.is_deleted = 0
            AND cf.mode_distribution = 
            	(SELECT value 
            	FROM civicrm_option_value AS cv
            	WHERE (cv.name = 'Inconnu'
            		AND (cv.option_group_id = (SELECT id FROM civicrm_option_group WHERE name = 'mode_distribution'))
            	))   			
		";
	
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name];
		}
		
		return $t;
	}



///////////////////
// ORGANISATIONS //
///////////////////


// Deux à travailler

/**
 * Recherche des Organisations n'ayant pas d'adresses
 * 
 * @return array Résultat de la requête
 */
	private function getOrganisationSansAdresse() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name
		FROM civicrm_contact AS c
		LEFT OUTER JOIN civicrm_address AS a ON c.id = a.contact_id
		WHERE 
			c.contact_type = 'Organization'
			AND c.is_deleted = 0
			AND a.contact_id IS NULL
		";
		
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name];
		}
		
		return $t;
	}

/**
 * Recherche des Organisations n'ayant pas de relation
 * 
 * @return array Résultat de la requête
 */
	private function getOrganisationSansRelation() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name
		FROM civicrm_contact AS c
		LEFT JOIN civicrm_relationship AS r_B ON c.id = r_B.contact_id_b 
		WHERE 
			(r_B.contact_id_b IS NULL)
			AND c.contact_type = 'Organization'
			AND c.is_deleted = 0
		";
		
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name];
		}
		
		return $t;
	}



/**
 * Recherche des Organisations ayant participée à un Evenement
 * 
 * @return array Résultat de la requête
 */
	private function getOrganisationEvenementTable() {
	/** @var array  $t  	Sélection des informations à restituer : id, display_name, nom de l'événement */
	/** @var string $sql	Requête SQL */
	/** @var string $dao 	Conversion de la requête SQL */

		$t = [];
		
		$sql = "
		SELECT 
			c.id,
			c.display_name,
			e.title
		FROM civicrm_contact AS c
		LEFT JOIN civicrm_participant AS p ON c.id = p.contact_id
		LEFT JOIN civicrm_event AS e ON p.event_id = e.id
		WHERE 
			c.contact_type = 'Organization'
			AND c.is_deleted = 0
			AND p.event_id IS NOT NULL
		";
	
		$dao = CRM_Core_DAO::executeQuery($sql);
		
		while ($dao->fetch()) {
			$t[] = [$dao->id, $dao->display_name, $dao->title];
		}
		
		return $t;
	}



}
