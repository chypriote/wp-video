<?php if( !defined('ABSPATH') ) exit;?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title(''); ?></title>
	<!--[if lt IE 9]>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
	  <script src="<?php print get_template_directory_uri();?>/assets/js/ie8/html5shiv.js"></script>
      <script src="<?php print get_template_directory_uri();?>/assets/js/ie8/respond.min.js"></script>
	<![endif]-->
	<?php wp_head();?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>
<body <?php body_class();?>>
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-sm-3" id="logo">
					<a title="<?php bloginfo('description');?>" href="<?php print home_url();?>">
						<?php
							global $videotube;
							$logo_image = isset( $videotube['logo']['url'] ) ? $videotube['logo']['url'] : get_template_directory_uri() . '/img/logo.png';
						?>
						<img src="<?php print $logo_image; ?>" alt="<?php bloginfo('description');?>" />
					</a>
				</div>
				<form method="get" action="<?php print home_url();?>">
					<div class="col-sm-6" id="header-search">
						<span class="glyphicon glyphicon-search search-icon"></span>
						<input value="<?php print get_search_query();?>" name="s" type="text" placeholder="<?php _e('Search here...','mars')?>" id="search">
					</div>
				</form>
				<div class="col-sm-3" id="header-social">
					<?php
						global $videotube;
						$social_array = mars_socials_url();
						if( is_array( $social_array ) ){
							foreach ( $social_array as $key=>$value ){
								if( !empty( $videotube[$key] ) ){
									print '<a href="'.$videotube[$key].'"><i class="fa fa-'.$key.'"></i></a>';
								}
							}
						}
					?>
					<a href="<?php bloginfo('rss_url');?>"><i class="fa fa-rss"></i></a>
				</div>
			</div>
		</div>
	</div><!-- /#header -->
	<div id="navigation-wrapper">
		<div class="container">
			<div class="navbar-header">
			  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
					<?php
						$menu = get_terms('categories');
						foreach ($menu as $value) {
							if ($value->parent == 0) {
								$final[$value->term_id]['name'] = $value->name;
								$final[$value->term_id]['slug'] = $value->slug;
							} else {
								$temp[] = $value;
							}
						}
						foreach ($temp as $value) {
							if ($final[$value->parent]) {
								$final[$value->parent]['childs'][$value->term_id]['name'] = $value->name;
								$final[$value->parent]['childs'][$value->term_id]['slug'] = $value->slug;
							}
							else
								$temp2[] = $value;
						}
						$final = array_reverse($final);
					?>
					<ul id="menu-all-pages" class="nav navbar-nav list-inline menu">
						<li><a href="<?php print home_url();?>"><?php _e('Accueil','mars')?></a></li>
						<?php foreach ($final as $item) {
							if (count($item['childs'])) {$dpdwn = true;}
							echo '<li class="menu-item menu-item-type-custom menu-item-object-custom ' . ($dpdwn ? 'dropdown menu-item-has-children': ''). '">';
							echo '<a href="/categories/'. $item['slug'] . '">' . $item['name'];
							echo $dpdwn ? ' <b class="caret"></b></a>' : '</a>';
							if ($dpdwn) {
								echo '<ul class="dropdown-menu">';
								foreach ($item['childs'] as $child) {
									echo '<li class="menu-item menu-item-type-custom menu-item-object-custom depth">';
									echo '<a href="/categories/'. $child['slug'] . '">' . $child['name'] . '</a>';
									echo '<li>';
								}
								echo '</ul>';
							}
							echo '</li>';
						} ?>
					</ul>
			</nav>
		</div>
	</div><!-- /#navigation-wrapper -->
