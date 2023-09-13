<?php

class SendMail
{
    public function send($data = [])
    {
        // init_set('display_errors', 1);
        // error_reporting(E_ALL);

        $from       = "admin@metas.co.id";
        $to         = $data['to'];
        $subject    = $data['title'];
        $message    = $data['message'];
        $headers    = "From: " . $from;

        mail($to, $subject, $message, $headers);
    }
}

/*
init_set('display_errors',1);
error_reporting(E_ALL);

$from 		= "admin@metas.co.id";
$to 		= "emailtujuan@mail.com";
$subject 	= "Judul pesan";
$message	= "isi pesan email disini";
$headers	= "From: ". $from;

mail($to,$subject,$message,$headers);
if (mail) {
	echo "pesan berhasil dikirim";
}
*/