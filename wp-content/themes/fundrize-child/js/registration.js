jQuery(document).ready(function(){
    /*-------- project change to view more ---------*/
    /*jQuery(".campaign-donation").append("<div class='sold_out'>Award</div>");*/
    jQuery("#charitable-user-fields").prepend('<div id="charitable_field_full_name" class="charitable-form-field charitable-form-field-text required-field even"><input type="text" name="full_name" id="charitable_field_full_name_element" value="" required="1" placeholder="Full Name" style="cursor: auto;"></div>');
    jQuery("#charitable-user-fields").prepend('<div id="charitable_field__name" class="charitable-form-field charitable-form-field-text required-field even"><select class="required donor_title" name="donor_title" id="charitable_field_tax_paying_status_element" data-placeholder="Causes support"><option value="Mr"selected>Mr</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select></div>');
    //jQuery("")
    //jQuery("#charitable_field_first_name_element").replaceWith("<select name='tax_paying_status' id='charitable_field_tax_paying_status_element'><option value='Mr.'>Mr.</option><option value='Doc'>Doc</option></select>");
     jQuery(".campaign .login-prompt > a").html("Already Registered, Login here");
     jQuery('#charitable-gateway-fields').append('<div id="imageLT4"></div>');
     jQuery('#charitable-donor-fields').append('<div id="HRDoner"></div>');
     var home_url = jQuery('.home_url').val();
     jQuery('#imageLT4').prepend('<img id="theImg" src="http://ec2-18-222-226-53.us-east-2.compute.amazonaws.com/indian-charity/wp-content/uploads/2018/10/CreditCardLogos2.jpg" />');
     var first_name = jQuery("input#charitable_field_first_name_element").val();
     var last_name = jQuery("input#charitable_field_last_name_element").val();
     if( first_name != '' || last_name != '' ) {
         jQuery("#charitable_field_full_name_element").val(first_name+" "+last_name);
     }

     // split the full name in  first name and last name form full name.
     if( first_name == '' || last_name == '' ) {
         jQuery("#charitable_field_full_name_element").focusout(function(){
             var entered_full_name = jQuery("#charitable_field_full_name_element").val();
             first_last_nae = entered_full_name.split(" ");
             var salutation = jQuery(".donor_title").val();
             var first_name =  salutation+ ' '+ first_last_nae[0];
             var last_name = '';
             jQuery("input#charitable_field_first_name_element").val( first_name );
             var count_name = first_last_nae.length;
            for ( var i = 1; i < count_name; ++i ) {
                last_name += first_last_nae[i]+' ';
            } //alert(last_name);
            if (last_name == '' ) {
                //last_name = first_name;
		last_name = " ";
            }
            jQuery("input#charitable_field_last_name_element").val(last_name);
           // alert(first_name);
            //alert(last_name);

         });



     }
     var donor_phone_number = jQuery(".donor-mobile-hidden").val();
     var donor_title = jQuery(".donor-title-hidden").val();
     jQuery("#charitable_field_phone_num_element").val(donor_phone_number);
     jQuery(".donor_title").val(donor_title);

     //check donor title if it is empty make it defult for the guest users.
     if( donor_title == "" ){
         jQuery(".donor_title").val("Mr");
         jQuery("#charitable_field_full_name_element").focusout(function(){
         //jQuery(".donor_title").val("Mr./Ms./Dr.");
     });

     }
     jQuery("#charitable_field_first_name").css("display","none");
     jQuery("#charitable_field_last_name").css("display","none");
     jQuery("input#charitable_field_email_element").attr("placeholder", "Email");
     jQuery("input#charitable_field_address_element").attr("placeholder", "Address");
     jQuery("input#charitable_field_address_2_element").attr("placeholder", "Address 2");
     jQuery("input#charitable_field_city_element").attr("placeholder", "City");
     jQuery("input#charitable_field_state_element").attr("placeholder", "State");
     jQuery("input#charitable_field_postcode_element").attr("placeholder", "Post Code");
     jQuery("input#charitable_field_phone_element").attr("placeholder", "Phone Number");
     jQuery("input#charitable_field_country_name_element").attr("placeholder", "Country");
     jQuery("input#charitable_field_phone_num_element").attr("placeholder", "Mobile Number");
     jQuery("input#charitable_field_user_login_element").attr("placeholder", "Enter your registred email");

     jQuery(".title").addClass("viwe-on-home");
     //jQuery(".title a").html('More');

     jQuery('.5ajauthName').click(function(){
    		jQuery('.tabset-lxa').hide();
    	});


 //('#addbasket').on('change','#multiid',function()
   jQuery('#msform').on('change','#state',function(){
         var state_id = jQuery(this).val();
         var home_url = jQuery('.home_url').val();
         if( state_id != 0 || state_id != null ) {
             jQuery("#city").prop('disabled', false);
             jQuery.ajax({
                 url: home_url+'/wp-admin/admin-ajax.php',
                 type: 'POST',
                 data: {
                   action:'select_city',
                   state_id: state_id,
                 },
                 success: function(data){
                   jQuery('#city').children().remove();
                   jQuery('#city').append(data);
                 }
             });
         }
     });

   var current_fs, next_fs, previous_fs;
   var left, opacity, scale;
   var animating;

   jQuery(".submit").click(function(){
    // e.preventDefault();

         var form = jQuery("#msform");
         form.validate({
             rules: {
                 org_name: {
                     required: true,
                 },
                 user_email: {
                     required: true,

                 },
                  full_name: {
                     required: true,

                 },
                 orgname:{
                     required: true,
                 },
                 phone:{
                     required: true,
                     maxlength: 10,
                     number: true
                 },
                 reg_add:{
                     required: true,
                    // minlength: 10,
                 },
                 state:{
                     required: true,
                 },
                 city:{
                     required: true,
                 },
                 expd:{
                     required: true,
                 },
                 incom:{
                     required: true,
                 },
                 ltr:{
                     required: true,
                 },
                 bnfs:{
                     required: true,
                 },
                 causes_for:{
                     required: true,
                 },
                  pan: {
                     required: true,
                     minlength: 10,
                 },
                 reg_ngo: {
                     required: true,

                 },
                 designation: {
                     required: true,

                 },
                 website: {
                   required:true,
                 },

             },
             messages: {
                 org_name: {
                     required: "Organisation name required",
                 },
                  user_email: {
                     required: "Email required",
                 },
                  full_name: {
                     required: "Full Name required",
                 },
                 orgname: {
                     required: "TAN Number required",
                 },
                 phone: {
                     required: "Phone required",
                 },
                 reg_add: {
                     required: "Registered Address required",
                 },
                 city: {
                     required: "city required",
                 },
                 state: {
                     required: "state required",
                 },
                 pan: {
                     required: "PAN Number required",
                 },
                  reg_ngo: {
                     required: "Select NGO Trype required",
                 },

                  designation: {
                     required: "Designation required",
                 },
                  g_80: {
                     required: "Enter G80 required",
                 },
                  website: {
                     required: "Website required",
                 },
             }
         });
         if (form.valid() == true){
             $('#text-cntr').html('Please wait...');
             current_fs = jQuery('#basic');
             next_fs =jQuery('#orgname');
             next_fs.show();
             current_fs.hide();
             if(animating) return false;
   animating = true;

   current_fs = jQuery(this).parent();
   next_fs = jQuery(this).parent().next();
   jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");
   next_fs.show();
   current_fs.animate({opacity: 0}, {
     step: function(now, mx) {
       scale = 1 - (1 - now) * 0.2;
       left = (now * 50)+"%";
       opacity = 1 - now;
       current_fs.css({
         'transform': 'scale('+scale+')',
         'position': 'absolute'
       });
       next_fs.css({'left': left, 'opacity': opacity});
     },
     duration: 800,
     complete: function(){
       current_fs.hide();
       animating = false;
     },
     easing: 'easeInOutBack'
   });

     }else{
         e.preventDefault();
  }

     jQuery('#state').change(function(){
         var state_id = jQuery(this).val();
         if( state_id != 0 || state_id != null ) {
             jQuery("#city").prop('disabled', false);
         }
     });

 });
 jQuery(".previous").click(function(){
     if(animating) return false;
     animating = true;

     current_fs = jQuery(this).parent();
     previous_fs = jQuery(this).parent().prev();
     jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");

     previous_fs.show();
     current_fs.animate({opacity: 0}, {
         step: function(now, mx) {
             scale = 0.8 + (1 - now) * 0.2;
             left = ((1-now) * 50)+"%";
             opacity = 1 - now;
             current_fs.css({'left': left});
             previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
         },
         duration: 800,
         complete: function(){
             current_fs.hide();
             animating = false;
         },
         easing: 'easeInOutBack'
     });
 });

 jQuery(".submit").click(function(){
     return true;
 });
 });

 //popup code
 jQuery(document).ready(function(){
     var home_url = jQuery('.home_url').val();
     jQuery(".header-aside-btn").html('<div class="header-aside-btn" style="padding-left: 10px;"><a class="btn" href='+home_url+'/donor-signup/"><span>Donor Signup</span> </div><div class="header-aside-btn"><a class="btn open-popup" data-id="popup_11" data-animation="rotateCube" href="#popup_11"><span>Login</span> </div>');


 (function(jQuery) {
   jQuery.fn.openPopup = function( settings ) {
     var elem = jQuery(this);
     // Establish our default settings
     var settings = jQuery.extend({
       anim: 'fade'
     }, settings);
     elem.show();
     elem.find('.popup-contents').addClass(settings.anim+'In');
   }

   jQuery.fn.closePopup = function( settings ) {
     var elem = jQuery(this);
     // Establish our default settings
     var settings = jQuery.extend({
       anim: 'fade'
     }, settings);
     elem.find('.popup-contents').removeClass(settings.anim+'In').addClass(settings.anim+'Out');

     setTimeout(function(){
         elem.hide();
         elem.find('.popup-contents').removeClass(settings.anim+'Out')
       }, 500);
   }

 }(jQuery));

 // Click functions for popup
 jQuery('.open-popup').click(function(){
   jQuery('#'+jQuery(this).data('id')).openPopup({
     anim: (!jQuery(this).attr('data-animation') || jQuery(this).data('animation') == null) ? 'fade' : jQuery(this).data('animation')
   });
 });
 jQuery('.close-popup').click(function(){
   jQuery('#'+jQuery(this).data('id')).closePopup({
     anim: (!jQuery(this).attr('data-animation') || jQuery(this).data('animation') == null) ? 'fade' : jQuery(this).data('animation')
   });
 });

 jQuery(function(){
   jQuery('.bxslider').bxSlider({
     mode: 'fade',
     captions: true,
   });
 });
 jQuery(function() {
   jQuery('.btn-6')
     .on('mouseenter', function(e) {
             var parentOffset = jQuery(this).offset(),
             relX = e.pageX - parentOffset.left,
             relY = e.pageY - parentOffset.top;
             jQuery(this).find('span').css({top:relY, left:relX})
     })
     .on('mouseout', function(e) {
             var parentOffset = jQuery(this).offset(),
             relX = e.pageX - parentOffset.left,
             relY = e.pageY - parentOffset.top;
         jQuery(this).find('span').css({top:relY, left:relX})
     });
   /*jQuery('[href=#]').click(function(){return false});*/
 });

         jQuery(".showonhover").click(function(){
             jQuery("#selectfile").trigger('click');
         });
     });



 jQuery("#accordion > li > div").click(function()
     {
         if(false == jQuery(this).next().is(':visible'))
             {
                 jQuery('#accordion ul').slideUp(300);
             }
                 jQuery(this).next().slideToggle(300);
     });
         jQuery('#accordion ul:eq(0)').show();

 jQuery( document ).ready(function(){
     $raised = jQuery('.get_donated_amount').val();
     //alert($raised);
     $total_amount = jQuery('.get_donated_goal').val();
     //alert($total_amount);
     jQuery('#raised-percentage-bar').jQMeter({ //alert($raised);
         goal:'$0',
         raised:'$1212',
         // the width of the progress meter
         width: "100%",

         // the height of the progress meter
         height: "20px",
       });
 /*jQuery(".SlickCarousel").slick({
     rtl:false, // If RTL Make it true & .slick-slide{float:right;}
     autoplay:true,
     autoplaySpeed:5000, //  Slide Delay
     speed:1200, // Transition Speed
     slidesToShow:3, // Number Of Carousel
     slidesToScroll:1, // Slide To Move
     pauseOnHover:false,
     appendArrows:jQuery(".Container .Head .Arrows"), // Class For Arrows Buttons
     prevArrow:'<span class="Slick-Prev"></span>',
     nextArrow:'<span class="Slick-Next"></span>',
     easing:"linear",
     responsive:[
       {breakpoint:801,settings:{

         slidesToShow:2,
       }},
       {breakpoint:641,settings:{

         slidesToShow:3,
       }},
       {breakpoint:481,settings:{

         slidesToShow:1,
       }},
     ],
   })*/
 });
 jQuery(document).ready(function(){
  jQuery("#charitable_field_tax_paying_status").change(function(){

        jQuery(this).find("option:selected").each(function(){

            var optionValue = jQuery(this).attr("value");
            //alert(optionValue);

            if(optionValue == "Indian"){

                jQuery("#charitable_field_country_name").hide();

            } else{

                jQuery("#charitable_field_country_name").show();

            }

        });

    }).change();

 });
 jQuery(document).ready(function(){
     jQuery("#charitable_field_tax_paying_status").change(function(){

           jQuery(this).find("option:selected").each(function(){

               var optionValue = jQuery(this).attr("value");
               //alert(optionValue);

               if(optionValue == "Indian"){

                   jQuery("#charitable_field_country_name").hide();
                   jQuery("#charitable_field_country_name_element").val("India");

               } else{

                   jQuery("#charitable_field_country_name").show();

               }

           });

       }).change();
     var TxtType = function(el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap-d">'+this.txt+'</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (this.isDeleting) { delta /= 2; }

            if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
            }

            setTimeout(function() {
            that.tick();
            }, delta);
        };

        window.onload = function() {
            var elements = document.getElementsByClassName('typewrite');
            for (var i=0; i<elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                  new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap-d { width: 279px}";
            document.body.appendChild(css);
        };

    });

    jQuery( document ).ready(function() {

     var $sticky = jQuery('.sticky');
     var $stickyrStopper = jQuery('.sticky-stopper');
     if (!!$sticky.offset()) { // make sure ".sticky" element exists

       var generalSidebarHeight = $sticky.innerHeight();console.log(generalSidebarHeight);
       var stickyTop = $sticky.offset().top;
       var stickOffset = 40;
       var stickyStopperPosition = $stickyrStopper.offset().top;console.log(stickyStopperPosition);
       var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;console.log(stopPoint);
       var diff = stopPoint + stickOffset;

       jQuery(window).scroll(function(){ // scroll event
         var windowTop = jQuery(window).scrollTop(); // returns number
         $sticky.css('right', '5%');
         $sticky.css('width', '21%');
         if (stopPoint < windowTop) {
             $sticky.css({ position: 'absolute', top: diff });
         } else if (stickyTop < windowTop+stickOffset) {
             $sticky.css({ position: 'fixed', top: stickOffset });
         } else {
             $sticky.css({position: 'absolute', top: 'initial'});
         }
       });

     }
     //Renge slider for donation

    var rangeSlider = function(){
     var slider = jQuery('.range-slider'),
         range = jQuery('.range-slider__range'),
         value = jQuery('.range-slider__value');

     slider.each(function(){

       value.each(function(){
         var value = jQuery(this).prev().attr('value');
         jQuery(this).html(value);
       });

       range.on('input', function(){
         jQuery(this).next(value).html(this.value);
         //alert(this.value);
         var fixamount = jQuery("#fix-amonut b").text();
         var packagename = jQuery("#fix-amonut em").text();
         if( this.value >1 && packagename != "Child"){
            packagename = packagename+"s";
         }
         if( this.value >1 && packagename == "Child"){
            packagename = packagename+"ren";
        }
         var result = fixamount * (this.value);
         var heading = "You are supporting"+" "+(this.value)+ " " + packagename+ " " + "of Rs." + " "+result;
         jQuery('.result-value').html(heading);
         jQuery('#result-amount').val(result);
         jQuery('.info-beneficiary').html( (this.value)+ " " + packagename);
         jQuery('.extra-package').val(this.value);
         if(this.value == 10){
            jQuery('.or_bold').show();
            jQuery('.extra-package-div').css('display','inline-flex');
         }else{
            jQuery('.or_bold').hide();
            jQuery('.extra-package-div').css('display','none');
         }
       });
     });
   };

   rangeSlider();
   });

   // Donor profiles image upload
   jQuery(document).ready(function() {


     var readURL = function(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();

             reader.onload = function (e) {
                 jQuery('.profile-pic').attr('src', e.target.result);
                 jQuery("#submit_my_image_upload").show();
             }

             reader.readAsDataURL(input.files[0]);
         }
     }


     jQuery(".user-file-upload").on('change', function(){
         readURL(this);
     });

     jQuery(".upload-button").on('click', function() {
        jQuery(".user-file-upload").click();
     });
     jQuery(".upload-button").click(function(){
     });
     jQuery("#submit_my_image_upload").click( function(){
         jQuery("#submit_my_image_upload").hide();
     } );

     //code for changing the faviroute color
     jQuery("#like-button").click(function(){
         jQuery(".inf-icon-heart").css("color", "red");
         jQuery(".dislike-remove").css("color", "#999");
     });
     jQuery("#like-button").click(function(){
         jQuery(".dislike-remove").css("color", "#999");
     });

     //selection on extra packages.
     jQuery(".extra-package").focusout(function(){
         var xtraenterconut = jQuery(".extra-package").val();
         var xtrafixamount = jQuery("#fix-amonut b").text();
         var xtrapackagename = jQuery("#fix-amonut em").text();
         if( xtraenterconut >1 && xtrapackagename != "Child"){
            xtrapackagename = xtrapackagename+"s";
         }
         if( xtraenterconut >1 && xtrapackagename == "Child"){
            xtrapackagename = xtrapackagename+"ren";
         }
         var xresult = xtrafixamount * xtraenterconut;
         var xheading = "You are supporting"+" "+xtraenterconut+ " " + xtrapackagename+ " " + "of Rs." + " "+xresult;
         jQuery('.result-value').html(xheading);
         jQuery('#result-amount').val(xresult);
         jQuery('.info-beneficiary').html(xtraenterconut+ " " + xtrapackagename);

     });

     //checked payment mode on checked on tabs
     jQuery(function(){
        // jQuery(".offline-donation").on("change",function(){
          //  jQuery("#gateway-offline").prop("checked",jQuery(this).prop("checked"));
            //jQuery("#gateway-paypal").not(this).prop("checked", false);
            //jQuery("#gateway-payu_money").not(this).prop("checked", false);
         //});

       });
     // code to show text input on selection of other categories in form 1.
     jQuery('#row_dim').hide();
     jQuery('#causes_f1').change(function(e){
         var causersupport = jQuery("#causes_f1").length;
         for(var i = 0; i < causersupport; i++) {
             if( jQuery('#causes_f1 option:selected:last').text() == "Others" ) {
             jQuery('#row_dim').show();
             } else {
                      jQuery('#row_dim').hide();

                      }
         }
     });

     //code to automatic input the phone number value in donation form.
     var donor_phone_number = jQuery(".donor-mobile-hidden").val();
     jQuery("#charitable_field_phone").css("display", "none");
     if( donor_phone_number == ""){
         var mobile_num = jQuery("#charitable_field_phone_num_element").val();
         jQuery("#charitable_field_phone_num_element").focusout(function(){
             //alert(mobile_num);

             jQuery("#charitable_field_phone_element").val( mobile_num );

         });

     }else{
         jQuery("#charitable_field_phone_element").val( donor_phone_number );
     }


         jQuery(".chosen-select").chosen();
         //jQuery("#charitable_field__name").hide();

         jQuery(".form-uplod").on("change", ".file-upload-field", function(){
             jQuery(this).parent(".file-upload-wrapper").attr("data-text",
                 jQuery(this).val().replace(/.*(\/|\\)/, '') );
         });

        //for printing the doantion recepite
          jQuery("#btn_donation").click(function () {
                 //Hide all other elements other than printarea.
                 jQuery("#site-header ").hide();
                 jQuery("#footer").hide();
                 jQuery("#bottom").hide();
                 jQuery("#btn_donation").hide();
                 jQuery(".print-line-on-pdf").css("width","49%");
                 jQuery(".don_reciept").show();
                 window.print();
             });



 //ajax check for login validations.

 //jQuery(".login-submit").validate();
 //var allow_submit = false;

 jQuery("#wp-submit").on('click', function(e){
    
     var loginname = jQuery("#id3").val();
     var userpassword = jQuery("#id4").val();
     var home_url = jQuery('.home_url').val();
     var abcd = jQuery(".check-test").val();
         e.preventDefault();
 //alert(abcd);
         jQuery.ajax({
             url: home_url+'/wp-admin/admin-ajax.php',
             type: 'POST',
             data: {
                 action: 'tbs_check_login_validation',
                 loginname: loginname,
                 password: userpassword,
             },
             success: function (data) {
               console.log(data.msg);
               if(data.status==0){
                 	  jQuery('.error').text(data.msg);
               }
               if(data.status==1){
                 	  jQuery('.error').text(data.msg);
                     window.location.replace(data.url);
               }
			//  jQuery('.error').text(data);
			  //location.reload();
			 // window.location.replace(redirect_url);
			//alert(data);
               //  var result = data.split("_and_");
               //  var result_final = result[0];
                 if( data == 'success') {
                     //var redirect_url = result[1]; //alert(redirect_url);
                   //  window.location.replace(redirect_url);
                 } else {
                     if( loginname && userpassword != "" ){
                        // jQuery('.error').text(data);
                    }


                 }
             },
             dataType : 'json'
         });

     });
     jQuery(".charitable-forgot-password-form #charitable_field_user_login_element").attr("placeholder", "Enter your registered email");

     //validate the mobile
         $cf = jQuery('#charitable_field_phone_num_element');
         $cf.blur(function(e){
             phone = jQuery(this).val();
             phone = phone.replace(/[^0-9]/g,'');
             if (phone.length != 10)
             {
                 jQuery('#charitable_field_phone_num_element').after('<p class="val_num" style="color:red;">Phone number has to be 10 digits long.</p>');
                 jQuery('#charitable_field_phone_num_element').val('');
                 jQuery('#charitable_field_phone_num_element').focus();
                 jQuery('.val_num').delay(1000).fadeOut(300);
             }
         });


         //login validation
             jQuery(".charitable-login-form .login-submit #wp-submit").addClass("loginbutton");
             //jQuery("#loginform #wp-submit").addClass("loginbutton");
             jQuery(".charitable-login-form #user_login").attr('id', 'id2');
             jQuery(".charitable-login-form #user_pass").attr('id', 'id1');

                 jQuery(".loginbutton").click(function( event ){
                 //jQuery("#user_login").addClass("userlogin");
                 //jQuery("#user_pass").addClass("userpass");
                                var user = jQuery("#id2").val();
                                var pass = jQuery ("#id1").val();
                              if(pass == ""){
                                 event.preventDefault();
                                  jQuery('#id1').after('<p class="abd" style="color:red;">Enter the Password.</p>');
                                  jQuery(".abd").delay(1000).fadeOut(300);
                              }
                              if(user == ""){
                                 event.preventDefault();

                                 jQuery('#id2').after('<p class="abd" style="color:red;">Enter The Username.</p>');
                                 jQuery(".abd").delay(1000).fadeOut(300);

                              }
                              //event.StoppreventDefault();

                     });


         //login validation for popup
             jQuery("#popup_11  #wp-submit").addClass("subm");
             jQuery("#popup_11 #user_login").attr('id', 'id3');
             jQuery("#popup_11 #user_pass").attr('id', 'id4');

                 jQuery(".subm").click(function( event ){
                 //jQuery("#user_login").addClass("userlogin");
                 //jQuery("#user_pass").addClass("userpass");
                                var user = jQuery("#id3").val();
                                var pass = jQuery ("#id4").val();
                              if(pass == ""){
                                 event.preventDefault();
                                  jQuery('#id3').after('<p class="abd" style="color:red;">Enter the Username.</p>');
                                  jQuery(".abd").delay(1000).fadeOut(300);
                              }
                              if(user == ""){
                                 event.preventDefault();

                                 jQuery('#id4').after('<p class="abd" style="color:red;">Enter The Passwords.</p>');
                                 jQuery(".abd").delay(1000).fadeOut(300);

                              }
                              //event.StoppreventDefault();

                     });

         //JQuery for the categories slider
         jQuery('.owl-theme_cat').owlCarousel({
             loop:true,
             margin:10,
             dots:false,
             autoplayHoverPause: true,
             autoplay:true,
             nav:false,
             items:1,
             itemsDesktop: [1000, 1],
             itemsDesktopSmall: [900, 1],
             itemsTablet: [600, 1],
             itemsMobile: false,
             pagination: false,
             autoplayTimeout: 10000,
         });
         jQuery(".owl-theme_cat").mouseleave(function() {
             jQuery(this).trigger('next.owl.carousel');
             });
        jQuery('#table_format').ddTableFilter();
 });
