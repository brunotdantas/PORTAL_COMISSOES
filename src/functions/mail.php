
<?php

function mail_utf8($to, $from_user, $from_email,$subject = '(No subject)', $message = ''){

   $url = 'https://api.sendgrid.com/';
   $user = 'azure_f6c25ca15608caf53ad7245c49eaed74@azure.com';
   $pass = 'admin@123';

   $params = array(
        'api_user' => $user,
        'api_key' => $pass,
        'to' => $to,
        'subject' => $subject,
        'html' => $message,
        'text' =>  $message,
        'from' => $from_user,
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

   return
  }

?>
