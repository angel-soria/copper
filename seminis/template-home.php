<?php
/*
Template Name: Home
*/
?>
<?php get_header();?>

<div class="home-slider">
    <?php 
            $option = array();
            $lastposts = get_posts( array(
                'posts_per_page' => 5,
                'post_type' => 'slider',

            ) );
            if ( $lastposts ) {
                foreach ( $lastposts as $post ) : 
                    if ( has_post_thumbnail() ) :
                        $img_full = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');                     
                    endif;
            ?>
                <div class="slide-div" style="background: url('<?php echo $img_full[0]; ?>') no-repeat; ">
                    <div class="contenido-slide">
                        <p><?php echo get_the_excerpt(); ?></p>
                        <h2><?php echo get_the_title(); ?></h2>
                        <a href="<?php echo get_post_meta( get_the_ID(), '_link_', true ); ?>"><?php echo get_post_meta( get_the_ID(), '_text_button_'.qtranxf_getLanguage(), true ); ?></a>            
                    </div>
                </div>

            <?php 
                endforeach; 
                wp_reset_postdata();
            }
        ?>
</div>

<div class="mini-about">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/copper-logo-content.png" alt="Copper">
				</h1>	
				<div class="contenido">
                <?php
                    while ( have_posts() ) : the_post();
                    the_content();
                    endwhile;
				?>
				</div>	
			</div>
		</div>
		<?php 
            $myterms = get_terms( array( 'taxonomy' => 'product_category', 'parent' => 0, 'hide_empty' => 0, 'orderby'    => 'id', ) );
            banners_categories($myterms);
        ?>
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs">
                    <?php $i=0; foreach ( $myterms as $term ) { ?>
                        <li class="<?php echo ($i == 0 ) ? 'active' : ''; ?>"><a data-toggle="tab" href="#seccion<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
                    <?php $i++; } ?>

				 </ul>
			</div>
		</div>
	</div>
</div>
<div class="gray-zone">
	<div class="container">
		  <div class="tab-content">
             <?php $i=0; foreach ( $myterms as $term ) { ?>
                <div id="seccion<?php echo $term->term_id; ?>" class="tab-pane fade in <?php echo ($i == 0 ) ? 'active' : ''; ?>">
                    <div class="row">
                        <?php
                            $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 3,
                            'tax_query' => array(
                                array(
                                'taxonomy' => 'product_category',
                                'field' => 'id',
                                'terms' => $term->term_id
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
            <?php $i++; } ?>
		  </div>
	</div>
</div>
<div class="sales">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="fancy"><?php echo get_option( 'aux_two_'.qtranxf_getLanguage() ); ?></h3>
			</div>
		</div>
		<div class="row">
            <?php
                $ofertas = unserialize(get_option( 'ofertas' ));
                foreach($ofertas as $oferta){
             ?>
                    <div class="col-xs-6 col-sm-3">
                        <a href="<?php echo get_the_title( $oferta ); ?>" class="content-product">
                            <div class="producto-white">
                                <div class="cabezal line">
                                    <?php 
                                        if ( has_post_thumbnail($oferta) ) {
                                            echo get_the_post_thumbnail( $oferta, '263x292', array( 'class' => 'img-responsive' ) );
                                        }
                                    ?>
                                    <div class="icon">
                                        <i class="copp-eye"></i>
                                        <p><?php echo get_option( 'aux_three_'.qtranxf_getLanguage() ); ?></p>
                                    </div>
                                </div>
                                <div class="pie-producto">
                                    <h4><?php echo get_the_title($oferta ); ?></h4>
                                    <p><?php echo get_post_meta( $oferta, '_price_'.qtranxf_getLanguage(), true ); ?></p>
                                    <span><?php echo get_option( 'aux_four_'.qtranxf_getLanguage() ); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php 
                }
            ?>

     	</div>
	</div>
</div>
<?php get_footer(); ?>