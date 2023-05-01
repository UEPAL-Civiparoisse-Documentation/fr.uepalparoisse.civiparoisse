<?php
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Pages_Page_SommaireListes extends CRM_Core_Page {

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('SommaireListes'));

 

    parent::run();
	
	
  }
  
}
