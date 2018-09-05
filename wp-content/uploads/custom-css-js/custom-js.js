<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 
jQuery(document).ready(function( $ ){
  jQuery(".login-link1 > a").click(function(event){
      event.preventDefault();
      jQuery("html, body").animate({ scrollTop: 0 }, "fast");
      setTimeout(function(){
          jQuery(".login-link > a").click();
      }, 300);
  });
});</script>
<!-- end Simple Custom CSS and JS -->
