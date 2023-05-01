<?php

class CRM_Civiparoisse_Qualitebase_Config_Parameters_IndividusSansMembre extends CRM_Civiparoisse_SavedSearch_BaseParameter {
const NAME='Individus_Sans_Membre';

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
       return self::NAME;
    }

    /**
   * Create la recherche Individus sans Statut Membre
   * @param 	string 	$name 	Name of the search
   * @return 	array	$params Parameters for the creation of the search
   */
  public function getParametersSearch(string $name): array {
    
		return [
			'values' => [
				'name'=> $name,
				'label' => 'Individus Sans statut Membre',
				'form_values' => null,
				'mapping_id' => null,
				'search_custom_id' => null,
				'description' => 'Recherches des Individus sans staut Membre',
				'api_entity' => 'Contact',
				'api_params'=> [
					'version' => 4,
					'select' => [
						'id',
						'Contact_Membership_contact_id_01.membership_type_id:label',
						'display_name'
					],
					'orderBy' => [],
					'where' =>[
						[
							'contact_type:name',
							'=',
							'Individual'
						],
						[
							'Contact_Membership_contact_id_01.membership_type_id:name',
							'IS EMPTY'
						],
						[
							'is_deceased',
							'=',
							false
						],
						[
							'is_deleted',
							'=',
							false
						]
					],
					'groupBy' => [],
					'join' => [
						[
							'Membership AS Contact_Membership_contact_id_01',
							'LEFT',
							[
								'id',
								'=',
								'Contact_Membership_contact_id_01.contact_id'
							],
        		],
					],
					'having' => [],
				],
			],
		];
	}

 /**
   * Create le Display Individus sans statut Membre sous forme de Table
   * @param 	string	$name 		Name of the search
   * @param 	int		$searchId Number of the associated search
   * @return 	array	$params 	Parameters for the creation of the display
   */
	public function getParametersDisplay(string $nameDisplay,int $searchId) :array {

		return [
			'values' => [
				'name'=> $nameDisplay,
	    	'label' => 'Individus Sans staut Membre Table',
				'saved_search_id' => $searchId,
	    	'type' => 'table',
				'acl_bypass' => false,
	    	'settings'=> [
	     			'actions' => true,
	     			'limit' => 50,
	     			'classes' => [
	     				'table',
	     				'table-striped',
	     				'table-bordered'
	     			],
	     			'pager' => [
	     				'show_count' => true,
	     				'expose_limit' => true
	     			],
	     			'columns' => [
	     				[
	     					'type' => 'field',
	     					'key' => 'id',
	     					'dataType' => 'Integer',
	     					'label' => 'Identifiant de contact',
	     					'sortable' => true
	     				],
	     				[
	     					'type' => 'field',
								'key' => 'Contact_Membership_contact_id_01.membership_type_id:label',
								'dataType' => 'Integer',
								'label' => 'Contact Adhésions: Type de membre',
								'sortable' => true,
								'editable' => true
	     				],
	     				[
	     					'type' => 'field',
	     					'key' => 'display_name',
	     					'dataType' => 'String',
	     					'label' => 'Nom affich\u00e9',
	     					'sortable' => true,
	     					'link' => [
	     						'path' => '',
	     						'entity' => 'Contact',
	     						'action' => 'view',
	     						'join' => '',
	     						'target' => '_blank'
     							],
     						'title' => 'Voir Contact'
     					],
     				],				
	     		],
				]
			];

	}







}

