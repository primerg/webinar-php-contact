<?php
  class ContactsController {
    public function index() {
      $message_type = '';
      $message = '';

      if (isset($_POST['email'])) {
        // EDIT THE 2 LINES BELOW AS REQUIRED
        $email_to = "rachel@koodi.ph";
        $email_subject = "Contact form";
     
        // validation expected data exists
     
        if (!isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['message'])) {
          $message = $this->error('We are sorry, but there appears to be a problem with the form you submitted.');
          $message_type = 'error';
          return view('views/contacts/index.php', compact('message', 'message_type'));
        }
     
        $first_name = $_POST['name']; // required
        $email_from = $_POST['email']; // required
        $comments = $_POST['message']; // required
     
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
     
        if(!preg_match($email_exp,$email_from)) {
          $message .= 'The Email Address you entered does not appear to be valid.<br />';
        }
     
        $string_exp = "/^[A-Za-z .'-]+$/";
     
        if(!preg_match($string_exp,$first_name)) {
          $message .= 'The First Name you entered does not appear to be valid.<br />';
        }
     
        if(strlen($comments) < 2) {
          $message .= 'The Comments you entered do not appear to be valid.<br />';
        }

        if (strlen($message) > 0) {
          $message = $this->error($error_message);
          $message_type = 'error';
          return view('views/contacts/index.php', compact('message', 'message_type'));
        }
     
        $email_message = "Form details below.\n\n";
        $email_message .= "Name: ". $this->clean_string($first_name)."\n";
        $email_message .= "Email: ". $this->clean_string($email_from)."\n";
        $email_message .= "Comments: ". $this->clean_string($comments)."\n";
     
        // create email headers
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         
        @mail($email_to, $email_subject, $email_message, $headers);  

        $message = 'Thank you for contacting us. We will be in touch with you very soon.';
        $message_type = 'success';
      }

      return view('views/contacts/index.php', compact('message', 'message_type'));
    }

    function error($error) {
     
      return "We are very sorry, but there were error(s) found with the form you submitted. " .
            "These errors appear below.<br /><br />" . 
            $error."<br /><br />" . 
            "Please go back and fix these errors.<br /><br />";
     
    }

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
  }