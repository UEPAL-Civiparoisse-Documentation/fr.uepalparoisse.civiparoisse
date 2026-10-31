<?php
use CRM_Civiparoisse_ExtensionUtil as E;
return
[
    "type" => "search",
    "title" => E::ts("Gestion des bergeries"),
    "placement" => [],
    "placement_filters" => [],
    "icon" => "fa-list-alt",
    "server_route" => "civicrm/bergeries",
    "permission" => [
        "access CiviCRM"
    ],
    "permission_operator" => "AND",
    "confirmation_type" => "redirect_to_url"
];
