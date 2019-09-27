<?php
$to = "santosh.olive626@gmail.com";
$subject = "Test Mail";
$message = "Hello! This is an email message from php script";
$from = "noreply@dalmiacement.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent to recipient.";
?>