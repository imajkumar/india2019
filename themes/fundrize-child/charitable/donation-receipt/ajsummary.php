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

	//check the doantion status here if completed then send the mail.
	if( $get_donation_status == "charitable-completed"){
		//echo $get_email_id;

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









		$donation_thank_you_message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
				<html xmlns='http://www.w3.org/1999/xhtml'>
				<head>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				<meta name='viewport' content='width=device-width, initial-scale=1' />
				<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
				<title>Donation recipte</title>
				<script src='https://code.jquery.com/jquery-3.3.1.min.js' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8='crossorigin='anonymous'></script>
				<style type='text/css'>

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
					.don_reciept .logo_rec {
						clear: both;
						overflow: hidden;
					  }
					  .don_reciept .content_middle_rec {
						display: flex;
					  }
					  .don_reciept p.middle_rec {
						border: 2px solid;
						max-width: 75%;
						font-weight: 600;
					  }
					  .rec_inner p {
						text-align: left;
						padding: 10px;
					  }
					  .rec_signature {

						padding: 18px;
						vertical-align: middle;
						margin-left: 25px;
						text-align: center;

					  }
					  .rec_signature img {
						max-width: 40%;
					  }
					  .rec_signature p {
						text-align: center;
					  }
					  .don_reciept .donation-summary dd {
						text-align: right;
					  }
					  .rec_add_area {
						text-align: left;
						font-style: italic;
					  }
					  .don_reciept .logo_rec img {
						float: right;
						padding: 18px;
					  }
					  .don_reciept .naming_content h3 {
						border-bottom: 2px solid;
						max-width: 35%;
						font-size: 30px;
						font-weight: 500;
					  }
					  .don_reciept tr, .don_reciept td, .don_reciept th {
						border: 2px solid;
					  }
					  .donation-details.charitable-table tr, .donation-details.charitable-table td, .donation-details.charitable-table th {

						border: 2px solid;

					  }
					  .don_reciept ~ p {
						display: none;
					  }
					  .don_reciept label {
						font-style: italic;
					  }
					  .don_reciept .name_span {
						font-style: italic;
						margin-top: 10px;
					  }
					  .don_reciept .rec_logo {

						max-width: 15%;
						float: left;
						text-align: center;

					  }
					  .don_reciept .rec_logo img {
						width:80%;
					  }
					  .don_reciept .header_rec {

						display: flex;

					  }
					  .don_reciept .rec_head {

						width: 74%;
						margin-bottom: 15px;
						text-align: center;
						float: none;

					  }
					  .don_reciept span.rno {
						float: left;
					  }
					  .don_reciept span.rec_date {
						float: right;
					  }
					  .don_reciept .RNo {
						clear: both;
						overflow: hidden;
					  }
					  .don_reciept span.rec_rupees {
						margin-bottom: 6px !important;
					  }
					  .don_reciept .rec_signature p {
						text-align: left;
						padding: 0px;
						margin: 30px 0 2px;
						text-align: center;
					  }
					  .don_reciept .add_rec {

						font-weight: 600;
						text-align: center;

					  }
					  .don_reciept h3.dev_head {
						margin-bottom: 0;
						font-weight: 700;
					  }
					  .rec_footer {
						display: none;
					  }
						td {
    text-align: left !important;
    padding-left: 10px;
}
				</style>

				<style type='text/css' media='screen'>
					@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
				</style>

				<style type='text/css' media='screen'>
					@media screen {

					* {
						font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
					}
					}
				</style>

				<style type='text/css' media='only screen and (max-width: 480px)'>

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
				</table>
				<div style='width:75%;margin:0px auto;text-align:center;'>
				<table>
				<tr  ><td style='text-align:left !important'>$user_prefix_name. $user_last_name<br/>
					XXXXXXXXXXXXXXXXX<br/>
					XXXXXXXXXXXXXXXXX<br/>
						Delhi - 201301<br/>
							India<br/>
					Mobile: $mobilenum<br/>
					Receipt No: XXXXXXXXXXXX<br/>
					Dear $user_last_name,<br/>
					<td></tr>
				</table><br/>
				<table>
				<tr> <td style='text-align:left !important'>Greetings from Indiadonates,</td></tr>
<tr> <td style='text-align:left !important'>We sincerely thank you for your valuable contribution to Indiadonates – A movement to change lives!
We are grateful for your generosity, your trust and most importantly, your commitment to our mission. Your donation will go a long way & will impact the lives of people who are in dire need.</td>
</table><br/>
<table>
<tr> <td style='text-align:left !important'>Regards,</td></tr>
<tr> <td style='text-align:left !important'>Indiadonates Team</td></tr>
<tr> <td style='text-align:left !important'>P.S. please find attached your receipt to claim your 80G deductions.</td></tr>
</table>

<table border='1'  style='text-align:left !important;margin:0px auto' >
<tr> <td >Receipt No.	$receiptnum 	Donation received on	$don_date</td></tr>
<tr> <td >80G certificate No. DIT(E)/2012-2013/ 887 Dt. 08/02/2013 under Section 80G of income Tax Act with perpetual validity</td></tr>
<tr> <td >Donation Receipt</td></tr>
<tr> <td >Full Name	$user_prefix_name  $donor_name_for</td></tr>
<tr> <td >Address	$address, </td></tr>
<tr> <td >Email ID	$email_id</td></tr>
<tr> <td >Phone	98XXXXXX21</td></tr>
<tr> <td >Permanent Account Number	$accountnum</td></tr>
<tr> <td >Donation Amount	$donamount</td></tr>
<tr> <td >Amount In Words	$inword</td></tr>
<tr> <td >Instrument type	Cash</td></tr>
<tr> <td >Instrument Ref. Number & Date	-NA- / 24-Apr-2018</td></tr>
<tr> <td >Thank You Supporting Indiadonates</td></tr>
<tr> <td >404, White House, 382 , Sant Nagar </td></tr>

<tr> <td >East of Kailash, Delhi- 110065 </td></tr>

<tr> <td >PAN : AAATD3420B </td></tr>

<tr> <td >Note:This is a computer generated receipt and doesn’t require a signature. </td></tr>
</table>
</div>";

		$subjects_message = "Thank you for your support!!";
		$checkmail= FALSE;
		if( $checkmail== FALSE ){
			//Convert donation recipte in PDF.
			//require("/fpdf/fpdf.php");
			$img_url = get_home_url()."/wp-content/themes/fundrize-child/charitable/donation-receipt/";
			//ob_start();
			require_once(dirname(__FILE__) ."/fpdf/fpdf.php");
			//ob_clean();
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf -> Line(2,2, 208, 2);
		//	$pdf->Image($img_url.'DevPro-final-logo.jpg',18,13,33);
			$pdf -> Line(2,2, 2, 295);
			$pdf -> Line(208,2, 208, 295);
			$pdf -> Line(2,295, 208, 295);

			$pdf->SetFont("Arial","B",16);
			$pdf->Cell(200,10,"Dev Pro",10,10,C);

			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200,5,"Reg. Off: 113A, Pocket A, DDA Flats, Sukdev Vihar",10,10,C);
			$pdf->Cell(200,5,"Delhi-110025",10,10,C);
			$pdf->Cell(200,5,"Phone: 011-46150777",10,10,C);
			$pdf->Cell(200,5,"Pan No: AAATD3420D",10,10,C);

			$pdf->Cell(180,5,"Date: $donation_date",10,10,R);
			$pdf->Cell(30,20,"R.No. $rn_no",100,100,L);

			$pdf->SetFont('Arial','',8);
			$pdf->Cell(10,5,"Received with thanks from $user_prefix_name  $donor_name_for the Sum of Rupees ($donation_inwords) $mail_amount by $donation_mode",10,10,L);
			$pdf->Cell(10,10,"Date: $date_of_donation Being the donation",10,10,L);

			$pdf -> Line(10,80, 170, 80);
			$pdf -> Line(170, 80,170,130 );
			$pdf -> Line(10,80, 10, 130);

			$pdf->SetFont('Arial','',10);
			//$pdf ->Line(200, 100, 200, 50);
			$pdf->Cell(10,10,"Donation exempt from income Tax under sec 80G of the Income Tax Act, 1961 vide letter DIT(E)",10,10,L);
			$pdf->Cell(10,5,"2007-2008/D-839/1659 dated 19-09-2007 of the Director of Income Tax (Exemption), Delhi-110092.",10,30,L);
			$pdf->Cell(180,5,"$mail_amount",10,30,R);
			$pdf->Cell(185,10,"For Dev Pro",10,30,R);

			$pdf->SetFont('Arial','',10);
			$pdf->SetLineWidth(0.8);
			$pdf -> Line(15, 105, 160, 105);
			$pdf->Cell(10,10,"Charitable Institutions are not required to affix revenue stamp on receipt under",10,10,L);
			$pdf->Cell(10,5,"schedule | ART - 53 exemption (b) of the Indian Stamp Act.",10,30, L);

			$pdf->SetLineWidth(0.2);
			$pdf -> Line(10,130, 170, 130);

			$pdf->Image($img_url.'sign.png',180,110,15 );

			$donation_reciept_path = WP_CONTENT_DIR.'/uploads/donation-reciept/'.$rn_no.'-donation.pdf';

            //$fiel = $pdf->Output($PdfName, 'F');
            $pdfdoc = $pdf->Output( WP_CONTENT_DIR.'/uploads/donation-reciept/'.$rn_no.'-donation.pdf', "F" );

            //$attachments = array( WP_CONTENT_DIR . '/uploads/Boarding-Pass.pdf' );
            $headers = 'From: IndiaDonates <myname@example.com>' . "\r\n";
            $attachments = array($donation_reciept_path);
            wp_mail( $get_email_id, $subjects_message, $donation_thank_you_message, $headers );
            $checkmail = TRUE;
		}else{
			//do nothing.
		}

	}
//function to chang html in pdf.



$amount   = $donation->get_total_donation_amount();

?>
<div class="don_reciept" style="border: 1px solid #212127; padding-top: 30px; padding-left: 26px; padding-bottom: 15px;">
	<div class="rec_inner">

    <?php
    $html "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
				<html xmlns='http://www.w3.org/1999/xhtml'>
				<head>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				<meta name='viewport' content='width=device-width, initial-scale=1' />
				<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
				<title>Donation recipte</title>
				<script src='https://code.jquery.com/jquery-3.3.1.min.js' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8='crossorigin='anonymous'></script>
				<style type='text/css'>

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
					.don_reciept .logo_rec {
						clear: both;
						overflow: hidden;
					  }
					  .don_reciept .content_middle_rec {
						display: flex;
					  }
					  .don_reciept p.middle_rec {
						border: 2px solid;
						max-width: 75%;
						font-weight: 600;
					  }
					  .rec_inner p {
						text-align: left;
						padding: 10px;
					  }
					  .rec_signature {

						padding: 18px;
						vertical-align: middle;
						margin-left: 25px;
						text-align: center;

					  }
					  .rec_signature img {
						max-width: 40%;
					  }
					  .rec_signature p {
						text-align: center;
					  }
					  .don_reciept .donation-summary dd {
						text-align: right;
					  }
					  .rec_add_area {
						text-align: left;
						font-style: italic;
					  }
					  .don_reciept .logo_rec img {
						float: right;
						padding: 18px;
					  }
					  .don_reciept .naming_content h3 {
						border-bottom: 2px solid;
						max-width: 35%;
						font-size: 30px;
						font-weight: 500;
					  }
					  .don_reciept tr, .don_reciept td, .don_reciept th {
						border: 2px solid;
					  }
					  .donation-details.charitable-table tr, .donation-details.charitable-table td, .donation-details.charitable-table th {

						border: 2px solid;

					  }
					  .don_reciept ~ p {
						display: none;
					  }
					  .don_reciept label {
						font-style: italic;
					  }
					  .don_reciept .name_span {
						font-style: italic;
						margin-top: 10px;
					  }
					  .don_reciept .rec_logo {

						max-width: 15%;
						float: left;
						text-align: center;

					  }
					  .don_reciept .rec_logo img {
						width:80%;
					  }
					  .don_reciept .header_rec {

						display: flex;

					  }
					  .don_reciept .rec_head {

						width: 74%;
						margin-bottom: 15px;
						text-align: center;
						float: none;

					  }
					  .don_reciept span.rno {
						float: left;
					  }
					  .don_reciept span.rec_date {
						float: right;
					  }
					  .don_reciept .RNo {
						clear: both;
						overflow: hidden;
					  }
					  .don_reciept span.rec_rupees {
						margin-bottom: 6px !important;
					  }
					  .don_reciept .rec_signature p {
						text-align: left;
						padding: 0px;
						margin: 30px 0 2px;
						text-align: center;
					  }
					  .don_reciept .add_rec {

						font-weight: 600;
						text-align: center;

					  }
					  .don_reciept h3.dev_head {
						margin-bottom: 0;
						font-weight: 700;
					  }
					  .rec_footer {
						display: none;
					  }
						td {
    text-align: left !important;
    padding-left: 10px;
}
				</style>

				<style type='text/css' media='screen'>
					@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
				</style>

				<style type='text/css' media='screen'>
					@media screen {

					* {
						font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
					}
					}
				</style>

				<style type='text/css' media='only screen and (max-width: 480px)'>

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
				</table>
				<div style='width:75%;margin:0px auto;text-align:center;'>
				<table>
				<tr  ><td style='text-align:left !important'>$user_prefix_name. $user_last_name<br/>
					XXXXXXXXXXXXXXXXX<br/>
					XXXXXXXXXXXXXXXXX<br/>
						Delhi - 201301<br/>
							India<br/>
					Mobile: $mobilenum<br/>
					Receipt No: XXXXXXXXXXXX<br/>
					Dear $user_last_name,<br/>
					<td></tr>
				</table><br/>
				<table>
				<tr> <td style='text-align:left !important'>Greetings from Indiadonates,</td></tr>
<tr> <td style='text-align:left !important'>We sincerely thank you for your valuable contribution to Indiadonates – A movement to change lives!
We are grateful for your generosity, your trust and most importantly, your commitment to our mission. Your donation will go a long way & will impact the lives of people who are in dire need.</td>
</table><br/>
<table>
<tr> <td style='text-align:left !important'>Regards,</td></tr>
<tr> <td style='text-align:left !important'>Indiadonates Team</td></tr>
<tr> <td style='text-align:left !important'>P.S. please find attached your receipt to claim your 80G deductions.</td></tr>
</table>

<table border='1'  style='text-align:left !important;margin:0px auto' >
<tr> <td >Receipt No.	$receiptnum 	Donation received on	$don_date</td></tr>
<tr> <td >80G certificate No. DIT(E)/2012-2013/ 887 Dt. 08/02/2013 under Section 80G of income Tax Act with perpetual validity</td></tr>
<tr> <td >Donation Receipt</td></tr>
<tr> <td >Full Name	$user_prefix_name  $donor_name_for</td></tr>
<tr> <td >Address	$address, </td></tr>
<tr> <td >Email ID	$email_id</td></tr>
<tr> <td >Phone	98XXXXXX21</td></tr>
<tr> <td >Permanent Account Number	$accountnum</td></tr>
<tr> <td >Donation Amount	$donamount</td></tr>
<tr> <td >Amount In Words	$inword</td></tr>
<tr> <td >Instrument type	Cash</td></tr>
<tr> <td >Instrument Ref. Number & Date	-NA- / 24-Apr-2018</td></tr>
<tr> <td >Thank You Supporting Indiadonates</td></tr>
<tr> <td >404, White House, 382 , Sant Nagar </td></tr>

<tr> <td >East of Kailash, Delhi- 110065 </td></tr>

<tr> <td >PAN : AAATD3420B </td></tr>

<tr> <td >Note:This is a computer generated receipt and doesn’t require a signature. </td></tr>
</table>
</div>";
echo $html;
?>


		<div class="header_rec">

			<div class="rec_head">
				<h3 class="dev_head">Indiadonate</h3>
			<div class="add_rec">
				<span class="address">Reg. Off: 113A, Pocket A, DDA Flats, Sukdev Vihar, <br />Delhi-110025</span> <br />
				<span class="rec_phoneno">Phone: 011-46150777</span> <br />
				<span class="rec_panno">Pan No: AAATD3420D</span>
			</div>
			</div>
		</div>
		<div class="RNo">
			<span class="rno">R.No. <b><?php echo $donation->get_number() ?></b></span>
			<span class="rec_date" style="padding-right: 50px">Date:- <b><?php echo date("d-m-y"); ?></b></span>
		</div>
		<div class="naming_content">
			<p class="name_span" style="padding-left: 0px !important;">Received with thanks from <b><?php $current_user = wp_get_current_user();
			$donar_id = $current_user->ID;
			if( is_user_logged_in() ){
				echo get_user_meta($donar_id,'user_title', true);

			}else{
			$donor = $donation->get_donor();
			//print_r( $donor );
			$first_name = $donor->get_donor_meta('first_name');
			$last_name = $donor->get_donor_meta('last_name');
			$donor_prefix_name = $donor->get_donor_meta('donor_title');
			echo  $donor_prefix_name." ".$first_name." " .$last_name;
			}
			?></b> <label for="check01"><strong>
				<?php $current_user = wp_get_current_user();
				$email_id = $current_user->user_email;
				echo $display_name = $current_user->display_name; ?> </strong>
				</label> the Sum of Rupees ( <?php echo convert_number_to_words($amount); ?>)<strong> <?php echo $new_amn = apply_filters( 'charitable_donation_receipt_donation_amount', charitable_format_money( $amount ), $amount, $donation, 'summary' )
			?> </strong>
			<?php //foreach ( $donation->get_campaign_donations() as $campaign_donation ) : ?>
			 by  <?php echo $donation->get_gateway_label() ?> Date: <?php echo $donation->get_date() ?> Being the donation.
		</div>
	<!-- <div class="table_border_sigabove">
			<div class="table_inner">
				   <table border = "2">
			         <tr>
			            <th>Ordganisation</th>
			            <th>Donation Option</th>
			            <th>Units</th>
			         </tr>
					<?php foreach ( $donation->get_campaign_donations() as $campaign_donation ) : ?>
						<tr>
							<td class="campaign-name"><?php
								echo $campaign_donation->campaign_name;

								/**
								 * Do something after displaying the campaign name.
								 *
								 * @since 	1.3.0
								 *
								 * @param 	object              $campaign_donation Database record for the campaign donation.
								 * @param 	Charitable_Donation $donation 	 	   The Donation object.
								 */
								do_action( 'charitable_donation_receipt_after_campaign_name', $campaign_donation, $donation );
								?>
							</td>
							<td class="donation-option">INDIADONATES - GO GREEN</td>
							<td>1</td>
						</tr>
					<?php endforeach ?>

			      </table>
			</div>
		</div>  -->

		<div class="content_middle_rec">
			<p class="middle_rec">
				Donation exempt from income Tax under sec 80G of the Income Tax Act, 1961 vide letter DIT(E) 2007-2008/D-839/1659 dated 19-09-2007 of the Director of Income Tax (Exemption), Delhi-110092. <br/>
				<span class="print-line-on-pdf" style="border: 1px solid; clear: both; overflow: hidden; width: 55%; padding: 0; position: absolute; margin: 0; left: 56px;"></span>
				Charitable Institutions	are not required to affix revenue stamp on receipt
				under schedule | ART - 53 exemption (b) of the Indian Stamp Act.
			</p>
			<div class="rec_signature">
				<span class="rec_rupees"><strong><?php echo $new_amn = apply_filters( 'charitable_donation_receipt_donation_amount', charitable_format_money( $amount ), $amount, $donation, 'summary' )
			?></strong></span>
				<p>For<strong> Dev Pro</strong></p>
				<img src="https://camo.githubusercontent.com/59e9997c538fc5b1147b51c70540065423c30fcf/68747470733a2f2f662e636c6f75642e6769746875622e636f6d2f6173736574732f393837332f3236383034362f39636564333435342d386566632d313165322d383136652d6139623137306135313030342e706e67" />
			</div>
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
