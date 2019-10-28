/*jQuery(document).ready(function(){
  var fullname = jQuery("#full_name").val();
 jQuery(".next").click(function(){
  alert(fullname);
  
  if(fullname == "") {  
  event.preventDefault(); 
    jQuery('#full_name').css('border-color','red');
  }


 })
});*/
/*jQuery(".next, .submit").click(function(e){
   // e.preventDefault();
        var form = jQuery("#msform");
        form.validate({
            rules: {
                user_name: {
                    required: true,
                    minlength: 4,
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
                },
                reg_add:{
                    required: true,
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
                 a_12: {
                    required: true,
                    
                },
            },
            messages: {
                user_name: {
                    required: "Username required",
                },
                 user_email: {
                    required: "Username Email required",
                },
                 full_name: {
                    required: "Full Name required",
                },
                orgname: {
                    required: "Organisation required",
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
                    required: "Select NFO Trype required",
                },
                 a_12: {
                    required: "Enter A12 required",
                },
                 g_80: {
                    required: "Enter G80 required",
                },
            }
        });
        if (form.valid() == true){
            current_fs = jQuery('#basic');
            next_fs =jQuery('#orgname');
            next_fs.show(); 
            current_fs.hide();
            return true;

    }else{
        e.preventDefault();
        

          
 }
});*/