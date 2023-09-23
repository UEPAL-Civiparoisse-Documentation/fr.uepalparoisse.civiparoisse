<?php

setlocale (LC_TIME, 'fr_FR.utf8','fra');

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Pages_Page_ConseilPresbyteral extends CRM_Core_Page {


	public function run() {
       	CRM_Utils_System::setTitle(E::ts('Composition du Conseil Presbyteral'));

	  	$TableMembreElu = civicrm_api3('RelationshipType', 'get', [
		  		'sequential' => 1,
		  		'return' => ["id"],
		  		'name_a_b' => "est_membre_elu_de",
				]);
		  	$IdMembreElu = $TableMembreElu['id'];

	  	$TableMembreDroit = civicrm_api3('RelationshipType', 'get', [
		  		'sequential' => 1,
		  		'return' => ["id"],
		  		'name_a_b' => "est_membre_de_droit_de",
				]);
		  	$IdMembreDroit = $TableMembreDroit['id'];

	  	$TableMembreInvite = civicrm_api3('RelationshipType', 'get', [
		  		'sequential' => 1,
		  		'return' => ["id"],
		  		'name_a_b' => "est_membre_invite_de",
				]);
		  	$IdMembreInvite = $TableMembreInvite['id'];


	    // Assign variables for use in a template
		$this->assign('CPBureau', $this->getBureauParoisse());
		$this->assign('CPMembreDroit', $this->getContacts($IdMembreDroit, "Membre de Droit"));
		$this->assign('CPMembreElu', $this->getContacts($IdMembreElu, "Membre Elu·e"));
		$this->assign('CPMembreInvite', $this->getInvites());
		
	    parent::run();
	}


	private function getBureauParoisse() {
    	$TablePresident = civicrm_api3('RelationshipType', 'get', [
	  		'sequential' => 1,
	  		'return' => ["id"],
	  		'name_a_b' => "est_president_de",
			]);
	  	$IdPresident = $TablePresident['id'];

	  	$TableVicePresident = civicrm_api3('RelationshipType', 'get', [
	  		'sequential' => 1,
	  		'return' => ["id"],
	  		'name_a_b' => "est_vice_president_de",
			]);
	  	$IdVicePresident = $TableVicePresident['id'];

	  	$TableSecretaire = civicrm_api3('RelationshipType', 'get', [
	  		'sequential' => 1,
	  		'return' => ["id"],
	  		'name_a_b' => "est_secretaire_de",
			]);
	  	$IdSecretaire = $TableSecretaire['id'];

	  	$TableTresorier = civicrm_api3('RelationshipType', 'get', [
	  		'sequential' => 1,
	  		'return' => ["id"],
	  		'name_a_b' => "est_tresorier_de",
			]);
	  	$IdTresorier = $TableTresorier['id'];


	  	$a = $this->getContacts($IdPresident, "Président·e");
		$b = $this->getContacts($IdVicePresident, "Vice-Président·e");
		$c = $this->getContacts($IdSecretaire, "Secrétaire");
		$d = $this->getContacts($IdTresorier, "Trésorier·ère");

		return array_merge($a, $b, $c, $d);
	}

	private function getInvites() {
    	$TableInvite = civicrm_api3('RelationshipType', 'get', [
	  		'sequential' => 1,
	  		'return' => ["id"],
	  		'name_a_b' => "est_membre_invite_de",
			]);
	  	$IdInvite = $TableInvite['id'];

	  	$TableReceveur = civicrm_api3('RelationshipType', 'get', [
	  		'sequential' => 1,
	  		'return' => ["id"],
	  		'name_a_b' => "est_receveur_de",
			]);
	  	$IdReceveur = $TableReceveur['id'];

	  	$a = $this->getContacts($IdInvite, "Membre Invité·e");
		$b = $this->getContacts($IdReceveur, "Receveur·e");
		
		return array_merge($a, $b);
	}


	private function getContacts($relIdRelation, $relNomRelation, $minRecords = 1) {
	  		$sql = "
	  		SELECT
	      		'$relNomRelation' role,
	      		CONCAT(c.last_name, ' ', c.first_name ) AS name,
	      		IFNULL(r.start_date, '/') AS start_date,
	      		IFNULL(r.end_date, '/') AS end_date,
	      		(
	        	SELECT
	          		group_concat(concat(DATE_FORMAT(ex_r.start_date, '%d/%m/%Y'), ' - ', DATE_FORMAT(ex_r.end_date, '%d/%m/%Y')) SEPARATOR '<br>')
	        	FROM
	          		civicrm_relationship AS ex_r
	        	WHERE
	          		ex_r.contact_id_a = r.contact_id_a
	        		AND ex_r.relationship_type_id = r.relationship_type_id
	        		AND ex_r.is_active = 0
	        	GROUP BY ex_r.contact_id_a
	        	ORDER BY ex_r.end_date DESC
	      		) AS ex_relationships,
	       		e.email AS email,
	      		p.phone AS phone,
	      		CONCAT(a.street_address, ', ', a.city) AS address,
	      		c.birth_date,
	      		c.id
	      	FROM civicrm_relationship AS r
			INNER JOIN civicrm_contact AS c ON r.contact_id_a = c.id AND c.is_deleted = 0
			LEFT OUTER JOIN civicrm_email AS e ON e.contact_id = c.id AND e.is_primary = 1
	      	LEFT OUTER JOIN civicrm_phone AS p ON p.contact_id = c.id AND p.is_primary = 1
			LEFT OUTER JOIN civicrm_address AS a ON a.contact_id = c.id AND a.is_primary = 1
	      	WHERE
	        	r.relationship_type_id = $relIdRelation
	        	AND r.is_active = 1
	        	# AND r.contact_id_b = {$this->paroisseId}
	      	ORDER BY c.sort_name
	  	";

	  	// store the result in an array
	    $dao = CRM_Core_DAO::executeQuery($sql);
	    $r = $dao->fetchAll();


		// see if we need to add blank records
			if (count($r) < $minRecords) {
				$numRecordsToAdd = $minRecords - count($r);
				for ($i = 0; $i <  $numRecordsToAdd; $i++) {
					$r[] = ['role' => $relNomRelation, '', '', '', '', '', '', ''];
				}
			}

	    return $r;
	}

}
