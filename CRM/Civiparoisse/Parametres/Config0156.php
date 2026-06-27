<?php

class CRM_Civiparoisse_Parametres_Config0156 extends CRM_Civiparoisse_Parametres_Config
{

// Rajouts dans la liste Instruments de musique
  public function ajoutInstrumentsMusique0156() {

    $newInstruments = [
      'Trombone',
      'Autres'
    ];

      CRM_Civiparoisse_Parametres_ConfigInstrumentsMusique::ajoutInstrumentsMusique($newInstruments);

    return;

  }


}
