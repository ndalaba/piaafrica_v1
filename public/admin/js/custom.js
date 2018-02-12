/* MEDIA JA */

$(document).ready(function () {
    /*====================================
     METIS MENU
     ======================================*/
    $('#main-menu').metisMenu();
    /*======================================
     LOAD APPROPRIATE MENU BAR ON SIZE SCREEN
     ========================================*/
    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
        }
    });
    //Set active menu
    var activeMenu = function () {
        var menu = ['home', 'sections', 'users', 'pub', 'entreprises', 'articles', 'realisations', 'annonces','lettres'];
        menu.forEach(function (value) {
            if ($('#page-wrapper .' + value).length) {
                $('#main-menu li a').removeClass('active-menu');
                $('#main-menu li ul').removeClass('in');
                $('#main-menu #' + value).addClass('active-menu');
                $('#main-menu #' + value).parent('li').find('ul').addClass('in');
            }
        });
    };
    activeMenu();
    // select all
    $('#select_all').change(function () {
        var checkboxes = $(this).closest('form').find(':checkbox');
        if ($(this).is(':checked')) {
            checkboxes.prop('checked', true);
        } else {
            checkboxes.prop('checked', false);
        }
    });

    /*======================================
     NAVIGATION AJAX
     ========================================*/
    var chargeUnefois = false;

    function pageTitle(value) {
        var title = $('title').attr('data-titre');
        $('title').html(title + " | " + value);
    }

    function showContent(url, title, element) {
        $('#page-wrapper').fadeOut(500, function () {
            $.get(url, function (data) {
                $('#page-wrapper').html(data);
                pageTitle(title);
                $('ul.nav a').removeClass('selected');
                if (element !== undefined) element.addClass('selected');
                $('#page-wrapper').fadeIn(500);
                chargeUnefois = true;
                $('html, body').animate({scrollTop: 0}, 'fast');
            });
        });
    }

    $('#country_id').on('change', function () {
        var country_id = $('#country_id').find(":selected").val();
        $.getJSON($url + '/villes/' + country_id, function (data) {
            if (data.length) {
                $('#ville_id').show();
                $('#ville').val('').hide();
                if (document.getElementById("ville") != null || document.getElementById("ville") != undefined)
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
                if (document.getElementById("ville") != null || document.getElementById("ville") != undefined)
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

$('.image-preview-input input:file').change(function () {
    var file = this.files[0];
    var reader = new FileReader();
    var datanum = $(this).data('num');
    reader.onload = function (e) {
        $("." + datanum).text(file.name);
    }
    reader.readAsDataURL(file);
});

$('body').on('click', '.deleteEntreprise', function (e) {
    if (!confirm("Êtes vous sur de vouloir supprimer cette entreprise?"))
        e.preventDefault();
});
})
;
