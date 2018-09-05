<?php 
/*
Template Name: User edit
*/
?>
<?php
global $current_user, $wp_roles;
get_currentuserinfo();

/* If profile was saved, update profile. */
if ( isset($_POST['updateuser']) ) {
        /* Update user password. */
 if (isset( $_POST['email'])) {
	 $success1='1';
    // check if user is really updating the value
    if ($user_email != $_POST['email']) {       
        // check if email is free to use
        if (email_exists( $_POST['email'] )){
            // Email exists, do not update value.
			$error="Email already exits";
			$success1="false";
			  // Maybe output a warning.
        } else {
            $args = array(
                'ID'         => $current_user->id,
                'user_email' => esc_attr( $_POST['email'] )
            );  
					$success1="true";
        wp_update_user( $args );
       }   
	   
   }
 
}   

if (isset( $_POST['display_name'])) {
    // check if user is really updating the value
    
            $args = array(
                'ID'         => $current_user->id,
                'display_name' => esc_attr( $_POST['display_name'] )
            );            
        wp_update_user( $args );
     
}   
  if ( !empty( $_POST['first_name'] ) )
                update_user_meta( $current_user->id, 'first_name', esc_attr( $_POST['first_name'] ) );
	if (  $_POST['last_name'] )
                update_user_meta( $current_user->id, 'last_name', esc_attr( $_POST['last_name'] ) );	
if ($_POST['DateofBirth'] ) 
	update_user_meta( $current_user->id, 'DateofBirth', esc_attr( $_POST['DateofBirth'] ) );	
if ($_POST['address'] ) 
	update_user_meta( $current_user->id, 'address', esc_attr( $_POST['address'] ) );	
if($success1=='true' || $success1=='1'){
wp_redirect( get_site_url()."/your-profile/?status1=success" );
}


}

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
                    <h1 style="color: #000;">Edit Profile</h1>
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
	  ?>
	  
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
        <div class="wpb_column vc_column_container  col-sm-12">
            <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
				<form method="post" id="adduser" action="<?php the_permalink(); ?>">
				<div class="row">
				<div class="form-field col-md-6">
					<label for="user_name">Name</label><input type="text" name="first_name" id="first_name" value="<?php global $current_user; get_currentuserinfo(); echo $current_user->first_name; ?>" /></div>
				<div class="form-field col-md-6">
					<label for="user_email">Last Name</label><input type="text" name="last_name" id="last_name" value="<?php global $current_user; get_currentuserinfo(); echo $current_user->last_name; ?>" /></div>
				   <div class="form-field col-md-6">
					<label for="user_email">Email</label><input type="text" name="email" id="email" value="<?php global $current_user; get_currentuserinfo(); echo $current_user->user_email; ?>" /><span><?php echo $error; ?></span></div>
					<div class="form-field col-md-6">
					<label for="user_email">Date Of Birth</label> <input type="text" name="DateofBirth" id="dateofbirth" value="<?php global $current_user; get_currentuserinfo(); echo $current_user->DateofBirth; ?>" /></div>
				    <div class="form-field col-md-6">
					<label for="user_email">Address</label> <input type="text" name="address" id="address" value="<?php global $current_user; get_currentuserinfo(); echo $current_user->address; ?>" /></div>
				    </div>
					<div class="form-field col-md-6">
					  </div>
					<div class="clearfix"></div>
					<div class="form-field col-md-6">
					 <input name="updateuser" type="submit" id="updateuser" class="submit button" value="Update Profile" />	
					  </div>
				  
				   </form>
                  </div>
              </div>
              </div>
          </div>
        </div>
	  </div>
	
	  
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