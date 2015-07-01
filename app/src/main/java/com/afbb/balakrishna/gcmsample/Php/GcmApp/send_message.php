<?php
//http://localhost/workspace/GcmApp/send_message.php?message=hello&regId=APA91bEZYSy4UISXTb9HlXK8kU3NEgjPUiNwbuY1v_zpSPh9WkIw6MOK89W0imKCJC_1YE60o2wda0-Ztz-gUFoQnYDJxRlZOxFZq3oVctF-f1ZLCkbcrEZVWRp3qtgOhmgCTimfJhT9

if (isset($_GET["regId"]) && isset($_GET["message"])) {
    $regId = $_GET["regId"];
    $message = $_GET["message"];
    
    include_once './GCM.php';
    
    $gcm = new GCM();

    $registatoin_ids = array($regId);
    $message = array("message" => $message);

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
}
?>
