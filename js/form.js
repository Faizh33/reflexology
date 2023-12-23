$(document).ready(function() {
    // Intercepter la soumission du formulaire
    $("#contactForm").submit(function(event) {
        event.preventDefault();

        // Sérialiser les données du formulaire
        var formData = $(this).serialize();

        // Envoyer les données du formulaire via Ajax
        $.ajax({
            type: "POST",
            url: "contact.php",
            data: formData,
            dataType: 'json', 
            success: function(response) {
                if (response.success !== null) {
                    // Afficher la div de succès ou d'erreur en fonction de la réponse
                    if (response.success) {
                        $("#successContainer").css("display", "inline-block");
                        $("#name, #email, #subject, #comment").val('');
                    } else {
                        $("#errorContainer").html("Erreur lors de l'envoi du message.");
                        $("#errorContainer").css("display", "inline-block");
                    }
                } else {
                    console.error("Réponse du serveur invalide.");
                }
            },            
            error: function(xhr, textStatus, errorThrown) {
                console.error("Erreur Ajax :", errorThrown);
            }
        });
    });
});