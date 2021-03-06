<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>

<main class="py-3">
	<div class="tml mx-auto tml-lostpassword" id="theme-my-login<?php $template->the_instance(); ?>">
		<?php $template->the_action_template_message( 'lostpassword' ); ?>
		<?php $template->the_errors(); ?>
		<div class="card text-white bg-dark my-3 tml-form-card inner-shadow border border-light">
			<h3 class="card-header"><?php _e( 'Lost Password', 'theme-my-login' ); ?></h3>
		<div class="card-body bg-secondary">
			<form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'lostpassword', 'login_post' ); ?>" method="post">
					<p class="tml-user-login-wrap">
						<label for="user_login<?php $template->the_instance(); ?>"><?php
						if ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
							_e( 'E-mail:', 'theme-my-login' );
						} else {
							_e( 'Username or E-mail:', 'theme-my-login' );
						} ?></label>
						<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input form-control" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
					</p>

					<?php do_action( 'lostpassword_form' ); ?>

					<p class="tml-submit-wrap">
						<input type="submit" name="wp-submit" class="btn btn-light" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Get New Password', 'theme-my-login' ); ?>" />
						<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
						<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
						<input type="hidden" name="action" value="lostpassword" />
					</p>
				</form>
			</div>
		<div class="card-footer">
			<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>
		</div>
		</div>
	</div>
</main>
