		<section class="entry-utility">
			<?php // if(function_exists('the_shortlink')) the_shortlink('shortlink'); ?>
			<div class="date">
				<?php tmpl::posted_on() ?>
			</div>
			<div class="taxonomy comments">
				<span class="cat-links">
					<span class="entry-utility-prep entry-utility-prep-cat-links" title="Posted in">
					<?php
						printf( __('Posted in %s', 'notey' ), '</span> '.get_the_category_list( ', ' ) );
					?>					
				</span>
				<span class="meta-sep">|</span>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<span class="entry-utility-prep entry-utility-prep-tag-links" title="Tagged"><?php printf( __('Tagged %s', 'notey'), '</span> ' . $tags_list ); ?>
					</span>
					<span class="meta-sep">|</span>
				<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link(
				__( 'Leave a comment', 'notey' ),
				__( '1 Comment', 'notey' ),
				__( '% Comments', 'notey' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'notey' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div>
		</section><!-- .entry-utility -->