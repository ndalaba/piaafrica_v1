/**
 * Created by ndalaba on 05/10/16.
 */
function loadfile(e, id) {
    var file = e.files[0];
    if (e.files && file) {
        var extensions = ['png', 'gif', 'jpg', 'jpeg', 'pdf', 'doc', 'docx'];
        var extension = file.name.split('.').pop();
        if (extensions.indexOf(extension) == -1) {
            return alert('Format de fichier invalide');
        }
       if (file.size > $image_size) {
            return alert("Taille fichier suppérieure à " + $image_size_help);
        }
        document.querySelector(id).innerText = file.name;
    }
}

$("document").ready(function ($) {
    $('#newsletter').submit(function (e) {
        e.preventDefault();
        var self = this;
        var email = $(self).find('#news_email').val();
        var token = $(self).find('.token').val();
        $.post($url + '/newsletters/subscribe', {'email': email, '_token': token}, function (response) {
            var rep = JSON.parse(response);
            if (rep.response == 1) {
                alert(rep.message);
                $(self).find('#news_email').val('');
            }
            else
                alert(rep.message);
        });
    });
    $('#categories ul  li a').click(function () {
        var url = $(this).attr('href');
        window.location.replace(url);
    });
    //SHARE
    var popupCenter = function (url, title, width, height) {
        var popupWidth = width || 640;
        var popupHeight = height || 320;
        var windowLeft = window.screenLeft || window.screenX;
        var windowTop = window.screenTop || window.screenY;
        var windowWidth = window.innerWidth || document.documentElement.clientWidth;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        var popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2;
        var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
        var popup = window.open(url, title, 'scrollbars=yes, width=' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop + ', left=' + popupLeft);
        popup.focus();
        return true;
    };
    if (document.querySelector('.share_twitter') != null) {
        document.querySelector('.share_twitter').addEventListener('click', function (e) {
            e.preventDefault();
            var url = this.getAttribute('data-url');
            var shareUrl = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) +
                "&via=Pia Africa" +
                "&url=" + encodeURIComponent(url);
            popupCenter(shareUrl, "Partager sur Twitter");
        });

        document.querySelector('.share_facebook').addEventListener('click', function (e) {
            e.preventDefault();
            var url = this.getAttribute('data-url');
            var shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
            popupCenter(shareUrl, "Partager sur facebook");
        });

        document.querySelector('.share_gplus').addEventListener('click', function (e) {
            e.preventDefault();
            var url = this.getAttribute('data-url');
            var shareUrl = "https://plus.google.com/share?url=" + encodeURIComponent(url);
            popupCenter(shareUrl, "Partager sur Google+");
        });

        document.querySelector('.share_linkedin').addEventListener('click', function (e) {
            e.preventDefault();
            var url = this.getAttribute('data-url');
            var shareUrl = "https://www.linkedin.com/shareArticle?url=" + encodeURIComponent(url);
            popupCenter(shareUrl, "Partager sur Linkedin");
        });
    }
    $('.deleteEntreprise').click(function (e) {
        if (!confirm("Votre entreprise  sera supprimée que si elle ne contient aucune d'information liée (SERVICES, RÉALISATIONS) "))
            e.preventDefault();
    });
    $('.deleteAnnonce').click(function (e) {
        if (!confirm("Votre annonce  sera supprimée "))
            e.preventDefault();
    });
    $('#country_id').on('change', function () {
        var country_id = $('#country_id').find(":selected").val();
        $.getJSON($url + '/villes/' + country_id, function (data) {
            if (data.length) {
                $('#ville_id').show();
                $('#ville').val('').hide();
                document.getElementById("ville").required = false;
                $('#ville_id').html('').append('<option value="">Ville</option>');
                $.each(data, function () {
                    $("#ville_id").append('<option value="' + this.id + '">' + this.ville + '</option>');
                });
                $("#ville_id").append('<option value="0">Autre</option>');
            }
            else {
                $('#ville_id').hide();
                document.getElementById("ville_id").required = false;
                $('#ville').show();
                document.getElementById("ville").required = true;
            }
        });
    });
    $('#ville_id').on('change', function () {
        var ville = $('#ville_id').find(":selected").val();
        if (ville == 0) {
            $('#ville').show();
            document.getElementById("ville").required = true;
        }
        else {
            $('#ville').val('').hide();
            document.getElementById("ville").required = false;
        }
    });

    $('#frm_search  #frm_search_country').on('change', function () {
        var country_id = $('#frm_search  #frm_search_country').find(":selected").val();
        $.getJSON($url + '/cities/' + country_id, function (data) {
            $('#frm_search  #frm_search_ville').html('').append('<option value="">Ville</option>');
            $.each(data, function () {
                $("#frm_search  #frm_search_ville").append('<option value="' + this.ville + '">' + this.ville + '</option>');
            });
        });
        $.getJSON($url + '/entreprises/' + country_id, function (data) {
            $('#frm_search  #frm_search_entreprise').html('').append('<option value="">Entreprises</option>');
            $.each(data, function () {
                $("#frm_search  #frm_search_entreprise").append('<option value="' + this.slug + '">' + this.name + '</option>');
            });
        });
    });
});



