<?php
$wclass = '';
if ( snsavaz_themeoption('blog_class') ) {
	$wclass = snsavaz_themeoption('blog_class');
}
$pagination = snsavaz_themeoption('pagination', 'def'); // get theme option
?>
<div id="snsmain" class="blog-layout2 posts sns-blog-posts <?php echo esc_attr($wclass);?>">
<?php 
// Theloop
while ( have_posts() ) : the_post();
    get_template_part( 'framework/tpl/posts/post2', get_post_format() );
endwhile;
// Paging
if( $pagination == 'def' || $pagination == '')
	get_template_part('tpl-paging');
?>
</div>
<?php
if( $pagination == 'ajax')
	snsavaz_paging_nav_ajax('#snsmain', 'framework/tpl/posts/post2' ); // This paging nav should be outside #snsmain div

echo '<input type="hidden" name="hidden_snsavaz_blog_layout" value="' . snsavaz_themeoption('blog_type') .  '">';