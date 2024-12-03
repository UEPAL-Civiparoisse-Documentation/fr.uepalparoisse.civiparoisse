<?php
/**
  Configuration du groupe de désabonnement
 */
class CRM_Civiparoisse_Parametres_ConfigDesabonnement
{
    /**
     * Création du groupe Désabonnement 
     * Réécrit pour pouvoir le lancer plusieurs fois si nécessaire
     */
    static public function createDesabonnementGroup()
    {
    
        $valueMailingList = (\Civi\Api4\OptionValue::get()
            ->setCheckPermissions(false)
            ->addSelect('value')
            ->addWhere('option_group_id:name', '=', 'group_type')
            ->addWhere('name', '=', 'Mailing List')
            ->execute()
            ->single())['value'];


        $count= \Civi\Api4\Group::get()
            ->setCheckPermissions(false)
            ->addClause('OR',
	    ['name', '=', 'desabonnements'],
	    ['title','=','Désabonnements'])            
            ->execute()
            ->count();        

        if($count===0) {
            $createGroup = \Civi\Api4\Group::create()
                ->setCheckPermissions(false)
                ->addValue('title', 'Désabonnements')
                ->addValue('name', 'desabonnements')
                ->addValue(
                    'description', 
                    'Liste des personnes ayant demandé un désabonnement aux envois de mailing'
                )
                ->addValue('is_active', true)
                ->addValue('visibility', 'User and User Admin Only')
                ->addValue(
                    'group_type', [
                    $valueMailingList,
                    ]
                )
                ->addValue('is_reserved', true)
                ->addValue('is_hidden', false)
                ->execute();
        }


    }
}