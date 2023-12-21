<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // A SUPPRIMER EN MÊME TEMPS QUE LE SQL

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Qualitebase_Page_ControleQualiteParoisse extends CRM_Civiparoisse_Qualitebase_Page_BaseQualiteParoisse {

    public function run() {
    // Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Corrections des données de la base CiviParoisse'));

    // Liste des pages SearchKit à afficher
    $listeControles = array(
      'Individus' => array(
        'Civip_Individus_Sans_Genre',
        'Civip_Individus_Sans_Civilite',
        'Civip_Individus_sans_Statut_Membre',
        'Civip_Individus_sans_lien_avec_Foyer_ou_Organisation',
        'Civip_Individus_Majeurs_avec_Statut_Enfant',
        'Civip_Individus_Enfants_avec_Statut_Chef_Famille',
        'Civip_Individus_Majeur_ChezParents',
      ),
      'Foyers' => array(
        'Civip_Foyers_avec_Statut_Membre',
        'Civip_Foyers_sans_Relation_ChefFamille',
        'Civip_Foyer_sans_Relation_Membre_du_Foyer',
        'Civip_Foyers_sans_Mode_de_Distribution_Journal',
      ),
      'Organisations' => array(
        'Civip_Organisation_avec_statut_Membre',
      ),
      'E-mails' => array(
        'Civip_E_mails_en_erreur',
      ),
    );

    $resultControle = parent::calculQualite($listeControles);
 
    $this->assign('ResultsDesControles', $resultControle);





    // Assign variables for use in a template
    // Fiches Individus
    $this->assign('IndividuSansGenre', $this->getIndividuSansGenreTable());
    $this->assign('IndividuSansCivilite', $this->getIndividuSansCiviliteTable());
    $this->assign('IndividuSansStatutMembre', $this->getIndividuSansStatutMembreTable());   
    $this->assign('IndividuEncoreStatutEnfant', $this->getIndividuEncoreStatutEnfantTable());   
    $this->assign('IndividuSansLienFoyerOrganisation', $this->getIndividuSansLienFoyerOrganisationTable());   
    $this->assign('IndividuEnfantChefFamille', $this->getIndividuEnfantChefFamilleTable());   
    $this->assign('IndividuDansFoyerParents', $this->getIndividuDansFoyerParentsTable());   
    $this->assign('EMailErreurs', $this->getEMailErreursTable());
    
    // Fiches Foyers
    $this->assign('FoyerAvecMembre', $this->getFoyerAvecMembreTable());
    $this->assign('FoyerSansRelation', $this->getFoyerSansRelation());
    $this->assign('FoyerSansChefFamille', $this->getFoyerSansChefFamilleTable());
    $this->assign('FoyerSansMembreFoyer', $this->getFoyerSansMembreFoyerTable());
    $this->assign('FoyerModeDistribution', $this->getFoyerModeDistributionTable());

    // Fiches Organisations
    $this->assign('OrganisationAvecMembre', $this->getOrganisationAvecMembreTable());
    
    
    parent::run();
  }

///////////////
// INDIVIDUS //
///////////////

    /**
     * Recherche des Individus n'ayant pas de genre
     *
     * @return array Résultat de la requête
     */
    private function getIndividuSansGenreTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        WHERE
            c.contact_type = 'Individual'
            AND c.gender_id IS NULL
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }

    /**
     * Recherche des Individus n'ayant pas de civilité
     *
     * @return array Résultat de la requête
     */
    private function getIndividuSansCiviliteTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        WHERE
            c.contact_type = 'Individual'
            AND c.prefix_id IS NULL
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }

    /**
     * Recherche des Individus n'ayant pas de Statut Membre
     *
     * @return array Résultat de la requête
     */
    private function getIndividuSansStatutMembreTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_membership AS m ON c.id = m.contact_id
        WHERE
            c.contact_type = 'Individual'
            AND m.membership_type_id IS NULL
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }

    /**
     * Recherche des Individus n'ayant pas de lien avec un Foyer ou une Organisation
     *
     * @return array Résultat de la requête
     */
    private function getIndividuSansLienFoyerOrganisationTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT DISTINCT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        WHERE c.id NOT IN
            (
            SELECT
                c1.id
            FROM civicrm_contact AS c1
            LEFT JOIN civicrm_relationship AS r_A ON c1.id = r_A.contact_id_a
            LEFT JOIN civicrm_contact AS c_b ON r_A.contact_id_b = c_b.id
            WHERE
                (c_b.contact_type = 'Household' OR c_b.contact_type = 'Organization')
                AND c1.is_deleted = 0
                AND r_A.is_active = 1
            )
            AND c.contact_type = 'Individual'
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }

    /**
     * Recherche des Individus de plus de 18 ans ayant encore le Statut "Inscrit Enfant",
     * ainsi que des Individus dont la date de création de la fiche est supérieure à 18 ans
     * et qui ont toujours le Statut "Inscrit Enfant"
     *
     * @return array Résultat de la requête
     */
    private function getIndividuEncoreStatutEnfantTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_membership AS m ON c.id = m.contact_id
        WHERE
            c.contact_type = 'Individual'
            AND m.membership_type_id = '2'
            AND
                (((YEAR(NOW()) - YEAR(c.birth_date)) > 18)
                OR
                (c.birth_date IS NULL AND (YEAR(NOW()) - YEAR(m.start_date)) > 18)
                OR
                (c.birth_date IS NULL AND (YEAR(NOW()) - YEAR(m.join_date)) > 18)
                )
                
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }

    /**
     * Recherche des Individus ayant le statut Membre Enfant (ou l'âge) et une Relation Chef de Famille
     *
     * @return array Résultat de la requête
     */
    private function getIndividuEnfantChefFamilleTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT DISTINCT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_membership AS m ON c.id = m.contact_id
        LEFT JOIN civicrm_relationship AS r ON c.id = r.contact_id_a
        WHERE
            c.contact_type = 'Individual'
            AND
                (m.membership_type_id = '2' OR (YEAR(NOW()) - YEAR(c.birth_date)) < 19)
            AND r.relationship_type_id = '7'
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }

    /**
     * Recherche des Individus ayant plus de 27 ans (ou fiche crée il y a plus de 27 ans)
     * et qui sont encore rattaché au Foyer de leurs parents
     *
     * @return array Résultat de la requête
     */
    private function getIndividuDansFoyerParentsTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name, date de naissance, nom du foyer */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];
        //  A TRAVAILLER

        $sql = "
        SELECT DISTINCT
            c.id,
            c.display_name,
            c.birth_date,
            c_b.display_name AS display_name_b,
                        c.sort_name
            
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_membership AS m ON c.id = m.contact_id
        LEFT JOIN civicrm_relationship AS r ON c.id = r.contact_id_a
        LEFT JOIN civicrm_contact AS c_b ON r.contact_id_b = c_b.id
        WHERE
            c.id NOT IN
                (
                SELECT
                    c1.id
                FROM civicrm_contact AS c1
                LEFT JOIN civicrm_relationship AS r1 ON c1.id = r1.contact_id_a
                WHERE
                    r1.relationship_type_id = '7'
                    AND c1.is_deleted = 0
                    AND c1.is_deceased = 0
                )
            AND c.contact_type = 'Individual'
            AND
                (
                ((YEAR(NOW()) - YEAR(c.birth_date)) > 27)
                OR
                (c.birth_date IS NULL AND (YEAR(NOW()) - YEAR(m.start_date)) > 27)
                OR
                (c.birth_date IS NULL AND (YEAR(NOW()) - YEAR(m.join_date)) > 27)
                )
            
                
            AND r.is_active = 1
            AND r.relationship_type_id = '8'
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ORDER BY c.sort_name ASC
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name, $dao->birth_date, $dao->display_name_b];
        }

        return $t;
    }


    /**
     * Recherche des E-mails en Erreur
     *
     * @return array Résultat de la requête
     */
    private function getEMailErreursTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name, adresse mail, date de blocage */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name,
            e.email,
            e.hold_date
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_email AS e ON c.id = e.contact_id
        WHERE
            e.on_hold IN ('1', '2')
            AND c.is_deleted = 0
            AND c.is_deceased = 0
        ORDER BY e.hold_date DESC, c.display_name ASC
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name, $dao->email, $dao->hold_date];
        }

        return $t;
    }





////////////
// FOYERS //
////////////

    /**
     * Recherche des Foyers ayant un statut Adhésion
     *
     * @return array Résultat de la requête
     */
    private function getFoyerAvecMembreTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_membership AS m ON c.id = m.contact_id
        WHERE
            c.contact_type = 'Household'
            AND c.is_deleted = 0
            AND m.membership_type_id IS NOT NULL
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
    private function getFoyerSansRelation()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

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
     * Recherche des Foyers n'ayant pas de relation Chef de Famille
     *
     * @return array Résultat de la requête
     */
    private function getFoyerSansChefFamilleTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT DISTINCT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        WHERE c.id NOT IN
            (
            SELECT
                c1.id
            FROM civicrm_contact AS c1
            LEFT JOIN civicrm_relationship AS r_B ON c1.id = r_B.contact_id_b
            WHERE
                r_B.relationship_type_id = '7'
                AND c1.contact_type = 'Household'
                AND c1.is_deleted = 0
                AND r_B.is_active = 1
            )
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
     * Recherche des Foyers n'ayant pas de relation Membre du Foyer
     *
     * @return array Résultat de la requête
     */

    private function getFoyerSansMembreFoyerTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT DISTINCT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        WHERE c.id NOT IN
            (
            SELECT
                c1.id
            FROM civicrm_contact AS c1
            LEFT JOIN civicrm_relationship AS r_B ON c1.id = r_B.contact_id_b
            WHERE
                r_B.relationship_type_id = '8'
                AND c1.contact_type = 'Household'
                AND c1.is_deleted = 0
                AND r_B.is_active = 1
            )
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
     * Recherche des Foyers où le mode de distribution du journal n'est pas renseigné
     *
     * @return array Résultat de la requête
     */
    private function getFoyerModeDistributionTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name, nom de l'événement */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
                   
        FROM civicrm_contact AS c
        
        LEFT JOIN  civicrm_value_complements_foyer AS cf
        ON c.id = cf.entity_id
        
        WHERE
            c.contact_type = 'Household'
            AND c.is_deleted = 0
            AND (cf.mode_distribution is NULL OR cf.mode_distribution = 0)
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

    /**
     * Recherche des Organisations ayant un statut Adhésion
     *
     * @return array Résultat de la requête
     */
    private function getOrganisationAvecMembreTable()
    {
        /** @var array $t Sélection des informations à restituer : id, display_name */
        /** @var string $sql Requête SQL */
        /** @var string $dao Conversion de la requête SQL */

        $t = [];

        $sql = "
        SELECT
            c.id,
            c.display_name
        FROM civicrm_contact AS c
        LEFT JOIN civicrm_membership AS m ON c.id = m.contact_id
        WHERE
            c.contact_type = 'Organization'
            AND c.is_deleted = 0
            AND m.membership_type_id IS NOT NULL
        ";

        $dao = CRM_Core_DAO::executeQuery($sql);

        while ($dao->fetch()) {
            $t[] = [$dao->id, $dao->display_name];
        }

        return $t;
    }


}

