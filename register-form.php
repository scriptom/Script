<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<main class="py-3">
	<div class="tml mx-auto tml-register" id="theme-my-login<?php $template->the_instance(); ?>">
		<?php $template->the_action_template_message( 'register' ); ?>
		<?php $template->the_errors(); ?>
		<div class="card bg-dark text-white my-3 tml-form-card border border-light">
			<h3 class="card-header"><?php _e( 'Register', 'theme-my-login' ); ?></h3>
			<div class="card-body bg-secondary">
				<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register', 'login_post' ); ?>" method="post">
					<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
					<p class="tml-user-login-wrap">
						<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?></label>
						<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input form-control" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
					</p>
					<?php endif; ?>
		
					<p class="tml-user-email-wrap">
						<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ); ?></label>
						<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input form-control" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
					</p>
		
					<?php do_action( 'register_form' ); ?>
		
					<p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>
					<p class="tml-submit-wrap">
						<input type="submit" name="wp-submit" class="btn btn-light w-25 mr-0" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
						<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
						<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
						<input type="hidden" name="action" value="register" />
					</p>
				</form>
			</div>
			<div class="card-footer">
				<?php $template->the_action_links( array( 'register' => false ) ); ?>	
			</div>
		</div>
	</div>
</main>
