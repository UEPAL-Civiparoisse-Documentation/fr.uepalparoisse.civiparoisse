<?php

use CRM_Civiparoisse_ExtensionUtil as E;
use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaires as F;
use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividu as FI;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Civiparoisse_Formulaires_Form_FormulaireIndividu extends CRM_Core_Form
{

    public function buildQuickForm()
    {

        CRM_Utils_System::setTitle(E::ts('Formulaire de création d\'un Individu / d\'un Particulier'));

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
        FI::addDateBenedictionNuptiale($this);

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
                'isDefault' => true,
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
    public function addRules()
    {
        // Vérification de la saisie du nom de famille
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateNomIndividu'));
        // Vérification de la saisie du Type de Relation Concubin si présence d'un nom
        // dans le champ Nom Conjoint, ou l'inverse.
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateLienConjoint'));
        // Vérification de la saisie du nom des parents si le Statut Individu est Enfant
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateLienEnfant'));
        // Vérification de la saisie du lien Fonctionnaire si présence d'un numéro Guso
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateLienFonctionnaire'));
        // Vérification de la cohérence de l'adresse mail personnelle, si elle est saisie
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateCourrielIndividu'));
        // Vérification de la cohérence de l'adresse mail professionnelle, si elle est saisie
        $this->addFormRule(array('CRM_Civiparoisse_Formulaires_Form_RulesFormulaires', 'validateCourrielOrganization'));
    }

    protected function computeParams(array $values): array
    {
        $ignores = array('entryURL', 'qfKey'); // suppression des valeurs inutiles dans le array
        $params = [];
        foreach ($values as $key => $data) {
            if (substr($key, 0, 1) != "_" && !in_array($key, $ignores)) {
                $params[$key] = $data; // création du tableau avec les valeurs à créer
            }
        }
        return $params;
    }

    protected function computeCustomFields(): array
    {
        /* Récupération des ID des Custom Fields */
        $listCustomFields = array();

        $getListCustomFields = civicrm_api3('CustomField', 'get', [
            'sequential' => 1,
            'return' => ["name"],
            'options' => ['limit' => 0],
        ]);

        /* transformation de la liste pour avoir le nom en premier et l'id derrière */
        for ($i = 0; $i < ($getListCustomFields['count']); $i++) {
            $j = $getListCustomFields['values'][$i]['name'];
            $listCustomFields[$j] = 'custom_' . $getListCustomFields['values'][$i]['id'];
        }
        return $listCustomFields;
    }

    protected function createIndividual(array $params, array $listCustomFields): ?int
    {
        // création de l'Individu //
        ////////////////////////////
        $newIndividualId = null;
        /* Création du contenu pour API3 Contact (contenu de base) */
        $createIndividual = array(
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
            /* Récupération du nouveau numéro ID pour utilisation dans les autres API */
            $newIndividualId = $newIndividual['id'];
            CRM_Core_Session::setStatus(' Individual in database saved', ' Individual saved', 'success');
        } catch (CiviCRM_API3_Exception $ex) {
            CRM_Core_Session::setStatus('Error saving Individual in database', 'NOT Saved Individual', 'error');
        }
        return $newIndividualId;

    }

    protected function computeLocationTypeId($firstAddr): ?int
    {
        $locationTypeId = null;
        if (is_array($firstAddr) && array_key_exists('location_type_id', $firstAddr)) {
            $locationTypeId = $firstAddr['location_type_id'];
        }
        return $locationTypeId;
    }

    protected function createIndividualAddr(
        int $newIndividualId,
        array $addressEntiteRattachement,
        $locationTypeId): void
    {
        // création de l'adresse de l'Individu //
        /////////////////////////////////////////

        try {
            \Civi\Api4\Address::create()
                ->addValue('contact_id', $newIndividualId)
                ->addValue('master_id', $addressEntiteRattachement['id'])
                ->addValue('street_address', $addressEntiteRattachement['street_address'])
                ->addValue('supplemental_address_1', $addressEntiteRattachement['supplemental_address_1'])
                ->addValue('supplemental_address_2', $addressEntiteRattachement['supplemental_address_2'])
                ->addValue('postal_code', $addressEntiteRattachement['postal_code'])
                ->addValue('city', $addressEntiteRattachement['city'])
                ->addValue('state_province_id', $addressEntiteRattachement['state_province_id'])
                ->addValue('country_id', $addressEntiteRattachement['country_id'])
                ->addValue('location_type_id', $locationTypeId)
                ->addValue('is_primary', 1)
                ->execute();

            CRM_Core_Session::setStatus(' Individual adresse in database saved', ' Adresse saved', 'success');
        } catch (CiviCRM_API3_Exception $ex) {
            CRM_Core_Session::setStatus('Error saving Individual adresse in database', 'NOT Saved Adresse', 'error');
        }

    }

    protected function createIndividualPhoneMobile($newIndividualId, $locationTypeId, $params): void
    {
        // création du téléphone portable de l'Individu //
//////////////////////////////////////////////////

        if (!empty($params['phone_mobile'])) {
            try {
                civicrm_api3('Phone', 'create', [
                    'contact_id' => $newIndividualId,
                    'phone' => $params['phone_mobile'],
                    'is_primary' => 1,
                    'location_type_id' => $locationTypeId,
                    'phone_type_id' => 'Mobile',
                ]);
                CRM_Core_Session::setStatus(' Individual Mobile Phone in database saved', ' Phone saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus(
                    'Error saving Individual mobile phone in database',
                    'NOT Saved Phone',
                    'error');
            }
        }

    }

    protected function createIndividualPhoneWork($newIndividualId, $params): void
    {
        // création du téléphone professionel de l'Individu //
        //////////////////////////////////////////////////////

        if (!empty($params['phone_work'])) {
            try {
                civicrm_api3('Phone', 'create', [
                    'contact_id' => $newIndividualId,
                    'phone' => $params['phone_work'],
                    'is_primary' => 0,
                    'location_type_id' => 'Travail',
                    'phone_type_id' => 'Phone',
                ]);
                CRM_Core_Session::setStatus(' Individual Work Phone in database saved', ' Phone saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus(
                    'Error saving Individual Work phone in database',
                    'NOT Saved Phone',
                    'error');
            }
        }
    }

    protected function createIndividualEmailHome($newIndividualId, $params): void
    {
        // création du courriel privé de l'Individu //
        //////////////////////////////////////////////

        if (!empty($params['email_home'])) {
            try {
                civicrm_api3('Email', 'create', [
                    'contact_id' => $newIndividualId,
                    'email' => $params['email_home'],
                    'is_primary' => 1,
                    'location_type_id' => 'Domicile',
                ]);
                CRM_Core_Session::setStatus(' Individual Home Mail in database saved', ' Mail saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Individual Home Mail in database', 'NOT Saved Mail', 'error');
            }
        }

    }

    protected function createIndividualEmailWork($newIndividualId, $params): void
    {
        // création du courriel professionnel de l'Individu //
        //////////////////////////////////////////////////////

        if (!empty($params['email_work'])) {
            try {
                civicrm_api3('Email', 'create', [
                    'contact_id' => $newIndividualId,
                    'email' => $params['email_work'],
                    'is_primary' => 0,
                    'location_type_id' => 'Travail',
                ]);
                CRM_Core_Session::setStatus(' Individual Work Mail in database saved', ' Mail saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Individual Work Mail in database', 'NOT Saved Mail', 'error');
            }
        }
    }

    protected function createInstruments($newIndividualId, $listCustomFields, $params): void
    {
        // création des instruments de musique //
        /////////////////////////////////////////
        if (!empty($params['musique_instrument'])) {
            $getInstruments = explode(',', $params['musique_instrument']);

            $idInputMusique = $listCustomFields["musique_instrument"];

            /* Création de l'instrument */
            civicrm_api3('Contact', 'create', [
                'id' => $newIndividualId,
                $idInputMusique => $getInstruments,
            ]);
        }
    }

    protected function createGroups($newIndividualId, $params): void
    {
        // création des groupes de l'individu //
        ////////////////////////////////////////
        if (!empty($params['groups'])) {

            $getoptionsGroups = explode(',', $params['groups']);

            try {
                civicrm_api3('GroupContact', 'create', [
                    'contact_id' => $newIndividualId,
                    'group_id' => $getoptionsGroups,
                ]);
                CRM_Core_Session::setStatus('Groups in database saved', 'Groups saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Groups in database', 'NOT Saved Groups', 'error');
            }
        }
    }

    protected function createTags($newIndividualId, $params): void
    {
        // création des etiquettes de l'individu //
        ///////////////////////////////////////////
        if (!empty($params['tags'])) {

            $getoptionsTags = explode(',', $params['tags']);

            try {
                civicrm_api3('EntityTag', 'create', [
                    'entity_table' => 'civicrm_contact',
                    'entity_id' => $newIndividualId,
                    'tag_id' => $getoptionsTags,
                ]);
                CRM_Core_Session::setStatus('Tags in database saved', 'Tags saved', 'success');
            } catch (CiviCRM_API3_Exception $ex) {
                CRM_Core_Session::setStatus('Error saving Tags in database', 'NOT Saved Tags', 'error');
            }
        }
    }

    protected function createMembership($newIndividualId, $params): void
    {
        // création de l'adhésion de l'individu //
        //////////////////////////////////////////
        try {
            civicrm_api3('Membership', 'create', [
                'contact_id' => $newIndividualId,
                'membership_type_id' => $params['membership'],
            ]);
            CRM_Core_Session::setStatus('Membership in database saved', ' Membership saved', 'success');
        } catch (CiviCRM_API3_Exception $ex) {
            CRM_Core_Session::setStatus('Error saving Membership in database', 'NOT Saved Membership', 'error');
        }
    }

    protected function computeListRelationTypes(): array
    {
        $listRelationTypes = [];
        /* Récupération des ID des relations*/
        $getListRelationTypes = civicrm_api3('RelationshipType', 'get', [
            'return' => ["name_a_b"],
            'options' => ['limit' => 0],
        ]);

        /* transformation de la liste pour avoir le nom en premier et l'id derrière */
        for ($i = 0; $i < ($getListRelationTypes['count']); $i++) {
            if (!empty($getListRelationTypes['values'][$i])) {
                $j = $getListRelationTypes['values'][$i]['name_a_b'];
                $listRelationTypes[$j] = $getListRelationTypes['values'][$i]['id'];
            }
        }
        return $listRelationTypes;
    }


    protected function createRelationsAdulteEnfant(int $newIndividualId, array $listRelationTypes, array $params): void
    {

        /* Mise en place des relations pour les adultes */
        if ($params['statutIndividu'] == 'adulte') {
            $appartenanceContactType = \Civi\Api4\Contact::get()
                ->addWhere('id', '=', $params['entity_link'])
                ->execute()->first()['contact_type'];
            if ($appartenanceContactType == 'Organization') {


                /* Relation Employeur - Employé */
                civicrm_api3('Contact', 'create', [
                    'contact_type' => "Individual",
                    'id' => $newIndividualId,
                    'employer_id' => $params['entity_link'],
                ]);
            } else {
                /* Relation Chef de Foyer*/
                $typeRelationEntite = $listRelationTypes['Head of Household for'];

                civicrm_api3('Relationship', 'create', [
                    'contact_id_a' => $newIndividualId,
                    'contact_id_b' => $params['entity_link'],
                    'relationship_type_id' => $typeRelationEntite,
                ]);

            }
        }
        /* Mise en place des relations pour les enfants */
        if ($params['statutIndividu'] == 'enfant') {
            /* Relation Enfants de / Parents de */
            $getIdParent = explode(',', $params['parents']);
            foreach ($getIdParent as $id_b_parent) {
                civicrm_api3('Relationship', 'create', [
                    'contact_id_a' => $newIndividualId,
                    'contact_id_b' => $id_b_parent,
                    'relationship_type_id' => $listRelationTypes['Child of'],
                ]);
            }

            /* Relation Freres/Soeurs de*/
            if (!empty($params['freres_soeurs'])) {
                $getIdFreresSoeurs = explode(',', $params['freres_soeurs']);
                foreach ($getIdFreresSoeurs as $id_b_freres_soeurs) {
                    civicrm_api3('Relationship', 'create', [
                        'contact_id_a' => $newIndividualId,
                        'contact_id_b' => $id_b_freres_soeurs,
                        'relationship_type_id' => $listRelationTypes['Sibling of'],
                    ]);
                }

            }
        }

    }


    protected function createRelationsConjoint(int $newIndividualId, array $listRelationTypes, array $params): void
    {
        /* Détermination de la Relation Conjoint */
        if (!empty($params['relationConjoint'])) {
            $flagRelationTypeConjoint = null;
            switch ($params['relationConjoint']) {
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
            if ($flagRelationTypeConjoint != null) {
                civicrm_api3('Relationship', 'create', [
                    'contact_id_a' => $newIndividualId,
                    'contact_id_b' => $params['nom_conjoint'],
                    'relationship_type_id' => $flagRelationTypeConjoint,
                ]);
            }
        }
    }


// TRAITEMENT DU FORMULAIRE
    public function postProcess()
    {
        // Destination après validation du formulaire
        $this->controller->_destination = CRM_Utils_System::url('civicrm/formulaire-individu', 'reset=1');

        $values = $this->exportValues(); // récupération des valeurs envoyées par le formulaire
        $params = $this->computeParams($values);
        $listCustomFields = $this->computeCustomFields();


        /* Récupération des données Adresse de l'entité de rattachement (Foyer ou Entreprise/Organisation) */
        $addressEntiteRattachement = \Civi\Api4\Address::get()
            ->addWhere('contact_id', '=', $params['entity_link'])
            ->execute();


        $firstAddr = $addressEntiteRattachement->first();
        $locationTypeId = $this->computeLocationTypeId($firstAddr);
        $listRelationTypes = $this->computeListRelationTypes();


///////////////////////////////////////
// CREATION DE L'INDIVIDU DANS L'API //
///////////////////////////////////////


        $newIndividualId = $this->createIndividual($params, $listCustomFields);

        if (is_numeric($newIndividualId)) {
            if ($firstAddr && $locationTypeId) {
                $this->createIndividualAddr($newIndividualId, $firstAddr, $locationTypeId);
                //comme locationTypeId dépend transitivement de firstAddr (pour le moment au moins),
                // on peut mettre ici les codes qui dépendent uniquement de bonnes valeurs
                // de newIndividualId et locationTypeId
                $this->createIndividualPhoneMobile($newIndividualId, $locationTypeId, $params);
            }
            $this->createIndividualPhoneWork($newIndividualId, $params);
            $this->createIndividualEmailHome($newIndividualId, $params);
            $this->createIndividualEmailWork($newIndividualId, $params);
            $this->createInstruments($newIndividualId, $listCustomFields, $params);
            $this->createGroups($newIndividualId, $params);
            $this->createTags($newIndividualId, $params);
            $this->createMembership($newIndividualId, $params);
            $this->createRelationsAdulteEnfant($newIndividualId, $listRelationTypes, $params);
            $this->createRelationsConjoint($newIndividualId, $listRelationTypes, $params);

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
