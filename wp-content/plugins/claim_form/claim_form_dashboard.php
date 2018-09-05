<?php
   /*
   Plugin Name: Claim Forms
   Plugin URI: https://phpyouth.com
   description: A plugin for handling the clain forms
   Version: 1.0
   Author: Team PhpYouth
   Author URI: https://phpyouth.com
   License: GPL2
   */
   add_action( 'admin_menu', 'register_my_custom_menu_page' );
	function register_my_custom_menu_page() {
	   add_menu_page( 'Claim Forms Dashboard', 'Claim Forms', 'manage_options', 'claim_forms', 'claim_forms_function', 'dashicons-welcome-widgets-menus', 90 );
	}
	
	function claim_forms_function(){
		global $table_prefix;
		echo '<table id="claim_form_table">';
		echo '<thead>';
		echo '<th>Claim ID</th>';
		echo '<th>User Name</th>';
		echo '<th>Claim for what</th>';
		echo '<th>Flight Number</th>';
		echo '<th>Flight Date</th>';
		echo '<th>Departure airport</th>';
		echo '<th>Arrival airport</th>';
		echo '<th>Airline Name</th>';
		echo '<th>Number of pessangers</th>';
		echo '<th>Booking Refrence</th>';
		echo '<th>Alternate Flight</th>';
		echo '<th>Details on overnight</th>';
		echo '<th>Reason for cancellation</th>';
		echo '<th>Reminder date</th>';
		echo '<th>Airline Refrence</th>';
		echo '<th>Time of claim submission</th>';
		echo '<th>Time of reply by airline</th>';
		echo '<th>Internal notes</th>';
		echo '<th>Status</th>';
		echo '</thead>';
		echo '<tbody>';
		$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$get_claims = mysqli_query($con,"select * from ".$table_prefix."claim_form ");
		while( $claim = mysqli_fetch_array($get_claims) ){
			echo '<tr>';
			echo '<td>'.$claim['id'].'</td>';
			$user_name = get_user_by("id" , $claim['user_id'])->display_name;
			if($user_name==false){ $user_name = ""; }
			else{}
			echo '<td>'.$user_name.'</td>';
			
			if($claim['forwhat_claim']=="late_flight"){ $forwhat_claim = "Late Flight"; }
			else if($claim['forwhat_claim']=="luggage_damage"){ $forwhat_claim = "Luggage - damaged"; }
			else { $forwhat_claim = "Luggage - lost"; }
			
			echo '<td>'.$forwhat_claim.'</td>';
			echo '<td>'.$claim['flight_num'].'</td>';
			echo '<td>'.$claim['flight_date'].'</td>';
			echo '<td>'.$claim['dept_airport'].'</td>';
			echo '<td>'.$claim['arriv_airport'].'</td>';
			echo '<td>'.$claim['airline'].'</td>';
			echo '<td>'.$claim['claimimg_pessangers'].'</td>';
			echo '<td>'.$claim['booking_ref'].'</td>';
			echo '<td>'.$claim['alt_flight'].'</td>';
			echo '<td>'.$claim['cancel_details_hotel'].'</td>';
			
			if($claim['cancel_reason']=="very_delay"){ $cancel_reason = "Late Flight"; }
			else if($claim['cancel_reason']=="flight_accident"){ $cancel_reason = "Any flight accident"; }
			else { $cancel_reason = "Any natural disaster"; }
			
			echo '<td>'.$cancel_reason.'</td>';
			echo '<td>'.$claim['reminder_date'].'</td>';
			echo '<td>'.$claim['airline_ref'].'</td>';
			echo '<td>'.date('m/d/Y H:i:s', $claim['submit_time']).'</td>';
			echo '<td>'.$claim['time_reply_airline'].'</td>';
			echo '<td>'.$claim['internal_notes'].'</td>';
			
			if($claim['status']=="0"){ $selected1 = ' selected '; }
			else{ $selected1 = ' '; }
			if($claim['status']=="1"){ $selected2 = ' selected '; }
			else{ $selected2 = ' '; }
			
			$status = '<select onchange="update_claim_status(`'.$claim['id'].'`);" id="update_claim_status" name="update_claim_status"><option '.$selected1.' value="0">Active</option><option '.$selected2.' value="1">Suspend</option></select>';
			
			echo '<td>'.$status.'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
		?>
		<script>
			function update_claim_status(claim_id){
				//alert(claim_id);
				jQuery.ajax({
				  type: "POST",
				  url: "<?php echo plugin_dir_url( __FILE__ ); ?>change_status.php",
				  data: {claim_id:claim_id},
				  cache: false,
				  success: function(data){
				  	alert(data);
					 jQuery("#resultarea").text(data);
				  }
				});
			}
		</script>
		<?php
		//echo '<script src="'.plugin_dir_url( __FILE__ ).'js/claim.js"></script>';
	}
?>