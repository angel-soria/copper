<?php get_header();?>
<?php
	$i=0;
	$entradas=[];
	while ( have_posts() ) : the_post();
		$entradas[$i]['id']=get_the_ID();
		$entradas[$i]['title']=get_the_title();
		$entradas[$i]['link']=get_permalink();
		$entradas[$i]['date']=get_the_date('F j, Y' );
		$i++;				
	endwhile;
?>
<div class="pagina-single productos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="breadcrum">
					<?php custom_breadcrumbs(); ?>
				</div>				
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<?php if(isset($entradas[0]['id'])){ ?>
					<a href="<?php echo $entradas[0]['link']; ?>" class="content-product">
						<div class="producto-white entrada-category">
							<div class="cabezal ">
								<?php 
									if ( has_post_thumbnail($entradas[0]['id']) ) {
										echo get_the_post_thumbnail( $entradas[0]['id'], '750x530', array( 'class' => 'img-responsive' ) );
									}
								?>
								<div class="icon">
									<i class="copp-eye"></i>
									<p><?php echo get_option( 'aux_three_'.qtranxf_getLanguage() ); ?></p>
								</div>
								<div class="caption-primer">
									<p><?php echo $entradas[0]['date']; ?></p>
									<h2><?php echo $entradas[0]['title']; ?></h2>
								</div>
							</div>
						</div>
					</a>
				<?php } ?>

	 		</div>
	 		<div class="col-xs-12 col-sm-4">
			 	<?php if(isset($entradas[1]['id'])){ ?>
					<a href="<?php echo $entradas[1]['link']; ?>" class="content-product">
						<div class="producto-white entrada-category">
							<div class="cabezal ">
								<?php 
									if ( has_post_thumbnail($entradas[1]['id']) ) {
										echo get_the_post_thumbnail( $entradas[1]['id'], '360x366', array( 'class' => 'img-responsive' ) );
									}
								?>
								<div class="icon">
									<i class="copp-eye"></i>
									<p><?php echo get_option( 'aux_three_'.qtranxf_getLanguage() ); ?></p>
								</div>
							</div>
							<div class="pie-producto">
								<p><?php echo $entradas[1]['date']; ?></p>
								<h2><?php echo $entradas[1]['title']; ?> </h2>
							</div>
						</div>
					</a>
				<?php } ?>
	 		</div>
	 	</div>
		<div class="row">

			<?php 
				if(isset($entradas[2]['id'])){ 
					for ($i = 2; $i < count($array); $i++) { 
			?>
					<div class="col-xs-12 col-sm-4">
						<a href="<?php echo $entradas[$i]['link']; ?>" class="content-product">
							<div class="producto-white entrada-category">
								<div class="cabezal ">
									<?php 
										if ( has_post_thumbnail($entradas[$i]['id']) ) {
											echo get_the_post_thumbnail( $entradas[$i]['id'], '360x366', array( 'class' => 'img-responsive' ) );
										}
									?>
								<div class="icon">
										<i class="copp-eye"></i>
										<?php echo get_option( 'aux_three_'.qtranxf_getLanguage() ); ?>
									</div>
								</div>
								<div class="pie-producto">
									<p><?php echo $entradas[$i]['date']; ?></p>
									<h2><?php echo $entradas[$i]['title']; ?></h2>
								</div>
							</div>
						</a>
					</div>
			<?php 
					}
				} 
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