<script>
	$(document).ready(function(){
			$repassword = '<div id="oldpassword" class="hidden"><label><?php echo ossn_print('password:security:old:password');?></label> <input type="password" name="oldpassword" /></div>';
			$($repassword).insertAfter('.profile-edit-layout-right input[type="password"]');
			$('body').on('keypress', '.profile-edit-layout-right input[type="password"]', function(){
						$('#oldpassword').removeClass('hidden');
			});						   
	});
</script>