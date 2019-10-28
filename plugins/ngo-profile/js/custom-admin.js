jQuery( document ).ready(function() {


	var maxField = 10; //Input fields increment limitation
	var addButton = jQuery('.add_button_admin'); //Add button selector
	var wrapper = jQuery('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div class="field_wrapper"><br/><div class="row"><div class="col-md-2 col-sm-12"><input type="text" name="txtname[]" placeholder="Name" class="form-control" ></div><div class="col-md-2 col-sm-12"><input type="text" name="desig[]" placeholder="Designation" class="form-control"  ></div><div class="col-md-2 col-sm-12"><input type="text" name="tenure[]" placeholder="Tenure" class="form-control" ></div><div class="col-md-2 col-sm-12"><input type="text" name="occup[]" placeholder="Occupation" class="form-control"  ></div><div class="col-md-3 col-sm-12"><input type="text" name="relation[]" placeholder="Relationship with the Board Member" class="form-control" ></div><a href="javascript:void(0);" class="remove_button" title="Remove field">  <img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/remove-icon.png"></a></div></div>';

	jQuery(addButton).click(function(){
					jQuery(wrapper).append(fieldHTML);
		 });


	//Once remove button is clicked
	jQuery(wrapper).on('click', '.remove_button', function(e){
		 e.preventDefault();
		jQuery(this).parent('div').remove();
	});




jQuery('#btnSendMail').click(function(){

	var txtNarative=jQuery('#txtNarative').val();
	var txtUserID=jQuery('#txtUserID').val();
	var ngoEmail=jQuery('.ngoEmail').html();



	jQuery.ajax({
                url:'/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                  action:'ajdata',
                  txtNarative: txtNarative,
                  ngoEmail: ngoEmail,
                  txtUserID: txtUserID,
                },
                success: function(data){
                  alert('Sent Successfuly');
									location.reload(1);
                }
            });

});

jQuery('#btnSendMailDueDili').click(function(){

	var txtNarative=jQuery('#txtNarativeDUE').val();
	var txtUserID=jQuery('#txtUserID').val();
	var ngoEmail=jQuery('.ngoEmail').html();



	jQuery.ajax({
                url:'/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                  action:'ajdata_duedili',
                  txtNarative: txtNarative,
                  ngoEmail: ngoEmail,
                  txtUserID: txtUserID,
                },
                success: function(data){
									console.log(data);
                  alert('Sent Due Deligece Message Successfuly');
									location.reload(1);
                }
            });

});




	var admin_pageURL = jQuery(location).attr("href");
	var pageurl_campaign = admin_pageURL.split('=');
	var pageurl_campaign_edit = admin_pageURL.split('edit.php');
	//alert(pageurl_campaign_edit);
	var pageurl_campaign_add_new = admin_pageURL.split('post-new.php');
	//alert(pageurl_campaign_add_new);

	var page_campaign_url = pageurl_campaign[1];
	if (page_campaign_url == 'campaign' ) {
		jQuery("#toplevel_page_ngo_projects_page").removeClass('wp-not-current-submenu');
		jQuery("#toplevel_page_ngo_projects_page").addClass('wp-has-current-submenu wp-menu-open');
		jQuery('.toplevel_page_ngo_projects_page').addClass('wp-has-current-submenu');
		if(pageurl_campaign_edit.length == 2 ) {
			jQuery('#toplevel_page_ngo_projects_page .wp-first-item').addClass('current');
		}
		if(pageurl_campaign_add_new.length == 2 ) {
			jQuery('#toplevel_page_ngo_projects_page .wp-first-item').siblings().addClass('current');
		}
	}

	//jQuery ('.tabs').tabs ();

	var GalleryState;

	// Uploading files
	var file_frame;

	jQuery('body').on('click', '#tbs_website_logo_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-website-logo-class').val(attachment_url);
			jQuery('.tbs-website-logo-class-display').attr( 'src', attachment_url );
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	/*Upload Trust documents*/

	jQuery('body').on('click', '#tbs_upload_trust_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_trust-class').val(attachment_url);
			jQuery('.tbs-upload_trust-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});
	/*end*/

	/*Edit Trust documents*/

	jQuery('body').on('click', '#tbs_edit_trust_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_trust-class').val(attachment_url);
			jQuery('.tbs-edit_trust-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});
	/*end*/


	/*Upload socity documents*/

	jQuery('body').on('click', '#tbs_upload_socity_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_socity-class').val(attachment_url);
			jQuery('.tbs-upload_socity-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});
	/*end*/

	/*Edit socity documents*/
	jQuery('body').on('click', '#tbs_edit_soc_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_soc-class').val(attachment_url);
			jQuery('.tbs-edit_soc-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});
	/*end*/

	/*Upload section 8 documents*/

	jQuery('body').on('click', '#tbs_upload_section8_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_section8-class').val(attachment_url);
			jQuery('.tbs-upload_section8-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	/*EDit section 8 documents*/

	jQuery('body').on('click', '#tbs_edit_sec_eight_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_sec_eight-class').val(attachment_url);
			jQuery('.tbs-edit_sec_eight-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});



	/*end*/

	/*Upload PAN documents*/

	jQuery('body').on('click', '#tbs_upload_pan_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_pan-class').val(attachment_url);
			jQuery('.tbs-upload_pan-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});


	/*Edit PAN documents*/

	jQuery('body').on('click', '#tbs_edit_pan_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_pan-class').val(attachment_url);
			jQuery('.tbs-edit_pan-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});



	/*end*/

	/* Upload TAN Doc*/
	jQuery('body').on('click', '#tbs_upload_tan_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_tan-class').val(attachment_url);
			jQuery('.tbs-upload_tan-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	/*end*/

	/* Edit TAN Doc*/
	jQuery('body').on('click', '#tbs_edit_tan_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_tan-class').val(attachment_url);
			jQuery('.tbs-edit_tan-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	/*end*/

	//upload 12a
	jQuery('body').on('click', '#tbs_upload_12a_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_12a-class').val( attachment_url );
			jQuery('.tbs-upload_12a-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Edit 12a
	jQuery('body').on('click', '#tbs_edit_12a_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_12a-class').val( attachment_url );
			jQuery('.tbs-edit_12a-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//upload FCRA
	jQuery('body').on('click', '#tbs_upload_frca_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-upload_frca-class').val( attachment_url );
			jQuery('.tbs-upload_frca-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});



	//Edit FCRA
	jQuery('body').on('click', '#tbs_edit_fcra_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_frca-class').val( attachment_url );
			jQuery('.tbs-edit_fcra-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});


	//upload 80g Recepite
	jQuery('body').on('click', '#tbs_upload_80g_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-ngo-80g-class').val( attachment_url );
			jQuery('.tbs-ngo-80g-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Edit 80g Recepite
	jQuery('body').on('click', '#tbs_edit_eighty_g_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_eighty_g-class').val( attachment_url );
			jQuery('.tbs-edit_eighty_g-class-display').html("<i class='fa fa-file-pdf-o fa-2x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Upload annual reports
	jQuery('body').on('click', '#tbs_ngo_report_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-ngo-report-class').val( attachment_url );
			jQuery('.tbs-ngo-report-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//edit annual reports
	jQuery('body').on('click', '#tbs_edit_anual_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_aunal-class').val( attachment_url );
			jQuery('.tbs-edit_aunal-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Upload Board memeber Details
	jQuery('body').on('click', '#borad_member_report_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.borad_member_details-class').val( attachment_url );
			jQuery('.borad_member_details-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});


	//Edit Board memeber Details
	jQuery('body').on('click', '#tbs_edit_borad_member_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_board_members-class').val( attachment_url );
			jQuery('.tbs-edit_board_members-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Upload Audited Details
	jQuery('body').on('click', '#audited_details_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.audited_details-class').val( attachment_url );
			jQuery('.audited_details-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Edit Audited fin Details
	jQuery('body').on('click', '#tbs_edit_audit_fin_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_audit_fin-class').val( attachment_url );
			jQuery('.tbs-edit_audit_fin-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	//Edit logo
	jQuery('body').on('click', '#tbs_edit_logo_id', function (event) {
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			var attachment_url = attachment.url;
			jQuery('.tbs-edit_logo-class').val( attachment_url );
			jQuery('.tbs-edit_logo-class-display').html("<i class='fa fa-file-pdf-o fa-3x' aria-hidden='true' style='color:red;'></i>");
			file_frame = undefined;
		});

		// Finally, open the modal
		file_frame.open();
	});

	jQuery("#campaign-description h2 span").html("Write project story");
	jQuery("#campaign-description h2 span").css("display","none");
	jQuery("#campaign-description textarea").attr("placeholder", "Enter the story of your Project");
	jQuery("#campaign_categorydiv span").html("Project Categories");
	jQuery("#campaign_category-tabs #campaign_category-all a").html("All Project Categories");
	jQuery("#campaign-goal h2").html("Project Budget");
	jQuery("#campaign-end-date h2").html("Project Duration");

	/* Added tiny editor on the textarea */
	tinymce.init({ selector:'#campg_desc-campaign_textarea_2' });
	tinymce.init({ selector:'#campg_desc-campaign_textarea_4' });
	tinymce.init({ selector:'#campg_desc-campaign_textarea_5' });
	tinymce.init({ selector:'#campg_desc-campaign_textarea_6' });
	tinymce.init({ selector:'#campg_desc-campaign_textarea_7' });
	tinymce.init({ selector:'#borad_member-text' });
	tinymce.init({ selector:'#form2-text' });
	tinymce.init({ selector:'#form3-text' });
	tinymce.init({ selector:'#form4-text' });
	tinymce.init({ selector:'#form5-text' });
	//tinymce.init({ selector:'#edit_ngo_succ' });
	//tinymce.init({ selector:'#edit_ngo_miss' });
	//tinymce.init({ selector:'#edit_ngo_vis' });
	//tinymce.init({ selector:'#edit_ngo_abt' });

	jQuery(".url_check").focusout(function () {
		jQuery.ajax({
			url: '/indiadonates/wp-admin/admin-ajax.php',
			type: 'POST',
			data: {
				action: 'validate_user_nice_name'
			},
			success: function (data) {
				//alert("Hello",data);
				//var use_nice_name = jQuery('.nicename').val();
				//var user_input_nicename = jQuery('.url_check').val();
				//alert( use_nice_name );
			}
		});
	});
	jQuery( "#titlediv" ).prepend('<div><label for="name">Project Title</label></div>');

	//hide show for ngo form 2 edit button
	jQuery(".fa-edit").click(function(){
		jQuery(".edit_show").toggle();
		jQuery(".edit_hide").toggle();
		jQuery(".ngo_form_2_update").toggle();
		//jQuery(".ngo_form_2_update").css("display", "block");
	  });




});
function printDiv() {

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

//ajcode section
jQuery('#exampleNarativeAdmin').DataTable();
jQuery('#example_userlist').DataTable();

//ajcode section
