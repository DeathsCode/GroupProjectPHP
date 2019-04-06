<?php
//Require the config
require_once("inc/config.inc.php");

//Require entities
require_once("inc/Entities/User.class.php");

require_once("inc/Entities/Address.class.php");


//Require Utilities
require_once("inc/Utility/TheMovieDbApi.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserMapper.class.php");
require_once("inc/Utility/AddressMapper.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Validation.class.php");

session_start();

if(!LoginManager::verifyLogin()) return;



AddressMapper::inizialize("Address");
UserMapper::initialize("User");
Page::$title = "Group Project";
Page::header();
$address = new Address();

if(false == AddressMapper::getAddress($_SESSION['user'])){
    $address->setUserID($_SESSION['user']->getUserID());
    $addressid = AddressMapper::createAddress($address);
    $address->setAddressID($addressid);
}else{
    $address = AddressMapper::getAddress($_SESSION['user']);
}
if(!empty($_POST["update"])){
    $address->setState($_POST["state"]);
    $address->setCity($_POST["city"]);
    $address->setStreet($_POST["street"]);
    $_SESSION["address"] = $address;
    AddressMapper::updateAddress($_SESSION["address"]);
}
$_SESSION["address"] = $address;

Page::PersonalInformation($_SESSION['user'],$_SESSION['address']);

Page::footer();
?>