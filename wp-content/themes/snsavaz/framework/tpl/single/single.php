<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Post Quote
    if ( get_post_format() == 'quote' && function_exists('rwmb_meta') && rwmb_meta('snsavaz_post_quotecontent') && rwmb_meta('snsavaz_post_quoteauthor') ) :
        $uq  = rand().time();
        ?>
        <div class="quote-info quote-info-<?php echo $uq; ?> post-thumb">
            <?php if ( rwmb_meta('snsavaz_post_quotecontent') ) : ?>
            <div class="quote-content gfont"><?php echo esc_html(rwmb_meta('snsavaz_post_quotecontent')); ?></div>
            <?php endif; ?>
             <?php if ( rwmb_meta('snsavaz_post_quoteauthor') ) : ?>
            <div class="quote-author"><?php echo esc_html(rwmb_meta('snsavaz_post_quoteauthor')); ?></div>
            <?php endif; ?>
        </div>
        <style scoped>
            .quote-info-<?php echo $uq; ?>{
                <?php if(rwmb_meta('snsavaz_post_quote_bg')) : ?>
                background: <?php echo esc_attr(rwmb_meta('snsavaz_post_quote_bg')); ?>;
                <?php endif; ?>
                <?php if(rwmb_meta('snsavaz_post_quote_color')) : ?>
                color: <?php echo esc_attr(rwmb_meta('snsavaz_post_quote_color')); ?>;
                <?php endif; ?>
            }
        </style>
    <?php
    // Post Link
    elseif ( get_post_format() == 'link' && function_exists('rwmb_meta') && rwmb_meta('snsavaz_post_linkurl') ) : ?>
        <div class="link-info post-thumb">
            <a class="gfont" title="<?php echo esc_attr(rwmb_meta('snsavaz_post_linktitle')) ?>" href="<?php echo esc_url( rwmb_meta('snsavaz_post_linkurl') ) ?>"><?php echo esc_html(rwmb_meta('snsavaz_post_linktitle')) ?></a>
        </div>
    <?php
    // Post Video
    elseif ( function_exists('rwmb_meta') && rwmb_meta('snsavaz_post_video') ) : ?>
        <div class="video-thumb video-responsive">
            <?php
            echo rwmb_meta('snsavaz_post_video');
            //echo wp_oembed_get(esc_attr(rwmb_meta('snsavaz_post_video')));
            ?>
        </div>
    <?php
    // Post Gallery
    elseif ( function_exists('rwmb_meta') && rwmb_meta('snsavaz_post_gallery') ) :
        wp_enqueue_script('owlcarousel');
    ?>
        <div class="gallery-thumb">
            <div class="navslider"><span class="prev"><i class="fa fa-angle-left"></i></span><span class="next"><i class="fa fa-angle-right"></i></span></div>
            <div class="thumb-container">
            <?php
            foreach (rwmb_meta('snsavaz_post_gallery', 'type=image') as $image) {?>
               <div class="item"><img alt="<?php echo esc_attr($image['alt']); ?>" src="<?php echo esc_attr($image['full_url']); ?>"/></div>
            <?php
            }
            ?>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#post-<?php the_ID() ?> .thumb-container').owlCarousel({
                    items: 1,
                    loop:true,
                    dots: false,
                    // animateOut: 'flipInY',
                    //animateIn: 'pulse',
                    //autoplay: true,
                    autoHeight: true,
                    onInitialized: callback,
                    slideSpeed : 800
                });
                function callback(event) {
                    if(this._items.length > this.options.items){
                        jQuery('#post-<?php the_ID() ?> .navslider').show();
                    }else{
                        jQuery('#post-<?php the_ID() ?> .navslider').hide();
                    }
                }
                jQuery('#post-<?php the_ID() ?> .navslider .prev').on('click', function(e){
                    e.preventDefault();
                    jQuery('#post-<?php the_ID() ?> .thumb-container').trigger('prev.owl.carousel');
                });
                jQuery('#post-<?php the_ID() ?> .navslider .next').on('click', function(e){
                    e.preventDefault();
                    jQuery('#post-<?php the_ID() ?> .thumb-container').trigger('next.owl.carousel');
                });
            });
        </script>
    <?php
    // Post Image
    elseif ( has_post_thumbnail() ) : ?>
        <div class="post-thumb">
            <?php
           the_post_thumbnail();
            ?>
        </div>
    <?php
    endif;?>
    
    <div class="post-content">
	    <?php if( get_the_category_list() ):?>
	    <div class="post-cats">
	        <span class="cat-links"><i class="fa fa-folder-o"></i><?php echo get_the_category_list(', '); ?></span>
	    </div>
	    <?php endif;?>
	    
	    <h1 class="page-header">
	        <?php the_title(); ?>
	    </h1>
	
	    <div class="single-post-date">
	        <span class="date-post"><?php the_time('F jS, Y'); ?></span>
	        <?php
	        // Edit link
	        edit_post_link(esc_html__('Edit','snsavaz'), '<span class="edit-post"><i class="fa fa-edit"></i> ', '</span>'); ?>
	    </div>
	
	    <div class="content">
	        <?php 
	        the_content();
	        // Post Paging
	        wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'snsavaz' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 
	        ?>
	    </div>
	    <div class="post-meta">
	    	<?php
	        // List tags
	        $tag_list = get_the_tag_list( '', esc_html__( ', ', 'snsavaz' ) );
	        if ( $tag_list ):?>
	        <div class="post-tag-list">
	            <?php esc_html_e( 'Tags:', 'snsavaz' );?>
	            <span class="tags-links"><?php echo $tag_list; ?></span>
	        </div>
	        <?php
	        endif;
	        ?>
	        
	        <?php
	        if ( snsavaz_themeoption('show_postsharebox') ) : ?>
	        <div class="post-share-block">
	            <?php  snsavaz_sharebox(); ?>
	        </div>
	        <?php
	        endif;
	        ?>
	    </div>
	</div><!-- /.post-content -->
    
    <?php
    // Author bio
    if ( snsavaz_themeoption('show_postauthor') ) :
        get_template_part( 'author-bio' );
    endif;
    // Related post
    if ( snsavaz_themeoption('enalble_related', false) ) :
    ?>
    <div class="post-related">
        <?php
            snsavaz_relatedpost();
        ?>
    </div>
    <?php
    endif;
    ?>
    <?php
    // post navigation.
      snsavaz_post_nav();
    ?>
    
    <?php 
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
    comments_template();
    endif;
    ?>
</article>