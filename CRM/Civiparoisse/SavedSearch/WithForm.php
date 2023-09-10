<?php

abstract class CRM_Civiparoisse_SavedSearch_WithForm extends CRM_Civiparoisse_SavedSearch_BaseParameter
{
    /**
     * get AFForm Parameters
     * @return array
     */
    abstract protected function getParametersForms(): array;

    /**
     * getAFForm Name
     * @return string
     */
    abstract public function getNameForm(): string;

    /**
     * create AFForm for savedSeaarch
     * @return void
     */
    public function createSavedForm()
    {
        // récupération des paramètres du Mapping
        /** @var array $formsParameters Liste des paramètres pour créer le Formulaire */
        $formsParameters = $this->getParametersForms();

        // création du Formulaire
        /** @var array $resultForm Envoi vers la fonction createFormulaire pour créer le formulaire */
        CRM_Civiparoisse_Formulaires_Config_ConfigForms::createFormulaire($formsParameters);

    }
}
