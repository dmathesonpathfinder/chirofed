<?php
  $args = array(
    'label_username' => __( 'Username or E-mail' ),
    'label_log_in'   => __( 'Log In' ),
  );

if (pll_current_language() == 'en') { ?>

  <div id="login-modal">
    <h3>Log in to your account</h3>
    <?php wp_login_form( $args ); ?>
    <p class="forgot-password"><a href="<?php echo wp_lostpassword_url(); ?>">Forgot your password?</a></p>
  </div>

<?php } else if (pll_current_language() == 'fr') { ?>

  <div id="login-modal">
    <h3>Connectez-vous à votre compte</h3>
    <?php wp_login_form( $args ); ?>
    <p class="forgot-password"><a href="<?php echo wp_lostpassword_url(); ?>">Mot de passe oublié?</a></p>
  </div>

<?php } ?>