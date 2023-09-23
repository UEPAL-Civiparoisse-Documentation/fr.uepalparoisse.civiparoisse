<?php

use CRM_Civiparoisse_ExtensionUtil as E;
use CRM_Civiparoisse_Parametres_TemplateMailMosaico as TMM;

class CRM_Civiparoisse_Parametres_ConfigMosaico {


  /**
   * Fonction de création du Template Mail UEPAL par l'API
   * 
   * @var  array  $result  Code de création du Template Mail par l'API 
   * 
   * @return  array  $result  Code de création du Template Mail par l'API
   *
   */ 
  public function createTemplateMosaico() {

    $result = civicrm_api3('MosaicoTemplate', 'create', [
      'title' => TMM::getTitle(),
      'base' => TMM::getBase(),
      'html' => TMM::htmlTemplateMosaico(),
      'content' => TMM::contentTemplateMosaico(),
      'metadata' => TMM::metadataTemplateMosaico(),
      ]
    );

    return $result;

  }
}
