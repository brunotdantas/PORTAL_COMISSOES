
<?php

function mail_utf8($to, $from_email,$subject = '(No subject)', $message = ''){

     $connectionInfo = array( "Database"=>DB_DATABASE, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
     $conn = sqlsrv_connect( DB_SERVER, $connectionInfo);

     if( !$conn ) {
         // Se não conseguir logar com .\SQLEXPRESS
         $connectionInfo = array( "Database"=>DB_DATABASE, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
         $conn = sqlsrv_connect( 'localhost', $connectionInfo);
     }

     if (!$conn){
         echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
     }

    $sql = " select * from param_portal where nomeParam = 'api_key_email'  ";

    $resultado = sqlsrv_query( $conn, $sql);

    if(sqlsrv_has_rows($resultado)){
      while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){

       $email_usuario = $row["conteudo_campo1"];
       $email_senha = $row["conteudo_campo2"];
       $apiKey = $row["conteudo_campo3"];

     }
    }else{
      echo 'Não tem resultado para :  select * from param_portal where nomeParam = api_key_email ';
    }

   $url = 'https://api.sendgrid.com/';
   $user = $email_usuario;//'azure_f6c25ca15608caf53ad7245c49eaed74@azure.com';
   $pass = $email_senha;

   $params = array(
        'api_user' => $user,
        'api_key' => $pass,
        'to' => $to,
        'subject' => $subject,
        'html' => $message,
        'text' =>  $message,
        'from' => $from_email,
     );

   $request = $url.'api/mail.send.json';

   // Generate curl request
   $session = curl_init($request);

   // Tell curl to use HTTP POST
   curl_setopt ($session, CURLOPT_POST, true);

   // Tell curl that this is the body of the POST
   curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

   // Tell curl not to return headers, but do return the response
   curl_setopt($session, CURLOPT_HEADER, false);
   curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

   // obtain response
   $response = curl_exec($session);
   curl_close($session);

   // print everything out
   print_r($response);


  }
//}else{
//  echo "Não existem configurações na tabela para realizar o envio do email";
//  die();
//}
?>
