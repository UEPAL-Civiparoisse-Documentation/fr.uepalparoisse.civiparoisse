<?php

use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Pages_Page_ConfigurationSommaireCiviParoisse
{
    private const ACCESS_CIVICRM='access CiviCRM';

    /* TO DO
     * changer les images en .svg
     */


    /**
     * Construction du menu Paroisse
     * @param array $menu Données de la barre de menu
     */
    public static function buildMenuCiviParoisse(&$menu)
    {
        /** @var int $maxKey Rang du menu Paroisse dans les entrées du menu */
        /** @var array $dataMenuPrincipalParoisse Construction de l'entrée de menu Paroisse */
        /** @var string $dataSubMenuParoisse Construction du détail du menu, par appel à la fonction subMenuParoisse */

        $maxKey = (max(array_keys($menu)));

        $dataMenuPrincipalParoisse = array(
            'label' => E::ts('Paroisse'),
            'name' => 'menu-civiparoisse',
            'navID' => $maxKey + 1,
            'url' => 'civicrm/sommaire-civiparoisse',
            'separator' => null,
            'active' => 1,
            'icon' => 'crm-i fa-handshake-o',
            'permission' => self::ACCESS_CIVICRM,
        );

        /* Appel aux données composant le menu */
        $dataSubMenuParoisse = self::subMenuParoisse();

        /* Création de la première ligne du menu */
        _civiparoisse_civix_insert_navigation_menu($menu, null, $dataMenuPrincipalParoisse);

        /* Création des lignes suivantes du menu */
        foreach ($dataSubMenuParoisse as $value) {
            // Création des lignes suivantes du menu
            _civiparoisse_civix_insert_navigation_menu($menu, 'menu-civiparoisse', $value);
        }

    }


    /**
     * Fonction qui crée chaque ligne du menu Paroisse
     * @return array  $data       Ensemble des détails (par ligne) du menu Paroisse
     */
    public static function subMenuParoisse()
    {
        /** @var int $indexMenu Variable de rang de chaque ligne du menu Paroisse */
        /** @var string $data Détail de chaque ligne du menu Paroisse */

        $indexMenu = 1;

        return [
            [
                'label' => E::ts('Nouveau Foyer'),
                'name' => 'menu-formulaire-foyer',
                'url' => 'civicrm/formulaire-foyer',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => null,
                'icon' => 'crm-i fa-address-card',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/form_foyer.png',
            ],
            [
                'label' => E::ts('Nouvel Individu / Particulier'),
                'name' => 'menu-formulaire-individu',
                'url' => 'civicrm/formulaire-individu',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => null,
                'icon' => 'crm-i fa-user-plus',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/form_particulier.png',
            ],
            [
                'label' => E::ts('Nouvelle Entreprise ou Organisation'),
                'name' => 'menu-formulaire-organisation',
                'url' => 'civicrm/formulaire-entreprise',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => 1,
                'icon' => 'crm-i fa-building-o',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/form_entreprise.png',
            ],
            [
                'label' => E::ts('Anniversaires'),
                'name' => 'menu-anniversaires',
                'url' => 'civicrm/prochains_anniversaires',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => 1,
                'icon' => 'crm-i fa-birthday-cake',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/anniversaires.png',
            ],
            [
                'label' => E::ts('Listes'),
                'name' => 'menu-listes',
                'url' => 'civicrm/sommaire-listes',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => null,
                'icon' => 'crm-i fa-list-alt',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/listes.png',
            ],
            [
                'label' => E::ts('Contrôles'),
                'name' => 'menu-controles',
                'url' => 'civicrm/controle-qualite',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => 1,
                'icon' => 'crm-i fa-check-square',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/controles.png',
            ],
            [
                'label' => E::ts('Aide en ligne'),
                'name' => 'menu-aide',
                'url' => 'civicrm/modes-emploi',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => 1,
                'icon' => 'crm-i fa-question-circle-o',
                'permission' => self::ACCESS_CIVICRM,
                'image' => 'images/aide.png',
            ],
            [
                'label' => E::ts('Paramètres'),
                'name' => 'menu-parametres',
                'url' => 'civicrm/sommaire-parametres',
                'navID' => $indexMenu++,
                'active' => 1,
                'separator' => 1,
                'icon' => 'crm-i fa-cog',
                'permission' => self::ACCESS_CIVICRM,
                'image' => null,
            ],


        ];
    }

    public static function subMenuMultiparoisse()
    {
      $indexMenu = 1;
      return [
        [
          'label' => E::ts('Gestion des bergeries'),
          'name' => 'menu-bergeries',
          'url' => 'civicrm/bergeries',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => '',
          'permission' => self::ACCESS_CIVICRM,
          'image' => null,
        ],
        [
          'label' => E::ts('Affectation aux bergeries'),
          'name' => 'menu-affectation-bergeries',
          'url' => 'civicrm/membres-sans-bergerie',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => '',
          'permission' => self::ACCESS_CIVICRM,
          'image' => null,
        ],
        [
          'label' => E::ts('Numérations des membres'),
          'name' => 'menu-numerations-membres',
          'url' => 'civicrm/numeration-membres-paroissiaux',
          'navID' => $indexMenu++,
          'active' => 1,
          'separator' => 1,
          'icon' => '',
          'permission' => self::ACCESS_CIVICRM,
          'image' => null,
        ],
      ];
    }
    /**
     * Sous menu multiparoisse
     * @param array $menu
     */
  public static function integrateMenuMultiparoisse(&$menu)
    {
       $navId=0;
       foreach($menu['child'] as $subnode)
       {
         if($subnode['name']=='menu-civiparoisse')
         {
           $navId=(max(array_keys($subnode['child'])))+1;
         }
       }
      $noeudMultiparoisse=[
        'label' => E::ts('MultiParoisse'),
        'name' => 'menu-multiparoisse',
        'navID' =>$navId,
        'separator' => 1,
        'active' => 1,
        'icon' => 'crm-i fa-church',
        'permission' => self::ACCESS_CIVICRM,
      ];
      _civiparoisse_civix_insert_navigation_menu($menu,'menu-civiparoisse',$noeudMultiparoisse);

      $sous_noeuds=self::subMenuMultiparoisse();
      foreach($sous_noeuds as $sous_noeud){
        _civiparoisse_civix_insert_navigation_menu($menu,'menu-civiparoisse/menu-multiparoisse',$sous_noeud);
      }
    }

}
