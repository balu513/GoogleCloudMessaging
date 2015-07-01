<?php
//http://localhost/workspace/GcmApp/register.php?name=balu&&email=balub513@yahoo.co.in&&regId=APA91bG98aelDGaK5-1gU8EvYapHKkpbVKj_HliifCtlQ2AEjCbKHMhLGIuY31ybK8bt_DAGzgOWUIGymL6RaOTbuI_-WsHP2CyAHSNaqM76hof_8Luk4RNo5diWO0-2p1AWzGzlunYm

error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );
// response json
$json = array();
$name=$_REQUEST['name'];
$email=$_REQUEST["email"];
$regid=$_REQUEST["regId"];

// echo "name: ".$name," email: ".$email." regid: ".$regid;
/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($name) && isset($email) && isset($regid)) {
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $gcm_regid = $_REQUEST["regId"]; // GCM Registration ID
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();
    $gcm = new GCM();

    $res = $db->storeUser($name, $email, $gcm_regid);

    $registatoin_ids = array($gcm_regid);
    $message = array("product" => "shirt");

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
} else {
    // user details missing
    echo "error params";
}
?>