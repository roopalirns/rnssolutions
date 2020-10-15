<?php
require 'dbconnection.php';

$errors = [];
$errorMessage = '';
if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $emailSubject = $_POST['subject'];
    $message = $_POST['msg'];
    if (empty($name)) {
        $errors[] = 'Name is empty';
    }
    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($message)) {
        $errors[] = 'Message is empty';
    }

    if (empty($emailSubject)) {
        $errors[] = 'Subject is empty';
    }

    if (empty($errors)) {
        $toEmail = 'roopali07@gmail.com';
        //$emailSubject = 'New email from your contant form';
        $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=iso-8859-1'];

        $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
        $body = join(PHP_EOL, $bodyParagraphs);
        if (mail($toEmail, $emailSubject, $body, $headers)) {
            $qry = "insert into contactus (name,email,phone,subject,message) values ('$name','$email','$phone','$emailSubject','$message')";
            $sql = mysqli_query($con, $qry);
            header('Location: contact.html');
        } else {
            $errorMessage = 'Oops, something went wrong. Please try again later';
        }
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
}

?>
