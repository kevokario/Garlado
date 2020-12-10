<?php

function connect() {
    $host = "localhost";
    $user = "root";
    $pass = "riotech";
    $db = "garladodb";
    $con = new mysqli($host, $user, $pass, $db);
    return $con;
}

//Step one : Generate the access token
function getAccessToken(){
    $consumerKey = 'QpdbeP2J5c1CUwJwWc534A15AxQVsWuH';
    $consumerSecret = 'bwJAQT43nP41GxHo';

    $headers = ['Content-Type:application/json; charset=utf8'];

    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl_init = curl_init( $url);
    curl_setopt($curl_init, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl_init, CURLOPT_HEADER, FALSE);
    curl_setopt($curl_init, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

    $result = curl_exec($curl_init);
    $result = json_decode($result);

    $access_token = $result->access_token;
    curl_close($curl_init);
    return $access_token;
   }
 
 getAccessToken();


function stk(){
    // function stk($phone,$price){
        $amount=1;
        $phone_paying='254704219247';
       
        //remove 07 for those that come with it
        // if($phone_paying->startsWith($phone_paying,"07")){
        //     $phone_paying=str_replace("07","2547",$phone_paying);
        // }
        //Variables specific to this application
        $merchant_id="174379"; //C2B Shortcode/Paybill
        $callback_url="http://2fe3c6ca6b42.ngrok.io/Core/mpesa/mpesa_callback.php";
        $passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919"; //Ask from Safaricom guys..
        $account_reference='AS '.$merchant_id;
        $transaction_description='Pay for Order:'.$phone_paying;

        //Initiate PUSH
        $timestamp=date("YmdHis");
        $password=base64_encode($merchant_id . $passkey .$timestamp); //No more Hashing like before
        // dd($password);
        $access_token = getAccessToken();
            // die($access_token);
        $curl = curl_init();
        $endpoint_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        curl_setopt($curl, CURLOPT_URL, $endpoint_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$access_token)); //setting custom header

        $curl_post_data = array(
            'BusinessShortCode' => $merchant_id,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone_paying,
            'PartyB' => $merchant_id,
            'PhoneNumber' => $phone_paying,
            'CallBackURL' => $callback_url,
            'AccountReference' => $account_reference,
            'TransactionDesc' => $transaction_description
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        $result = json_decode($curl_response);
       
        // $sql_stk_push_payment_requests ="
        // INSERT INTO `stk_push_payment_requests`(
        //     `order_id`,
        //     `merchant_request_id`,
        //     `checkout_request_id`,
        //     `amount`,
        //     `status`
        // )
        // VALUES(
        //     '70',
        //     '".$result->MerchantRequestID."',
        //     '".$result->CheckoutRequestID."',
        //     '".$amount."',
        //     '1'
        // )
        // ";

        // $con = connect();
        // $con->query($sql_stk_push_payment_requests);

        /*

        if (array_key_exists("errorCode", $result)) { //Error
            return json_encode([
                "success" => 0,
                "message" => "Request Failed"
            ]);
        } else if ("ResponseCode" == 0) { //Success
            //create the pending request...
            return json_encode([
                "success" => 1,
                "message" => "Request Sent Successfully"
            ]);
        } else {
            return json_encode([
                "success" => 0,
                "message" => "Unknown Error, Please Retry"
            ]);
        }*/

        echo $curl_response;

}

stk();

//  echo getAccessToken();

?> 
