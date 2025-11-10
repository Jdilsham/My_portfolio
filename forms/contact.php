<?php

// Your receiving email address
$receiving_email_address = 'janitha1717@gmail.com';

// Include the PHP Email Form library
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
  include($php_email_form);
} else {
  die('Unable to load the "PHP Email Form" Library!');
}

// Create the email form object
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set email details
$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// SMTP (Gmail)
$contact->smtp = array(
  'host' => 'smtp.gmail.com',
  'username' => 'janithadilsham@gmail.com',
  'password' => 'ptdazwhvnkfmuzli',
  'port' => '587'
);

// Add message fields
$contact->add_message($_POST['name'], 'Name');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Send email
echo $contact->send();

?>
