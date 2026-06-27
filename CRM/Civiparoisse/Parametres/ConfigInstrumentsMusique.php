<?php

/**
 * Classe gérant la configuration des instruments de musique dans CiviCRM.
 * Permet d'ajouter des instruments et de modifier leur ordre d'affichage.
 */

class CRM_Civiparoisse_Parametres_ConfigInstrumentsMusique {

    /** @var string Nom du groupe d'options pour les instruments de musique. */
    private const OPTION_GROUP_NAME = 'instruments';

  /**
   * Ajoute une liste d'instruments de musique dans le groupe d'options CiviCRM.
   *
   * @param array<string> $newInstruments Tableau de libellés d'instruments à ajouter.
   * @return void
   */
  public static function ajoutInstrumentsMusique(array $newInstruments): void {

    foreach ($newInstruments as $label) {

      \Civi\Api4\OptionValue::create()
        ->setCheckPermissions(false)
        ->addValue('label', $label)
        ->addValue('option_group_id:name', self::OPTION_GROUP_NAME)
        ->addValue('is_active', true)
        ->execute();
    }
    self::modificationOrdreInstrumentsMusique();
  }

  /**
   * Modifie l'ordre (weight) des instruments de musique dans le groupe d'options.
   * L'option "Autres" est automatiquement placée en dernier avec un poids fixe.
   *
   * @return void
   */
  public static function modificationOrdreInstrumentsMusique(): void {

  // Récupération de la liste des Instruments de musique
    $listeInstruments = \Civi\Api4\OptionValue::get()
      ->setCheckPermissions(false)
      ->addSelect('label')
      ->addWhere('option_group_id:name', '=', self::OPTION_GROUP_NAME)
      ->addWhere('is_active', '=', true)
      ->execute()->column('label');

  // Modification de l'ordre de chaque Instrument (weight)
    sort($listeInstruments);

    foreach ($listeInstruments as $key => $value) {
      \Civi\Api4\OptionValue::update()
        ->setCheckPermissions(false)
        ->addValue('weight', $key + 1)
        ->addWhere('option_group_id:name', '=', self::OPTION_GROUP_NAME)
        ->addWhere('label', '=', $value)
        ->execute();
    }

    // pour l'entrée Autres, modification de la Value pour la fixer à 999
    \Civi\Api4\OptionValue::update()
        ->setCheckPermissions(false)
        ->addValue('weight', 999)
        ->addWhere('option_group_id:name', '=', self::OPTION_GROUP_NAME)
        ->addWhere('label', '=', 'Autres')
        ->execute();
  }
}
