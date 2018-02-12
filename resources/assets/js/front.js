$(document).ready(function () {

    // Ajout class supplémentaire aux tableaux
    $('#main #ajax-content table').addClass('table table-bordered');


    // Boutton navigation pour petit écran
    $('.navbar-toggle').on('click', function () {
        $('#bs-example-navbar-collapse-1').toggleClass('in');
    });

    $('#main').on('click', '.navbar .nav li a', function (e) {
        $('#bs-example-navbar-collapse-1').toggleClass('in');
    });

    // Navigation ajax
    var chargeUnefois = false;

    function pageTitle(value) {
        var title = $('title').attr('data-titre');
        $('title').html(title + " | " + value);
    }

    function showContent(url, title, element) {
        $('#main #ajax-content').html("");
        $("#main .loader").fadeIn("slow");
        $.get(url, function (data) {

           // $('html, body').scrollTop($('html, body')[0].scrollHeight);

            $("#main .loader").fadeOut("slow");
            $('#main #ajax-content').html(data);

            $('html, body').animate({ scrollTop: 0 }, 'slow');

            pageTitle(title);
            $('ul.nav a').removeClass('selected');
            if (element !== undefined)
                element.addClass('selected');


            $('#main #ajax-content table').addClass('table table-bordered');
            chargeUnefois = true;

        });
    }

    $('body').on('click', '.ajax', function (e) {
        e.preventDefault();
        var a = $(this);
        var url = a.attr('href');
        var title = a.attr('title');
        if(typeof title === 'undefined'){
            title=" Découvrer nos cours";
        };
        showContent(url, title, a);
        history.pushState({titre: title}, title, url);
        e.stopPropagation();
    });

    window.onpopstate = function (event) {
        if (event.state == null && chargeUnefois)
            showContent(document.location.pathname, 'Cours accessible à tous'); //window.location.reload();
        else
            showContent(document.location.pathname, event.state.titre);

    }
    //fin navigation ajax

});

