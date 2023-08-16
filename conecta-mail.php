<?php
//	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	$mail->isSMTP();                                            // Send using SMTP
	$mail->Host       = 'c2470538.ferozo.com';                  // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	$mail->SMTPSecure = "ssl";
	$mail->Username   = 'sistema@esculturas.org.mx';            // SMTP username
	$mail->Password   = 'Izuly@2022';                         // SMTP password
	$mail->Port       = 465;  

?>