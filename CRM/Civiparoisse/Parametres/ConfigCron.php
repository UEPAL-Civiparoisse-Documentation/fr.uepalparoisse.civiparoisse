<?php

use CRM_Civiparoisse_Parametres_ConfigUtils as CU;
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_ConfigCron {

  public function checkConfigCron() {

// liste des jobs à activer  
    CU::getCronChange('process_mailing','Always','','job', 1, 'Send Scheduled Mailings');
    CU::getCronChange('fetch_bounces','Hourly','','job', 1, 'Fetch Bounces');
    CU::getCronChange('geocode','Daily',"geocoding=1\nparse=0\nthrottle=1",'job', 1, 'Geocode and Parse Addresses');
    CU::getCronChange('send_reminder','Daily','','job', 1, 'Send Scheduled Reminders');
    CU::getCronChange('process_membership','Daily','','job', 1, 'Update Membership Statuses');
    CU::getCronChange('cleanup','Hourly','','job', 1, 'Clean-up Temporary Data and Files');
    CU::getCronChange('group_rebuild','Hourly','','job', 1, 'Rebuild Smart Group Cache');
    CU::getCronChange('disable_expired_relationships','Daily','','job', 1, 'Disable expired relationships');
    CU::getCronChange('update_greeting','Daily',"ct=Individual\ngt=email_greeting\nforce=0",'job', 1, 'Update Greetings and Addressees');
    CU::getCronChange('process_participant','Always','','job', 1, 'Update Participant Statuses');
    CU::getCronChange('update_email_resetdate','Daily',"minDays=3\nmaxDays=7",'mailing', 1, 'Validate Email Address from Mailings.');

// liste des jobs à désactiver (par sécurité)  
    CU::getCronChange('version_check','Weekly','','job', 0, 'CiviCRM Update Check');
    CU::getCronChange('mail_report','Daily','','job', 0, 'Mail Reports');
    CU::getCronChange('fetch_activities','Hourly','','job', 0, 'Process Inbound Emails');
    CU::getCronChange('process_pledge','Daily','','job', 0, 'Process Pledges'); // A activer lorsqu'on aura paramétré des rapports à envoyer
    CU::getCronChange('process_respondent','Always','','job', 0, 'Process Survey Respondents');
    CU::getCronChange('process_sms','Always','','job', 0, 'Send Scheduled SMS');
    
    // CU::getCronChange('prune_temp_tables','Daily','','Relationship', 1, 'Drop temporary relationship ACL tables'); // A activer éventuellement si on installe l'extension relationship-permissions-acls

    
// liste des jobs à créer  
    CU::getCronCreate('update_greeting','Daily',"ct=Household\ngt=email_greeting\nforce=0",'job', 1, 'Update Greetings and Addressees - Mail - Household'); // Update Greetings and Addressees
    CU::getCronCreate('update_greeting','Daily',"ct=Organization\ngt=email_greeting\nforce=0",'job', 1, 'Update Greetings and Addressees - Mail - Organisation'); // Update Greetings and Addressees

  }

}
