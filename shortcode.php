<?php
function rochester_mc_shortcode() { 
  
// Things that you want to do.
$message = "
<style type=\"text/css\">
	#mc_embed_signup{clear:left;}
#mc_embed_signup .helper_text {background-color: inherit;}
#mc_embed_signup h2 {margin-top: 0;}
#mc_embed_signup form {margin: 0;}
#mc_embed_signup .form-flex {display: flex; gap: 10px;}
#mc_embed_signup input[type=\"email\"] {border-radius: 10px; width: 100%; border: 1px solid #aaa;}
#mc_embed_signup input[type=\"submit\"] {width: 100px; padding: 0 15px !important; font-weight: bold !important; font-size: 14px !important;}
#mc_embed_signup div.mce_inline_error {
	border-radius: 10px;
    margin: 1em 0 1em 0;
    background-color: #fff !important;
}
</style>
<div id=\"mc_embed_signup\">
    <form action=\"https://rochestermfa.us20.list-manage.com/subscribe/post?u=bc9bc226fa2f8840e644b2639&amp;id=555df7b98c&amp;f_id=00ae4ee6f0\" method=\"post\" id=\"mc-embedded-subscribe-form\" name=\"mc-embedded-subscribe-form\" class=\"validate\" target=\"_blank\" novalidate>
        <div id=\"mc_embed_signup_scroll\">
        <!--<h2>E-Newsletter</h2>-->
		
<div class=\"form-flex\">
<div class=\"mc-field-group\" style=\"flex: 1;\">
	<input type=\"email\" value=\"\" name=\"EMAIL\" class=\"required email\" id=\"mce-EMAIL\" placeholder=\"E-Mail Address\" required>
	<span id=\"mce-EMAIL-HELPERTEXT\" class=\"helper_text\"></span>
</div>
<input type=\"submit\" value=\"Subscribe\" name=\"subscribe\" id=\"mc-embedded-subscribe\" class=\"button\">
</div>
	<div id=\"mce-responses\" class=\"clear foot\">
		<div class=\"response\" id=\"mce-error-response\" style=\"display:none\"></div>
		<div class=\"response\" id=\"mce-success-response\" style=\"display:none\"></div>
	</div>
	<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style=\"position: absolute; left: -5000px;\" aria-hidden=\"true\"><input type=\"text\" name=\"b_bc9bc226fa2f8840e644b2639_555df7b98c\" tabindex=\"-1\" value=\"\"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';fnames[6]='MMERGE6';ftypes[6]='address';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
";
return $message;
}
add_shortcode('mcform', 'rochester_mc_shortcode');