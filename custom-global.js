var quickForm = {
    init: function () {
        this.setOnClickAttr();
        this.onSubmitForm();
        this.sendTextClub();
        this.feedbackRatingIcon();
    },
    quickSubmitForm: function (form_id) {
        //console.log("submit");
        jQuery('#gform_submit_button_' + form_id).trigger('click');
    },
    quickApplicationAttach: function (ele) {
        //console.log("attach");
        jQuery('.ginput_container_fileupload #' + ele).trigger('click');
    },
    setOnClickAttr: function () {
        jQuery('.check-terms').each(function () {
            var get_id = jQuery(this).find('ul').attr('id');
            var checkbox = jQuery('#' + get_id).find('input').attr('id');
            jQuery('#' + get_id).attr('onclick', 'quickForm.quickAcceptTerms("' + checkbox + '")');
        });
        //var get_id = jQuery('.check-terms ul').attr('id');

        //var checkbox = jQuery('#'+get_id).find('input').attr('id');
        //jQuery('#'+get_id).attr('onclick', 'quickForm.quickAcceptTerms("'+checkbox+'")');
        //console.log("accept");

        jQuery('.ginput_container_fileupload #input_6_20').change(function () {
            var file = jQuery(this).val();
            //console.log(file);
            jQuery('.button-attachment').append('<div class="file-name">' + file + '</div>');
        });
    },
    quickAcceptTerms: function (ele) {
        jQuery('#' + ele).on('change', function (event) {
            var checked = jQuery(this).find('input').prop('checked');
            //console.log(checked);
            jQuery(this).parent().parent().removeClass('checked');
            var val = jQuery(this).prop('checked');
            if (val) {
                jQuery(this).parent().parent().addClass('checked');
            }
            //console.log(val);
        });
    },
    onSubmitForm: function () {

        jQuery(document).bind('gform_page_loaded', function (event, form_id, page_number) {
            //Replace 2 with your actual form ID
            if (form_id === 1 || form_id === 2 || form_id === 3 || form_id === 4 || form_id === 5 || form_id === 6 || form_id === 7 || form_id === 8 || form_id === 9) {

                //Add your tooltip javascript code here
                //console.log('submitted but error');
                quickForm.setOnClickAttr();

                jQuery('.check-terms').each(function () {
                    var input_id = jQuery(this).find('input').attr('id');
                    var ul_id = jQuery(this).find('ul').attr('id');
                    var checkboxes = jQuery('#' + input_id).prop('checked');
                    if (checkboxes) {
                        jQuery('#' + ul_id).addClass('checked');
                    }
                });
                // var checked_terms = jQuery('#choice_6_7_1').prop('checked');
                // if(checked_terms){
                //     jQuery('#input_6_7').addClass('checked');
                // }
            }

            if (form_id === 7) {
                quickForm.sendTextClub();
            }

            if (form_id === 4) {
                quickForm.feedbackRatingIcon();
            }
        });
    },
    sendTextClub: function () {
        jQuery('#gform_7').on('submit', function (event) {

            var proxy_url = "https://cors-anywhere.herokuapp.com/";
            var qnc = jQuery('#input_7_16').val();
            var phone = jQuery('#input_7_4').val();
            phone = phone.replace(/[^0-9]+/g, "");

            if (phone && qnc !== '') {
                var url = 'https://relay.mobilesecuregateway.com/relayivm.asp?user_guid=%7BB6C7ED7A-041A-489D-86DF-A01B76AF8846%7D&keyword=QuickNCleanCarWashWEBSITE&custom10=' + qnc + '&shortcode=30400&page=contactmanager_keyword.asp&mobile=' + phone;
                url = proxy_url + url;

                jQuery.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded",
                    success: function (msg) {
                        console.log(msg);
                    }
                }).done(function (res) {
                    console.log(res);
                }).error(function (res) {
                    console.log(res);
                });
            }

        });
    },
    feedbackRatingIcon: function () {
        jQuery('.gchoice_4_10_4 label').addClass('activated');
        jQuery('#input_4_10 input[type="radio"]').on('change', function () {
            jQuery('#input_4_10 label').removeClass('activated');

            var rating = jQuery(this).val();

            switch (rating) {
                case '1':
                    jQuery('.gchoice_4_10_0 label').addClass('activated');
                    break;
                case '2':
                    jQuery('.gchoice_4_10_1 label').addClass('activated');
                    break;
                case '3':
                    jQuery('.gchoice_4_10_2 label').addClass('activated');
                    break;
                case '4':
                    jQuery('.gchoice_4_10_3 label').addClass('activated');
                    break;
                case '5':
                    jQuery('.gchoice_4_10_4 label').addClass('activated');
                    break;
                default:
                    jQuery('.gchoice_4_10_4 label').addClass('activated');
                    break;
            }
            console.log(rating);
        });
    }
};

quickForm.init();

jQuery(window).ready(function ($) {
    $('.ginput_container_select').append('<span class="pointer"><i class="fa fa-chevron-down"></i></span>');
    $('.elementor-nav-menu .sub-arrow > i').removeClass('fa').addClass('fas fa-chevron-down');
});