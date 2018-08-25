<?php

/*
 * Template for displaying search form
 */
?>
<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
    <div class="input-group search">
        <input type="text" class="form-control" name="q" placeholder="<?php echo esc_attr__('Search for...', 'lifestone'); ?>">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search" id="search-submit"></i></button>
        </span>
    </div>
</form>