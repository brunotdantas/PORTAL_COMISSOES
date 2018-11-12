
<?php


  $sql = " select * from param_portal where nomeParam = 'api_key_email'  ";

  $resultado = sqlsrv_query( $conn, $sql);

  if(sqlsrv_has_rows($resultado)){
    while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){

     $email_usuario = $row["conteudo_campo1"];
     $email_senha = $row["conteudo_campo2"];
     $apiKey = $row["conteudo_campo3"];

   }
  }

  define('KEY_API_EMAIL', $apiKey);
  define('USUARIO_API_EMAIL', $email_usuario);
  define('SENHA_API_EMAIL', $email_senha);

function mail_utf8($to, $from_email,$subject = '(No subject)', $message = ''){

   $url = 'https://api.sendgrid.com/';
   $user = USUARIO_API_EMAIL;//'azure_f6c25ca15608caf53ad7245c49eaed74@azure.com';
   $pass = SENHA_API_EMAIL;

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

?>
