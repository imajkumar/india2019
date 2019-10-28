<?php
/*
 Plugin Name: Post Request Review 
 Plugin URI: https://techbrise.com
 description: A plugin to prevent the direct post publish by admin in Multisite networks
 Version: 1.0
 Author:TechBrise Solutions
 Author URI:  https://www.techbrise.com
 License: GPL2
*/
?>
<?php 
function tbs_remove_author_publish_posts(){

    // $wp_roles is an instance of WP_Roles.
    global $wp_roles;
    //print_r ($wp_roles);
    //$wp_roles->remove_cap( 'ngo_charitable', 'publish_posts' );
    //$wp_roles->remove_cap( 'ngo_charitable', 'publish_pages' );
    $wp_roles->remove_cap( 'ngo_charitable', 'publish_campaigns' );
    //$wp_roles->remove_cap( 'ngo_charitable', 'edit_published_pages' );
    //$wp_roles->remove_cap( 'ngo_charitable', 'edit_published_posts' ); 
    $wp_roles->remove_cap( 'ngo_charitable', 'edit_published_campaigns' ); 
    //$wp_roles->remove_cap( 'ngo_charitable', 'update_publish_campaigns' ); 
}

add_action( 'init', 'tbs_remove_author_publish_posts' );

/*function tbs_send_mail_on_project_publish(){
   $to = 'ashishk@techbrise.com';
   $subject = 'The subject';
   $body = 'The email body content';
   $headers = array('Content-Type: text/html; charset=UTF-8');
    
   $pass= wp_mail( $to, $subject, $body, $headers );
   if($pass){
      echo "Mail send.";
   }
   else{
      echo "Try more";
   }

}
add_action('save_post', 'tbs_send_mail_on_project_publish')*/

add_action('future_to_pending', 'send_emails_on_new_event');
add_action('new_to_pending', 'send_emails_on_new_event');
add_action('draft_to_pending', 'send_emails_on_new_event');
add_action('auto-draft_to_pending', 'send_emails_on_new_event');

/**
* Send emails on event publication
*
* @param WP_Post $post
*/
function send_emails_on_new_event($post){
   $author_id = $post->post_author;
   //$emails = "ashishk@techbrise.com, akmashish15@gmail.com"; 
   $ngo_mail = get_the_author_meta( 'user_email' , $author_id );
  //$emails = "ashishk@techbrise.com, akmashish15@gmail.com"; 
   $user_salutation = get_user_meta( $author_id, 'user_prefix_name', true );
   $user_last_name = get_user_meta( $author_id, 'user_last_name', true );
   $emails = get_option('admin_email');
   $title = wp_strip_all_tags(get_the_title($post->ID));
   $url = get_permalink($post->ID);
   $message = "Hi Admin, There is Project proposal:\n{$url}";
   $ngo_message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
   <html xmlns='http://www.w3.org/1999/xhtml'>
   <head>
     <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
     <meta name='viewport' content='width=device-width, initial-scale=1' />
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
   
     <title>India Donates</title>
   
     <style type='text/css'>
       /* Take care of image borders and formatting, client hacks */
       img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
       a img { border: none; }
       table { border-collapse: collapse !important;}
       #outlook a { padding:0; }
       .ReadMsgBody { width: 100%; }
       .ExternalClass { width: 100%; }
       .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
       table td { border-collapse: collapse; }
       .ExternalClass * { line-height: 115%; }
       .container-for-gmail-android { min-width: 600px; }
   
   
       /* General styling */
       * {
         font-family: Helvetica, Arial, sans-serif;
       }
   
       body {
         -webkit-font-smoothing: antialiased;
         -webkit-text-size-adjust: none;
         width: 100% !important;
         margin: 0 !important;
         height: 100%;
         color: #676767;
       }
   
       td {
         font-family: Helvetica, Arial, sans-serif;
         font-size: 14px;
         color: #777777;
         text-align: center;
         line-height: 21px;
       }
   
       a {
         color: #676767;
         text-decoration: none !important;
         cursor: pointer;
       }
   
       .pull-left {
         text-align: left;
       }
   
       .pull-right {
         text-align: right;
       }
   
       .header-lg,
       .header-md,
       .header-sm {
         font-size: 32px;
         font-weight: 700;
         line-height: normal;
         padding: 35px 0 25px;
         color: #4d4d4d;
       }
   
       .header-md {
         font-size: 24px;
       }
   
       .header-sm {
         padding: 5px 0;
         font-size: 18px;
         line-height: 1.3;
       }
   
       .content-padding {
         padding: 20px 0 30px;
       }
   
       .mobile-header-padding-right {
         width: 290px;
         text-align: right;
         padding-left: 10px;
       }
   
       .mobile-header-padding-left {
         width: 290px;
         text-align: left;
         padding-left: 10px;
       }
   
       .free-text {
         width: 100% !important;
         padding: 10px 60px 0px;
       }
   
       .block-rounded {
         border-radius: 5px;
         border: 1px solid #e5e5e5;
         vertical-align: top;
       }
   
       .button {
         padding: 55px 0 0;
       }
   
       .info-block {
         padding: 0 20px;
         width: 260px;
       }
   
       .mini-block-container {
         padding: 30px 50px;
         width: 500px;
       }
   
       .mini-block {
         background-color: #ffffff;
         width: 498px;
         border: 1px solid #cccccc;
         border-radius: 5px;
         padding: 60px 75px;
       }
   
       .block-rounded {
         width: 260px;
       }
   
       .info-img {
         width: 258px;
         border-radius: 5px 5px 0 0;
       }
   
       .force-width-img {
         width: 480px;
         height: 1px !important;
       }
   
       .force-width-full {
         width: 600px;
         height: 1px !important;
       }
   
       .user-img img {
         width: 82px;
         border-radius: 5px;
         border: 1px solid #cccccc;
       }
   
       .user-img {
         width: 92px;
         text-align: left;
       }
   
       .user-msg {
         width: 236px;
         font-size: 14px;
         text-align: left;
         font-style: italic;
       }
   
       .code-block {
         padding: 10px 0;
         border: 1px solid #cccccc;
         color: #4d4d4d;
         font-weight: bold;
         font-size: 18px;
         text-align: center;
       }
   
       .force-width-gmail {
         min-width:600px;
         height: 0px !important;
         line-height: 1px !important;
         font-size: 1px !important;
       }
   
        .button-width {
         width: 228px;
       }
       .fab {
       font-family: 'Font Awesome 5 Brands' !important;
       }
       .bottom_regards {
       text-align: left;
       padding: 10px 60px 0px;
       }
     </style>
   
     <style type='text/css' media='screen'>
       @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
     </style>
   
     <style type='text/css' media='screen'>
       @media screen {
         /* Thanks Outlook 2013! */
         * {
           font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
         }
       }
     </style>
   
     <style type='text/css' media='only screen and (max-width: 480px)'>
       /* Mobile styles */
       @media only screen and (max-width: 480px) {
   
         table[class*='container-for-gmail-android'] {
           min-width: 290px !important;
           width: 100% !important;
         }
   
         table[class='w320'] {
           width: 320px !important;
         }
   
         img[class='force-width-gmail'] {
           display: none !important;
           width: 0 !important;
           height: 0 !important;
         }
   
         a[class='button-width'],
         a[class='button-mobile'] {
           width: 248px !important;
         }
   
         td[class*='mobile-header-padding-left'] {
           width: 160px !important;
           padding-left: 0 !important;
         }
   
         td[class*='mobile-header-padding-right'] {
           width: 160px !important;
           padding-right: 0 !important;
         }
   
         td[class='header-lg'] {
           font-size: 24px !important;
           padding-bottom: 5px !important;
         }
   
         td[class='header-md'] {
           font-size: 18px !important;
           padding-bottom: 5px !important;
         }
   
         td[class='content-padding'] {
           padding: 5px 0 30px !important;
         }
   
          td[class='button'] {
           padding: 15px 0 5px !important;
         }
   
         td[class*='free-text'] {
           padding: 10px 18px 30px !important;
         }
   
         img[class='force-width-img'],
         img[class='force-width-full'] {
           display: none !important;
         }
   
         td[class='info-block'] {
           display: block !important;
           width: 280px !important;
           padding-bottom: 40px !important;
         }
   
         td[class='info-img'],
         img[class='info-img'] {
           width: 278px !important;
         }
   
         td[class='mini-block-container'] {
           padding: 8px 20px !important;
           width: 280px !important;
         }
   
         td[class='mini-block'] {
           padding: 20px !important;
         }
   
         td[class='user-img'] {
           display: block !important;
           text-align: center !important;
           width: 100% !important;
           padding-bottom: 10px;
         }
   
         td[class='user-msg'] {
           display: block !important;
           padding-bottom: 20px !important;
         }
       }
     </style>
   </head>
   
   <body bgcolor='#f7f7f7'>
   <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
     <tr>
       <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
         <center>
         <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
           <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
             <tr>
               <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                 <center>
                   <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                     <tr>
                       <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                         <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                       </td>
                       <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                         <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
                       </td>
                     </tr>
                   </table>
                 </center>
                 <!--[if gte mso 9]>
                 </v:textbox>
               </v:rect>
               <![endif]-->
               </td>
             </tr>
           </table>
         </center>
       </td>
     </tr>
     <tr>
       <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
         <center>
           <table cellspacing='0' cellpadding='0' width='600' class='w320'>
             <tr>
               <td class='header-lg'>
                 Welcome
               </td>
             </tr>
             <tr>
               <td class='free-text pull-left'>
                 <strong>Hooray! You’re on board with us!</strong> <br />
                 <br>
                 Dear <strong>$user_salutation, $user_last_name</strong>
   
                 <p>We are happy to inform you that we have received your project details & we will be publishing it soon and would be notifying you, once your project is live.</p>
   
               </td>
             </tr>
   
             <tr>
               <td>
                 <div class='bottom_regards'>
                   <p>Regards, </p>
                   <p><strong>IndiaDonatesTeam</strong></p>
                 </div>
               </td>
             </tr>
           </table>
         </center>
       </td>
     </tr>
   
     <tr>
       <td align='center' valign='top' width='100%' style='background-color: #fff; height: 100px;'>
         <center>
           <table cellspacing='0' cellpadding='0' width='600' class='w320'>
             <tr>
               <td style='padding: 25px 0 25px'>
                 <a style='margin-bottom: 10px;' href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a><br />
   
                   <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                     Sector 20, Noida<br>
                     Uttar Pradesh 201301.<br>
                     <span class='text-white'>Phone:</span><a href='tel:+91-120-4773200'> +91-120-4773200</a><br>
                     <span class='text-white'>Email:</span><a href='mailto:hello@indiadonates.in'> hello@indiadonates.in</a></p>
                   </div>
               </td>
             </tr>
           </table>
         </center>
       </td>
     </tr>
   </table>
   </body>
   </html>";

   wp_mail( $emails, "New Project Proposal: {$title}", $message );
   wp_mail( $ngo_mail, "Thank you for your project proposal: {$title}", $ngo_message );
}

add_action('pending_to_publish', 'send_emails_on_publish');
//send mail to the NGO after Project publish.
function send_emails_on_publish($post){
  $author_id = $post->post_author;
  //$emails = "ashishk@techbrise.com, akmashish15@gmail.com"; 
  $ngo_mail = get_the_author_meta( 'user_email' , $author_id );
  $user_salutation = get_user_meta( $author_id, 'user_prefix_name', true );
  $user_last_name = get_user_meta( $author_id, 'user_last_name', true );
  $title = wp_strip_all_tags(get_the_title($post->ID));
  $url = get_permalink($post->ID);
  $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
  <html xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
  
    <title>India Donates</title>
  
    <style type='text/css'>
      /* Take care of image borders and formatting, client hacks */
      img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
      a img { border: none; }
      table { border-collapse: collapse !important;}
      #outlook a { padding:0; }
      .ReadMsgBody { width: 100%; }
      .ExternalClass { width: 100%; }
      .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
      table td { border-collapse: collapse; }
      .ExternalClass * { line-height: 115%; }
      .container-for-gmail-android { min-width: 600px; }
  
  
      /* General styling */
      * {
        font-family: Helvetica, Arial, sans-serif;
      }
  
      body {
        -webkit-font-smoothing: antialiased;
        -webkit-text-size-adjust: none;
        width: 100% !important;
        margin: 0 !important;
        height: 100%;
        color: #676767;
      }
  
      td {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #777777;
        text-align: center;
        line-height: 21px;
      }
  
      a {
        color: #676767;
        text-decoration: none !important;
        cursor: pointer;
      }
  
      .pull-left {
        text-align: left;
      }
  
      .pull-right {
        text-align: right;
      }
  
      .header-lg,
      .header-md,
      .header-sm {
        font-size: 32px;
        font-weight: 700;
        line-height: normal;
        padding: 35px 0 25px;
        color: #4d4d4d;
      }
  
      .header-md {
        font-size: 24px;
      }
  
      .header-sm {
        padding: 5px 0;
        font-size: 18px;
        line-height: 1.3;
      }
  
      .content-padding {
        padding: 20px 0 30px;
      }
  
      .mobile-header-padding-right {
        width: 290px;
        text-align: right;
        padding-left: 10px;
      }
  
      .mobile-header-padding-left {
        width: 290px;
        text-align: left;
        padding-left: 10px;
      }
  
      .free-text {
        width: 100% !important;
        padding: 10px 60px 0px;
      }
  
      .block-rounded {
        border-radius: 5px;
        border: 1px solid #e5e5e5;
        vertical-align: top;
      }
  
      .button {
        padding: 55px 0 0;
      }
  
      .info-block {
        padding: 0 20px;
        width: 260px;
      }
  
      .mini-block-container {
        padding: 30px 50px;
        width: 500px;
      }
  
      .mini-block {
        background-color: #ffffff;
        width: 498px;
        border: 1px solid #cccccc;
        border-radius: 5px;
        padding: 60px 75px;
      }
  
      .block-rounded {
        width: 260px;
      }
  
      .info-img {
        width: 258px;
        border-radius: 5px 5px 0 0;
      }
  
      .force-width-img {
        width: 480px;
        height: 1px !important;
      }
  
      .force-width-full {
        width: 600px;
        height: 1px !important;
      }
  
      .user-img img {
        width: 82px;
        border-radius: 5px;
        border: 1px solid #cccccc;
      }
  
      .user-img {
        width: 92px;
        text-align: left;
      }
  
      .user-msg {
        width: 236px;
        font-size: 14px;
        text-align: left;
        font-style: italic;
      }
  
      .code-block {
        padding: 10px 0;
        border: 1px solid #cccccc;
        color: #4d4d4d;
        font-weight: bold;
        font-size: 18px;
        text-align: center;
      }
  
      .force-width-gmail {
        min-width:600px;
        height: 0px !important;
        line-height: 1px !important;
        font-size: 1px !important;
      }
  
       .button-width {
        width: 228px;
      }
      .fab {
      font-family: 'Font Awesome 5 Brands' !important;
      }
      .bottom_regards {
      text-align: left;
      padding: 10px 60px 0px;
      }
    </style>
  
    <style type='text/css' media='screen'>
      @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
    </style>
  
    <style type='text/css' media='screen'>
      @media screen {
        /* Thanks Outlook 2013! */
        * {
          font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
      }
    </style>
  
    <style type='text/css' media='only screen and (max-width: 480px)'>
      /* Mobile styles */
      @media only screen and (max-width: 480px) {
  
        table[class*='container-for-gmail-android'] {
          min-width: 290px !important;
          width: 100% !important;
        }
  
        table[class='w320'] {
          width: 320px !important;
        }
  
        img[class='force-width-gmail'] {
          display: none !important;
          width: 0 !important;
          height: 0 !important;
        }
  
        a[class='button-width'],
        a[class='button-mobile'] {
          width: 248px !important;
        }
  
        td[class*='mobile-header-padding-left'] {
          width: 160px !important;
          padding-left: 0 !important;
        }
  
        td[class*='mobile-header-padding-right'] {
          width: 160px !important;
          padding-right: 0 !important;
        }
  
        td[class='header-lg'] {
          font-size: 24px !important;
          padding-bottom: 5px !important;
        }
  
        td[class='header-md'] {
          font-size: 18px !important;
          padding-bottom: 5px !important;
        }
  
        td[class='content-padding'] {
          padding: 5px 0 30px !important;
        }
  
         td[class='button'] {
          padding: 15px 0 5px !important;
        }
  
        td[class*='free-text'] {
          padding: 10px 18px 30px !important;
        }
  
        img[class='force-width-img'],
        img[class='force-width-full'] {
          display: none !important;
        }
  
        td[class='info-block'] {
          display: block !important;
          width: 280px !important;
          padding-bottom: 40px !important;
        }
  
        td[class='info-img'],
        img[class='info-img'] {
          width: 278px !important;
        }
  
        td[class='mini-block-container'] {
          padding: 8px 20px !important;
          width: 280px !important;
        }
  
        td[class='mini-block'] {
          padding: 20px !important;
        }
  
        td[class='user-img'] {
          display: block !important;
          text-align: center !important;
          width: 100% !important;
          padding-bottom: 10px;
        }
  
        td[class='user-msg'] {
          display: block !important;
          padding-bottom: 20px !important;
        }
      }
    </style>
  </head>
  
  <body bgcolor='#f7f7f7'>
  <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
    <tr>
      <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
        <center>
        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
          <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
            <tr>
              <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                <center>
                  <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                    <tr>
                      <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                        <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                      </td>
                      <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                        <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
                      </td>
                    </tr>
                  </table>
                </center>
                <!--[if gte mso 9]>
                </v:textbox>
              </v:rect>
              <![endif]-->
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
    <tr>
      <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
        <center>
          <table cellspacing='0' cellpadding='0' width='600' class='w320'>
            <tr>
              <td class='header-lg'>
                Welcome
              </td>
            </tr>
            <tr>
              <td class='free-text pull-left'>
                <strong>Hooray! You’re on board with us!</strong> <br />
                <br>
                Dear <strong>$user_salutation, $user_last_name</strong>
  
                <p>We are happy to inform you that your project is live.\n<a href='{$url}'></a></p>
  
              </td>
            </tr>
  
            <tr>
              <td>
                <div class='bottom_regards'>
                  <p>Regards, </p>
                  <p><strong>IndiaDonatesTeam</strong></p>
                </div>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
  
    <tr>
      <td align='center' valign='top' width='100%' style='background-color: #fff; height: 100px;'>
        <center>
          <table cellspacing='0' cellpadding='0' width='600' class='w320'>
            <tr>
              <td style='padding: 25px 0 25px'>
                <a style='margin-bottom: 10px;' href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a><br />
  
                  <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                    Sector 20, Noida<br>
                    Uttar Pradesh 201301.<br>
                    <span class='text-white'>Phone:</span><a href='tel:+91-120-4773200'> +91-120-4773200</a><br>
                    <span class='text-white'>Email:</span><a href='mailto:hello@indiadonates.in'> hello@indiadonates.in</a></p>
                  </div>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
  </table>
  </body>
  </html>";

  //wp_mail( $emails, "New post published: {$title}", $message );
  wp_mail( $ngo_mail, "Your Project has been published: {$title}", $message );
}


//code to send the mail on post status pending. 
add_action( 'transition_post_status', 'tbs_pending_post_status', 10, 3 );

function tbs_pending_post_status( $new_status, $old_status, $post ) {

   if ( $new_status === "pending" ) {
     $ngo_id = get_current_user_id();
     $ngo_mail = get_user_meta($ngo_id, 'user_email', true );
     $emails = get_option('admin_email');
     $title = wp_strip_all_tags(get_the_title($post->ID));
     $url = get_permalink($post->ID);
     $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
     <html xmlns='http://www.w3.org/1999/xhtml'>
     <head>
       <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
       <meta name='viewport' content='width=device-width, initial-scale=1' />
       <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
     
       <title>India Donates</title>
     
       <style type='text/css'>
         /* Take care of image borders and formatting, client hacks */
         img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
         a img { border: none; }
         table { border-collapse: collapse !important;}
         #outlook a { padding:0; }
         .ReadMsgBody { width: 100%; }
         .ExternalClass { width: 100%; }
         .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
         table td { border-collapse: collapse; }
         .ExternalClass * { line-height: 115%; }
         .container-for-gmail-android { min-width: 600px; }
     
     
         /* General styling */
         * {
           font-family: Helvetica, Arial, sans-serif;
         }
     
         body {
           -webkit-font-smoothing: antialiased;
           -webkit-text-size-adjust: none;
           width: 100% !important;
           margin: 0 !important;
           height: 100%;
           color: #676767;
         }
     
         td {
           font-family: Helvetica, Arial, sans-serif;
           font-size: 14px;
           color: #777777;
           text-align: center;
           line-height: 21px;
         }
     
         a {
           color: #676767;
           text-decoration: none !important;
           cursor: pointer;
         }
     
         .pull-left {
           text-align: left;
         }
     
         .pull-right {
           text-align: right;
         }
     
         .header-lg,
         .header-md,
         .header-sm {
           font-size: 32px;
           font-weight: 700;
           line-height: normal;
           padding: 35px 0 25px;
           color: #4d4d4d;
         }
     
         .header-md {
           font-size: 24px;
         }
     
         .header-sm {
           padding: 5px 0;
           font-size: 18px;
           line-height: 1.3;
         }
     
         .content-padding {
           padding: 20px 0 30px;
         }
     
         .mobile-header-padding-right {
           width: 290px;
           text-align: right;
           padding-left: 10px;
         }
     
         .mobile-header-padding-left {
           width: 290px;
           text-align: left;
           padding-left: 10px;
         }
     
         .free-text {
           width: 100% !important;
           padding: 10px 60px 0px;
         }
     
         .block-rounded {
           border-radius: 5px;
           border: 1px solid #e5e5e5;
           vertical-align: top;
         }
     
         .button {
           padding: 55px 0 0;
         }
     
         .info-block {
           padding: 0 20px;
           width: 260px;
         }
     
         .mini-block-container {
           padding: 30px 50px;
           width: 500px;
         }
     
         .mini-block {
           background-color: #ffffff;
           width: 498px;
           border: 1px solid #cccccc;
           border-radius: 5px;
           padding: 60px 75px;
         }
     
         .block-rounded {
           width: 260px;
         }
     
         .info-img {
           width: 258px;
           border-radius: 5px 5px 0 0;
         }
     
         .force-width-img {
           width: 480px;
           height: 1px !important;
         }
     
         .force-width-full {
           width: 600px;
           height: 1px !important;
         }
     
         .user-img img {
           width: 82px;
           border-radius: 5px;
           border: 1px solid #cccccc;
         }
     
         .user-img {
           width: 92px;
           text-align: left;
         }
     
         .user-msg {
           width: 236px;
           font-size: 14px;
           text-align: left;
           font-style: italic;
         }
     
         .code-block {
           padding: 10px 0;
           border: 1px solid #cccccc;
           color: #4d4d4d;
           font-weight: bold;
           font-size: 18px;
           text-align: center;
         }
     
         .force-width-gmail {
           min-width:600px;
           height: 0px !important;
           line-height: 1px !important;
           font-size: 1px !important;
         }
     
          .button-width {
           width: 228px;
         }
         .fab {
         font-family: 'Font Awesome 5 Brands' !important;
         }
         .bottom_regards {
         text-align: left;
         padding: 10px 60px 0px;
         }
       </style>
     
       <style type='text/css' media='screen'>
         @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
       </style>
     
       <style type='text/css' media='screen'>
         @media screen {
           /* Thanks Outlook 2013! */
           * {
             font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
           }
         }
       </style>
     
       <style type='text/css' media='only screen and (max-width: 480px)'>
         /* Mobile styles */
         @media only screen and (max-width: 480px) {
     
           table[class*='container-for-gmail-android'] {
             min-width: 290px !important;
             width: 100% !important;
           }
     
           table[class='w320'] {
             width: 320px !important;
           }
     
           img[class='force-width-gmail'] {
             display: none !important;
             width: 0 !important;
             height: 0 !important;
           }
     
           a[class='button-width'],
           a[class='button-mobile'] {
             width: 248px !important;
           }
     
           td[class*='mobile-header-padding-left'] {
             width: 160px !important;
             padding-left: 0 !important;
           }
     
           td[class*='mobile-header-padding-right'] {
             width: 160px !important;
             padding-right: 0 !important;
           }
     
           td[class='header-lg'] {
             font-size: 24px !important;
             padding-bottom: 5px !important;
           }
     
           td[class='header-md'] {
             font-size: 18px !important;
             padding-bottom: 5px !important;
           }
     
           td[class='content-padding'] {
             padding: 5px 0 30px !important;
           }
     
            td[class='button'] {
             padding: 15px 0 5px !important;
           }
     
           td[class*='free-text'] {
             padding: 10px 18px 30px !important;
           }
     
           img[class='force-width-img'],
           img[class='force-width-full'] {
             display: none !important;
           }
     
           td[class='info-block'] {
             display: block !important;
             width: 280px !important;
             padding-bottom: 40px !important;
           }
     
           td[class='info-img'],
           img[class='info-img'] {
             width: 278px !important;
           }
     
           td[class='mini-block-container'] {
             padding: 8px 20px !important;
             width: 280px !important;
           }
     
           td[class='mini-block'] {
             padding: 20px !important;
           }
     
           td[class='user-img'] {
             display: block !important;
             text-align: center !important;
             width: 100% !important;
             padding-bottom: 10px;
           }
     
           td[class='user-msg'] {
             display: block !important;
             padding-bottom: 20px !important;
           }
         }
       </style>
     </head>
     
     <body bgcolor='#f7f7f7'>
     <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
       <tr>
         <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
           <center>
           <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
             <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
               <tr>
                 <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                   <center>
                     <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                       <tr>
                         <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                           <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                         </td>
                         <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                           <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
                         </td>
                       </tr>
                     </table>
                   </center>
                   <!--[if gte mso 9]>
                   </v:textbox>
                 </v:rect>
                 <![endif]-->
                 </td>
               </tr>
             </table>
           </center>
         </td>
       </tr>
       <tr>
         <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
           <center>
             <table cellspacing='0' cellpadding='0' width='600' class='w320'>
               <tr>
                 <td class='header-lg'>
                   Welcome
                 </td>
               </tr>
               <tr>
                 <td class='free-text pull-left'>
                   <strong>Hooray! You’re on board with us!</strong> <br />
                   <br>
                   Dear <strong>Mr./Ms., Last Name</strong>
     
                   <p>It feels great to inform you that we have received your project details & we will be publishing it soon and notifying you once your project is live.</p>
     
                 </td>
               </tr>
     
               <tr>
                 <td>
                   <div class='bottom_regards'>
                     <p>Regards, </p>
                     <p><strong>IndiaDonatesTeam</strong></p>
                   </div>
                 </td>
               </tr>
             </table>
           </center>
         </td>
       </tr>
     
       <tr>
         <td align='center' valign='top' width='100%' style='background-color: #fff; height: 100px;'>
           <center>
             <table cellspacing='0' cellpadding='0' width='600' class='w320'>
               <tr>
                 <td style='padding: 25px 0 25px'>
                   <a style='margin-bottom: 10px;' href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a><br />
     
                     <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                       Sector 20, Noida<br>
                       Uttar Pradesh 201301.<br>
                       <span class='text-white'>Phone:</span><a href='tel:+91-120-4773200'> +91-120-4773200</a><br>
                       <span class='text-white'>Email:</span><a href='mailto:hello@indiadonates.in'> hello@indiadonates.in</a></p>
                     </div>
                 </td>
               </tr>
             </table>
           </center>
         </td>
       </tr>
     </table>
     </body>
     </html>
     ";
     $headers = 'From: My Name <no-reply@indidonates.in>' . "\r\n";

    wp_mail( $ngo_mail, "New post published check here.: {$title}", $message , $headers );
  }

}

?>