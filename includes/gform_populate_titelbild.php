<?php




add_filter( 'gform_field_value_edit_titelbild', 'edit_inserat_populate_titelbild');
function edit_inserat_populate_titelbild( $value) {
    global $post;


    $titelbild = get_the_post_thumbnail_url($post->id, 'medium');

    return $titelbild;
  }
 

?>  

