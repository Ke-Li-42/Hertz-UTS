<?php
    session_start();
    $emailContent = $_SESSION['emailContent'];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $state =  $_POST["state"];
    $postcode =  $_POST["postcode"];
    $payment =  $_POST["payment"];
    $content = "Hi $firstName, $lastName<br><br>$emailContent <br>Address: $address1 $address2, $state, $postcode<br/>Payment method: $payment<br/><br>";
    $subject = "Confirmation";
    mail($email, $subject, $content, "From:ke.li-1@student.uts.edu.au\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=ISO-8859-1\r\n");
    unset($_SESSION['cart']);
    unset($_SESSION['emailContent']);
    ?>

<?php include "header.php"; ?>
<div class="container">
<h4 class="text-center">Thanks for reservation. enjoy your trip</h4>
<br>
<?php echo $emailContent; ?>

<br>
<a class="btn btn-warning" href="index.php">Back to home</a>
</div>

