<div class="container blog-header">
	<div class="row">
		<div class="pull-left">
			<h1><a href="<?php echo \Jade\Config::get('site.siteRoot'); ?>"><?php echo \Jade\Config::get('site.name'); ?></a></h1>
		</div>
		<div class="pull-right">
			<blockquote>
				<?php echo \Jade\Config::get('site.tagLine'); ?>
			</blockquote>
		</div>
	</div>
	<div class="row blog-header-background">
	</div>
	<div class="row blog-navigation">
			<div class="navbar">
				<div class="navbar-inner">
					<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse navbar-responsive-collapse collapse" style="height: 0px;">
						<?php

							$menu = new \Bootstrap\MenuControl('');
							$menu->remove('posts');
							$menu->remove('0');
                        $menu->remove('1');

                        $menu->reverse();
							$menu->display();
						?>
					</div><!-- /.nav-collapse -->
				</div><!-- /navbar-inner -->
			</div>
		</div>
</div>