<?php

if ($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $email_subject = "";
    $visitor_message = "";
    $email_body = "<div>";

    if (isset($_POST['InputName'])) {
        $visitor_name = filter_var($_POST['InputName'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>" . $visitor_name . "</span>
                        </div>";
    }

    if (isset($_POST['InputEmail'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['InputEmail']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>" . $visitor_email . "</span>
                        </div>";
    }

    if (isset($_POST['InputSubject'])) {
        $email_subject = filter_var($_POST['InputSubject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>" . $email_subject . "</span>
                        </div>";
    }

    if (isset($_POST['InputMessage'])) {
        $visitor_message = htmlspecialchars($_POST['InputMessage']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>" . $visitor_message . "</div>
                        </div>";
    }

    $recipient = "tahmidimran1@gmail.com";
    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $visitor_email . "\r\n";

    if (mail($recipient, $email_subject, $email_body, $headers)) {
        echo "<p>Thank you for contacting me, $visitor_name.</p>";
    } else {
        echo '<p>Sorry, you\'re email did not go through.</p>';
    }
} else {
    echo '<p>Something went wrong</p>';
}
