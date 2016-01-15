<?php if( !defined('ABSPATH') ) exit;?>
<form role="form" class="form-inline" method="get" action="<?php print home_url();?>" class="sidebar-search">
	<div class="form-group has-feedback">
		<input value="<?php print get_search_query();?>" name="s" type="text" placeholder="<?php _e('Rechercher...','mars')?>" id="search" class="form-control">
		<span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
	</div>
</form>

