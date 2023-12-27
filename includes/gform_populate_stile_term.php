<?php


// populate Stile Term
add_filter( 'gform_field_value_edit_stil', 'edit_inserat_populate_stile_term', 10, 3 );

function edit_inserat_populate_stile_term( $value  ) {  

    global $post;
    /* get Terms */
    $insertion_stile_terms = get_the_terms($post->ID,'stil');
    
    
    // loop through terms and put them comma seperated togeter
    $i = 0;
    
    if (isset($insertion_stile_terms) && !empty($insertion_stile_terms)):    
        foreach ($insertion_stile_terms as $insertion_stile_term):

             $i++;    
            // do not print a comma before the first value
            if ($i > 1):
                $insertion_stile_term_ids = $insertion_stile_term_ids . ', ' . $insertion_stile_term->term_id;
            else:
                $insertion_stile_term_ids = $insertion_stile_term->term_id;

            endif;

        endforeach; 
    endif;    


    if (isset($insertion_stile_term_ids) && !empty($insertion_stile_term_ids)): 
        $values = array(
            'edit_stil'   => $insertion_stile_term_ids,
        );
    
        return $values;
    endif;    
} 

 

?>  

