<?php
function civicrm_api3_bergerie_get($params){
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__),$params);
}
