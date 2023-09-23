<?php

class CRM_Civiparoisse_Parametres_MappingImport_SeraphinContacts
    extends CRM_Civiparoisse_Parametres_ConfigMappingImport
{

    public const NAME = 'Seraphin-Contacts';

    /**
     * @inheritDoc
     */
    protected function getName(): string
    {

        return self::NAME;

    }

    /**
     * Create le mapping d'import depuis Séraphin, pour les Individus
     *
     * @return     array    $params Parameters for the creation of the mapping
     */
    protected function getParametersMapping(): array
    {

        return [
            'name' => $this->getName(),
            'description' => "Modèle d'import des contacts extraits de Séraphin",
            'mapping_type_id_name' => "Import Contact",
        ];
    }


    /**
     * Create le MappingField d'import depuis Séraphin, pour les Individus
     *
     * @return  array $params   Parameters for the creation of the mapping fields
     */
    protected function getParametersDisplay(): array
    {

        return [
            $this->computeCommonDisplayField('contact_source', 0),
            $this->computeCommonDisplayField('external_identifier', 1),
            $this->computeRelationshipDisplayField('household_name',
                2,
                self::findRelationshipTypeId('Household Member of'),
                'a_b'),
            $this->computeCommonDisplayField('prefix_id', 3),
            $this->computeCommonDisplayField('last_name', 4),
            $this->computeCommonDisplayField('first_name', 5),
            $this->computeCommonDisplayField('middle_name', 6),
            $this->computeRelationshipDisplayField(
                'organization_name',
                7,
                self::findRelationshipTypeId('Employee of'),
                'a_b'),
            $this->computeCommonDisplayField('job_title', 8),
            $this->computeLocationDisplayField('email', 9, 'Domicile'),
            $this->computePhoneDisplayField('phone', 10, 'Domicile', 'Phone'),
            $this->computeCommonDisplayField(self::findCustomFieldId('nom_naissance', self::CG_ETAT_CIVIL), 11),
            $this->computeCommonDisplayField(self::findCustomFieldId('lieu_naissance', self::CG_ETAT_CIVIL), 12),
            $this->computeCommonDisplayField('birth_date', 13),
            $this->computeCommonDisplayField('gender_id', 14),
            $this->computeCommonDisplayField(self::findCustomFieldId('date_mariage', self::CG_ETAT_CIVIL), 15),
            $this->computeCommonDisplayField(self::findCustomFieldId(
                'date_benediction_nuptiale',
                self::CG_ETAT_CIVIL),
                16),
            $this->computeCommonDisplayField(self::findCustomFieldId('paroisse_mariage', self::CG_ETAT_CIVIL), 17),
            $this->computeCommonDisplayField(self::findCustomFieldId('verset_mariage', self::CG_ETAT_CIVIL), 18),
            $this->computeCommonDisplayField(self::findCustomFieldId('divorce', self::CG_ETAT_CIVIL), 19),
            $this->computeCommonDisplayField(self::findCustomFieldId('date_divorce', self::CG_ETAT_CIVIL), 20),
            $this->computeCommonDisplayField(self::findCustomFieldId('date_veuvage', self::CG_ETAT_CIVIL), 21),
            $this->computeCommonDisplayField(self::findCustomFieldId('date_obseques', self::CG_ETAT_CIVIL), 22),
            $this->computeCommonDisplayField(self::findCustomFieldId('paroisse_enterrement', self::CG_ETAT_CIVIL), 23),
            $this->computeCommonDisplayField('is_deceased', 24),
            $this->computeCommonDisplayField(self::findCustomFieldId('securite_sociale', self::CG_ETAT_CIVIL), 25),
            $this->computeCommonDisplayField(self::findCustomFieldId('fonctionnaire', self::CG_ETAT_CIVIL), 26),
            $this->computeCommonDisplayField(self::findCustomFieldId('religion', self::CG_INFO_RELIGION), 27),
            $this->computeCommonDisplayField(self::findCustomFieldId('date_bapteme', self::CG_INFO_RELIGION), 28),
            $this->computeCommonDisplayField(self::findCustomFieldId('paroisse_bapteme', self::CG_INFO_RELIGION), 29),
            $this->computeCommonDisplayField(self::findCustomFieldId('verset_bapteme', self::CG_INFO_RELIGION), 30),
            $this->computeCommonDisplayField(self::findCustomFieldId('date_confirmation', self::CG_INFO_RELIGION), 31),
            $this->computeCommonDisplayField(self::findCustomFieldId(
                'paroisse_confirmation',
                self::CG_INFO_RELIGION),
                32),
            $this->computeCommonDisplayField(self::findCustomFieldId(
                'verset_confirmation',
                self::CG_INFO_RELIGION),
                33),
            $this->computeLocationDisplayField('street_address', 34, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_1', 35, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_2', 36, 'Domicile'),
            $this->computeLocationDisplayField('supplemental_address_3', 37, 'Domicile'),
            $this->computeLocationDisplayField('city', 38, 'Domicile'),
            $this->computeLocationDisplayField('postal_code', 39, 'Domicile'),
            $this->computeLocationDisplayField('country', 40, 'Domicile'),
            $this->computeLocationDisplayField('state_province', 41, 'Domicile'),
            $this->computeCommonDisplayField('is_opt_out', 42),
            $this->computeRelationshipDisplayField(
                'household_name',
                43, self::findRelationshipTypeId('Head of Household for'),
                'a_b')

        ];
    }


}

