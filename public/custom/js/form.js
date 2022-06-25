(function ($) {
    "use strict";

    /*----------------------------	
      		product form  submit using ajax
    	------------------------------*/
    $("#productForm").on("submit", function (e) {
        e.preventDefault();
        var instance = $(".content").val();

        if (instance != null) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }

        var btnhtml = $(".formBtn").html();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").attr("disabled", "");
                $(".formBtn").html(
                    '<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>Please Wait....'
                );
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                Sweet("success", response);
                $(".formBtn").html(btnhtml);
                success(response);
            },
            error: function (xhr, status, error) {
                $(".formBtn").removeAttr("disabled");
                $(".formBtn").html(btnhtml);

                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*----------------------------	
      	 ajax	form submit using id
    	------------------------------*/
    $("#ajaxForm").on("submit", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").attr("disabled", "");
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                Sweet("success", response);

                success(response);
            },
            error: function (xhr, status, error) {
                $(".formBtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*----------------------------	
      		ajax form submit using class 
    	------------------------------*/
    $(".ajaxForm").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formBtnHtml = $(".formBtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").html(
                    '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Please Wait....'
                );
                $(".formBtn").attr("disabled", "");
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                Sweet("success", response);
                $(".formBtn").html(formBtnHtml);
                success(response);
            },
            error: function (xhr, status, error) {
                $(".formBtn").html(formBtnHtml);
                $(".formBtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*--------------------------------------	
      		ajax form  submit With Reload using class 
    	---------------------------------------*/
    $(".ajaxFormReload").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formBtnHtml = $(".formBtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").html(
                    '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Please Wait....'
                );
                $(".formBtn").attr("disabled", "");
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                Sweet("success", response);
                $(".formBtn").html(formBtnHtml);
                setTimeout(window.location.reload.bind(window.location), 1000);
            },
            error: function (xhr, status, error) {
                $(".formBtn").html(formBtnHtml);
                $(".formBtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*--------------------------------------	
      		ajax form submit With Reset using class 
    	---------------------------------------*/
    $(".ajaxFormReset").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formBtnHtml = $(".formBtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").html(
                    '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Please Wait....'
                );
                $(".formBtn").attr("disabled", "");
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                Sweet("success", response);
                $(".formBtn").html(formBtnHtml);
                $(".ajaxFormReset").trigger("reset");
            },
            error: function (xhr, status, error) {
                $(".formBtn").html(formBtnHtml);
                $(".formBtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*--------------------------------------	
      		ajax form submit With Remove
    	---------------------------------------*/
    $(".ajaxFormRemove").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formBtnHtml = $(".formBtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").html("Please Wait....");
                $(".formBtn").attr("disabled", "");
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                Sweet("success", response);
                $(".formBtn").html(formBtnHtml);
                $('input[name="ids[]"]:checked').each(function (i) {
                    var ids = $(this).val();
                    $("#row" + ids).remove();
                });
            },
            error: function (xhr, status, error) {
                $(".formBtn").html(formBtnHtml);
                $(".formBtn").removeAttr("disabled");
                $(".errorarea").show();
                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*--------------------------------------	
      		Login Form submit With Reload
    	---------------------------------------*/
    $(".loginAjaxForm").on("submit", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formBtnHtml = $(".formBtn").html();
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $(".formBtn").html("Please Wait....");
                $(".formBtn").attr("disabled", "");
            },

            success: function (response) {
                $(".formBtn").removeAttr("disabled");
                $(".formBtn").html(formBtnHtml);
                location.reload();
            },
            error: function (xhr, status, error) {
                $(".formBtn").html(formBtnHtml);
                $(".formBtn").removeAttr("disabled");

                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*--------------------------------------	
      		id basicform1 when submit 
    	---------------------------------------*/
    $("#ajaxForm1").on("submit", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: this.action,
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                success(response);
            },
            error: function (xhr, status, error) {
                $(".errorarea").show();

                $.each(xhr.responseJSON.errors, function (key, item) {
                    Sweet("error", item);
                    $("#errors").html(
                        "<li class='text-danger'>" + item + "</li>"
                    );
                });
                errosresponse(xhr, status, error);
            },
        });
    });

    /*--------------------------------------	
      		AllCheck Checkbox Active
    	---------------------------------------*/
    $(".checkAll").on("click", function () {
        $("input:checkbox").not(this).prop("checked", this.checked);
    });

    /*------------------------------------------------------------
      		if all child selected then parent checked - Dynamic
    	--------------------------------------------------------------*/
    $(".child")
        .on("change", function () {
            var parent = $(this).closest(".parent"),
                status =
                    parent.find("input.child").not(":checked").length === 0;
            parent.prev("label").find(".parent").prop("checked", status);
        })
        .trigger("change");

    $(".cancel").on("click", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Do It!",
        }).then((result) => {
            if (result.value == true) {
                window.location.href = link;
            }
        });
    });

    /*--------------------------------------	
      		Sweet Alert Active
    	---------------------------------------*/
    function Sweet(icon, title, time = 3000) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: time,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        Toast.fire({
            icon: icon,
            title: title,
        });
    }
})(jQuery);

/*-----------------------------
          status change using ajax 
-----------------------------*/
$(".statusBtn").on("click", function (e) {
    e.preventDefault();

    var statusBtnHtml = $(".statusBtn").html();
    $.ajax({
        type: "GET",
        url: this.href,
        type: "GET",
        beforeSend: function () {
            // $(".statusbtn").html(
            //     '<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Please Wait....'
            // );
            $(".statusBtn").attr("disabled", "");
        },
        success: function (response) {
            $(".statusBtn").removeAttr("disabled");
            Sweet("success", response);
            // $(".statusBtn").html(statusBtnHtml);
            setTimeout(window.location.reload.bind(window.location), 1000);
            // location.reload();
        },
        error: function (xhr, status, error) {
            // $(".statusBtn").html(statusBtnHtml);
            $(".statusBtn").removeAttr("disabled");
            $(".errorarea").show();
            $.each(xhr.responseJSON.errors, function (key, item) {
                Sweet("error", item);
                $("#errors").html("<li class='text-danger'>" + item + "</li>");
            });
            errosresponse(xhr, status, error);
        },
    });
});

/*-------------------------------
    Delete  Alert
  -----------------------------------*/
$(".deleteIndex").on("click", function (event) {
    const id = $(this).data("id");
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this blog!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById("delete_datalist_form_" + id).submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelled",
                "Your Data is Save :)",
                "error"
            );
        }
    });
});
