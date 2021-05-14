(function ($) {
    "use strict"
	
jQuery("#pf-form").validate({
    rules: {
        "fullname": {
            required: true
        },
        "doc_name": {
            required: true,
            extension: "jpg|png"
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
            required: !0
        },
        "state": {
            required: !0
        },
        "city": {
            required: !0
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
        if(element.attr("name") == "doc_type"){
            error.appendTo('#error-doctype');
        }else if(element.attr("name") == "gender"){
            error.appendTo('#error-gender');
        }else if(element.attr("name") == "country"){
            error.appendTo('#error-country');
        }else if(element.attr("name") == "state"){
            error.appendTo('#error-state');
        }else if(element.attr("name") == "city"){
            error.appendTo('#error-city');
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