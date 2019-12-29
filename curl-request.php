<?php

    header('Content-Type: application/json');
    
    // BEARER TOKEN THAT WILL GET AUTHENTICATED SERVER SIDE BY THE API
    $token = "TOKEN STRING HERE";

    $curl = curl_init();
    
    // A DEFAULT VALUE FOR THE NUMBER OF DATA ITEMS FOR THE API TO RETURN
    $countNum = '1';

    // IF THE QUERY SPECIFIES A 'MAX' VAL (INT) THEN USE THAT VALUE FOR THE NUMBER OF DATA ITEMS
    if (isset($_GET['max'])){
            $countNum = $_GET['max'];
    }

    // THE CURL REQUEST ITSELF...
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://127.0.0.1:3000/count?max=".$countNum,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,  // REMNANT, CAN REMOVE?
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $token,
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    // IF THERE IS A CURL ERROR, SHOW AND DONE, OTHERWISE, SHOW THE CURL RESPONSE (JSON)
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }

?>
