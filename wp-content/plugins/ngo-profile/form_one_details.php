<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- include summernote css/js -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
   <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
   <script src="//cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
   <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
   <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>






   <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>

<?php

     if( isset( $_GET['nunid'] ) ){
        $nid = $_GET['nunid'];
        $ngo_user_data = get_userdata( $nid );
        $user_ngo_login =  $ngo_user_data->user_login;
        $user_ngo_password = $ngo_user_data->user_pass;
        $user_ngo_email_id = $ngo_user_data->user_email;
        $user_ngo_web = $ngo_user_data->user_url;
        $user_ngo_name = $ngo_user_data->display_name;
        $ngo_user_meta = get_user_meta( $nid );
        //print_r($ngo_user_meta);
        $ngo_user_org_name = get_user_meta( $nid, 'org_name', true);
        $ngo_user_prefix_name = get_user_meta( $nid, 'user_prefix_name', true );
        $ngo_user_first_name = get_user_meta( $nid, 'user_first_name', true );
        $ngo_user_last_name = get_user_meta( $nid, 'user_last_name', true );
        $ngo_user_state = get_user_meta( $nid, 'user_state', true );
        $ngo_user_city = get_user_meta( $nid, 'user_city', true );
        $ngo_user_mobile_number = get_user_meta( $nid, 'user_phone', true );
        $ngo_user_desig = get_user_meta( $nid, 'user_designation', true );
        $ngo_user_reg_add = get_user_meta( $nid, 'user_reg_add', true );
        $ngo_user_reg_type = get_user_meta( $nid, 'user_ngo_type', true );
        $ngo_user_last_incom = get_user_meta( $nid, 'user_last_year_incom',true );
        $ngo_user_last_expd = get_user_meta( $nid, 'user_last_year_expd' ,true );
        $ngo_user_a_12_number = get_user_meta( $nid, 'user_a_12' ,true );
        $ngo_user_g_80_number = get_user_meta( $nid, 'user_g_80', true );
        $ngo_user_pan_number = get_user_meta( $nid, 'user_pan' ,true );
        $ngo_user_tan_number = get_user_meta( $nid, 'user_tan', true );
        $ngo_user_causes_for = get_user_meta( $nid, 'user_causes_for', true );
        $ngo_user_other_causes = get_user_meta( $nid, 'user_other_causes', true );
        $ngo_user_temp_pass = get_user_meta( $nid, 'vikkip', true );
      // echo" <center><h1> NGO Form- 1 details</h1></center>";

       ?>
       <div class="user-ngo-details-main-div">
       <center><h1> NGO Registration Details (Form-1)</h1></center>
         <div class="user-ngo-details-inner-first-div">
           <table class="tg">
             <tr>
               <td class="tg-0lax">Organsiation Name</td>
               <td class="tg-lqy6">:   <?php echo $ngo_user_org_name; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">State</td>
               <td class="tg-lqy6">:  <?php
               global $wpdb;
               $results_state = $wpdb->get_results( "SELECT * FROM wp_state_city WHERE id = $ngo_user_state;");
               foreach ($results_state as $key ) {?>
              <?php echo $key->name; }?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Full Name</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_prefix_name." ". $ngo_user_first_name." ".$ngo_user_last_name ; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Mobile Number</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_mobile_number; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Registered Address</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_reg_add; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Last Year's Income</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_last_incom; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">80G</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_g_80_number; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">PAN</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_pan_number; ?></td>
             </tr>

             <tr>
               <td class="tg-0lax">Causes support</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_causes_for; echo $ngo_user_other_causes; ?></td>
             </tr>

           </table>

         </div>
         <div class="user-ngo-details-inner-second-div">
           <table class="tg">
             <tr>
               <td class="tg-0lax">Websites</td>
               <td class="tg-lqy6">:  <?php echo $user_ngo_web; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">city</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_city; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Designation</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_desig; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax ">Email</td>
               <td class="tg-lqy6">:  <?php echo $user_ngo_email_id; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Registration type</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_reg_type; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">Last Year's Expenditure</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_last_expd; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">12A</td>
               <td class="tg-lqy6">:  <?php echo  $ngo_user_a_12_number; ?></td>
             </tr>
             <tr>
               <td class="tg-0lax">TAN</td>
               <td class="tg-lqy6">:  <?php echo $ngo_user_tan_number; ?></td>
             </tr>
             <tr style="background-color:transparent; border-bottom:transparent;">
               <td class="tg-0lax"></td>
               <td class="tg-lqy6"></td>
             </tr>
           </table>

         </div>
   	  <div style="clear:both;"></div>
   		<!-- <center>
       <center><h1> Board Member</h1></center>
         <div class="">
           <table class="tg">
             <tr>
   		  <th>S.No</th>
   		  <th>Name</th>
   		  <th>Designation</th>
   		  <th>Tenure</th>
   		  <th>Occupation</th>
   		  <th>Relationship</th></tr>
   	  <?php $s=1;
   	  $results_state11 = $wpdb->get_results( "SELECT * FROM wp_board_member WHERE user_id = $nid");
               foreach ($results_state11 as $key ) { ?>

   		  <tr>
               <td class="tg-0lax"><?php echo $s++ ?></td>
               <td class="tg-lqy6">  <?php echo $key->name; ?></td>
   			<td class="tg-lqy6">  <?php echo $key->designation; ?></td>
   			<td class="tg-lqy6">  <?php echo $key->tenure; ?></td>
   			<td class="tg-lqy6">  <?php echo $key->occupation; ?></td>
   			<td class="tg-lqy6"> <?php echo $key->relationship; ?></td>
             </tr>

   			<?php } ?>

   			 </table>

         </div>

   	  </center>-->
   	  <div style="clear:both;"></div>
           <?php
           if ( isset( $_POST["approve"] ) ) {
   			$idsa = $_POST['useridss']; //Array ( [approve] => yes [useridss] => 323 )

   			 $saltdd = $idsa.$user_ngo_email_id;
   			$awesome_level = md5($saltdd);
   			update_user_meta( $idsa, 'salltddata', $awesome_level);
             $link = admin_url('/admin.php?page=ngo_profile_form');
             $message = "Mail Sent to NGO!";
             $arr_of_name = explode(' ', $ngo_user_full_name );
             $lastname = array_pop( $arr_of_name );
             $password_rset_link = home_url('/login/change-password/?daata='.$awesome_level.'&d1='.$idsa);

             $ngo_form_Second_link = admin_url('/admin.php?page=ngo_profile_form');
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
                     padding: 10px 10px 0px;
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
                     padding: 30px 10px;
                     width: 500px;
                   }

                   .mini-block {
                   background-color: #ffffff;
                   width: 498px;
                   border: 0px solid #cccccc;
                   border-radius: 5px;
                   padding: 15px 15px;
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
                     padding: 10px 10px;
                     border: 1px solid #cccccc;
                     color: #4d4d4d;
                     font-weight: bold;
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
                   padding: 10px 10px 0px;
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
                               <table cellpadding='0' cellspacing='0' width='800' class='w320'>
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
                       <table cellspacing='0' cellpadding='0' width='800' class='w320'>
                         <tr>
                           <td class='free-text pull-left'>
                             Dear <strong> $ngo_user_prefix_name. $ngo_user_last_name </strong>

                             <p>Greetings from IndiaDonates!</p>

                             <p>Thank you for showing your interest. Your details have been verified. In order to proceed further, we would request you to fill in the online form. This needs activation of your account.</p>

                              <p>To activate your account, please click the link below:</p>
                             <a href='$ngo_form_Second_link'>$ngo_form_Second_link</a>
                           </td>
                         </tr>
                         <tr>
                           <td style='padding-bottom: 10px;'></td>

                         </tr>
                         <tr>
                           <td class='mini-block-container'>
                             <table cellspacing='0' cellpadding='0' width='100%'  style='border-collapse:separate !important;'>
                               <tr>
                                 <td class='mini-block'>
                                   <table cellpadding='5' cellspacing='5' width='100%'>
                                     <tr>
                                       <td class='code-block' style='text-align:center;background-color:#DCDCDC;'>
                                         <p>Username is your registered email id: <a href='mailto: $user_ngo_email_id'> $user_ngo_email_id </a></p>
                                         <p>Auto generated password is:<span style='color: #000'>$ngo_user_temp_pass</span></p>
                                       </td>
                                     </tr>
                                   </table>
                                 </td>
                               </tr>
                             </table>
                           </td>
                         </tr>
                         <tr>
                           <td style='padding: 10px 10px 0px; text-align: left;'>
                             <p>In case, you wish to change your password <a href='$password_rset_link'>click here</a></p>
   						    <p class='bottom_regards'>For any questions and clarifications, do not hesitate to contact us at info@indiadonates.in</p>
                               <!--<p><a href='$password_rset_link'> $password_rset_link</strong></a></p>-->
                           </td>
                         </tr>
                         <tr>
                           <td>

                           </td>
                         </tr>
                         <tr>
                           <td>
                             <div class='bottom_regards'>
                               <p>Regards,<br><strong>IndiaDonatesTeam</strong></p>

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

                             <!--  <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                                 Sector 20, Noida<br>
                                 Uttar Pradesh 201301.<br>
                                 <span class='text-white'>Phone:</span><a href='tel:+91-120-4773200'> +91-120-4773200</a><br>
                                 <span class='text-white'>Email:</span><a href='mailto:info@indiadonates.in'> info@indiadonates.in</a></p>
                               </div>-->
                           </td>
                         </tr>
                       </table>
                     </center>
                   </td>
                 </tr>
               </table>
               </body>
               </html>";
             //$ngo_message = "Dear Mr./ Ms. {$ngo_user_full_name}. Invitation to create your next fundraiser profile, click on the link given below.\n URL: \n{$link}\n Username:{$user_ngo_login} \n Password:{$ngo_user_temp_pass} ";
             $ngo_headers = 'From: Indiadonates <no-reply@indiadonates.com>' . "\r\n";
             wp_mail( $user_ngo_email_id, "Welcome to IndiaDonates.in, Activate your account now!", $ngo_message , $ngo_headers);
             $user_nid = $_GET['nunid'];
             update_user_meta( $user_nid, 'first_form_mail', 'send' );

             echo "<script type='text/javascript'>alert('$message');</script>";
           }
           ?>
           <form method="post">
             <div class="btn-ngo-approve-div">
			 <center>
               <?php
                $use_nid = $_GET['nunid'];
                $send_mail_status = get_user_meta( $use_nid, 'first_form_mail', true );
                $check_mail = get_user_meta( $use_nid );
               // print_r( $check_mail );
                if( $send_mail_status == "send" ){ ?>
                 <button id="send_mail_form_1" class="btn_ngo_approve" name="approve" value="yes">Authorised Acess and share Login detail </button><br> <?php
                }else{ ?>
                  <button id="send_mail_form_1" class="btn_ngo_approve" name="approve" value="yes">Authorised Acess and share Login detail </button><br>
                <?php
                }
               ?>
   			<input type="hidden" name="useridss" value="<?php echo $use_nid; ?>">
               <em class="em-heading"></em>
			   </center>
			  
               </div>
           </form>

       </div>

       <?php

   }else{
     global $wpdb;

     ?>
   <center><h2>List of NGOs Users</h2></center>

     <style media="screen">
     thead input {
         width: 100%;
     }
     </style>
   <table id="example_userlist" class="display" style="width:100%">
           <thead>
               <tr>
                   <th>NGO Name</th>
                   <th>Date of Registration</th>
                   <th>Status</th>
                   <th>Approved Date</th>
                   <th>Details</th>

               </tr>
           </thead>
           <tbody>
             <?php
           $table_name = "wp_users";
              $result = $wpdb->get_results( " SELECT *  FROM $table_name
              JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id
              WHERE wp_usermeta.meta_key = 'wp_capabilities' and wp_usermeta.meta_value like '%ngo_charitable%' ORDER BY id DESC " );
              foreach( $result as $print ){
                //print_r( $print );
                  $ngo_form_id = $print->ID;
                ?>
                       <tr>
                         <td class="th-ngoname"><?php echo $print->display_name;?></td>
                         <td><?php echo date("jS F, Y", strtotime( $print->user_registered ) );?></td>
                         <td><?php
                          $ngo_status_btn = "";
                          //global $wpdb;
                          $table_name = "wp_ngo_profile";
                          $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$ngo_form_id'" );
                          if ( empty( $result ) ) {
                             echo $status = "Pending";
                           }else{
                           foreach ($result as $ngo ) {
                           $ngo_status_btn = $ngo->approval_status;
                           switch ( $ngo_status_btn ) {
                             case 'yes':
                               $status = 'Approved';
                               break;
                             case 'no':
                               $status = 'Rejected';
                               break;
                             default:
                               $status = 'Pending';
                               break;
                           }//end switch.
                         }
                           ?><?php echo $status;?></td><?php
                         }//end forech ?>
                           <td><?php echo date("j F, Y", strtotime($ngo->approval_on)); ?></td>

                          <td><a style="text-decoration: none;" href ="<?php echo get_admin_url();?>admin.php?page=ngo_user_details&nunid=<?php echo $print->ID; ?>">View Details</a></td>
                       </tr>
                <?php
   }
   ?>


           </tbody>

       </table>


          <?php
     }//end else condition.
     ?>

  <script type="text/javascript">

  $(document).ready(function() {
    // Setup - add a text input to each footer cell
  //  $('#example_userlist').DataTable();

    $('#example_userlist thead tr').clone(true).appendTo( '#example_userlist thead' );
    $('#example_userlist thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var table = $('#example_userlist').DataTable( {
       "dom": 'lBfrtip',
      "buttons": [
              {
                  extend: 'collection',
                  text: 'Export',
                  buttons: [
                      'copy',
                      'excel',
                      'csv',
                      'pdf',
                      'print'
                  ]
              }
          ],
        orderCellsTop: true,
        fixedHeader: true
    } );









} );

  </script>
