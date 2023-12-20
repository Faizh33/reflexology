<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fonction de nettoyage des données
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Vérification du nom et prénom
    if (empty($_POST["name"])) {
        $errors[] = "Le nom et prénom sont obligatoires.";
    } else {
        $name = clean_input($_POST["name"]);
    }

    // Vérification de l'adresse e-mail
    if (empty($_POST["email"])) {
        $errors[] = "L'adresse e-mail est obligatoire.";
    } else {
        $email = clean_input($_POST["email"]);
        // Vérifier si c'est une adresse e-mail valide
        if (!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i", $_POST['email'])){
            $errors[] = "L'adresse e-mail n'est pas valide.";
        }
    }

    // Vérification du sujet
    if (empty($_POST["subject"])) {
        $errors[] = "Le sujet est obligatoire.";
    } else {
        $subject = clean_input($_POST["subject"]);
    }

    // Vérification du commentaire
    if (empty($_POST["comment"])) {
        $errors[] = "Le commentaire est obligatoire.";
    } else {
        $comment = clean_input($_POST["comment"]);
    }

    $to = "reflexolm@gmail.com";

    // Sujet de l'e-mail
    $email_subject = "Nouveau message du formulaire de contact: $subject";

    // Corps de l'e-mail
    $email_body = "<html><body>";
    $email_body .= "<p>Nom et Prénom: $name</p>";
    $email_body .= "<p>Adresse Email: $email</p>";
    $email_body .= "<p>Sujet: $subject</p>";
    $email_body .= "<p>Commentaire:<br>$comment</p>";
    $email_body .= "</body></html>";

    // Entêtes de l'e-mail
    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = "From: $email";
    
    // Ajout de sauts de ligne entre chaque headers
    $headers = implode("\r\n", $headers);

    // Envoi de l'e-mail
    $mail_success = mail($to, $email_subject, $email_body, $headers);

    // Retourner le succès ou l'échec de l'envoi du courriel
    echo json_encode(['success' => $mail_success]);
} else {
    // Retourner les erreurs sous forme de chaîne JSON
    echo json_encode(['success' => false, 'errors' => $errors]);
}
?>