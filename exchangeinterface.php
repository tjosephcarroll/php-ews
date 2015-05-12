<?php

//ini_set('display_errors', '1');
/**
 * Contains functions that facilitate the communication between the exchange server and the application. 
 * For exchange server 2010
 * Utilizes ews-php library
 *
 * Currently we're is including the whole library
 * It's recomended that this be changed in the future to only include the files we need.
 */
foreach (glob("exchangeInterface/php-ews-master/*.php") as $filename)
{
    include_once($filename);
   
}


/**
 *The foreach's go in alphabetical order
 *ItemType and RecurrencePatternBaseType are superclasses that come alphabetically after their subclasses
 *Therefore we need to include them first
 */
$filename = "exchangeInterface/php-ews-master/EWSType/ItemType.php";
include_once($filename);

$filename = "exchangeInterface/php-ews-master/EWSType/RecurrencePatternBaseType.php";
include_once($filename);

foreach (glob("exchangeInterface/php-ews-master/EWSType/*.php") as $filename)
{
    include_once($filename);
}
foreach (glob("exchangeInterface/php-ews-master/NTLMSoapClient/*.php") as $filename)
{
    include_once($filename);
}

$filename = 'exchangeInterface/exchangeutilities.php';
include_once($filename);
$filename = 'exchangeInterface/exchangeupdatefunctions.php';
include_once($filename);
$filename = 'exchangeInterface/exchangecreatedeletefunctions.php';
include_once($filename);
$filename = 'exchangeInterface/exchangeremovefunctions.php';
include_once($filename);



//$test = searchByName('Test','Ledin','');
//echo '<br>',print_r($test);
/**/
?>