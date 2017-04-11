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
					<div class="imagen">
						<?php if ( has_post_thumbnail() ) : ?>
       						<?php the_post_thumbnail('large', array( 'class' => 'img-responsive' )); ?>
       					<?php endif; ?>
					</div>
					<div class="excerpt single"><?php echo get_the_date(); ?></div>
					<h1 class="single"><?php the_title();?></h1>
					<div class="contenido-word">
						<?php the_content();?>
					</div>
				<?php
				endwhile;
				?>
				<div class="complemento">
					
					<h3>
						<?php echo get_option( 'aux_one_'.qtranxf_getLanguage() ); ?>
					</h3>
					<?php
					    $myterms = get_terms( array( 'taxonomy' => 'product_category', 'parent' => 0, 'hide_empty' => 0, 'orderby'    => 'id', ) );
            			banners_categories($myterms);
					 ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php call_to_action(); ?>
<?php get_footer();?>