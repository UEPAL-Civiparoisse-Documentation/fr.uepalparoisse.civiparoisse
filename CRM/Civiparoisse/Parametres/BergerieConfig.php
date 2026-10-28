<?php
class CRM_Civiparoisse_Parametres_BergerieConfig
{
  public static function getCommunes(): array
  {
    $ret=[];
    $client=CRM_Civisolraddr_SolrClient::singleton();
    $codes=$client->retrieveAllCodeCommunes();
    foreach($codes as $k=>$v)
    {
      $ret[$v]=$k;
    }
    return $ret;
  }
}
