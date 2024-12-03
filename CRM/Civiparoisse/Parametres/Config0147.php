<?php

class CRM_Civiparoisse_Parametres_Config0147 extends CRM_Civiparoisse_Parametres_Config
{

// Création du groupe Conseil Presbytéral
    public static function createConseilPresbyteralGroup()
    {
        
            $count = \Civi\Api4\Group::get()
                ->setCheckPermissions(false)
                ->addClause('OR',['name', '=', 'civip_conseil_presbyteral'],
		['title','=','Conseil Presbytéral'])
                ->execute()
		->count();

        
           if($count===0){
            $createGroup = \Civi\Api4\Group::create()
                ->setCheckPermissions(false)
                ->addValue('title', 'Conseil Presbytéral')
                ->addValue('name', 'civip_conseil_presbyteral')
                ->addValue('description', 'Liste des Conseillers Presbytéraux')
                ->addValue('is_active', true)
                ->addValue('visibility', 'User and User Admin Only')
                ->addValue('is_reserved', true)
                ->addValue('is_hidden', false)
                ->execute();
        }
    }
}
