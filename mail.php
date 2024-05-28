<?php

    // POST Request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
			$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $number = trim($_POST["number"]);
        $website = trim($_POST["website"]);
        $subject = trim($_POST["subject"]);
        $address = trim($_POST["address"]);
        $select_opt = trim($_POST["select_opt"]);
        $comment = trim($_POST["comment"]);

        // Check sent to the mailer.
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please Fillup the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "info@example.com";

        // Set the email sub.
        $sub = "Mail contact from $name";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Number: $num\n\n";
        $email_content .= "Number: $website\n\n";
        $email_content .= "Number: $subject\n\n";
        $email_content .= "Number: $address\n\n";
        $email_content .= "select_opt_2: $select_opt_2\n\n";
        $email_content .= "select_opt: $select_opt\n\n";
        $email_content .= "Comment:\n$comment\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
		$okk = mail($recipient, $email_headers, $email_content);
        if ( $okk ) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your comment has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your comment.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
