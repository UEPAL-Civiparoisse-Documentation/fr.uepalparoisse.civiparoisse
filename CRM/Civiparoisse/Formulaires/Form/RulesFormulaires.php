<?php

use CRM_Civiparoisse_ExtensionUtil as E;

/**
 *
 */
class CRM_Civiparoisse_Formulaires_Form_RulesFormulaires
{

    public const LATIN_CHAR_REGEX = '/^[\p{Latin}\p{N}\' -]+$/';

// Default constructor pour ne pas permettre une instanciation de la classe depuis l'extérieur
    protected function __construct()
    {
    }

    /**
     * Fonction de vérification de la saisie du nom de famille de l'Individu
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */
    public static function validateNomIndividu($fields)
    {
        $errors = [];

        if (!(is_array($fields)
            && array_key_exists('last_name', $fields)
            && preg_match(self::LATIN_CHAR_REGEX, $fields['last_name']))) {

            $errors['last_name'] =
                ts('Merci de renseigner le nom de famille de l\'Individu (sans caractères spéciaux)');
            return $errors;
        }
        return true;
    }

    /**
     * Fonction de vérification de la saisie du nom de l'Entreprise ou de l'Organisation
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */
    public static function validateNomOrganization($fields)
    {
        $errors = [];

        if (is_array($fields)
            && !empty($fields)
            && (
                !preg_match(self::LATIN_CHAR_REGEX, $fields['organization_name'])
                || empty($fields['organization_name']))
        ) {

            $errors['organization_name'] =
                ts('Merci de renseigner le nom de l\'Entreprise ou de l\'Organisation (sans caractères spéciaux)');
            return $errors;
        }
        return true;
    }

    /**
     * Fonction de vérification de la saisie du nom du Foyer
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */
    public static function validateNomFoyer($fields)
    {
        $errors = [];

        if (is_array($fields)
            && !empty($fields)
            && (!preg_match('/^[\p{Latin}\p{N}\' -]+$/u', $fields['household_name'])
                || empty($fields['household_name']))) {

            $errors['household_name'] = ts('Merci de renseigner le nom du Foyer (sans caractères spéciaux)');
            return $errors;
        }
        return true;
    }

    /**
     * Fonction de vérification de la saisie de la ville de l'Entreprise ou Organisation
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */

    public static function validateVille($fields)
    {
        $errors = [];

        if (is_array($fields)
            && !empty($fields)
            && (!preg_match(self::LATIN_CHAR_REGEX, $fields['city']) || empty($fields['city']))) {
            $errors['city'] = ts('Merci de renseigner la ville (sans caractères spéciaux)');
            return $errors;
        }
        return true;
    }

    /**
     * Fonction de vérification de la validité de l'adresse mail, lorsqu'elle est saisit
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */
    public static function validateCourrielIndividu($fields)
    {
        $errors = [];

        if (is_array($fields)
            && !empty($fields)
            && !empty($fields['email_home'])
            && !filter_var($fields['email_home'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_home'] = ts('Merci de corriger l\'adresse mail');
            return $errors;
        }
        return true;
    }

    /**
     * Fonction de vérification de la validité de l'adresse mail, lorsqu'elle est saisit
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */

    public static function validateCourrielOrganization($fields)
    {
        $errors = [];

        if (is_array($fields)
            && !empty($fields)
            && !empty($fields['email_work'])
            && !filter_var($fields['email_work'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_work'] = ts('Merci de corriger l\'adresse mail');
            return $errors;
        }
        return true;
    }

    /**
     * Fonction de vérification de la validité de l'adresse internet, lorsqu'elle est saisit
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */

    public static function validateWebsite($fields)
    {
        $errors = [];


        if (is_array($fields) && !empty($fields) && !empty($fields['web_site']) && !filter_var($fields['web_site'], FILTER_VALIDATE_URL)) {
            $errors['web_site'] = ts('Merci de corriger l\'adresse du site Internet : saisir http:// ou https:// au début, ne pas utiliser de caractères accentués ou spéciaux');

            return $errors;
        }
        return true;
    }


    /**
     * Fonction de vérification de la saisie du Type de Relation Concubin
     * si présence d'un nom dans le champ Nom Conjoint, ou l'inverse
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */
    public static function validateLienConjoint($fields)
    {
        $errors = [];

        $relationSet = self::isRelationConjointSet($fields);
        $nomSet = self::isNomConjointSet($fields);


        if ($nomSet && !$relationSet) {
            $errors['relationConjoint'] = ts('Merci de saisir le Type de relation avec le conjoint ou partenaire');
            return $errors;
        } elseif (!$nomSet && $relationSet) {
            $errors['nom_conjoint'] = ts('Merci de saisir le nom du conjoint ou partenaire');
            return $errors;

        }
        return true;
    }

    /**
     * Déterminer si on a la relation de conjoint positionnée
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     * @return boolean
     */
    protected static function isRelationConjointSet($fields)
    {
        return is_array($fields)
            && !empty($fields)
            && array_key_exists('relationConjoint', $fields)
            && !empty($fields['relationConjoint']);
    }

    /**
     * Déterminer si on a le nom du conjoint positionné
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     * @return boolean
     */
    protected static function isNomConjointSet($fields)
    {
        return is_array($fields)
            && !empty($fields)
            && array_key_exists('nom_conjoint', $fields)
            && !empty($fields['nom_conjoint']);
    }

    /**
     * Fonction de vérification de la saisie du nom des parents si le Statut Individu est Enfant
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */

    public static function validateLienEnfant($fields)
    {
        $errors = [];

        if (is_array($fields)
            && !empty($fields)
            && array_key_exists('statutIndividu', $fields)
            && array_key_exists('parents', $fields)
            && $fields['statutIndividu'] == 'enfant'
            && empty($fields['parents'])) {
            $errors['parents'] = ts('Merci de renseigner le nom du ou des parents');
            return $errors;
        }
        return true;
    }


    /**
     * Fonction de vérification de la saisie du lien Fonctionnaire si présence d'un numéro Guso
     *
     * @param array $fields Ensemble des valeurs saisis dans le formulaire et sousmis à la validation
     *
     * @return boolean|array Message d'erreur personnalisé, si besoin
     */

    public static function validateLienFonctionnaire($fields)
    {
        $errors = [];

        if (is_array($fields) && !empty($fields) && !empty($fields['guso']) && !isset($fields['fonctionnaire'])) {
            $errors['fonctionnaire'] = ts('Merci de saisir le champ Fonctionnaire');
            return $errors;
        }
        return true;
    }


}
