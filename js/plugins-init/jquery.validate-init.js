(function ($) {
    "use strict"
	
jQuery("#pf-form").validate({
    rules: {
        "fullname": {
            required: true
        },
        "doc_name": {
            required: true,
            extension: "png|jpg"
        },
        "doc_type": {
            required: true
        },
        "gender": {
            required:true,
        },
        "email": {
            required: true,
            email: true
        },
        "address": {
            required: true
        },
        "country": {
            required: true
        },
        "state": {
            required: true
        },
        "city": {
            required: true
        },
        "bsc_address": {
            required: true
        },
        "val-website": {
            required: !0,
            url: !0
        },
        "val-phoneus": {
            required: !0,
            phoneUS: !0
        },
        "val-digits": {
            required: !0,
            digits: !0
        },
        "val-number": {
            required: !0,
            number: !0
        },
        "val-range": {
            required: !0,
            range: [1, 5]
        },
        "val-terms": {
            required: !0
        }
    },
    messages: {
        "doc_name": {
            required: "Please select a file!",
            extension: "Just .jpg and .png extension is allowed!"
        },
        "doc_type": "Please select a document type!",
        "gender": "Please select a gender!",
        "fullname": {
            required: "Please enter your fullname!",
        },
        "email": "Please enter a valid email address!",
        "address": "Please enter your full address!",
        "country": "Please select a country!",
        "state": "Please select a state!",
        "city": "Please select a city!",
        "bsc_address": "Please enter your website!",
    },

    // ignore: [],
    errorClass: "invalid-feedback animated fadeInUp",
    // // errorElement: "p",
    errorPlacement: function(error, element) {
        if(element.prop("type") == "radio"){
            error.insertAfter(element.parent('.form-group > p'));
        }else{
            error.insertAfter(element);
        }
        // jQuery(a).parents(".form-group > input").append(e)
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
    },
});


jQuery(".form-valide-with-icon").validate({
    rules: {
        "val-username": {
            required: !0,
            minlength: 3
        },
        "val-password": {
            required: !0,
            minlength: 5
        }
    },
    messages: {
        "val-username": {
            required: "Please enter a username",
            minlength: "Your username must consist of at least 3 characters"
        },
        "val-password": {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        }
    },

    ignore: [],
    errorClass: "invalid-feedback animated fadeInUp",
    errorElement: "div",
    errorPlacement: function(e, a) {
        jQuery(a).parents(".form-group > div").append(e)
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-valid")
    }




});

})(jQuery);