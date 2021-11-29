<div id="secondary">

<div id="sidebar-1" class="sidebar">

	<div id="rss-links">
		<p><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to this Feed via RSS">Subscribe to Feed</a></p>
	</div>
	
	<ul class="xoxo">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?><!--sidebar-1 widgets start-->
		
		<li id="recent-posts" class="widget">
			<h2><?php _e('Recent Posts'); ?></h2>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=10'); ?>
			</ul>
		</li>
		
		<li id="categories" class="widget">
			<h2><?php _e('Categories'); ?></h2>
			<ul>
				<?php wp_list_categories('title_li='); ?>
			</ul>
		</li>
	<?php endif; ?><!--sidebar-1 widgets end-->
	</ul>
</div><!--#sidebar-1-->

<div id="sidebar-2" class="sidebar">
	
	<div id="search">
			<?php include(TEMPLATEPATH . '/searchform.php'); ?>
	</div>
	
	<ul class="xoxo">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?><!--sidebar-2 widgets start-->
		
		<li id="pages" class="widget">
			<h2><?php _e('Pages') ?></h2>
			<ul>
			<?php wp_list_pages('title_li='); ?>
			</ul>
		</li>		
		
		<li id="archives" class="widget">
			<h2><?php _e('Archives'); ?></h2>
			<ul>
				<?php wp_get_archives(); ?>
			</ul>
		</li>
		<?php wp_list_bookmarks('class=widget'); ?>
		<li id="meta" class="widget">
			<h2><?php _e('Meta') ?></h2>
			<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
			</ul>
		</li>
	<?php endif; ?><!--sidebar-2 widgets end-->
	</ul>
</div><!--#sidebar-2-->
</div><!--#secondary-->