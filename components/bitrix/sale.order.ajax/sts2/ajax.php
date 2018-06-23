<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/testzone/util/platform.php';
include_once getPlatformPath();
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$pl = new Platform();
echo json_encode($pl->createNewPartnerOrder($_POST));