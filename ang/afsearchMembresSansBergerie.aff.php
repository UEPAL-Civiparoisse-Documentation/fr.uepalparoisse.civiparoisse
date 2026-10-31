<?php
use CRM_Civiparoisse_ExtensionUtil as E;
return
[
    "type" => "search",
    "title" => E::ts("Membres sans bergerie"),
    "placement" => [],
    "placement_filters" => [],
    "icon" => "fa-list-alt",
    "server_route" => "civicrm/membres-sans-bergerie",
    "permission" => [
        "access CiviCRM"
    ],
    "permission_operator" => "AND",
    "confirmation_type" => "redirect_to_url",
    "created_id" => 2
];
