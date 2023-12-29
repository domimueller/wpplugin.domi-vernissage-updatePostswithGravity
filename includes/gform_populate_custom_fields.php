<?php



// populate Custom Fields (withour terms)
add_filter( 'gform_field_value', 'edit_inserat_populate_fields', 10, 3 );
function edit_inserat_populate_fields( $value, $field, $name  ) {
    global $post;

    /* get Postmeta */
    $post_meta = get_post_meta($post->ID);
    $insertion_desc = $post_meta['insertion_description'][0];
    $insertion_color = $post_meta['insertion_color'][0];
    $insertion_secondary_color = $post_meta['insertion_secondary_color'][0];
    $insertion_width = $post_meta['insertion_width'][0];
    $insertion_height = $post_meta['insertion_height'][0];
    $insertion_logistics = $post_meta['insertion_logistics'][0];
    $insertion_price = $post_meta['insertion_price'][0];


    


    $values = array(
        'edit_inserattitel'   => $post->post_title,
        'edit_inseratbeschreibung'   => $insertion_desc,
        'edit_format' => 'value three',
        'edit_technik'   => 'value one',
        'edit_malgrund' => 'value three',
        'edit_dominanteFarbe'   => $insertion_color,
        'edit_begleitFarbe' => $insertion_secondary_color,
        'edit_breite'   => $insertion_width,
        'edit_hoehe'   => $insertion_height,
        'edit_logistik' => $insertion_logistics,
        'edit_mehrteilig'   => 'value two',
        'edit_price' => $insertion_price,
        'edit_additional_Images'   => 'value one',
    );
 
    return isset( $values[ $name ] ) ? $values[ $name ] : $value;}
 

?>  

