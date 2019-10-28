jQuery(document).ready(function()  {






    jQuery('.steps').on('change','#state_f2',function(){
        var state_id = jQuery(this).val();
        if( state_id != 0 || state_id != null ) {
            jQuery("#city_f2").prop('disabled', false);
            jQuery.ajax({
                url:'/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                  action:'select_cityf2',
                  state_id: state_id,
                },
                success: function(data){
                  jQuery('#city_f2').children().remove();
                  jQuery('#city_f2').append(data);
                }
            });
        }
    });


  var current_fs,next_fs,previous_fs;var left,opacity,scale;
  var animating;
  jQuery(".steps").validate( {
    errorClass:'invalid',errorElement:'span',errorPlacement:function(error,element) {
      error.insertAfter(element.next('span').children());},
      highlight:function(element){jQuery(element).next('span').show();},unhighlight:function(element){jQuery(element).next('span').hide();}});jQuery(".next").click(function(){jQuery(".steps").validate({errorClass:'invalid',errorElement:'span',errorPlacement:function(error,element){error.insertAfter(element.next('span').children());},highlight:function(element){jQuery(element).next('span').show();},unhighlight:function(element){jQuery(element).next('span').hide();}});if((!jQuery('.steps').valid())){return true;}
if(animating)return false;animating=true;current_fs=jQuery(this).parent();next_fs=jQuery(this).parent().next();jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");next_fs.show();current_fs.animate({opacity:0},{step:function(now,mx){scale=1-(1-now)*0.2;left=(now*50)+"%";opacity=1-now;current_fs.css({'transform':'scale('+scale+')'});next_fs.css({'left':left,'opacity':opacity});},duration:800,complete:function(){current_fs.hide();animating=false;},easing:'easeInOutExpo'});});jQuery(".submit").click(function(){jQuery(".steps").validate({errorClass:'invalid',errorElement:'span',errorPlacement:function(error,element){error.insertAfter(element.next('span').children());},highlight:function(element){jQuery(element).next('span').show();},unhighlight:function(element){jQuery(element).next('span').hide();}});if((!jQuery('.steps').valid())){return false;}
if(animating)return false;animating=true;current_fs=jQuery(this).parent();next_fs=jQuery(this).parent().next();jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");next_fs.show();current_fs.animate({opacity:0},{step:function(now,mx){scale=1-(1-now)*0.2;left=(now*50)+"%";opacity=1-now;current_fs.css({'transform':'scale('+scale+')'});next_fs.css({'left':left,'opacity':opacity});},duration:800,complete:function(){current_fs.hide();animating=false;},easing:'easeInOutExpo'});});jQuery(".previous").click(function(){if(animating)return false;animating=true;current_fs=jQuery(this).parent();previous_fs=jQuery(this).parent().prev();jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");previous_fs.show();current_fs.animate({opacity:0},{step:function(now,mx){scale=0.8+(1-now)*0.2;left=((1-now)*50)+"%";opacity=1-now;current_fs.css({'left':left});previous_fs.css({'transform':'scale('+scale+')','opacity':opacity});},duration:800,complete:function(){current_fs.hide();animating=false;},easing:'easeInOutExpo'});});});jQuery(document).ready(function(){jQuery("#edit-submitted-acquisition-amount-1,#edit-submitted-acquisition-amount-2,#edit-submitted-cultivation-amount-1,#edit-submitted-cultivation-amount-2,#edit-submitted-cultivation-amount-3,#edit-submitted-cultivation-amount-4,#edit-submitted-retention-amount-1,#edit-submitted-retention-amount-2,#edit-submitted-constituent-base-total-constituents").keyup(function(){calcTotal();});});function calcTotal(){var grade=0;var donorTotal=Number(jQuery("#edit-submitted-constituent-base-total-constituents").val().replace(/,/g,""));if(donorTotal)
{donorTotal=parseFloat(donorTotal);}
else
{donorTotal=0;}
grade+=getBonusDonorPoints(donorTotal);var acqAmount1=Number(jQuery("#edit-submitted-acquisition-amount-1").val().replace(/,/g,""));var acqAmount2=Number(jQuery("#edit-submitted-acquisition-amount-2").val().replace(/,/g,""));var acqTotal=0;if(acqAmount1){acqAmount1=parseFloat(acqAmount1);}else{acqAmount1=0;}
if(acqAmount2){acqAmount2=parseFloat(acqAmount2);}else{acqAmount2=0;}
if(acqAmount1>0&&acqAmount2>0){acqTotal=((acqAmount2-acqAmount1)/ acqAmount1*100).toFixed(2);}else{acqTotal=0;}
jQuery("#edit-submitted-acquisition-percent-change").val(acqTotal+'%');grade+=getAcquisitionPoints(acqTotal);console.log(grade);var cultAmount1=Number(jQuery("#edit-submitted-cultivation-amount-1").val().replace(/,/g,""));var cultAmount2=Number(jQuery("#edit-submitted-cultivation-amount-2").val().replace(/,/g,""));var cultTotal=0;if(cultAmount1){cultAmount1=parseFloat(cultAmount1);}else{cultAmount1=0;}
if(cultAmount2){cultAmount2=parseFloat(cultAmount2);}else{cultAmount2=0;}
if(cultAmount1>0&&cultAmount2>0){cultTotal=((cultAmount2-cultAmount1)/ cultAmount1*100).toFixed(2);}else{cultTotal=0;}
jQuery("#edit-submitted-cultivation-percent-change1").val(cultTotal+'%');grade+=getAcquisitionPoints(cultTotal);var cultAmount3=Number(jQuery("#edit-submitted-cultivation-amount-3").val().replace(/,/g,""));var cultAmount4=Number(jQuery("#edit-submitted-cultivation-amount-4").val().replace(/,/g,""));if(cultAmount3){cultAmount3=parseFloat(cultAmount3);}else{cultAmount3=0;}
if(cultAmount4){cultAmount4=parseFloat(cultAmount4);}else{cultAmount4=0;}
if(cultAmount3>0&&cultAmount4>0){cultTotal2=((cultAmount4-cultAmount3)/ cultAmount3*100).toFixed(2);}else{cultTotal2=0;}
jQuery("#edit-submitted-cultivation-percent-change2").val(cultTotal2+'%');grade+=getAcquisitionPoints(cultTotal2);var retAmount1=Number(jQuery("#edit-submitted-retention-amount-1").val().replace(/,/g,""));var retAmount2=Number(jQuery("#edit-submitted-retention-amount-2").val().replace(/,/g,""));var retTotal=0;if(retAmount1){retAmount1=parseFloat(retAmount1);}else{retAmount1=0;}
if(retAmount2){retAmount2=parseFloat(retAmount2);}else{retAmount2=0;}
if(retAmount1>0&&retAmount2>0){retTotal=(retAmount2 / retAmount1*100).toFixed(2);}else{retTotal=0;}
jQuery("#edit-submitted-retention-percent-change").val(retTotal+'%');grade+=getAcquisitionPoints(retTotal);jQuery("#edit-submitted-final-grade-grade").val(grade+' / 400');}
function getAcquisitionPoints(val)
{if(val<1)
{return 0;}
else if(val>=1&&val<6)
{return 50;}
else if(val>=6&&val<11)
{return 60;}
else if(val>=11&&val<16)
{return 70;}
else if(val>=16&&val<21)
{return 75;}
else if(val>=21&&val<26)
{return 80;}
else if(val>=26&&val<31)
{return 85;}
else if(val>=31&&val<36)
{return 90;}
else if(val>=36&&val<41)
{return 95;}
else if(val>=41)
{return 100;}}
function getCultivationGiftPoints(val)
{if(val<1)
{return 0;}
else if(val>=1&&val<4)
{return 50;}
else if(val>=4&&val<7)
{return 60;}
else if(val>=7&&val<10)
{return 70;}
else if(val>=10&&val<13)
{return 75;}
else if(val>=13&&val<16)
{return 80;}
else if(val>=16&&val<21)
{return 85;}
else if(val>=21&&val<26)
{return 90;}
else if(val>=26&&val<51)
{return 95;}
else if(val>=51)
{return 100;}}
function getCultivationDonationPoints(val)
{if(val<1)
{return 0;}
else if(val>=1&&val<6)
{return 50;}
else if(val>=6&&val<11)
{return 60;}
else if(val>=11&&val<16)
{return 70;}
else if(val>=16&&val<21)
{return 75;}
else if(val>=21&&val<26)
{return 80;}
else if(val>=26&&val<31)
{return 85;}
else if(val>=31&&val<36)
{return 90;}
else if(val>=36&&val<41)
{return 95;}
else if(val>=41)
{return 100;}}
function getRetentionPoints(val)
{if(val<1)
{return 0;}
else if(val>=1&&val<51)
{return 50;}
else if(val>=51&&val<56)
{return 60;}
else if(val>=56&&val<61)
{return 70;}
else if(val>=61&&val<66)
{return 75;}
else if(val>=66&&val<71)
{return 80;}
else if(val>=71&&val<76)
{return 85;}
else if(val>=76&&val<81)
{return 90;}
else if(val>=81&&val<91)
{return 95;}
else if(val>=91)
{return 100;}}
function getBonusDonorPoints(val)
{if(val<10001)
{return 0;}
else if(val>=10001&&val<25001)
{return 10;}
else if(val>=25001&&val<50000)
{return 15;}
else if(val>=50000)
{return 20;}}
jQuery(document).ready(function(){

  // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");

    // Declare a loop variable
    var i;

    // List View
    function listView() {
        for (i = 0; i < elements.length; i++) {
            elements[i].style.width = "100%";
        }
    }

    // Grid View
    function gridView() {
        for (i = 0; i < elements.length; i++) {
            elements[i].style.width = "50%";
        }
    }

    /* Optional: Add active class to the current button (highlight it) */
    var container = document.getElementById("btnContainer");
    if ( container != null ) {
        var btns = container.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(){
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    }
});
