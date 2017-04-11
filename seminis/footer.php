<div class="newsletter">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<div>
					Recibe nuestro newletter
					<form action="#">
						<input type="text" >
						<input type="submit" value="+">
					</form>
					<?php  if (function_exists('newsletter_form')) newsletter_form();?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="redes">
					<span><?php echo (qtranxf_getLanguage()=='es') ? 'Siguenos' : "Follow us"; ?></span> 
					<a href="<?php echo get_option( 'facebook' ); ?>"><i class="copp-facebook"></i></a>
					<a href="<?php echo get_option( 'youtube' ); ?>"><i class="copp-youtube"></i></a>					
				</div>
			</div>
		</div>
	</div>
</div>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<h3><?php echo (qtranxf_getLanguage()=='es') ? 'Cátalogo' : "Catalog"; ?></h3>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="imagen-footer">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/copper-footer.png" alt="Copper Santa clara" class="img-responsive">
				</div>
			</div>
			<div class="col-xs-12 col-sm-5">
				<div class="mail">
					<a href="mailto:<?php echo get_option( 'correo' ); ?>">
						<span><i class="copp-mail"></i></span><?php echo get_option( 'correo' ); ?>
					</a>
				</div>
				<div class="tel">
					<a href="tel:<?php echo get_option( 'telefono' ); ?>">
						<?php echo get_option( 'telefono' ); ?>
					</a>  
					<span><i class="copp-phone"></i></span>
				</div>
			</div>
		</div>
	</div>
	<div class="last-footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-9">
					<a href="<?php echo get_page_link(34); ?>"><?php echo get_the_title(34); ?></a> |
					<a href="<?php echo get_page_link(36); ?>"><?php echo get_the_title(36); ?></a> |
					<?php echo (qtranxf_getLanguage()=='es') ? 'Todos los derechos reservados' : "All rights reserved."; ?>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="sign">
						Design by <a href="">F R O Y L A N</a>					
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>