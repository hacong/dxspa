<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		

	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="edd-image-wrap">
			<?php
				// check if the post has a Post Thumbnail assigned to it.
				if ( has_post_thumbnail() ) {
					//the_post_thumbnail();
				} 
			?>
		</div>

		<?php 			
			the_post_thumbnail('thumbnail');
			the_title('<h6>','</h6>');
			the_excerpt();
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->