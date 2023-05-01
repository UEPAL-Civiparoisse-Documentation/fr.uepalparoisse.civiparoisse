<?php
use Civi\Api4\Generic\Result;

abstract class CRM_Civiparoisse_SavedSearch_BaseParameter {
	
	/**
	* @return string name
	*/
	
	abstract public function getName(): string;

/**
	* Récupérer les paramètres de la recherche
	* @param 	string 	$name 	Name of the search
	* @return 	array	$params Parameters for the creation of the search
	*/

	abstract public function getParametersSearch (string $name):array;
	
	abstract public function getParametersDisplay (string $nameDisplay, int $searchId): array;
	
	protected function createSavedSearch(): Result
	{
		$name = $this->getName();
		
		$params = $this->getParametersSearch($name);
        $params['checkPermissions']=FALSE;
		return CRM_Civiparoisse_SavedSearch_SearchKitCreation::createSavedSearch($params);
	} 
	
	protected function createSavedDisplay(): Result
	{
		$name = $this->getName();
		$nameDisplay = $this->getNameDisplay();
		$searchId = CRM_Civiparoisse_SavedSearch_SearchKitCreation::findSearchId($name);
		$params = $this->getParametersDisplay($nameDisplay,$searchId);
        $params['checkPermissions']=FALSE;
		return CRM_Civiparoisse_SavedSearch_SearchKitCreation::createSearchDisplay($params);
	}

	/**
	* @return string displayName
	*/
	
	public function getNameDisplay(): string
	{
		return $this->getName().'_Table';
	}
	
	public function installSaveSearchAndDisplay()
	{        
			$this->createSavedSearch();
			$this->createSavedDisplay();
	}
}