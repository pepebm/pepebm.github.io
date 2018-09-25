<?php
    # Include the Autoloader (see "Libraries" for install instructions)
    require 'vendor/autoload.php';
    use Mailgun\Mailgun;
    $errorMSG = "";

    // NAME
    if (empty($_POST["name"])) {
        $errorMSG = "Name is required ";
    } else {
        $name = $_POST["name"];
    }

    // EMAIL
    if (empty($_POST["email"])) {
        $errorMSG .= "Email is required ";
    } else {
        $email = $_POST["email"];
    }

    // File
    if (empty($_POST["file_upload"])) {
        $errorMSG .= "Subject is required ";
    } else {
        $file_upload = $_POST["file_upload"];
    }

    // MESSAGE
    if (empty($_POST["message"])) {
        $errorMSG .= "Message is required ";
    } else {
        $message = $_POST["message"];
    }

    # Instantiate the client.
    $mgClient = new Mailgun('b371525014bd88b72ba010582ff1d3a3-b0aac6d0-2b41ea2e');
    $domain = "sandbox8e7cce5697b2436490e272e79da1dd07.mailgun.org";

    # Make the call to the client.
    $result = $mgClient->sendMessage("$domain",
            array('from'       => 'Nuevo cliente potencial' . $from,
                    'to'         => 'Energias renovables <mario.energiarenovable@gmail.com>',
                    'subject'    => 'Página web',
                    'text'       => $name . " está interesado en nuestro servicio.\n Mensaje del cliente\n" . $message,
                    'attachment' => [
                        ['fileContent' => $file_upload]
                    ]
                ));

    // redirect to success page
    if ($result && $errorMSG == "") {
        echo "success";
    } else {
        if($errorMSG == ""){
            echo "Something went wrong :(";
        } else {
            echo $errorMSG;
        }
    }
?>