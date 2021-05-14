(function ($) {
    "use strict"
	
jQuery("#pf-form").validate({
    rules: {
        "fullname": {
            required: true
        },
        "doc_name": {
            required: true,
            extension: "xls|csv"
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
        "bsc_address": "Please enter a valid BSC Address!",
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



})(jQuery);