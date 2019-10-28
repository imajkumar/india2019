<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- include summernote css/js -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('#dtformsubmitdata').DataTable();
  $('#dtCoutry').DataTable();
  $('#dtCurrency').DataTable();
  $('#dtlocation').DataTable();
  $('#dtvehicle').DataTable();
  $('#dtvtc_rate').DataTable();
  //$('#mycountry').modal('show');
} );
</script>

<?php



$kv_errors= array();
if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['submit_form_support_replay']))  {
	$fields = array('kv_name','email','message','subject');
	$errors = array_filter($kv_errors);

	 if (empty($errors)) {
 		if ( ! function_exists( 'wp_handle_upload' ) ) {
 			require_once( ABSPATH . 'wp-admin/includes/file.php' );
 		}

 		$uploadedfile = $_FILES['attachmentFile'];
 		$upload_overrides = array( 'test_form' => false );
 		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
 		if ( $movefile && ! isset( $movefile['error'] ) ) {
 			$movefile['url'];

        if ($movefile) {
          $wp_filetype = $movefile['type'];
          $filename = $movefile['file'];
          $wp_upload_dir = wp_upload_dir();
          $attachment = array(
            'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
            'post_mime_type' => $wp_filetype,
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
            'post_content' => '',
            'post_status' => 'inherit'
          );
          $attach_id = wp_insert_attachment( $attachment, $filename);
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );

          //die(json_encode(array('type'=>'error', 'text' => 'Ok', 'error' => 0)));
        }else{
          //  die(json_encode(array('type'=>'error',  'error' => 1)));
        }

 		}



            $txtMessageReplay=$_POST['txtMessageReplay'];
            $rowID=$_POST['rowID'];

            //save
            global $wpdb;
            $wpdb->update(
          	'wp_ngo_support',
          	array(
          		'admin_remarks' => $txtMessageReplay,

          	),
            array( 'id' => $rowID ), 

          );

  //







            //save

          $HTML='';


    $msgDta= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <!-- If you delete this tag, the sky will fall on your head -->
    <meta name="viewport" content="width=device-width" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IndiaDonates.in</title>

    <style>
    * {
    	margin:0;
    	padding:0;
    }
    * { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

    img {
    	max-width: 100%;
    }
    .collapse {
    	margin:0;
    	padding:0;
    }
    body {
    	-webkit-font-smoothing:antialiased;
    	-webkit-text-size-adjust:none;
    	width: 100%!important;
    	height: 100%;
    }
    a { color: #F89011;}

    .btn {
    	text-decoration:none;
    	color: #FFF;
    	background-color: #666;
    	padding:10px 16px;
    	font-weight:bold;
    	margin-right:10px;
    	text-align:center;
    	cursor:pointer;
    	display: inline-block;
    }

    p.callout {
    	padding:15px;
    	background-color:#ECF8FF;
    	margin-bottom: 15px;
    }
    .callout a {
    	font-weight:bold;
    	color: #2BA6CB;
    }

    table.social {
    /* 	padding:15px; */
    	background-color: #ebebeb;

    }
    .social .soc-btn {
    	padding: 3px 7px;
    	font-size:12px;
    	margin-bottom:10px;
    	text-decoration:none;
    	color: #FFF;font-weight:bold;
    	display:block;
    	text-align:center;
    }
    a.fb { background-color: #3B5998!important; }
    a.tw { background-color: #1daced!important; }
    a.gp { background-color: #DB4A39!important; }
    a.ms { background-color: #000!important; }

    .sidebar .soc-btn {
    	display:block;
    	width:100%;
    }
    table.head-wrap { width: 100%;}
    .header.container table td.logo { padding: 15px; }
    .header.container table td.label { padding: 15px; padding-left:0px;}
    table.body-wrap { width: 100%;}

    table.footer-wrap { width: 100%;	clear:both!important;
    }
    .footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
    .footer-wrap .container td.content p {
    	font-size:10px;
    	font-weight: bold;

    }

    h1,h2,h3,h4,h5,h6 {
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
    }
    h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

    h1 { font-weight:200; font-size: 44px;}
    h2 { font-weight:200; font-size: 37px;}
    h3 { font-weight:500; font-size: 27px;}
    h4 { font-weight:500; font-size: 23px;}
    h5 { font-weight:900; font-size: 17px;}
    h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

    .collapse { margin:0!important;}

    p, ul {
    	margin-bottom: 10px;
    	font-weight: normal;
    	font-size:13px;
    	line-height:1.6;
    }
    p.lead { font-size:17px; }
    p.last { margin-bottom:0px;}

    ul li {
    	margin-left:5px;
    	list-style-position: inside;
    }

    /* -------------------------------------
    		SIDEBAR
    ------------------------------------- */
    ul.sidebar {
    	background:#ebebeb;
    	display:block;
    	list-style-type: none;
    }
    ul.sidebar li { display: block; margin:0;}
    ul.sidebar li a {
    	text-decoration:none;
    	color: #F89011;
    	padding:10px 16px;
    /* 	font-weight:bold; */
    	margin-right:10px;
    /* 	text-align:center; */
    	cursor:pointer;
    	border-bottom: 1px solid #777777;
    	border-top: 1px solid #FFFFFF;
    	display:block;
    	margin:0;
    }
    ul.sidebar li a.last { border-bottom-width:0px;}
    ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}
    .container {
    	display:block!important;
    	max-width:600px!important;
    	margin:0 auto!important; /* makes it centered */
    	clear:both!important;
    }
    .content {
    	padding:15px;
    	max-width:600px;
    	margin:0 auto;
    	display:block;
    }
    .content table { width: 100%; }
    /* Odds and ends */
    .column {
    	width: 300px;
    	float:left;
    }
    .column tr td { padding: 15px; }
    .column-wrap {
    	padding:0!important;
    	margin:0 auto;
    	max-width:600px!important;
    }
    .column table { width:100%;}
    .social .column {
    	width: 280px;
    	min-width: 279px;
    	float:left;
    }

    .clear { display: block; clear: both; }
    @media only screen and (max-width: 600px) {

    	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

    	div[class="column"] { width: auto!important; float:none!important;}

    	table.social div[class="column"] {
    		width:auto!important;
    	}

    }
    </style>

    </head>

    <body bgcolor="#f1f1f1" style="background-color:#f1f1f1">

    <!-- HEADER -->


    <!-- BODY -->
    <table class="body-wrap">
    	<tr>
    		<td></td>
    		<td class="container">

    			<div class="content" style="background-color:#ffffff">
    			<table>
    				<tr>
    					<td>

    						<!-- A Real Hero (and a real human being) -->
    						<p><img width="200px" src="https://indiadonates.in/wp-content/uploads/2018/12/india-donates-1024x344.png" /></p><!-- /hero -->
    						<p>&nbsp;</p>

    						<p>&nbsp;</p>
    						<h3>Dear Admin </h3>

    						<p class="lead">Narative Upload with Attachment  </p>
    						<!-- Callout Panel -->

    						<h5> Observation : </h5>
    						<p style="font-size: 15px;">
    							 NGO Name:

    						</p>
    						<p style="font-size: 15px;">
    							 Project Name:

    						</p>
    						<p style="font-size: 15px;">
    							Project Details:

    						</p>

    						<p>&nbsp;</p>

    						<p>&nbsp;</p>
    						<h5>Thanks and Regards</h5>
    						<h5>Indiadonates team</h5>



    					</td>
    				</tr>
    			</table>
    			</div>

    		</td>
    		<td></td>
    	</tr>
    </table><!-- /BODY -->

    </body>
    </html>
';












 		$headers = 'From: '.$posted['kv_name'].' <'.$posted['email'].'>' . "\r\n";
    //$headers = array('Content-Type: text/html; charset=UTF-8');
 		if(wp_mail('ngo1@yopmail.com','Narative Upload with Attachment' , $msgDta, $headers, $attachments)){
 				echo '<div style="background-color: #BBF6E2; border: 1px solid #01BE47; margin-top: 10px; padding: 8px;" > Sent Successfully </div> ' ;
 		}else {
 				echo '<div style="background-color:#FAFFBD;border:1px solid #DAAAAA;color:#D8000C;margin-top:20px;" Error occurred </div> ' ;
 		}
 		unlink( $movefile['file'] );
 	}
}




?>
<!--- Include the above in your HEAD tag ---------->

    <div class="page-header">
        <h1>Support <span class="pull-right label label-default">:)</span></h1>
    </div>
    <div class="row">
    	<div class="col-md-12">
        <nav class="navbar navbar">
 <div class="container-fluid">

   <ul class="nav navbar-nav">
     <li class="active"><a href="#" class="btn btn-primary">Support Ticket List</a></li>

   </ul>
   <ul class="nav navbar-nav navbar-right">

     <li><a href="javascript::void(0)"   data-toggle="modal" data-target="#myModalAddNarative"><span class="btn btn-primary glyphicon glyphicon-plus"> Add New</span></a></li>
   </ul>
 </div>
</nav>

              <!-- ajcode for dataTables -->
        <table id="exampleNarative" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S#</th>
                <th>NGO Name</th>
                <th>Date</th>
                <th>Type</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Attachment</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php
            global $wpdb;


          $table_name = "wp_ngo_support";
          $result = $wpdb->get_results( " SELECT * FROM $table_name");
          $i=0;
          foreach( $result as $printRow ){
            $i++;


             $table_name = "wp_ngo_profile";
             $result_arr = $wpdb->get_row( "SELECT * FROM $table_name where nguser_id = '$printRow->ngo_id'" );


            $flink=wp_get_attachment_link( $printRow->attach_id, $unfiltered );

           if($printRow->status==0){
             $sta='<span class="badge badge-success">Open</span>';
           }else{
              $sta='<span class="badge badge-success">Close</span>';
           }

            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $result_arr->org_name ;?></td>
                <td><?php echo date('j M Y',strtotime($printRow->created_on))?></td>
                <td><?php echo $printRow->type?></td>
                <td><?php echo $printRow->subject?></td>
                <td><?php echo $printRow->message?></td>
                <td><?php echo $sta?></td>
                <td><?php echo $flink?></td>
                <td><?php echo $printRow->admin_remarks?></td>
                <td><a href="javascript::void(0)"  onclick="showSupportDetail(<?php echo $printRow->id ?>)" class="btn btn-primary">View Details </a></td>
            </tr>
            <?php

          }

          ?>


        </tbody>

    </table>

              <!-- ajcode for dataTables -->
        </div>

	</div>


  <!-- Modal -->
<div id="myModalSuportData" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Support Ticket</h4>
      </div>
      <div class="modal-body">



        <?php
        $usid = get_current_user_id();
        global $wpdb;
        $table_name = "wp_ngo_support";
        $result_arr = $wpdb->get_row( "SELECT * FROM $table_name where nguser_id = '$usid'" );
        // echo "<pre>";
        // print_r($result_arr->nguser_id);
        ?>


         <form action="" method="post" enctype="multipart/form-data">

<input name="txtNGO_ID" type="hidden" value="<?php echo $result_arr->nguser_id ?>" required placeholder="Your Name">
<input name="rowID" type="hidden" id="rowID">

   <input name="txtNGO_name" type="hidden" value="<?php echo $result_arr->org_name; ?>" required placeholder="Your Name">


   <input name="email" type="hidden" value="<?php echo $result_arr->email_id; ?>" required placeholder="Your Email">




            <div class = "form-group">
               <label for = "exampleInputEmail1">Subject</label>
               <input name="txtSubject" type = "text" class = "form-control"
                  id = "txtSubject" aria-describedby = "emailHelp"
                  placeholder = "Enter Subject">
            </div>

            <div class = "form-group">
               <label for = "exampleInputPassword1">Message</label>
                    <textarea id="summernote"  name="txtMessage"></textarea>
            </div>

            <div class = "form-group">
               <label for = "exampleInputPassword1">Replay Message </label>
                    <textarea id="summernoteReplay"  name="txtMessageReplay"></textarea>
            </div>




            <input class = "btn btn-primary"  id="submit" name="submit_form_support_replay" type="submit" value="Submit">

         </form>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  <script type="text/javascript">
  function showSupportDetail(NgoID){


    jQuery.ajax({
                  url:'/wp-admin/admin-ajax.php',
                  type: 'POST',
                  data: {
                  action:'ajdata_support',
                  ng_id:NgoID,

                  },
                  success: function(data){
                    console.log(data.subject);
                  //  alert('Sent Successfuly');
                      jQuery('#myModalSuportData').modal('show');
                       $('#txtSubject').val(data.subject);
                       $('#summernote').val(data.message);
                       $('#rowID').val(data.id);



                  //  location.reload(1);
                },
                 dataType: 'json',
              });



  }


  $(document).ready(function() {




  $('#exampleNarative').DataTable();

   $('#summernote').summernote({
        placeholder: 'Enter Project Details',
        tabsize: 2,
        height: 100,
            codemirror: { // codemirror options
          theme: 'monokai'
        }
    });

    $('#summernoteReplay').summernote({
         placeholder: 'Enter Project Details',
         tabsize: 2,
         height: 100,
             codemirror: { // codemirror options
           theme: 'monokai'
         }
     });


} );

  </script>
