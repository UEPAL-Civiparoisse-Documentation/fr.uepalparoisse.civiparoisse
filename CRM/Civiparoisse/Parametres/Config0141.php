<?php

class CRM_Civiparoisse_Parametres_Config0141 extends CRM_Civiparoisse_Parametres_Config
{

// Création du groupe Désabonnement
    public static function createDesabonnementGroup()
    {
        try {
            $valueMailingList = \Civi\Api4\OptionValue::get()
                ->setCheckPermissions(false)
                ->addSelect('value')
                ->addWhere('option_group_id:name', '=', 'group_type')
                ->addWhere('name', '=', 'Mailing List')
                ->execute()
                ->first();


            $createGroup = \Civi\Api4\Group::get()
                ->setCheckPermissions(false)
                ->addWhere('name', '=', 'desabonnements')
                ->execute();

        } catch (Exception $e) {

            $createGroup = \Civi\Api4\Group::create()
                ->setCheckPermissions(false)
                ->addValue('title', 'Désabonnements')
                ->addValue('name', 'desabonnements')
                ->addValue('description', 'Liste des personnes ayant demandé un désabonnement aux envois de mailing')
                ->addValue('is_active', true)
                ->addValue('visibility', 'User and User Admin Only')
                ->addValue('group_type', [
                    $valueMailingList['value'],
                ])
                ->addValue('is_reserved', true)
                ->addValue('is_hidden', false)
                ->execute();
        }

        return $createGroup;
    }

// Création du Champ Mode de Distribution sur les fiches Foyers
    public static function getCustomFieldComplementsFoyerModeDistribution()
    {
        $customGroupId = \Civi\Api4\CustomGroup::get()
            ->setCheckPermissions(false)
            ->addSelect('id')
            ->addWhere('name', '=', 'complements_foyer')
            ->execute()
            ->first();

        $params = [
            'custom_group_id' => $customGroupId['id'],
            'name' => 'mode_distribution',
            'label' => 'Mode de distribution du journal',
            'data_type' => 'String',
            'html_type' => 'Select',
            'is_searchable' => '1',
            'is_search_range' => '0',
            'weight' => '2',
            'is_active' => '1',
            'text_length' => '255',
            'note_columns' => '60',
            'note_rows' => '4',
            'column_name' => 'mode_distribution',
            'option_group_id' => self::getOptionGroupModeDistribution()['id'],
            'in_selector' => '0'
        ];
        return self::createOrGetCustomField($params);
    }

// Définition des options pour le Champ Mode de distribution (du journal)
    public static function getOptionGroupModeDistribution()
    {
        $params = [
            'name' => 'mode_distribution',
            'title' => 'Mode de distribution du journal',
            'data_type' => 'String',
            'is_reserved' => '0',
            'is_active' => '1',
            'is_locked' => '0'
        ];
        $options = [
            'Inconnu',
            'Distribué',
            'Emporté',
            'Par la Poste',
            'Pas de journal',
        ];
        return self::createOrGetOptionGroup($params, $options);
    }

// Création du format d'impression de page Format A4 Marges normales (2cm de chaque côté)
    public static function createFormatPageA4()
    {
        \Civi\Api4\OptionValue::create()
            ->setCheckPermissions(false)
            ->addValue('option_group_id.name', 'pdf_format')
            ->addValue('name', 'Page_A4_marges_normales')
            ->addValue('label', 'Page A4 marges normales')
            ->addValue('description', 'Page A4 marges normales')
            ->addValue('is_default', true)
            ->addValue('weight', 1)
            ->addValue('value', '{"paper_size":"a4","stationery":null,"orientation":"portrait","metric":"cm",'
                .'"margin_top":2,"margin_bottom":2,"margin_left":2,"margin_right":2}')
            ->execute();

    }

}
