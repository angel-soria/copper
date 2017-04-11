<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
	<div class="head">
		<div class="container">
			<div class="row">
				<div class="col-xs-4">
					<p class="first"><span><i class="copp-phone"></i></span>Llama al <a href="tel:<?php echo get_option( 'telefono' ); ?>"><?php echo get_option( 'telefono' ); ?></a></p>
				</div>
				<div class="col-xs-4">
					<?php
						if(	qtranxf_getLanguage() == 'es'){
							$link=qtranxf_get_url_for_language($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],'en',true);
							$Texto="English";
						}else{
							$link=qtranxf_get_url_for_language($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],'es',true);
							$Texto="Español";
						}
					 ?>
					<p class="languaje"><a href="<?php echo $link; ?>"><i class="copp-world"></i> <span><?php echo $Texto; ?></span></a></p>
				</div>
				<div class="col-xs-4">
					<p class="right-align icons">Síguenos en <a href="<?php echo get_option( 'facebook' ); ?>"><i class="copp-facebook"></i></a> <a href="<?php echo get_option( 'youtube' ); ?>"><i class="copp-youtube"></i></a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="menu">
		<div class="container-fluid speciall-con">
			<div class="row">
				<div class="col-xs-12 hidden-xs">
					<nav>
						<ul>
							<li><a href="#">Quienes Somos</a></li>
							<li><a href="#">Catalogo <span class="caret"></span></a>
								<ul>
									<li><a href="#">Photoshop</a></li>
									<li><a href="#">Illustrator</a></li>
									<li><a href="#">Web Design</a></li>
								</ul>
							</li>
							<li class="logo"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/logo.png" alt="Copper Santa clara" class="img-responsive"></a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Contacto</a></li>
							<li class="logo"><a href="#" class="search"><i class="copp-search-1"></i></a></li>
						</ul>
					</nav>
					
				</div>
			</div>
		</div>
	</div>
</header>