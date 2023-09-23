<?php
//
///**
// *  N'est plus utilisé dans la version 1.42. Conservé à titre de mémoire
// */
//class CRM_Civiparoisse_Reports_Config_Initial extends CRM_Civiparoisse_Reports_Config_Base
//{
//  /**
//   * @inheritDoc
//   */
//  protected function getTemplateParams()
//  {
//    return [
//      $this->getListeGroupesTemplate(),
//
//    ];
//  }
//
//  /**
//   * @inheritDoc
//   */
//  protected function getInstanceParams()
//  {
//    return [
//
//      $this->getListeElectoraleRapportParams(),
//
//    ];
//  }
//
//
//  /** Template Liste des Groupes
//   * @return array tableau avec les paramètres du rapport
//   */
//  protected function getListeGroupesTemplate()
//  {
///* N'est plus utilisé dans la version 1.42. Conservé à titre de mémoire */
//    return [
//      'label' => "Liste des Groupes",
//      'value' => "fr.uepalparoisse.reports/listedesgroupes",
//      'name' => "CRM_Civiparoisse_Reports_Form_Report_ListeDesGroupes",
//      'description' => "Modèle de rapport permettant de créer des listes par groupe",
//      'is_active' => "1",
//    ];
//
//  }
//
//
//
//  /****************************************/
//  /* DEFINITION DES INSTANCES DE RAPPORTS */
//  /****************************************/
//
//  /** Rapport Liste Electorale
//   * @return array tableau avec les pararamètres du report instance
//   */
///* N'est plus utilisé dans la version 1.42. Conservé à titre de mémoire */
//  protected function getListeElectoraleRapportParams()
//  {
//    return [
//      'title' => "Liste electorale",
//      'report_id' => "fr.uepalparoisse.reports/listeelectorale",
//      'description' => "Rapport permettant d'afficher la liste électorale",
//      'permission' => "access CiviReport",
//      'grouprole' => array(
//        "utilisateur authentifié",
//        "administrator"
//      ),
//    'form_values' => "a:40:{s:6:\"fields\";a:10:{s:9:\"sort_name\";s:1:\"1\";s:9:\"last_name\";s:1:\"1\";s:10:\"first_name\";s:1:\"1\";s:10:\"birth_date\";s:1:\"1\";s:14:\"street_address\";s:1:\"1\";s:11:\"postal_code\";s:1:\"1\";s:4:\"city\";s:1:\"1\";s:10:\"country_id\";s:1:\"1\";s:5:\"email\";s:1:\"1\";s:5:\"phone\";s:1:\"1\";}s:12:\"sort_name_op\";s:3:\"has\";s:15:\"sort_name_value\";s:0:\"\";s:15:\"contact_type_op\";s:2:\"in\";s:18:\"contact_type_value\";a:1:{i:0;s:10:\"Individual\";}s:13:\"is_deleted_op\";s:2:\"eq\";s:16:\"is_deleted_value\";s:1:\"0\";s:21:\"created_date_relative\";s:0:\"\";s:17:\"created_date_from\";s:0:\"\";s:15:\"created_date_to\";s:0:\"\";s:14:\"is_deceased_op\";s:2:\"eq\";s:17:\"is_deceased_value\";s:1:\"0\";s:6:\"id_min\";s:0:\"\";s:6:\"id_max\";s:0:\"\";s:5:\"id_op\";s:3:\"lte\";s:8:\"id_value\";s:0:\"\";s:29:\"membership_join_date_relative\";s:0:\"\";s:25:\"membership_join_date_from\";s:0:\"\";s:23:\"membership_join_date_to\";s:0:\"\";s:6:\"tid_op\";s:2:\"in\";s:9:\"tid_value\";a:1:{i:0;s:1:\"1\";}s:6:\"sid_op\";s:2:\"in\";s:9:\"sid_value\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:8:\"tagid_op\";s:2:\"in\";s:11:\"tagid_value\";a:0:{}s:6:\"gid_op\";s:2:\"in\";s:9:\"gid_value\";a:0:{}s:9:\"order_bys\";a:1:{i:1;a:2:{s:6:\"column\";s:9:\"sort_name\";s:5:\"order\";s:3:\"ASC\";}}s:11:\"description\";s:50:\"Rapport permettant d'afficher la liste électorale\";s:13:\"email_subject\";s:0:\"\";s:8:\"email_to\";s:0:\"\";s:8:\"email_cc\";s:0:\"\";s:9:\"row_count\";s:0:\"\";s:9:\"view_mode\";s:4:\"view\";s:13:\"cache_minutes\";s:2:\"60\";s:10:\"permission\";s:17:\"access CiviReport\";s:9:\"parent_id\";s:0:\"\";s:8:\"radio_ts\";s:0:\"\";s:6:\"groups\";s:0:\"\";s:11:\"instance_id\";N;}",
//      'header' => "\r\n  \r\n    \r\n    \r\n    \r\n    \r\n  \r\n",
//      'footer' => "\r\n\r\n",
//    ];
//  }
//
//
//}
