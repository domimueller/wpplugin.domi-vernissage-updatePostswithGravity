<?php
// populate format Term
add_filter( 'gform_field_value_edit_format', 'edit_inserat_populate_format_term', 10, 3 );

function edit_inserat_populate_format_term( $value  ) {  

    global $post;
    /* get Terms */
    $insertion_format_terms = get_the_terms($post->ID,'formate');


    // loop through terms and put them comma seperated togeter
    $i = 0;
    if (isset($insertion_format_terms) && !empty($insertion_format_terms)):   
        foreach ($insertion_format_terms as $insertion_format_term):

             $i++;    
            // do not print a comma before the first value
            if ($i > 1):
                $insertion_format_term_ids = $insertion_format_term_ids . ', ' . $insertion_format_term->term_id;
            else:
                $insertion_format_term_ids = $insertion_format_term->term_id;

            endif;

        endforeach;
    endif;

    if (isset($insertion_format_term_ids) && !empty($insertion_format_term_ids)):   
        $values = array(
            'edit_format'   => $insertion_format_term_ids,
        );
    
        return $values;
    endif;
}     

 

?>  

