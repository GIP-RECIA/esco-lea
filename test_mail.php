<?php


$destinataire = 'faoamier@yahoo.fr';
// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
$expediteur = 'faoamier@yahoo.fr';
$copie = 'faoamier@yahoo.fr';
$copie_cachee = 'faoamier@yahoo.fr';
$objet = 'Test'; // Objet du message
$headers  = 'MIME-Version: 1.0' . "\r\n"; // Version MIME
$headers .= 'Reply-To: '.$expediteur."\r\n"; // Mail de reponse
$headers .= 'From: '.$expediteur."\r\n"; // Expediteur
$headers .= 'Delivered-to: '.$destinataire."\r\n"; // Destinataire
$headers .= 'Cc: '.$copie."\r\n"; // Copie Cc
$headers .= 'Bcc: '.$copie_cachee."\r\n\r\n"; // Copie cachée Bcc		
$message = 'Un Bonjour de Developpez.com!';
if (mail($destinataire, $objet, $message, $headers)) // Envoi du message
{
	echo 'Votre message a bien été envoyé ';
}
else // Non envoyé
{
	echo "Votre message n'a pas pu être envoyé";
}



phpinfo();
?>