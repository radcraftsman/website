<?php
 
if($_POST) {
    $name = "";
    $email = "";
    $subject = "Website Inquiry: Specific Table Ordered!";
    $table = "";
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
     
    if(isset($_POST['table'])) {
        $table = filter_var($_POST['table'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>The table that the customer inquired about:</b></label>&nbsp;<span>".$table."</span>
                        </div>";
    }
     
    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
     
    if(mail($recipient, $subject, $email_body, $headers)) {
        $data['success'] = true;
        $data['message'] = "Thank you for contacting us, $name. We will get back to you within 24 hours";
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