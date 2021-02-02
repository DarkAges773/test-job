<?php
include_once "CProducts.class.php";
$cPr = new CProducts();
$cPr->hideProduct($_POST["ID"]);
?>