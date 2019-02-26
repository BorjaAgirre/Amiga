<?php 

$action = $_POST['action'];
$item = $_POST['item'];  
$origen = $_POST['origen']; 
$destino = $_POST['destino']; 
$updateRecordsArray = $_POST['persona'];


if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
/*	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE records SET recordListingID = " . $listingCounter . " WHERE recordID = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
*/	
//	$orig = ($origen == 'undefined') ? $destino : $origen; 
	echo 'Item: '.$item;
//	echo '<br>Origen: '.$origen;
	echo '<br>Destino: '.$destino;
/*	echo '<pre>';
	print_r($updateRecordsArray);
	echo '</pre>';
*/
}
?>
