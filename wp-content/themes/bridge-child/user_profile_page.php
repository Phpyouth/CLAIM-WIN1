<?php 
/*
Template Name: User Profile
*/
?>
<?php get_header(); ?>
<div id="primary" class="content-area grid_section">
    <main id="main" class="site-main section_inner" role="main">
		<?php
		if(is_user_logged_in()){
		global $current_user;
		?>
        <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-4">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <h1 style="color: #000;">Your Profile</h1>
                  </div>
              </div>
                <div class="separator  small left  " style="background-color: #99b63b;height: 5px;width: 100px;"></div>
              </div>
          </div>
          </div>
        <div class="blue-li wpb_column vc_column_container vc_col-sm-4">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper"></div>
          </div>
          </div>
        <div class="green-li wpb_column vc_column_container vc_col-sm-4">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper"></div>
          </div>
          </div>
      </div>
	  
	  <?php
	  if($_GET['status']=="success"){
			echo '<h2 id="success_message">Your claim request submitted successfully</h2>';
		}
		 if($_GET['status1']=="success"){
			echo '<h2 id="success_message">Your Profile Update successfully</h2>';
		}
	  ?>
	  
	  <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>Name: <b><?php echo $current_user->first_name; ?></b></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	   <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>Last Name: <b><?php echo $current_user->last_name; ?></b></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	  <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>User Name: <b><?php echo $current_user->display_name; ?></b></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	  
	  <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>Email Address: <b><?php echo $current_user->user_email; ?></b></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	   <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>Date Of Birth: <b><?php echo $current_user->DateofBirth; ?></b></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	  <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>Address: <b><?php echo $current_user->address; ?></b></p>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	  <div class="section_inner_margin clearfix">
        <div class="wpb_column vc_column_container vc_col-sm-6">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>
				
					<a href="<?php echo get_site_url().'/edit-profile' ; ?>" target="_blank"><span>Edit Profile</a></b></p>
					
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	  <?php
	  global $table_prefix;
	  $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$get_claims = mysqli_query($con,"select * from ".$table_prefix."claim_form  where user_id='".get_current_user_id()."' ");
		if(mysqli_num_rows($get_claims)>0){
			echo '<div id="claim_request_title">Your claim Requests</div>';
			echo '<div id="claim_form_table_holder"><table id="claim_form_table">';
			echo '<thead>';
			echo '<th>Claim Number</th>';
			echo '<th>Claim for what</th>';
			echo '<th>Flight Number</th>';
			echo '<th>Flight Date</th>';
			echo '<th>Departure airport</th>';
			echo '<th>Arrival airport</th>';
			echo '<th>Airline Name</th>';
			echo '<th>Number of pessangers</th>';
			echo '<th>Booking Refrence</th>';
			echo '<th>Alternate Flight</th>';
			echo '<th style="min-width:250px;">Details on overnight</th>';
			echo '<th>Reason for cancellation</th>';
			echo '<th>Reminder date</th>';
			echo '<th>Time of claim submission</th>';
			echo '<th>Status</th>';
			echo '</thead>';
			echo '<tbody>';
			while( $claim = mysqli_fetch_array($get_claims) ){
				echo '<tr>';
				echo '<td>cw_'.$claim['id'].'</td>';
				
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
				
				if(strlen($claim['cancel_details_hotel'])>99){
					$cancel_details_hotel = '<div id="short_'.$claim['id'].'">'.substr($claim['cancel_details_hotel'], 0 , 99).'<span class="show_more" onclick="show_full(`'.$claim['id'].'`);">... show more</span></div><div style="display:none;" id="full_'.$claim['id'].'">'.$claim['cancel_details_hotel'].'</div>';
				}
				else{
					$cancel_details_hotel = $claim['cancel_details_hotel'];
				}
				
				echo '<td>'.$cancel_details_hotel.'</td>';
				
				if($claim['cancel_reason']=="very_delay"){ $cancel_reason = "Late Flight"; }
				else if($claim['cancel_reason']=="flight_accident"){ $cancel_reason = "Any flight accident"; }
				else { $cancel_reason = "Any natural disaster"; }
				
				echo '<td>'.$cancel_reason.'</td>';
				echo '<td>'.$claim['reminder_date'].'</td>';
				echo '<td>'.date('m/d/Y H:i:s', $claim['submit_time']).'</td>';
				echo '<td>'.$claim['status'].'</td>';
				echo '</tr>';
			}
			echo '</tbody>';
		echo '</table></div>';
		}
		else{
			echo 'Sorry , there is no claim request by you.';
		}
	  ?>
	  
	  <script>
	  function show_full(claim_id){
	  	jQuery("#short_"+claim_id).remove();
		jQuery("#full_"+claim_id).show();
	  }
	  </script>
	  
	  <div style="height: 50px;"></div>
        <?php
		}
		else{
			echo '<h3>Please login to access this page</h3>';
		}
		?>
		
	</main><!-- .site-main -->
 
    <?php get_sidebar( 'content-bottom' ); ?>
 
</div><!-- .content-area -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>