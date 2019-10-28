<?php
/**
 * Displays the donation summary.
 *
 * Override this template by copying it to yourtheme/charitable/donation-receipt/summary.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Donation Receipt
 * @since   1.0.0
 * @version 1.4.7
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }
//require("fpdf/fpdf.php");
//require_once(dirname(__FILE__) ."/fpdf/fpdf.php");
function convert_number_to_words($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    //$decimal     = ' point ';
    $dictionary  = array(
       // 0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}

/* @var Charitable_Donation */
$donation = $view_args['donation'];
//print_r( $donation );
//print_r(get);

	//send the mail to user
	$get_donation_id = $donation->ID;
	$get_donation_status = $donation->post_status;
	$rn_no = $donation->get_number();
	$donation_amount = $donation->get_total_donation_amount();
	$mail_amount = apply_filters( 'charitable_donation_receipt_donation_amount', charitable_format_money( $donation_amount ), $donation_amount, $donation, 'summary' );
	$donation_date = date("d-m-y");
	$date_of_donation =  $donation->get_date();
	$donation_mode = $donation->get_gateway_label();
	$donation_inwords = convert_number_to_words( $donation_amount );;

	//Custom query to get the doaner id.
	global $wpdb;
	$donor_table_name = "wp_charitable_donors";
	$charitable_cam_donation = "wp_charitable_campaign_donations";
	//Fetch the doaner id.
	$saved_donation_id =  $wpdb->get_results( "SELECT donor_id FROM $charitable_cam_donation WHERE donation_id = $get_donation_id " );
	foreach( $saved_donation_id as $get_donation_id ){
		$fetched_donation_id =  $get_donation_id ->donor_id;

	}

	//query for the getting the email of the donor
	$donor_eamil_id =  $wpdb->get_results( "SELECT * FROM $donor_table_name WHERE donor_id = $fetched_donation_id " );
	foreach( $donor_eamil_id as $fetched_donor_email ){
		$get_email_id = $fetched_donor_email->email;
		$get_last_name = $fetched_donor_email->last_name;
		$get_first_name = $fetched_donor_email->first_name;
	}


	//echo $get_email_id;

//$get_donation_status='charitable-completed';


	//check the doantion status here if completed then send the mail.
	if( $get_donation_status == "charitable-completed" ){
	

		if( is_user_logged_in() ){
			$user_prefix_name =  get_user_meta( get_current_user_id(),'user_title', true );
			$current_user = wp_get_current_user();
			$donor_name_for = $current_user->display_name;
		}
		else{

			$donor = $donation->get_donor();
			$first_name = $donor->get_donor_meta('first_name');
			$user_last_name = $donor->get_donor_meta('last_name');
			//$user_prefix_name = $donor->get_donor_meta('donor_title');
			$split_first_name = explode(" ", $first_name);
			$user_prefix_name = $split_first_name[0];
			$donor_name_for =  $split_first_name[1]." " .$user_last_name;

			//$user_prefix_name = "Mr/Ms/Dr.";
			//$split_first_name = explode(" ", $get_first_name);
			//$user_prefix_name = $split_first_name[0];
			//$donor_name_for = $get_first_name." ". $get_last_name;
			//$donor_name_for = $split_first_name[1]." ". $get_last_name;
		}
		$donor = $donation->get_donor();
		$get_first_name = $donor->get_donor_meta('first_name');
		$get_last_name = $donor->get_donor_meta('last_name');
		if( $get_last_name == " " ){
				$split_last_name = explode(" ", $get_first_name);
				$user_last_name = $split_last_name[1];
		}else{
				$user_last_name = $get_last_name;
		}

		$get_email_id;
		$current_user = wp_get_current_user();

		$donar_id = $current_user->ID;
		
		 $phonneaj=get_user_meta($donar_id,'user_phone', true);
		 $address_aj=get_user_meta($donar_id,'user_reg_add', true);
		 $city=get_user_meta($donar_id,'city', true);
		 $pincode_aj=get_user_meta($donar_id,'user_pin', true);
		  $userTitle=get_user_meta($donar_id,'user_title', true)." ".$displayname=$current_user->display_name;
	
		 
		 
		 
		//$user_last_name = $get_last_name;
		$donation_thank_you_message ='

<table cellspacing="0" border="0" width="100%">
	<colgroup width="252"></colgroup>
	<tr>
		<td height="17" align="left"> '.$userTitle.'</td>
	</tr>
	<tr>
		<td height="17" align="left">'.$address_aj.'</td>
	</tr>
	<tr>
		<td height="17" align="left">'.$city.' - '.$pincode_aj.'</td>
	</tr>
	

	<tr>
		<td height="17" align="left">Mobile: '.$phonneaj.'</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left">Receipt No: '.$rn_no.'</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left">Dear '.$displayname=$current_user->display_name.',</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left">Greetings from Indiadonates,</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td colspan=6 height="32" align="left" valign=middle>We sincerely thank you for your valuable contribution to Indiadonates – A movement to<br>change lives!</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left" valign=middle>We are grateful for your generosity, your trust and most importantly, your commitment to</td>
	</tr>
	<tr>
		<td height="17" align="left">our mission. Your donation will go a long way &amp;amp; will impact the lives of people who are in</td>
	</tr>
	<tr>
		<td height="17" align="left">dire need.</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left">Regards</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td height="17" align="left">Indiadonates Team</td>
	</tr>
	<tr>
		<td height="17" align="left"><br></td>
	</tr>
	<tr>
		<td colspan=6 height="17" align="left" valign=middle>P.S. please find attached your receipt to claim your 80G deductions.</td>
	</tr>
</table>
';
      //ajcode 
	  
	  //pdf code /
	  $pdf_data ='<html><table style="width: 100%;" border="1">
<tbody>
<tr style="height: 21px;">
<td style="height: 21px;">Receipt No.</td>
<td style="height: 21px;">254545</td>
<td style="height: 21px;">Donation received on</td>
<td style="height: 21px;">'.date('d-m-y').'</td>
</tr>
<tr style="height: 41px;">
<td style="height: 41px;" colspan="4">80G certificate No. DIT(E)/2012-2013/ 887 Dt. 08/02/2013 under Section 80G of income Tax Act with perpetual validity</td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">Donation Receipt</td>
<td style="height: 21px;">'.$rn_no.'</td>
<td style="height: 21px;"></td>
<td style="height: 21px;"></td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">Full Name</td>
<td style="height: 21px;">'.$userTitle.'</td>
<td style="height: 21px;">;</td>
<td style="height: 21px;"></td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">Address</td>
<td style="height: 21px;">'.$city.' - '.$pincode_aj.'</td>
<td style="height: 21px;"></td>
<td style="height: 21px;"></td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">Email ID</td>
<td style="height: 21px;">'.$get_email_id.'</td>
<td style="height: 21px;"></td>
<td style="height: 21px;"></td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">Phone</td>
<td style="height: 21px;">'.$phonneaj.'</td>
<td style="height: 21px;"></td>
<td style="height: 21px;"></td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">Permanent Account Number</td>
<td style="height: 21px;"></td>
<td style="height: 21px;"></td>
<td style="height: 21px;"></td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">&nbsp;</td>
<td style="height: 21px;">&nbsp;</td>
<td style="height: 21px;">&nbsp;</td>
<td style="height: 21px;">&nbsp;</td>
</tr>
<tr style="height: 21px;">
<td style="height: 21px;">&nbsp;</td>
<td style="height: 21px;">&nbsp;</td>
<td style="height: 21px;">&nbsp;</td>
<td style="height: 21px;">&nbsp;</td>
</tr>
</tbody>
</table></html>';
$cdate=date('d-m-Y');
$amount   = $donation->get_total_donation_amount();
$new_amn = apply_filters( 'charitable_donation_receipt_donation_amount', charitable_format_money( $amount ), $amount, $donation, 'summary' );

$rsword=ucwords(convert_number_to_words($amount));
 



$ajhtml='
<table width="619" border="2">
  <tr>
    <td width="167">Receipt No.:</td>
    <td width="118">'.$rn_no.'</td>
    <td width="140">Donation received on</td>
    <td width="164">'.$cdate.'</td>
  </tr>
  <tr>
    <td colspan="4"><p>80G certificate No. DIT(E)/2012-2013/ 887 Dt.  08/02/2013 under Section 80G of income Tax Act with perpetual validity</p></td>
   
  </tr>
   <tr>
    <td width="167">Donation Receipt</td>
    <td width="118"></td>
    <td width="140"></td>
    <td width="164"></td>
  </tr>
  
   <tr>
    <td width="167">Full Name</td>
    <td width="118">'.$userTitle.'</td>
    <td width="140"></td>
    <td width="164"></td>
  </tr>
 
  <tr>
    <td width="167">Address</td>
    <td width="118">'.$city.' - '.$pincode_aj.'</td>
    <td width="140"></td>
    <td width="164"></td>
  </tr>
   <tr>
    <td width="167">Email ID</td>
    <td width="200">'.$get_email_id.'</td>
    <td width="140"></td>
    <td width="164"></td>
  </tr>
 
  <tr>
    <td width="167">Phone</td>
    <td width="118">'.$phonneaj.'</td>
    <td width="140"></td>
    <td width="164"></td>
  </tr>
   <tr>
    <td width="167">Permanent Account Number</td>
    <td width="118"></td>
    <td width="140"></td>
    <td width="164"></td>
  </tr>
 

  <tr>
    <td>Donation Amount</td>
    <td colspan="3">'.$new_amn.'</td>
 
  </tr>
  <tr>
    <td>Amount In Words</td>
    <td colspan="3">'.$rsword.'</td>
   
  </tr>
  <tr>
    <td colspan="4">Instrument type</td>
  </tr>
  <tr>
    <td colspan="4"><p>Instrument Ref. Number  &amp; Date         -NA- / 24-Apr-2018</p></td>
  </tr>
  <tr>
    <td colspan="4"><p>Thank You Supporting Indiadonates</p></td>
  </tr>
  <tr>
    <td colspan="4"><p>404, White House, 382 , Sant Nagar </p></td>
  </tr>
  <tr>
    <td colspan="4"><p>East of Kailash, Delhi- 110065</p></td>
  </tr>
  <tr>
    <td colspan="4"><p>PAN : AAATD3420B </p></td>
  </tr>
  <tr>
    <td colspan="4"><p>Note:This is a computer  generated receipt and doesn&rsquo;t require a signature.</p></td>
  </tr>
</table>
';




	  //pdf code /
	

	//require_once(dirname(__FILE__) ."/fpdf/html2pdf.php");
	require_once(dirname(__FILE__) ."/fpdf/html_table.php");


	
	  
	  //ajcode 
		$subjects_message = "Thank you for your support!!";
		$checkmail= FALSE;
		if( $checkmail== FALSE ){
			
			
			$img_url = get_home_url()."/wp-content/themes/fundrize-child/charitable/donation-receipt/";
			//ob_start();
			
	
	
	
	
	$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($ajhtml);
	
	  $donation_reciept_path = WP_CONTENT_DIR.'/uploads/donation-reciept/'.$rn_no.'-donation.pdf';
      $pdfdoc = $pdf->Output( WP_CONTENT_DIR.'/uploads/donation-reciept/'.$rn_no.'-donation.pdf', "F" );
      $headers = 'From: IndiaDonates <info@indiadonates.in>' . "\r\n";
      $attachments = array($donation_reciept_path);
	
      wp_mail( $get_email_id, $subjects_message, $donation_thank_you_message, $headers, $attachments );
	 
	  
      $checkmail = TRUE;
		}else{
			//do nothing.
		}

	}
//function to chang html in pdf.



$amount   = $donation->get_total_donation_amount();

?>
<div class="don_reciept" style="border: 1px solid #212127; padding-top: 30px; padding-left: 26px; padding-bottom: 5px;">
	<div class="rec_inner">
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 5.1.6.2 (Linux)"/>
	<meta name="created" content="2019-09-20T23:45:44.734767954"/>
	<meta name="changed" content="2019-09-21T00:03:28.285960664"/>
	<style type="text/css">
		@page { margin: 1cm }
		p { margin-bottom: 0.2cm; line-height: 120% }
		a:link { so-language: zxx }

	</style>
</head>
<body lang="en-IN" dir="ltr">
<p style="margin-bottom: 0cm; line-height: 80%"> Receipt No.   <?php echo $donation->get_number() ?>
		Donation received on  <?php echo date("d-m-y"); ?></p>
<p style="margin-bottom: 0cm; line-height: 100%">80G certificate No.
DIT(E)/2012-2013/ 887 Dt. 08/02/2013 under Section 80G of income Tax</p>
<p style="margin-bottom: 0cm; line-height: 100%">Act with perpetual
validity</p>
<p style="margin-bottom: 0cm; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0; line-height: 100%"><b>Donation Receipt</b></p>
<p style="margin-bottom: 0; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0; line-height: 80%"><b>Full Name :</b> 
  <?php $current_user = wp_get_current_user();

 
 
  
 
  
  $donar_id = $current_user->ID;
  if( is_user_logged_in() ){
    echo get_user_meta($donar_id,'user_title', true)." ".$displayname=$current_user->display_name;
	
	
	

  }else{
  $donor = $donation->get_donor();

  $first_name = $donor->get_donor_meta('first_name');
  $last_name = $donor->get_donor_meta('last_name');

  $donor_prefix_name = $donor->get_donor_meta('donor_title');
  echo  $donor_prefix_name." ".$first_name." " .$last_name;
  }
  ?>
</p>
<p style="margin-bottom: 0; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0cm; line-height: 100%"><b>Address:</b>
<?php 
echo get_user_meta($donar_id,'user_reg_add', true).",".get_user_meta($donar_id,'city', true);

?>
</p>
<p style="margin-bottom: 0cm; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0cm; line-height: 100%"><b>Email ID:</b>
  <strong>
    <?php $current_user = wp_get_current_user();
    $email_id = $current_user->user_email;
    $display_name = $current_user->display_name; ?> </strong>

<a href="mailto:<?php echo $email_id;?>"><?php echo $email_id;?></a></p>
<p style="margin-bottom: 0cm; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0cm; line-height: 100%"><b>Phone :</b>
<?php 
echo get_user_meta($donar_id,'user_phone', true);

?>
</p>
<p style="margin-bottom: 0cm; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0cm; line-height: 100%"><b>Permanent Account Number:</b>
	 



</p>
<p style="margin-bottom: 0cm; line-height: 100%"><br/>

</p>
<p style="margin-bottom: 0cm; line-height: 100%"><b>Donation Amount:</b>
  <?php 
  echo $new_amn = apply_filters( 'charitable_donation_receipt_donation_amount', charitable_format_money( $amount ), $amount, $donation, 'summary' )

?>
 (<?php echo ucwords(convert_number_to_words($amount)); ?>)
</p>
</body>
</html>
		</div>
	<!--	<table>
			<tbody>
				<tr class="donation-summary">
					<td class="donation-id"><?php _e( 'Donation Number:', 'charitable' ) ?></td>
					<td class="donation-summary-value"><?php echo $donation->get_number() ?></td>
				</tr>
				<tr>
					<td class="donation-date"><?php _e( 'Date:', 'charitable' ) ?></td>
					<td class="donation-summary-value"><?php echo $donation->get_date() ?></td>
				</tr>
				<tr>
					<td class="donation-total"> <?php _e( 'Total:', 'charitable' ) ?></td>
					<td class="donation-summary-value"><?php
						/**
						 * Filter the total donation amount.
						 *
						 * @since  1.5.0
						 *
						 * @param  string              $amount   The default amount to display.
						 * @param  float               $total    The total, unformatted.
						 * @param  Charitable_Donation $donation The Donation object.
						 * @param  string              $context  The context in which this is being shown.
						 * @return string
						 */
						echo apply_filters( 'charitable_donation_receipt_donation_amount', charitable_format_money( $amount ), $amount, $donation, 'summary' )
					?></td>
				</tr>
				<tr>
					<td class="donation-method"><?php _e( 'Payment Method:', 'charitable' ) ?></td>
					<td class="donation-summary-value"><?php echo $donation->get_gateway_label() ?></td>
				</tr>
				<tr>
				</tr>
			</tbody>
		</table> -->
	</div>
</div>
<center style="padding-top: 10px;"><button id="btn_donation"><i class="fa fa-print"></i> Print</button></center>
