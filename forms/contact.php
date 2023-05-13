<?php
if(isset($_POST['email'])) {

    // Adresse email où sera envoyé le message
    $email_to = "jeaneudes.gbada@gmail.com";

    $email_subject = "Nouveau message depuis le formulaire de contact";

    function died($error) {
        // Les erreurs de formulaire s'afficheront ici
        echo "Nous sommes désolés, mais il y a eu des erreurs dans votre formulaire. ";
        echo "Ces erreurs apparaissent ci-dessous.<br /><br />";
        echo $error."<br /><br />";
        echo "Merci de corriger ces erreurs et de réessayer.<br /><br />";
        die();
    }

    // validation des données entrées par l'utilisateur
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('Nous sommes désolés, mais il semble y avoir un problème avec le formulaire que vous avez soumis.');       
    }

    $name = $_POST['name']; // champ requis
    $email_from = $_POST['email']; // champ requis
    $subject = $_POST['subject']; // champ requis
    $message = $_POST['message']; // champ requis

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'L\'adresse e-mail que vous avez saisie ne semble pas être valide.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Le nom que vous avez saisi ne semble pas être valide.<br />';
  }
  if(strlen($message) < 2) {
    $error_message .= 'Le message que vous avez saisi ne semble pas être valide.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Détails du formulaire ci-dessous.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Nom: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Objet: ".clean_string($subject)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

  // Création de l'en-tête du mail  
  $headers = 'From: '.$email_from."\r\n".
  'Reply-To: '.$email_from."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  @mail($email_to, $email_subject, $email_message, $headers);   
  ?>

  <!-- Le message de confirmation s'affichera ici
  Merci de nous avoir contacté. Nous vous répondrons sous peu. -->

  <?php
  }
  ?>















  
