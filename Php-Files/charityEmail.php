<?php
$to      = 'stewartkey@hotmail.co.uk';
$subject = 'Remember to claim excess food!';
$message = "Just a friendly reminder from your friends at neighbourfood that local businesses have donated food you can claim for free!\n"
        . "Just load up your neighbourfoods app to see what you can get!"
        . "\n\n Many thanks,\nStewart\nCommunity Manager\ncommunitymanager@neighbourfoods.com";
$headers = 'From: claim@neighbourfood.com' . "\r\n" .
    'Reply-To: claim@neighbourfood.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 

