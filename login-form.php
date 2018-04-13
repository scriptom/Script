<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<main class="py-3">
	<div class="card text-white bg-dark my-3 tml-form-card mx-auto border border-light">
		<div class="tml tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
			<?php $template->the_action_template_message( 'login' ); ?> 
			<h3 class="card-header"> <?php  _e( 'Login', 'theme-my-login' ); ?></h3>
			<div class="card-body bg-secondary">
				<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login', 'login_post' ); ?>" method="post">
					<p class="tml-user-login-wrap">
						<label for="user_login<?php $template->the_instance(); ?>"><?php
							if ( 'username' == $theme_my_login->get_option( 'login_type' ) ) {
								_e( 'Username', 'theme-my-login' );
							} elseif ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
								_e( 'E-mail', 'theme-my-login' );
							} else {
								_e( 'Username or E-mail', 'theme-my-login' );
							}
						?></label>
						<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="form-control input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
					</p>
			
					<p class="tml-user-pass-wrap">
						<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
						<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="form-control input" value="" size="20" autocomplete="off" />
					</p>
			
					<?php do_action( 'login_form' ); ?>
			
					<div class="tml-rememberme-submit-wrap">
						<p class="tml-rememberme-wrap">
							<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
							<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?></label>
						</p>
			
						<p class="tml-submit-wrap">
							<input type="submit" name="wp-submit" class="btn btn-light" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
							<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
							<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
							<input type="hidden" name="action" value="login" />
						</p>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<?php $template->the_action_links( array( 'login' => false ) ); ?>	
			</div>
		</div>
	</div>
</main>