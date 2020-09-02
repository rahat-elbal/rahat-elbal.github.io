<?php 
  ob_start();

	session_start();
?>
<meta charset="utf-8"/>
<meta name="description" content="">
<meta name="author" content="Mtioui Hamza">
<?php
error_reporting(E_ALL); ini_set("display_errors", '1');
// $errors = [];
  $errors = array(); // on crée une vérif de champs
if(!array_key_exists('nom', $_POST) || $_POST['nom'] == '') {// on verifie l'existence du champ et d'un contenu
  $errors ['nom'] = "vous n'avez pas renseigné votre nom";
  }
if(!array_key_exists('mail', $_POST) || $_POST['mail'] == '') {// on verifie l'existence du champ et d'un contenu
  $errors ['mail'] = "vous n'avez pas renseigné votre adresse mail";
  }
if(!array_key_exists('service', $_POST) || $_POST['service'] == '') {// on verifie existence de la clé
  $errors ['mail'] = "vous n'avez pas renseigné votre service";
  }
if(!array_key_exists('commentaire', $_POST) || $_POST['commentaire'] == '') {
  $errors ['commentaire'] = "vous n'avez pas renseigné votre message";
  }
/*if(array_key_exists('antispam', $_POST)) {// on place un petit filet anti robots spammers
  $errors ['antispam'] = "Vous êtes un robots spammer";
  }*/
//On check les infos transmises lors de la validation
  if(!empty($errors)){ // si erreur on renvoie vers la page précédente
  $_SESSION['errors'] = $errors;//on stocke les erreurs
  $_SESSION['inputs'] = $_POST;
  header('Location: ../contact.php');
  }else{
  $_SESSION['success'] = 1;
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $headers .= 'FROM:' . htmlspecialchars($_POST['mail']);
  $to = 'hamzamtioui@gmail.com'; // Insérer votre adresse email ICI
  $subject="UN MESSAGE DE CONTACT AGIRCALL";
  $content = '- Nom & Prénom: '.htmlspecialchars($_POST['nom']) .'<br> - Email: <i>' . htmlspecialchars($_POST['mail']) .'</i>';
  $message_content = '
  <b>Emetteur du message:</b><br>
  '. $content . '<br>
  <b>Contenu du message:</b><br>
  '. htmlspecialchars($_POST['commentaire']);
mail($to, $subject, $message_content, $headers);
  header('Location: ../contact.php');
  }
 ob_end_flush();?>
