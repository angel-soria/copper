<?php get_header(); $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>

<div class="pagina-single productos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="breadcrum">
					<?php custom_breadcrumbs(); ?>
				</div>
					<h1><?php echo get_option( 'aux_five_'.qtranxf_getLanguage() ); ?></h1>
					<div class="excerpt"><?php echo get_option( 'aux_six_'.qtranxf_getLanguage() ); ?></div>				
			</div>
		</div>
	</div>
	<div class="filters">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul>
						<li><a href="<?php echo get_term_link($term).'?by=mprice'; ?>" <?php echo ($_GET['by'] == "mprice" ) ? 'class="active"' : ''; ?> ><?php echo get_option( 'aux_seven_'.qtranxf_getLanguage() ); ?></a></li>
						<li><a href="<?php echo get_term_link($term).'?by=lprice'; ?>" <?php echo ($_GET['by'] == "lprice" ) ? 'class="active"' : ''; ?> ><?php echo get_option( 'aux_eight_'.qtranxf_getLanguage() ); ?></a></li>
						<li><a href="<?php echo get_term_link($term).'?by=alpha'; ?>" <?php echo ($_GET['by'] == "alpha" ) ? 'class="active"' : ''; ?> >A-Z</a></li>
						<li><a href="<?php echo get_term_link($term).'?by=zalpha'; ?>" <?php echo ($_GET['by'] == "zalpha" ) ? 'class="active"' : ''; ?> >Z-A</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php
				while ( have_posts() ) : the_post();
			?>
				<div class="col-xs-6 col-sm-3">
					<a href="<?php echo get_the_permalink( ); ?>" class="content-product">
						<div class="producto-white">
							<div class="cabezal">
								<?php 
									if ( has_post_thumbnail() ) {
										echo get_the_post_thumbnail( get_the_ID(), '263x292', array( 'class' => 'img-responsive' ) );
									}
								?>
								<div class="icon">
									<i class="copp-eye"></i>
									<p><?php echo get_option( 'aux_three_'.qtranxf_getLanguage() ); ?></p>
								</div>
							</div>
							<div class="pie-producto">
								<h4><?php echo get_the_title( ); ?></h4>
								<p><?php echo get_post_meta( get_the_ID(), '_price_'.qtranxf_getLanguage(), true ); ?></p>
								<span><?php echo get_option( 'aux_four_'.qtranxf_getLanguage() ); ?></span>
							</div>
						</div>
					</a>
				</div>
			<?php
				endwhile; 
			?>


	 	</div>
	 	<div class="paginacion">
			<?php 
				global $wp_query;
				$big = 999999999; // need an unlikely integer
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
				) );
			?>	 		
	 	</div>
	</div>
</div>

<?php call_to_action(); ?>
<?php get_footer();?>