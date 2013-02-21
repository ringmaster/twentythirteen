	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="assistive-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<div class="nav-previous"><?php echo $theme->next_page_link( _t( "<span class='meta-nav'>&larr;</span> Older posts", 'twentythirteen' ) ); ?></div>

			<div class="nav-next"><?php echo $theme->prev_page_link( _t( "Newer posts <span class='meta-nav'>&rarr;</span>", 'twentythirteen' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
