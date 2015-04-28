<?php
$to      = 'stewartkey@hotmail.co.uk';
$subject = 'Remember to donate your excess food!';
$message = "Just a friendly reminder from your friends at neighbourfoods to donate any excess food you have.\n"
        . "Theres a lot of local charities in your area in need of what you would just throw in the trash\n"
        . "Just load up your neighbour foods app to donate your food today!"
        . "\n\n Many thanks,\nStewart\nCommunity Manager\ncommunitymanager@neighbourfoods.com";
$headers = 'From: donate@neighbourfoods.com' . "\r\n" .
    'Reply-To: donate@neighbourfoods.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 