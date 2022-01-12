<?php
 
if($_POST) {
    $name = "";
    $email = "";
    $email_subject = "Website Inquiry: General Contact Form!"
    $subject = "";
    $message = "";
    $recipient = "chas@radcraftsman.ca";
    $data = [];
     
    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Name:</b></label>&nbsp;<span>".$name."</span>
                        </div>";
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }
     
    if(isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Subject of message:</b></label>&nbsp;<span>".$subject."</span>
                        </div>";
    }
     
    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$message."</div>
                        </div>";
    }
     
    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
     
    if(mail($recipient, $email_subject, $email_body, $headers)) {
        $data['success'] = true;
        $data['message'] = "Thank you for contacting us, $name. You will get a reply within 24 hours";
        echo json_encode($data);
    } else {
        $data['success'] = false;
        $data['message'] = "We are sorry but the email did not go through, please try again";
        echo json_encode($data);
    }
     
} else {
    $data['success'] = false;
    $data['message'] = "Something went wrong";
    echo json_encode($data);
}
?>