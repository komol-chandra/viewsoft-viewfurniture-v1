$('.iconpicker').iconpicker();
    $('.iconpicker').on('change', function(e) {
        $(".icon").val(e.icon);
    });