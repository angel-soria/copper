<?php get_header();?>

<div class="producto-single">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="breadcrum">
					<?php custom_breadcrumbs(); ?>
				</div>
			</div>
				<?php
					while ( have_posts() ) : the_post();
					$id_prod= get_the_ID();
					$terms = wp_get_post_terms( $post->ID, 'product_category');
					foreach($terms as $term_single) {
					$taxonomia= $term_single->term_id; //do something here
					}
					$metavalue = get_post_meta( $post->ID, 'mgop_media_value', true );
					if ( has_post_thumbnail() ) :
						array_unshift($metavalue["mgop_mb_galeria-de-productos"], get_post_thumbnail_id());						
					endif;
				?>
					<div class="col-xs-12 col-sm-5">
						<div class="slider-for slider_productos">
						<?php 
							foreach($metavalue["mgop_mb_galeria-de-productos"] as $img_id){ 
								$img_full = wp_get_attachment_image_src($img_id, '458x300');
								echo '<div><img src="'.$img_full[0].'" /></div>';
							}
						?>
						</div>
						<div class="slider-nav slider_productos_tab">
							<?php 
							foreach($metavalue["mgop_mb_galeria-de-productos"] as $img_id){ 
								$img_full = wp_get_attachment_image_src($img_id, '45x45');
								echo '<div><img src="'.$img_full[0].'" /></div>';
							}
						?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-1"></div>
					<div class="col-sm-6 col-xs-12">
						<div class="contenido-producto">
							<p class="identificador"><span>ID</span> <?php echo get_post_meta( get_the_ID(), '_id', true ); ?></p>
							<h1><?php echo get_the_title( ); ?></h1>
							<p class="price"><?php echo get_post_meta( get_the_ID(), '_price_'.qtranxf_getLanguage(), true ); ?></p>
							<p class="descripcion">
								<?php echo get_the_excerpt();?>
							</p>
							<p class="disponible">
								<?php echo get_post_meta( get_the_ID(), '_quantity', true ); ?> <?php echo (qtranxf_getLanguage()=='es') ? 'disponibles.' : "avalaible"; ?>
							</p><br/>
							<a href="<?php echo get_home_url();?>/contacto/?producto=<?php echo get_the_ID();?>"><?php echo (qtranxf_getLanguage()=='es') ? 'contactar para comprar.' : "Contact to buy"; ?></a> 
						</div>
					</div>
				<?php
					endwhile;
				?>

		</div>
	</div>
</div>
<div class="tabs-producto">
	<div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <div class="sociales">
                    <h4><?php echo (qtranxf_getLanguage()=='es') ? 'Compartir este producto.' : "Share this"; ?></h4>
                    <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo get_the_permalink( ); ?>" onclick="window.open(this.href, this.target, 'width=500,height=300'); return false;" ><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a htarget="_blank" href="http://twitter.com/home?status=<?php echo get_the_title( ).'+'.get_the_permalink(); ?>" onclick="window.open(this.href, this.target, 'width=500,height=510'); return false;"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><?php echo (qtranxf_getLanguage()=='es') ? 'Detalles.' : "Details"; ?></a></li>
                </ul>
            </div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <?php the_content();?>
                    </div>
                </div>            
            </div>
        </div>
	</div>
</div>
<div class="sales">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="fancy"><?php echo (qtranxf_getLanguage()=='es') ? 'Productos <br><span>relacionados</span>' : "Related <br><span>products</span>"; ?></h3>
			</div>
		</div>
		<div class="row">
				<?php
                            $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 3,
                            'post__not_in' => array($id_prod), 
                            'tax_query' => array(
                                array(
                                'taxonomy' => 'product_category',
                                'field' => 'id',
                                'terms' => $taxonomia
                                )
                            )
                            );
                            $query = new WP_Query( $args ); 
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
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
                                    }
                                wp_reset_postdata();
                                } 
                            ?>

     	</div>
	</div>
</div>
<?php call_to_action(); ?>
<?php get_footer();?>