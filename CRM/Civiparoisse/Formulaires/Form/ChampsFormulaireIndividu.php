<?php

use CRM_Civiparoisse_ExtensionUtil as E;

trait CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividuGeneraux
{
    /**
     * Function addPrenom, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le prénom
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addPrenom($form)
    {
        $form->add(
            'text',
            'first_name',
            ts('Prénom'));
    }

    /**
     * Function addNomIndividu, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le nom de famille
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addNomIndividu($form)
    {
        $form->add(
            'text',
            'last_name',
            ts('Nom de famille'));
    }

    /**
     * Function addNomNaissance, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le nom de jeune fille
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addNomNaissance($form)
    {
        $form->add(
            'text',
            'nom_naissance',
            ts('Nom de jeune fille'));
    }

    /**
     * Function addDateNaissance, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date de naissance
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateNaissance($form)
    {
        $form->add(
            'datepicker',
            'birth_date',
            ts('Date de naissance'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividu::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addLieuNaissance, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le lieu de naissance
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addLieuNaissance($form)
    {
        $form->add(
            'text',
            'lieu_naissance',
            ts('Lieu de naissance'));
    }

    /**
     * Function addCivilite, appelée par le Formulaire Individu
     * Permet de choisir
     *  la civilité
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addCivilite($form)
    {
        $form->addRadio(
            'prefix_id',
            ts("Civilité"),
            CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'prefix_id'),
            null,
            CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividu::RADIO_SEPARATOR,
            true
        );
    }

    /**
     * Function addGenre, appelée par le Formulaire Individu
     * Permet de choisir
     *  le genre
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addGenre($form)
    {
        $form->addRadio(
            'gender_id',
            ts("Gender"),
            CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id'),
            null,
            CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividu::RADIO_SEPARATOR,
            true
        );
    }

}
trait CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividuCasuels
{
    /**
     * Function addDateBénédictionNuptiale, appelée par le Formulaire Individu
     * Permet de choisir
     *  la date de la bénédiction nuptiale
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateBenedictionNuptiale($form)
    {
        $form->add(
            'datepicker',
            'date_benediction_nuptiale',
            ts('Date de la bénediction nuptiale'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addParoisseMariage, appelée par le Formulaire Individu
     * Permet de choisir
     *  la paroisse de mariage
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addParoisseMariage($form)
    {
        $form->addEntityRef(
            'paroisse_mariage',
            ts('Lieu de la bénédiction nuptiale'),
            [
                'entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'liste_paroisses'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]
        );
    }

    /**
     * Function addVersetMariage, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le verset de mariage
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addVersetMariage($form)
    {
        $form->add(
            'textarea',
            'verset_mariage',
            ts('Verset de mariage')
        );
    }

    /**
     * Function addDatePresentation, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date de la présentation
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDatePresentation($form)
    {
        $form->add(
            'datepicker',
            'date_presentation',
            ts('Date de présentation'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addParoissePresentation, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la paroisse de présentation
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addParoissePresentation($form)
    {
        $form->addEntityRef(
            'paroisse_presentation',
            ts('Lieu de présentation'),
            [
                'entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'liste_paroisses'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]
        );
    }

    /**
     * Function addDateBapteme, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date du baptême
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateBapteme($form)
    {
        $form->add(
            'datepicker',
            'date_bapteme',
            ts('Date de baptême'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addParoisseBapteme, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la paroisse de baptême
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addParoisseBapteme($form)
    {
        $form->addEntityRef(
            'paroisse_bapteme',
            ts('Lieu de baptême'),
            ['entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'liste_paroisses'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]
        );
    }

    /**
     * Function addVersetBapteme, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le verset du baptême
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addVersetBapteme($form)
    {
        $form->add(
            'textarea',
            'verset_bapteme',
            ts('Verset de baptême')
        );
    }

    /**
     * Function addDateConfirmation, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date de confirmation
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateConfirmation($form)
    {
        $form->add(
            'datepicker',
            'date_confirmation',
            ts('Date de confirmation'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addParoisseConfirmation, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la paroisse de confirmation
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addParoisseConfirmation($form)
    {
        $form->addEntityRef(
            'paroisse_confirmation',
            ts('Lieu de confirmation'),
            [
                'entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'liste_paroisses'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]
        );
    }

    /**
     * Function addVersetConfirmation, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le verset de confirmation
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addVersetConfirmation($form)
    {
        $form->add(
            'textarea',
            'verset_confirmation',
            ts('Verset de confirmation')
        );
    }

    /**
     * Function addDateObseques, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date des obsèques
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateObseques($form)
    {
        $form->add(
            'datepicker',
            'date_obseques',
            ts('Date des obsèques'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addParoisseObseques, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la paroisse des obsèques
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addParoisseObseques($form)
    {
        $form->addEntityRef(
            'paroisse_enterrement',
            ts('Lieu des obsèques'),
            ['entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'liste_paroisses'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]);
    }

}

trait CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividuSpecifiques
{
    /**
     * Function addChoixOrganisationFoyer, appelée par le Formulaire Individu
     * Permet de choisir
     *  le Foyer ou l'Organisation d'appartenance
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addChoixOrganisationFoyer($form)
    {
        $form->addEntityRef(
            'entity_link',
            ts('Choisir le Foyer ou l\'Organisation d\'appartenance'),
            ['api' =>
                ['params' => ['contact_type' => ['Household', 'Organization']],
                ],
                'select' => ['minimumInputLength' => 0],
            ],
            true);
    }

    /**
     * Function addParents, appelée par le Formulaire Individu
     * Permet de choisir
     *  le nom des parents (en cas d'enfants)
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addParents($form)
    {
        $form->addEntityRef(
            'parents',
            ts('Nom des parents'),
            ['entity' => 'contact',
                'api' => [
                    'params' => ['contact_type' => 'Individual'],
                ],
                'select' => ['minimumInputLength' => 0],
                'multiple' => true,
            ]);
    }

    /**
     * Function addFreresSoeurs, appelée par le Formulaire Individu
     * Permet de choisir
     *  le nom des frères et des soeurs
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addFreresSoeurs($form)
    {
        $form->addEntityRef(
            'freres_soeurs',
            ts('Nom des frères et soeurs'),
            ['entity' => 'contact',
                'api' => [
                    'params' => ['contact_type' => 'Individual'],
                ],
                'select' => ['minimumInputLength' => 0],
                'multiple' => true,
            ]);
    }

    /**
     * Function addNomConjoint, appelée par le Formulaire Individu
     * Permet de choisir
     *  le nom du conjoint ou du partenaire
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addNomConjoint($form)
    {
        $form->addEntityRef(
            'nom_conjoint',
            ts('Sélectionner le conjoint ou partenaire'),
            ['api' => [
                'params' => ['contact_type' => 'Individual'],
            ],
                'select' => ['minimumInputLength' => 0],
            ]);
    }

    /**
     * Function addLienConjoint, appelée par le Formulaire Individu
     * Permet de choisir
     *  le lien Conjoint ou Partenaire
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addLienConjoint($form)
    {
        $form->addRadio(
            'relationConjoint',
            ts("Type de relation"),
            array(
                'conjoint' => 'Conjoint de',
                'partenaire' => 'Partenaire de'),
            null,
            self::RADIO_SEPARATOR,
            false
        );
    }
    /**
     * Function addDateMariage, appelée par le Formulaire Individu
     * Permet de choisir
     *  la date du mariage
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateMariage($form)
    {
        $form->add(
            'datepicker',
            'date_mariage',
            ts('Date du mariage'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addDivorce, appelée par le Formulaire Individu
     * Permet de choisir
     *  si la personne est divorcée
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDivorce($form)
    {
        $form->addYesNo(
            'divorce',
            ts('Divorcé ?')
        );
    }

    /**
     * Function addDateDivorce, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date du divorce
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateDivorce($form)
    {
        $form->add(
            'datepicker',
            'date_divorce',
            ts('Date de divorce'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }

    /**
     * Function addDateVeuvage, appelée par le Formulaire Individu
     * Permet de renseigner
     *  la date du veuvage
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addDateVeuvage($form)
    {
        $form->add(
            'datepicker',
            'date_veuvage',
            ts('Date de veuvage'),
            array('class' => 'some-css-class'),
            false,
            array('time' => false,
                'date' => 'dd-mm-yy',
                'yearRange' => self::INDIVIDU_DATE_RANGE)
        );
    }
    /**
     * Function addStatut, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le statut de l'individu vis-à-vis de la paroisse
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addStatut($form)
    {
        $form->addRadio(
            'statutIndividu',
            ts("Statut Individu"),
            array(
                'adulte' => 'Adulte',
                'enfant' => 'Enfant'),
            null,
            self::RADIO_SEPARATOR,
            true
        );
    }

    /**
     * Function addLienParoisse, appelée par le Formulaire Individu
     * Permet de choisir
     *  le statut de l'individu par rapport à la paroisse
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addLienParoisse($form)
    {
        $membership = CRM_Member_PseudoConstant::membershipType();
        $form->addRadio(
            'membership',
            ts("Lien avec la Paroisse"),
            $membership,
            null,
            null,
            true
        );
    }
    /**
     * Function addMetier, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le métier de l'individu
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addMetier($form)
    {
        $form->add(
            'text',
            'job_title',
            ts('Métier')
        );
    }

    /**
     * Function addSecuriteSociale, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le numéro de Sécurité Sociale
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addSecuriteSociale($form)
    {
        $form->add(
            'text',
            'securite_sociale',
            ts('Numéro de Sécurité Sociale')
        );
    }

    /**
     * Function addGuso, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le numéro de Guso
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addGuso($form)
    {
        $form->add(
            'text',
            'guso',
            ts('Numéro Guso')
        );
    }

    /**
     * Function addFonctionnaire, appelée par le Formulaire Individu
     * Permet de renseigner
     *  le statut Fonctionnaire
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addFonctionnaire($form)
    {
        $form->addYesNo(
            'fonctionnaire',
            ts('Fonctionnaire ?')
        );
    }

    /**
     * Function addGroupes, appelée par le Formulaire Individu
     * Permet de choisir
     *  les groupes d'appartenance
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addGroupes($form)
    {
        $form->addEntityRef(
            'groups',
            ts('Groupe(s)'),
            [
                'entity' => 'group',
                'select' => ['minimumInputLength' => 0],
                'multiple' => true,
            ]
        );
    }

    /**
     * Function addInstruments, appelée par le Formulaire Individu
     * Permet de choisir
     *  les instruments de musique
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addInstruments($form)
    {
        $form->addEntityRef(
            'musique_instrument',
            ts('Compétence Musique : instrument'),
            ['entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'instruments'],
                ],
                'select' => ['minimumInputLength' => 0],
                'multiple' => true,
            ]
        );
    }

    /**
     * Function addVoix, appelée par le Formulaire Individu
     * Permet de choisir
     *  la voix (chant)
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addVoix($form)
    {
        $form->addEntityRef(
            'musique_chant',
            ts('Compétence Musique : voix'),
            [
                'entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'voix_chant'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]
        );
    }

    /**
     * Function addReligion, appelée par le Formulaire Individu
     * Permet de choisir
     *  la religion
     *
     * @param CRM_Core_Form $form
     * @access public
     * @return void
     *
     */
    public static function addReligion($form)
    {
        $form->addEntityRef(
            'religion',
            ts('Religion'),
            [
                'entity' => 'OptionValue',
                'api' => [
                    'params' => ['option_group_name' => 'religion'],
                ],
                'select' => ['minimumInputLength' => 0],
            ]
        );
    }

}
/**
 *
 */
class CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividu
{
    public const INDIVIDU_DATE_RANGE='-120:+1';
    public const RADIO_SEPARATOR='&nbsp;&nbsp;&nbsp;';
    use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividuGeneraux;
    use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividuSpecifiques;
    use CRM_Civiparoisse_Formulaires_Form_ChampsFormulaireIndividuCasuels;

// Default constructor pour ne pas permettre une instanciation de la classe depuis l'extérieur
    protected function __construct()
    {
    }



}
