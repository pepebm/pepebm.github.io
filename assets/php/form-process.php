<?php
    require 'PHPMailer.php';
    require 'Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $errorMSG = "";

    // NAME
    if (empty($_POST["name"])) {
        $errorMSG = "Name is required \n";
    } else {
        $name = $_POST["name"];
    }

    // EMAIL
    if (empty($_POST["email"])) {
        $errorMSG .= "Email is required \n";
    } else {
        $email = $_POST["email"];
    }

    // File 1
    if (empty($_POST["file_upload_front"])) {
        $errorMSG .= "Front file is required \n";
    } else {
        $file_upload_front = $_POST["file_upload_front"];
    }

    // File 2
    if (empty($_POST["file_upload_back"])) {
        $errorMSG .= "Back file is required \n";
    } else {
        $file_upload_back = $_POST["file_upload_back"];
    }

    // Address
    if (empty($_POST["address"])) {
        $errorMSG .= "Address is required \n";
    } else {
        $address = $_POST["address"];
    }

    if ($errorMSG == "") {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            $sender = 'energias.renovables.pagina@gmail.com';
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $sender;                            // SMTP username
            $mail->Password = 'energiarenovable1';                // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($sender, 'Mailer');
            $mail->addAddress('jm.beauregard26@gmail.com');      // Add a recipient
            //Attachments
            $mail->addAttachment($file_upload_front);             // Add attachments
            $mail->addAttachment($file_upload_back);              // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Cliente potencial';
            $mail->Body    = "Nombre: $name\nCorreo: $email\nDirección: $address";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        if($errorMSG == ""){
            echo "Something went wrong :(";
        } else {
            echo $errorMSG;
        }
    }
?>