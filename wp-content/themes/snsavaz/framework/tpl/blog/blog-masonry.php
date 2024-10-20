<?php
wp_enqueue_script('masonry');
wp_enqueue_script('imagesloaded');
$wclass = '';
if ( snsavaz_themeoption('blog_class') ) {
	$wclass = snsavaz_themeoption('blog_class');
}
$pagination = snsavaz_themeoption('pagination', 'def'); // get theme option
?>
<div class="sns-grid posts sns-blog-posts sns-blog-masonry <?php echo esc_attr($wclass);?>">
	<div id="snsmain" class="sns-grid-masonry">
		<?php 
		while ( have_posts() ) : the_post();
		?>
			<?php get_template_part( 'framework/tpl/posts/post-masonry', get_post_format() )?>
		<?php
		endwhile;
		?>
	</div>
	<?php
	// Paging
	if( $pagination == 'def')
		get_template_part('tpl-paging');
	?>
</div>
<?php
if( $pagination == 'ajax')
	snsavaz_paging_nav_ajax('#snsmain', 'framework/tpl/posts/post-masonry' ); // This paging nav should be outside #snsmain div

echo '<input type="hidden" name="hidden_snsavaz_blog_layout" value="' . snsavaz_themeoption('blog_type') .  '">';