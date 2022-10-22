<?php 
	
	//Import PHPMailer classes into the global namespace
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;

	require 'vendor/autoload.php';

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-with");
		
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$data = json_decode(file_get_contents("php://input"));

		$name = $data["name"];
		$email = $data["email"];
		$number = $data["phone"];
		$option = $data["select_option"];

		//Create a new PHPMailer instance
		$mail = new PHPMailer();

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		//SMTP::DEBUG_OFF = off (for production use)
		//SMTP::DEBUG_CLIENT = client messages
		//SMTP::DEBUG_SERVER = client and server messages
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
		//if your network does not support SMTP over IPv6,
		//though this may cause issues with TLS

		//Set the SMTP port number:
		// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
		// - 587 for SMTP+STARTTLS
		$mail->Port = 465;

		//Set the encryption mechanism to use:
		// - SMTPS (implicit TLS on port 465) or
		// - STARTTLS (explicit TLS on port 587)
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = 'etimdaniel08@gmail.com';

		//Password to use for SMTP authentication
		$mail->Password = 'P@$sw0rd1';

		//Set who the message is to be sent from
		//Note that with gmail you can only use your account address (same as `Username`)
		//or predefined aliases that you have configured within your account.
		//Do not use user-submitted addresses in here
		$mail->setFrom('etimdaniel08@gmail.com');

		//Set an alternative reply-to address
		//This is a good place to put user-submitted addresses
		$mail->addAddress($email, $name);

		//Set the subject line
		$mail->Subject = 'PHPMailer GMail SMTP test';

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML("<h3>Hello {$name}, {$number}</h3>");

		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';

		$msg = "";

		//send the message, check for errors
		if (!$mail->send()) {
		    $msg = 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    $msg = 'Message sent!';
		    //Section 2: IMAP
		    //Uncomment these to save your message in the 'Sent Mail' folder.
		    #if (save_mail($mail)) {
		    #    echo "Message saved!";
		    #}
		}

		echo json_encode($msg);

	}