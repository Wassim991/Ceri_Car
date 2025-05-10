$(document).ready(function () {
    // Gestion de la recherche via Ajax
    $('#btnrecherche').on('click', function (e) {
        e.preventDefault();

        var form = $('#recherche-form');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                $('#results-container').html(response.html);
                updateNotification(response.message, response.type);
            },
            error: function () {
                updateNotification('Une erreur est survenue lors de la recherche.', 'danger');
            }
        });
    });

    // Gestion du login via Ajax
    $('#login-button').on('click', function (e) {
        e.preventDefault(); // Empêcher l'envoi classique du formulaire

        var form = $('#login-form');
        console.log('Envoi de la requête AJAX :', form.serialize());

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                console.log('Réponse AJAX reçue :', response);

                if (response.html) {
                    $('#ajax-content').html(response.html);
                }

                if (response.message) {
                    updateNotification(response.message, response.type);
                }

                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 2000);
                }
            },
            error: function () {
                updateNotification('Une erreur est survenue lors de la connexion.', 'danger');
            }
        });
    });

    // Gestion de la déconnexion via Ajax
    $('#logout-button').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).closest('form').attr('action'),
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log('Réponse AJAX reçue :', response);

                if (response.message) {
                    updateNotification(response.message, response.type);
                }

                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erreur AJAX :', status, error);
                console.error('Code de statut HTTP :', xhr.status);
                console.error('Réponse du serveur :', xhr.responseText);
                updateNotification('Une erreur est survenue lors de la déconnexion.', 'danger');
            }
        });
    });

    // Gestion de l'inscription via Ajax
    $('#inscription-form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                console.log('Réponse AJAX reçue :', response);

                if (response.html) {
                    $('#ajax-content').html(response.html);
                }

                if (response.message) {
                    updateNotification(response.message, response.type);
                }

                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erreur AJAX :', status, error);
                console.error('Code de statut HTTP :', xhr.status);
                console.error('Réponse du serveur :', xhr.responseText);
                updateNotification('Une erreur est survenue lors de l\'inscription.', 'danger');
            }
        });
    });

    // Gestion de la réservation via Ajax
    $('#reservation-form').on('submit', function (e) {
        e.preventDefault(); // Empêcher l'envoi classique du formulaire

        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                console.log('Réponse AJAX reçue :', response);

                if (response.html) {
                    $('#ajax-content').html(response.html); // Insérer la vue partielle reçue
                }

                if (response.message) {
                    updateNotification(response.message, response.type);
                }

                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect; // Redirection après 2 secondes
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erreur AJAX :', status, error);
                updateNotification('Une erreur est survenue lors de la réservation.', 'danger');
            }
        });
    });
    $('#proposer-voyage-form').on('submit', function (e) {
        e.preventDefault(); // Empêcher l'envoi classique du formulaire

        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                console.log('Réponse AJAX reçue :', response);

                if (response.message) {
                    updateNotification(response.message, response.type);
                }

                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect; // Redirection après 2 secondes
                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erreur AJAX :', status, error);
                updateNotification('Une erreur est survenue lors de la proposition du voyage.', 'danger');
            }
        });
    });

    // Fonction pour mettre à jour le bandeau de notification
    function updateNotification(message, type) {
        var banner = $('#notification-banner');
        banner
            .removeClass('alert-success alert-danger alert-warning alert-info')
            .addClass('alert alert-' + type)
            .text(message)
            .stop(true, true)
            .fadeIn()
            .delay(3000)
            .fadeOut();
    }
});
