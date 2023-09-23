<?php
//
///**
// * Setup des rapports
// * La classe Base est la classe mère pour les setups ultérieurs
// * 
// *  N'est plus utilisé dans la version 1.42. Conservé à titre de mémoire
// *
// */
//abstract class CRM_Civiparoisse_Reports_Config_Base
//{
//  /**
//   * get the report template params
//   * @return array array of array storing params
//   */
//  protected abstract function getTemplateParams();
//
//  /**
//   * get the report instance params
//   * @return array array of array storing params
//   */
//  protected abstract function getInstanceParams();
//
//  /**
//   * create all the report templates and instances defined by the class
//   * @throws CiviCRM_API3_Exception
//   */
//  public function installReportTemplatesAndInstances()
//  {
//    $this->createTemplates();
//    $this->createInstances();
//  }
//
//  /**
//   * Create (register) all the report templates defined by the class
//   * @throws CiviCRM_API3_Exception
//   */
//  protected function createTemplates()
//  {
//    foreach ($this->getTemplateParams() as $param) {
//      $this->createTemplate($param);
//    }
//  }
//
//  /**
//   * Create all the instances defined by the class
//   * @throws CiviCRM_API3_Exception
//   */
//  protected function createInstances()
//  {
//    foreach ($this->getInstanceParams() as $param) {
//      $this->createInstance($param);
//    }
//  }
//
//
//
//
//
//
//
//
//
//
//
//  /***********************************/
//  /* CREATION DES MODELES DE RAPPORT */
//  /***********************************/
//  /**
//   * Create report Template
//   * @param array $params template parameters
//   * @throws CiviCRM_API3_Exception
//   */
//  protected function createTemplate($params)
//  {
//    $rapportType = civicrm_api3('ReportTemplate', 'create', $params);
//  }
//
//
//
//  /**************************************/
//  /* CREATION DES INSTANCES DE RAPPORTS */
//  /**************************************/
//  /**
//   * Create report Instance
//   * @param array $params
//   * @throws CiviCRM_API3_Exception
//   */
//  protected function createInstance($params)
//  {
//    $rapportType = civicrm_api3('ReportInstance', 'create', $params);
//  }
//
//}
