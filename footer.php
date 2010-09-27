
<footer>

	<p class="wrap">
	&copy; Patrick Forringer - This blog is proudly powered by <a href="http://wordpress.org/">WordPress</a>
		<br /><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
		and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.
		<?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds.
	</p>
	
<?php wp_footer(); ?>

</footer>

</body>
</html>