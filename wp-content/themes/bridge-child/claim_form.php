<?php 
/*
Template Name: Claim Form
*/
if($_POST['claim_submit']){
	extract($_POST);
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	/*if (mysqli_connect_errno()){ echo "Failed to connect to MySQL: " . mysqli_connect_error(); }
	else{ echo 'connected'; }*/
	
	if(is_user_logged_in()){
		global $current_user;
		$message = __('Hi '.$current_user->first_name.',') . "\r\n\r\n";
		$message .= __("Your claim request has been submitted successfully.") . "\r\n\r\n";
		$message .= __('Thanks,') . "\r\n";
		$message .= __($blogname) . "\r\n";
		
	
		$title = sprintf( __('Claim request submitted on [%s]'), $blogname );
		
		wp_mail($user_email, $title, $message);
		
		$submit_claim = mysqli_query($con,"INSERT INTO `_cu_claim_form` (`forwhat_claim`, `flight_num`, `flight_date`, `dept_airport`, `arriv_airport`, `airline`, `claimimg_pessangers`, `booking_ref`, `alt_flight`, `cancel_details_hotel`, `cancel_reason`, `reminder_date`, `submit_time`, `airline_ref`, `time_claim_sub`, `time_reply_airline`, `internal_notes`, `user_id`, `status`) VALUES ('$forwhat_claim','$flight_num','$flight_date','$dept_airport','$arriv_airport','$airline','$claimimg_pessangers','$booking_ref','$alt_flight','$cancel_details_hotel','$cancel_reason','$reminder_date','".time()."','$airline_ref','$time_claim_sub','$time_reply_airline','$internal_notes','".get_current_user_id()."','0')");
		if($submit_claim){
			wp_redirect( get_site_url()."/your-profile/?status=success" );
			exit;
			//$success_message = '<h2 id="success_message">form submitted successfully</h2>';
		}
			
	}
	else{
		
		$user_name1 = str_replace(" ","_",$user_name);
		function user_check($user_name1){
			$user_id = username_exists( $user_name1 );
			if( $user_id == false ){
				//echo " non-exist ";
				//echo $user_name1;
				$GLOBALS['user_name1'] = $user_name1;
				return $user_name1;
			}
			else{
				//echo " exist ";
				$user_name11 = $user_name1."1";
				user_check($user_name11);
			}
		}
		
		$user_name12 = user_check($user_name1);
		//echo "hello".$user_name1."hii";
		
		if ( email_exists($user_email) == false ) {
			$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_id = wp_create_user( $user_name1, $random_password, $user_email );
			$user_data = wp_update_user( array( 'ID' => $user_id, 'first_name' => $user_name ) );
			
			$creds = array(
				'user_login'    => $user_name1,
				'user_password' => $random_password,
				'remember'      => true
			);
		 
			$user_login = wp_signon( $creds, false );
		 
			if ( is_wp_error( $user_login ) ) {
				echo $user_login->get_error_message();
			}
			
			
			if ( is_multisite() )
				$blogname = $GLOBALS['current_site']->site_name;
			else
				$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
			
			$message = __('Hi '.$user_name.',') . "\r\n\r\n";
			$message .= __('You have successfully registered with us.') . "\r\n\r\n";
			$message .= __('User Name -> '.$user_name1.'') . "\r\n\r\n";
			$message .= __('Password -> '.$random_password.'') . "\r\n\r\n";
			$message .= __('Your claim request has been submitted successfully.') . "\r\n\r\n";
			$message .= __("If you didn't make this request, you can ignore this email") . "\r\n\r\n";
			$message .= __('Thanks,') . "\r\n";
			$message .= __($blogname) . "\r\n";
			
		
			$title = sprintf( __('Registration successfull on [%s]'), $blogname );
			
			wp_mail($user_email, $title, $message);
			
			$submit_claim = mysqli_query($con,"INSERT INTO `_cu_claim_form` (`forwhat_claim`, `flight_num`, `flight_date`, `dept_airport`, `arriv_airport`, `airline`, `claimimg_pessangers`, `booking_ref`, `alt_flight`, `cancel_details_hotel`, `cancel_reason`, `reminder_date`, `submit_time`, `airline_ref`, `time_claim_sub`, `time_reply_airline`, `internal_notes`, `user_id`, `status`) VALUES ('$forwhat_claim','$flight_num','$flight_date','$dept_airport','$arriv_airport','$airline','$claimimg_pessangers','$booking_ref','$alt_flight','$cancel_details_hotel','$cancel_reason','$reminder_date','".time()."','$airline_ref','$time_claim_sub','$time_reply_airline','$internal_notes','$user_id','0')");
			if($submit_claim){
				wp_redirect( get_site_url()."/your-profile/?status=success" );
				exit;
				//$_SESSION['success_message'] = '<h2 id="success_message">form submitted successfully</h2>';
				//header("Refresh:0");
				//$success_message = '<h2 id="success_message">form submitted successfully</h2>';
			}

		}
		else {
			$success_message = '<h2 id="error_message">Email already exists. Please login first.</h2>';
		}
	}
}
?>
<?php get_header(); ?>
 
<div id="primary" class="content-area grid_section">
    <main id="main" class="site-main section_inner" role="main">
		<?php 
		echo $success_message; 
		/*if($_GET['status']=="success"){
			echo '<h2 id="success_message">form submitted successfully</h2>';
		}*/
		?>
		<form method="post" id="claim_form">
			<?php
			if(is_user_logged_in()){}
			else{
			?>
			<div class="row">
				<div class="form-field col-md-6">
					<label for="user_name">Name*</label> <input type="text" required="" name="user_name" id="user_name">
				</div>
				<div class="form-field col-md-6">
					<label for="user_email">Email*</label> <input type="email" required="" name="user_email" id="user_email">
				</div>
			</div>
			<?php } ?>
			
	<div class="row">		
    <div class="form-field col-md-4"><label for="forwhat_claim">For what you want claim*</label> 
				<select id="forwhat_claim" required="" name="forwhat_claim">
					<option value="late_flight">Late Flight</option>
					<option value="luggage_damage">Luggage - damaged</option>
					<option value="luggage_lost">Luggage - lost</option>
				</select>
			</div>
			<div class="form-field col-md-4">
<label for="flight_date">Flight Date*</label> <input type="date" required="" name="flight_date" id="flight_date">
				
			</div>
			<div class="form-field col-md-4">
				<label for="flight_num">Flight Number*</label> <input type="text" required="" name="flight_num" id="flight_num">
			</div></div>
<div class="row">
			<div class="form-field col-md-6">
				<label for="dept_airport">Departure airport*</label> <input type="text" required="" name="dept_airport" id="dept_airport">
			</div>
			<div class="form-field col-md-6">
				<label for="arriv_airport">Arrival airport*</label> <input type="text" required="" name="arriv_airport" id="arriv_airport">
			</div></div>
<div class="row">
			<div class="form-field col-md-6">
				<label for="airline">Airline Name*</label> <input type="text" required="" name="airline" id="airline">
			</div>
			<div class="form-field col-md-6">
				<label for="claimimg_pessangers">Number of pessangers</label> <input type="number" name="claimimg_pessangers" id="claimimg_pessangers">
			</div></div>
<div class="row">
			<div class="form-field col-md-6">
				<label for="booking_ref">Booking Refrence</label> <input type="text" name="booking_ref" id="booking_ref">
			</div>
			<div class="form-field col-md-6">
				<label for="alt_flight">Alternate Flight <small>(If flight is cancelled)</small> </label> <input type="text" name="alt_flight" id="alt_flight">
			</div></div>
<div class="row">
			<div class="form-field">
				<label for="cancel_details_hotel">Details on overnight hotel / transfers* <small>(If flight is cancelled)</small></label> <textarea required="" name="cancel_details_hotel" id="cancel_details_hotel"></textarea>
			</div></div>
<div class="row">
			<div class="form-field col-md-6">
				<label for="cancel_reason">Reason for cancellation <small>(If flight is cancelled)</small></label> 
				<select id="cancel_reason" name="cancel_reason">
					<option value="">Select Reason</option>
					<option value="very_delay">Very Delay in flight</option>
					<option value="flight_accident">Any flight accident</option>
					<option value="natural_disaster">Any natural disaster</option>
				</select>
			</div>
			<div class="form-field col-md-6">
				<label for="reminder_date">Reminder date</label> <input type="date" name="reminder_date" id="reminder_date">
			</div></div>
<div class="row">
			<div class="form-field col-md-6">
				<input type="submit" name="claim_submit" value="Get Claim">
			</div></div>
		</form>
 
    </main><!-- .site-main -->
 
    <?php get_sidebar( 'content-bottom' ); ?>
 
</div><!-- .content-area -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>