<?php


// populate stueckelung Term
add_filter( 'gform_field_value_edit_stueckelung', 'edit_inserat_populate_stueckelung_term', 10, 3 );

function edit_inserat_populate_stueckelung_term( $value  ) {  

    global $post;
    /* get Terms */
    $insertion_stueckelung_terms = get_the_terms($post->ID,'stueckelung');
    
    // loop through terms and put them comma seperated togeter
    $i = 0;
 
    if (isset($insertion_stueckelung_terms) && !empty($insertion_stueckelung_terms)):    
        foreach ($insertion_stueckelung_terms as $insertion_stueckelung_term):

             $i++;    
            // do not print a comma before the first value
            if ($i > 1):
                $insertion_stueckelung_term_ids = $insertion_stueckelung_term_ids . ', ' . $insertion_stueckelung_term->term_id;
            else:
                $insertion_stueckelung_term_ids = $insertion_stueckelung_term->term_id;

            endif;

        endforeach;
    endif;    
    
    if (isset($insertion_stueckelung_term_ids) && !empty($insertion_stueckelung_term_ids)):    

        $values = array(
            'edit_mehrteilig'   => $insertion_stueckelung_term_ids,
        );
        
        return $values;
    endif;    
} 

 

?>  

