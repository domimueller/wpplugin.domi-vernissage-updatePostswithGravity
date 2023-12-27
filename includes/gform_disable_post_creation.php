<?php

add_filter( 'gform_disable_post_creation_4', 'disable_post_creation', 10, 3 );

function disable_post_creation( $is_disabled, $form, $entry ) {
    return true;
}  
?>  

