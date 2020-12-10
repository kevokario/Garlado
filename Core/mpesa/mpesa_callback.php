<?php

function connect() {
  $host = "localhost";
  $user = "root";
  $pass = "riotech";
  $db = "garladodb";
  /*$user = "myonline_garlado";
  $pass = "l}W[5(0STLKE";
  $db = "myonline_garladodb";*/
  $con = new mysqli($host, $user, $pass, $db);
  // if ($con->connect_error) {
  //     $con = 'Connect Error'; // "error ".$conn->connect_error;
  // }
  return $con;
}

$postData = file_get_contents('php://input');
      
    //   echo '{"ResultCode": 0, "ResultDesc": "The service was accepted successfully", "ThirdPartyTransID": "1234567890"}';
  
    $con =  connect();
    
    // Step 1 : Log the response in table mpesa_calbacks
    $sql = "
            INSERT INTO `mpesa_callbacks`(`ip`, `caller`, `content`)
            VALUES( 'NULL','stk_push_callback', '$postData')
        ";

    $con->query($sql);

    $js = json_decode($postData);
    
     $merchantId = $js->Body->stkCallback->MerchantRequestID;
     $rscode = $js->Body->stkCallback->ResultCode;
     $amount = $js->Body->stkCallback->CallbackMetadata->Item[0]->Value;
     $msisdn = $js->Body->stkCallback->CallbackMetadata->Item[4]->Value;
     $trasid = $js->Body->stkCallback->CallbackMetadata->Item[1]->Value;
//       $amount = $jsData->Body['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
      // $msisdn = $jsData->Body['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
      // $trasid = $jsData->Body['stkCallback']['CallbackMetadata']['Item'][1]['Value'];

      // //get the customer details
      $sql_order = "
          SELECT `order_id` FROM `stk_push_payment_requests` WHERE `merchant_request_id`='$merchantId' limit 1 ";
      $rs_order = $con->query($sql_order);
      
      $order = '';
      for($a=0;$a<$rs_order->num_rows;$a++){
        $rs_order->data_seek($a);
        $order = $rs_order->fetch_assoc()['order_id'];
      }

      $sql_client = `
        SELECT
            clientaddress.fName,
            clientaddress.lName,
            clientaddress.phone
        FROM
            clientorders
        INNER JOIN clientaddress ON clientaddress.addressId = clientorders.addressId 
        WHERE clientorders.orderNumber='`.$order.` limit 1'
      `;

      $rs_client = $con->query($sql_client);
      $fn = $ln = $phone = '';

      for($a=0;$a<$rs_client->num_rows;$a++){
        $rs_client->data_seek($a); $fn = $rs_client->fetch_assoc()['fName'];
        $rs_client->data_seek($a); $ln = $rs_client->fetch_assoc()['lName'];
        $rs_client->data_seek($a); $phone = $rs_client->fetch_assoc()['phone'];
      }

      $sql_mpesa_repayments = "
        INSERT INTO `mpesa_repayments`(
            `identifier`,
            `amount`,
            `msisdn`,
            `transaction_id`,
            `first_name`,
            `middle_name`,
            `last_name`,
            `bill_reference`,
            `balance`
        )
        VALUES(
            'stkCallback',
            '".$amount."', 
            '".$msisdn."', 
            '".$trasid."', 
            '".$fn."', 
            '".$ln."', 
            '".$phone."', 
            '".$merchantId."', 
            'phone'
        )
        
      ";

      // $file2 = fopen("sql_mpesa_repaymentes.txt", "w"); //url fopen should be allowed for this to occur
      // if(fwrite($file2, $amount) === FALSE)
      // {
      //     fwrite("Error: no data written");
      // }
  
      // fwrite("\r\n");
      // fclose($file2);

      $con->query($sql_mpesa_repayments);
      if($con->error){
        $file1 = fopen("sql_mpesa_repayments_errorsfes.txt", "w"); //url fopen should be allowed for this to occur
            if(fwrite($file1, $con->error) === FALSE)
            {
                // fwrite("Error: no data written");
            }
        
            // fwrite("\r\n");
            fclose($file1);
      }

      //perform your processing here, e.g. log to file....
      $file = fopen("logs.txt", "w"); //url fopen should be allowed for this to occur
      if(fwrite($file, $postData) === FALSE)
      {
          fwrite("Error: no data written");
      }
  
      fwrite("\r\n");
      fclose($file);
  
    
  


?>