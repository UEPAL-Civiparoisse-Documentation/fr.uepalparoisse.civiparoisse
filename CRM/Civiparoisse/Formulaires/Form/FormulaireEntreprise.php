<?php

use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaires as F;
use CRM_Civiparoisse_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Civiparoisse_Formulaires_Form_FormulaireEntreprise extends CRM_Core_Form
{
    public function buildQuickForm()
    {

        CRM_Utils_System::setTitle(E::ts('Formulaire de création d\'une Organisation ou Entreprise'));

        // NomOrganisation
        F::addNameOrganisation($this);

        // BlocAdresse
        F::addAdresse($this);

        // TelephoneFixe (Professionnel)
        $varType = 'Téléphone Fixe Professionnel';
        F::addTelephoneFixe($this, $varType);

        // Fax
        F::addFax($this);

        // MailProfessionnel
        F::addMailProfessionnel($this);

        // Site Internet
        F::addWebsite($this);


        // Etiquettes
        F::addEtiquette($this);


        // Secteur d'activité. A rajouter en lot ultérieur ?


        // Bouton Envoyer
        $this->addButtons(array(
            array(
                'type' => 'submit',
                'name' => E::ts('Save'),
                'isDefault' => true,
            ),
        ));

        // export form elements
        $this->assign('elementNames', $this->getRenderableElementNames());
        parent::buildQuickForm();
    }

// REGLES DE VERIFICATION

    /**
     * Function to add validation condition rules (overrides parent function)
     *
     * @param void
     *
     * @access public
     *
     * @return void
     */
    public function addRules()
    {
        // Vérification de la saisie du nom de l'Entreprise ou de l'Organisation.
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateNomOrganization'));
        // Vérification de la saisie de la ville de l'Entreprise ou Organisation
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateVille'));
        // Vérification de la saisie du courriel de l'Entreprise ou Organisation
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateCourrielOrganization'));
        // Vérification de la saisie de l'adresse du site Internet de l'Entreprise ou Organisation
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateWebsite'));
    }

    protected function createOrganisation(array $params): ?int
    {
        $newOrganizationId = null;
        /* Création de l'Entreprise dans l'API */
        if (!empty($params['organization_name'])) {
            try {

                $newOrganization = \Civi\Api4\Contact::create()
                    ->addValue('contact_type:name', 'Organization')
                    ->addValue('organization_name', $params['organization_name'])
                    ->execute();

                CRM_Core_Session::setStatus(' Organization in database saved', 'Organization saved', 'success');

                $newOrganizationId = $newOrganization->first()['id']; // Pour utilisation dans les API suivantes
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Organization in database', 'NOT Saved Organization', 'error');
            }
        }
        return $newOrganizationId;
    }

    protected function createOrganizationAddr(int $newOrganizationId, array $params): void
    {
        // création de l'adresse de l'Organisation //
        /////////////////////////////////////////////

        if (!empty($params['city'])) {
            try {
                civicrm_api3('Address', 'create', [
                    'contact_id' => $newOrganizationId,
                    'location_type_id' => 'Travail',
                    'is_primary' => 1,
                    'street_address' => $params['street_address'],
                    'supplemental_address_1' => $params['supplemental_address_1'],
                    'supplemental_address_2' => $params['supplemental_address_2'],
                    'postal_code' => $params['postal_code'],
                    'city' => $params['city'],
                    'state_province_id' => $params['state_province_id'],
                    'country_id' => $params['country_id'],
                ]);
                CRM_Core_Session::setStatus(' Organization adresse in database saved', 'Adresse saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus(
                    'Error saving Organization adresse in database',
                    'NOT Saved Adresse',
                    'error');
            }
        }

    }

    protected function createOrganizationPhone(int $newOrganizationId, array $params): void
    {
        // création du téléphone fixe de l'Organisation //
        //////////////////////////////////////////////////

        if (!empty($params['phone'])) {
            try {
                civicrm_api3('Phone', 'create', [
                    'contact_id' => $newOrganizationId,
                    'location_type_id' => 'Travail',
                    'is_primary' => 1,
                    'phone_type_id' => 'Phone',
                    'phone' => $params['phone'],
                ]);
                CRM_Core_Session::setStatus(' Organization Phone in database saved', 'Phone saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Organization Phone in database', 'NOT Saved Phone', 'error');
            }
        }
    }

    protected function createOrganizationFax(int $newOrganizationId, array $params): void
    {
        // création du fax de l'Organisation //
        ///////////////////////////////////////

        if (!empty($params['fax'])) {
            try {
                civicrm_api3('Phone', 'create', [
                    'contact_id' => $newOrganizationId,
                    'location_type_id' => 'Travail',
                    'phone_type_id' => 'Fax',
                    'phone' => $params['fax'],
                ]);
                CRM_Core_Session::setStatus(' Organization Fax in database saved', 'Fax saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Organization Fax in database', 'NOT Saved Fax', 'error');
            }
        }
    }

    protected function createOrganizationEmailWork(int $newOrganizationId, array $params): void
    {
        // création du courriel générique de l'Organisation //
        //////////////////////////////////////////////////////

        if (!empty($params['email_work'])) {
            try {
                civicrm_api3('Email', 'create', [
                    'contact_id' => $newOrganizationId,
                    'email' => $params['email_work'],
                    'is_primary' => 1,
                    'location_type_id' => 'Travail',
                ]);
                CRM_Core_Session::setStatus(' Organization Contact Mail in database saved', 'Mail saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus(
                    'Error saving Organization Contact Mail in database',
                    'NOT Saved Mail',
                    'error');
            }
        }
    }

    protected function createOrganizationInternetSite(int $newOrganizationId, array $params): void
    {
        // création du site Internet  de l'Organisation //
        //////////////////////////////////////////////////

        if (!empty($params['web_site'])) {
            try {
                civicrm_api3('Website', 'create', [
                    'contact_id' => $newOrganizationId,
                    'url' => $params['web_site'],
                    'is_primary' => 1,
                    'website_type_id' => 'Work', // travail
                ]);
                CRM_Core_Session::setStatus(' Organization Website in database saved', 'Website saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus(
                    'Error saving Organization Website in database',
                    'NOT Saved Website',
                    'error');
            }
        }
    }

    protected function createOrganizationTags(int $newOrganizationId, array $params): void
    {
        // création des etiquettes de l'Organisation //
        ///////////////////////////////////////////////
        if (!empty($params['tags'])) {

            $getoptionsTags = explode(',', $params['tags']);

            try {
                civicrm_api3('EntityTag', 'create', [
                    'entity_table' => 'civicrm_contact',
                    'entity_id' => $newOrganizationId,
                    'tag_id' => $getoptionsTags,
                ]);
                CRM_Core_Session::setStatus('Tags in database saved', 'Tags saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Tags in database', 'NOT Saved Tags', 'error');
            }
        }
    }

// TRAITEMENT DU FORMULAIRE

    public function postProcess()
    {
        // Destination après validation du formulaire
        $this->controller->_destination = CRM_Utils_System::url('civicrm/formulaire-individu', 'reset=1');

        $values = $this->exportValues(); // récupération des valeurs envoyés par le formulaire

        $params = array(); // initialisation de la variable

        $ignores = array('entryURL', 'qfKey'); // suppression des valeurs inutiles dans le array
        foreach ($values as $key => $data) {
            if (substr($key, 0, 1) != "_" && !in_array($key, $ignores)) {
                $params[$key] = $data; // création du tableau avec les valeurs à créer
            }
        }

        // création de l'Entreprise //
        //////////////////////////////

        $newOrganizationId = $this->createOrganisation($params);
        if (is_numeric($newOrganizationId)) {
            $this->createOrganizationAddr($newOrganizationId, $params);
            $this->createOrganizationPhone($newOrganizationId, $params);
            $this->createOrganizationFax($newOrganizationId, $params);
            $this->createOrganizationInternetSite($newOrganizationId, $params);
            $this->createOrganizationEmailWork($newOrganizationId, $params);
            $this->createOrganizationTags($newOrganizationId, $params);
        }
        parent::postProcess();
    }

    /**
     * Get the fields/elements defined in this form.
     *
     * @return array (string)
     */
    public function getRenderableElementNames()
    {
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
