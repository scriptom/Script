<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<?php if ( '' !== $template->get_errors() ): ?>
<div class="alert alert-info">
<?php $template->the_errors(); ?>
</div>
<?php $template->the_action_template_message( 'profile', '<div class="alert alert-info>"', '</div>' ); ?>
<?php endif; ?>
<div class="card bg-dark border border-light inner-shadow container" id="theme-my-login<?php $template->the_instance(); ?>">
	<form id="your-profile" action="<?php $template->the_action_url( 'profile', 'login_post' ); ?>" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<p>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		</p>

		<h2 class="card-header"><?php _e( 'Opciones de usuario', 'theme-my-login' ); ?></h2>
		<div class="card-body">
			<div class="form-group">
				<label for="admin_bar_front"><?php _e( 'Toolbar', 'theme-my-login' )?></label>
				<div class="form-check">
					<input type="checkbox" name="admin_bar_front" class="form-check-input" id="admin_bar_front" value="1"<?php checked( _get_admin_bar_pref( 'front', $profileuser->ID ) ); ?> />
					<label for="admin_bar_front" class="form-check-label">
					<?php _e( 'Mostrar barra de herramientas mientras navega el sitio', 'theme-my-login' ); ?>
					</label>
				</div>
			</div>
			<?php do_action( 'personal_options', $profileuser ); ?>

			<?php do_action( 'profile_personal_options', $profileuser ); ?>
			<div class="row d-flex align-items-stretch">
				<div class="col-md-6">
					<fieldset>
						<legend><?php _e( 'Nombre', 'theme-my-login' ); ?></legend>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="user_login"><?php _e( 'Nombre de usuario', 'theme-my-login' ); ?></label>
									<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text box-shadow form-control disabled" /> <small class="text-muted form-text font-italic"><?php _e( 'Los nombres de usuario no se pueden cambiar.', 'theme-my-login' ); ?></small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="first_name"><?php _e( 'Primer Nombre', 'theme-my-login' ); ?></label>
									<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text form-control box-shadow" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="last_name"><?php _e( 'Apellido', 'theme-my-login' ); ?></label>
									<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text form-control box-shadow" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nickname"><?php _e( 'Apodo', 'theme-my-login' ); ?> <small class="text-muted font-italic"><?php _e( '(requerido)', 'theme-my-login' ); ?></small></label>
									<input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text form-control box-shadow" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="display_name"><?php _e( 'Mostrar nombre publicamente como', 'theme-my-login' ); ?></label>
									<select name="display_name" id="display_name" class="form-control box-shadow">
										<?php
										$public_display = array();
										$public_display['display_nickname']  = $profileuser->nickname;
										$public_display['display_username']  = $profileuser->user_login;

										if ( ! empty( $profileuser->first_name ) )
										$public_display['display_firstname'] = $profileuser->first_name;

										if ( ! empty( $profileuser->last_name ) )
										$public_display['display_lastname'] = $profileuser->last_name;

										if ( ! empty( $profileuser->first_name ) && ! empty( $profileuser->last_name ) ) {
											$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
											$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
										}

										if ( ! in_array( $profileuser->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
										$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;

										$public_display = array_map( 'trim', $public_display );
										$public_display = array_unique( $public_display );

										foreach ( $public_display as $id => $item ) {
											?>
											<option <?php selected( $profileuser->display_name, $item ); ?>><?php echo $item; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="col-md-6">
					<fieldset>
						<legend><?php _e( 'Info de Contacto', 'theme-my-login' ); ?></legend>
						<div class="form-group">
							<label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?> <small class="text-muted font-italic"><?php _e( '(requerido)', 'theme-my-login' ); ?></small></label>
							<input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text form-control box-shadow" /></td>
							<?php
							$new_email = get_option( $current_user->ID . '_new_email' );
							if ( $new_email && $new_email['newemail'] != $current_user->user_email ) : ?>
							<div class="updated inline">
								<p><?php
								printf(
									__( 'Hay un cambio pendiente de su correo a %1$s. <a href="%2$s">Cancelar</a>', 'theme-my-login' ),
									'<code>' . $new_email['newemail'] . '</code>',
									esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
								); ?></p>
							</div>
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="url"><?php _e( 'Sitio web', 'theme-my-login' ); ?> <small class="text-muted font-italic">(opcional)</small></label>
							<input type="text" name="url" id="url" value="<?php echo esc_attr( $profileuser->user_url ); ?>" class="regular-text code form-control box-shadow" />
						</div>

						<?php
						foreach ( wp_get_user_contact_methods() as $name => $desc ) {
							?>
							<div class="form-group">
								<label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label>
								<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $profileuser->$name ); ?>" class="regular-text form-control box-shadow" />
							</div>
							<?php
						}
						?>
					</fieldset>
				</div>
				<div class="col-md-6">
					<fieldset>
						<legend><?php _e( 'Acerca de ti', 'theme-my-login' ); ?></legend>
						<div class="form-group">
							<label for="description"><?php _e( 'Info Biografica', 'theme-my-login' ); ?></label>
							<textarea name="description" id="description" class="form-control box-shadow" rows="5" cols="30"><?php echo esc_html( $profileuser->description ); ?></textarea>
							<small class="text-muted font-italic"><?php _e( 'Comparte una pequeña reseña biográfica. Puede ser mostrada públicamente.', 'theme-my-login' ); ?></small>
						</div>
					</fieldset>
				</div>

				<?php
				$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
				if ( $show_password_fields ) :
					?>
				<div class="col-md-6">
					<fieldset>
						<legend><?php _e( 'Manejo de Cuenta', 'theme-my-login' ); ?></legend>
						<div id="password" class="user-pass1-wrap form-group">
							<label for="pass1"><?php _e( 'Nueva Contraseña', 'theme-my-login' ); ?></label>
								<input class="hidden" value=" " /><!-- #24364 workaround -->
								<button type="button" class="btn box-shadow btn-secondary wp-generate-pw hide-if-no-js form-control"><?php _e( 'Generar Contraseña', 'theme-my-login' ); ?></button>
								<div class="wp-pwd hide-if-js">
									<span class="password-input-wrapper">
										<input type="password" name="pass1" id="pass1" class="regular-text form-control box-shadow" value="" autocomplete="off" data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
									</span>
									<div class="row">
										<div style="display:none" id="pass-strength-result" class="col" aria-live="polite"></div>
										<div class="col">
											<button type="button" class="btn btn-secondary wp-hide-pw hide-if-no-js form-control" data-toggle="0" aria-label="<?php esc_attr_e( 'Ocultar contraseña', 'theme-my-login' ); ?>">
												<span class="dashicons dashicons-hidden"></span>
												<span class="text"><?php _e( 'Ocultar', 'theme-my-login' ); ?></span>
											</button>
										</div>
										<div class="col">
											<button type="button" class="btn btn-secondary wp-cancel-pw hide-if-no-js form-control" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancelar cambio de contraseña', 'theme-my-login' ); ?>">
												<span class="text"><?php _e( 'Cancelar', 'theme-my-login' ); ?></span>
											</button>
										</div>
									</div>
								</div>
						</div>
						<div class="user-pass2-wrap hide-if-js form-group">
							<label for="pass2"><?php _e( 'Repita la nueva Contraseña', 'theme-my-login' ); ?></label>
							<input name="pass2" type="password" id="pass2" class="regular-text form-control box-shadow" value="" autocomplete="off" />
							<small class="font-italic"><?php _e( 'Escriba su contraseña otra vez', 'theme-my-login' ); ?></small>
						</div>
						<div class="pw-weak form-group">
							<h6><?php _e( 'Confirm Password', 'theme-my-login' ); ?></h6>
							<div class="form-check">
								<input type="checkbox" name="pw_weak" class="pw-checkbox form-check-input" />
								<label class="form-check-label">
									<?php _e( 'Confirm use of weak password', 'theme-my-login' ); ?>
								</label>
							</div>
						</div>
					</fieldset>
				</div>
				<?php endif; ?>


				<?php do_action( 'show_user_profile', $profileuser ); ?>

			</div>
		</div>
		<div class="card-footer text-center">
			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="btn btn-primary form-control col-sm-6 box-shadow" value="<?php esc_attr_e( 'Actualizar Perfil', 'theme-my-login' ); ?>" name="submit" id="submit" />
		</div>
	</form>
</div>
