<?php

//var_dump($_POST); //uncomment this to see what we post to your URL.
$sessionId = $_POST['sessionId'];
$direction = $_POST['direction'];
$callerNumber = $_POST['callerNumber'];
$callerCountryCode = $_POST['callerCountryCode'];
$destinationNumber = $_POST['destinationNumber'];
$callSessionState = $_POST['callSessionState']; // this will be "Dialing" during ringing and when answered it will be "Bridge"
$isActive = $_POST['isActive']; // 0 before answer and 1 when answered
$callStartTime = $_POST['callStartTime'];
$dialDestinationNumbers = $_POST['dialDestinationNumbers'];
$hangupCause = $_POST['hangupCause']; // the responses you expect are "USER_BUSY" "NO_ANSWER" "NO_USER_RESPONSE" "SUBSCRIBER_ABSENT" "SERVICE_UNAVAILABLE" "USER_NOT_REGISTERED" "UNALLOCATED_NUMBER"

if ($isActive == '0') {
    if ($hangupCause == 'USER_BUSY' || $hangupCause == 'NO_ANSWER' || $hangupCause == 'NO_USER_RESPONSE') {
        $response = '<?xml version="1.0" encoding="UTF-8"?><Response><Dial record="true" phoneNumbers="'.$callerNumber.'" /></Response>';
    }
} else {
    //log the data
}

echo $response;
