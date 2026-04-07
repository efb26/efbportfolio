<?php
if(isset($_POST['Email'])) {

    $email_to = "enzo.brockmeyer@gmail.com"; // CHANGE THIS to your real email
    $email_subject = "Portfolio Contact Form Submission";

    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted.";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // SECTION A - assign variables to fields posted from form
    $FirstName  = $_POST['FirstName'];  // required
    $LastName   = $_POST['LastName'];   // required
    $City       = $_POST['City'];       // NOT required
    $ST         = $_POST['ST'];         // NOT required
    $Zip        = $_POST['Zip'];        // NOT required
    $email_from = $_POST['Email'];      // required
    $Gender     = $_POST['Gender'];     // NOT required
    $Education  = $_POST['Education'];  // NOT required
    $Comments   = $_POST['Comments'];   // required

    // Basic validation for required fields
    if(empty($FirstName)) { died('Please enter your first name.'); }
    if(empty($LastName))  { died('Please enter your last name.'); }
    if(empty($email_from) || !filter_var($email_from, FILTER_VALIDATE_EMAIL)) {
        died('Please enter a valid email address.');
    }
    if(empty($Comments))  { died('Please enter a comment or message.'); }

    function clean_string($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    // SECTION B - build the email body
    $email_message  = "New contact form submission from your portfolio site:\n\n";
    $email_message .= "First Name:  " . clean_string($FirstName)  . "\n";
    $email_message .= "Last Name:   " . clean_string($LastName)   . "\n";
    $email_message .= "City:        " . clean_string($City)        . "\n";
    $email_message .= "State:       " . clean_string($ST)          . "\n";
    $email_message .= "Zip:         " . clean_string($Zip)         . "\n";
    $email_message .= "Email:       " . clean_string($email_from)  . "\n";
    $email_message .= "Gender:      " . clean_string($Gender)      . "\n";
    $email_message .= "Education:   " . clean_string($Education)   . "\n";
    $email_message .= "Comments:\n"   . clean_string($Comments)    . "\n";

    // Build email headers
    $headers = 'From: ' . $email_from . "\r\n" .
               'Reply-To: ' . $email_from . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    @mail($email_to, $email_subject, $email_message, $headers);
?>
<html>
<head>
    <meta http-equiv="REFRESH" content="1;url=contactSent.htm">
</head>
<body></body>
</html>
<?php
}
die();
?>