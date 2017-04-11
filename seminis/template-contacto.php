<?php
/*
Template Name: Contacto
*/
?>
<?php get_header();?>

<div class="pagina-single">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="breadcrum">
					<?php custom_breadcrumbs(); ?>
				</div>
				<?php
				while ( have_posts() ) : the_post();
				?>
					<h1><?php the_title();?></h1>
					<div class="excerpt"><?php the_excerpt();?></div>
					<div class="bloque-blanco">
						<div class="row">
							<div class="col-xs-12">
								<h3>Visitanos! </h3>
							</div>
						</div>
						


						<div class="row">
							<div class="col-xs-6 col-sm-2 hidden-xs">
								<a data-fancybox data-src="https://maps.google.com/maps?q=<?php echo get_post_meta( get_the_ID(), '_lat', true ); ?>,<?php echo get_post_meta( get_the_ID(), '_long', true ); ?>&hl=es;z=14&amp;output=embed" href="javascript:;">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/pin.png" class="img-responsive" alt="Localización">
								</a>
							</div> 
							<div class="col-xs-12 col-sm-4">
								<p>
									<?php echo get_post_meta( get_the_ID(), '_direccion', true ); ?>
								</p>									
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="mail mrgin">
								<a href="mailto:<?php echo get_option( 'correo' ); ?>">
									<?php echo get_option( 'correo' ); ?> <span> <i class="copp-mail"></i></span>
								</a>
								</div>
								<div class="tel mrgin">
									<a href="tel:<?php echo get_option( 'telefono' ); ?>">
										<?php echo get_option( 'telefono' ); ?>
									</a> 
									<span><i class="copp-phone"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="bloque-blanco">
						
				<?php
				if(isset($_POST['email_'])){

						if(isset($_POST['_product'])){
							$producto="<tr>
								<td>Producto Interesado: </td>
								<td>".strip_tags($_POST['_product'])."</td>
								</tr>";
						}else{
							$producto="";
						}

						$to = "angel.soherrera@gmail.com";

						$subject = "Website - Contacto";
						$message = "
								<html>
								<head>
								<title>Mensaje Nuevo</title>
								</head>
								<body>
								<table>
								<tr>
								<td>Nombre: </td>
								<td>".strip_tags($_POST['name_'])."</td>
								</tr>
								<tr>
								<td>Teléfono: </td>
								<td>".strip_tags($_POST['phone_'])."</td>
								</tr>
								<tr>
								<td>Email: </td>
								<td>".strip_tags($_POST['email_'])."</td>
								</tr>".$producto."
								<tr>
								<td>Mensage: </td>
								<td>".strip_tags($_POST['message_'])."</td>
								</tr>
								</table>
								</body>
								</html>
						";




						// Always set content-type when sending HTML email
						$headers  = "From:".strip_tags($_POST['name_user'])." <".strip_tags($_POST['email_user']).">\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8\r\n";

						// More headers
						
							//wp_mail($to,$subject,$message,$headers);
							echo (qtranxf_getLanguage()=='es') ? '<h3>Gracias</h3><p>Hemos recibido su mensaje, lo contactarémos lo más pronto posible</p>' : '<h3>Thank you</h3><p>We appreciate you contacting us. We try to respond as soon as possible, so one of our Customer Service colleagues will get back to you within a few hours.</p>';
					}else{ ?>
					<div class="row">
							<div class="col-xs-12">
								<h3><?php echo (qtranxf_getLanguage()=='es') ? 'Contáctanos' : "Contact us"; ?> </h3>
							</div>
						</div>

						<form action="<?php echo get_permalink();?>" class="form-contacto" method="post" id="contact">
							<div class="row">
								<div class="col-xs-12 col-sm-6">
									<input name="name_" type="text" placeholder="<?php echo (qtranxf_getLanguage()=='es') ? 'Nombre' : "Name"; ?>">
									<input name="email_" type="text" placeholder="<?php echo (qtranxf_getLanguage()=='es') ? 'Correo' : "e-Mail"; ?>">
									<input name="phone_" type="text" placeholder="<?php echo (qtranxf_getLanguage()=='es') ? 'Teléfono' : "Phone"; ?>">	
									<?php if(isset($_GET['producto'])){ ?>
										<input type="hidden" name="_product" value="<?php echo get_the_title(intval($_GET['producto'])); ?>">	
									<?php }?>							
								</div>
								<div class="col-xs-12 col-sm-6">
									<textarea name="message_" cols="15" rows="4" placeholder="<?php echo (qtranxf_getLanguage()=='es') ? 'Mensaje' : "Message"; ?>"></textarea>
									<input type="submit" value="<?php echo (qtranxf_getLanguage()=='es') ? 'enviar' : "Send"; ?>">
								</div>
							</div>
						</form>
<?php } ?>
					</div>
				<?php
				endwhile;
				?>

			</div>
		</div>
	</div>
</div>
<?php call_to_action(); ?>
<?php get_footer();?>