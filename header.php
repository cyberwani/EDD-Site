<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package EDD
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="header-outer">
		<header class="header clearfix">
			<div id="logo">
				<a href="<?php echo esc_url( '/' ); ?>" class="logo-image"><img src="images/logo.png" alt="Easy Digital Downloads" /></a>
			</div><!-- #logo -->

			<nav id="primary" class="navigation-main" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- /#primary -->

			<div id="sign-in-form" class="clearfix">
				<div class="tooltip-arrow"></div>
				<h3>Sign In</h3>
				<form action="" method="post">
					<p class="login-username">
						<label for="user-login">Username</label>
						<input type="text" name="user-login" id="user-login" class="input" size="20" />
					</p>
					<p class="login-password">
						<label for="user-pass">Password</label>
						<input type="text" name="user-pass" id="user-pass" class="input" size="20" />
					</p>
					<p class="login-submit clearfix">
						<input type="submit" value="Sign In" />
						<a class="forgot-password" href="">Forgot your password?</a>
					</p>
				</form>
			</div><!-- /#sign-in-form -->
		</header><!-- /.header -->
	</div><!-- /.header-outer -->