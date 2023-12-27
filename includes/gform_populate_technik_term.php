<?php


// populate technik Term
add_filter( 'gform_field_value_edit_technik', 'edit_inserat_populate_technik_term', 10, 3 );

function edit_inserat_populate_technik_term( $value  ) {  

    global $post;
    /* get Terms */
    $insertion_technik_terms = get_the_terms($post->ID,'techniken');
    
    // loop through terms and put them comma seperated togeter
    $i = 0;
  
    if (isset($insertion_technik_terms) && !empty($insertion_technik_terms)):    
        foreach ($insertion_technik_terms as $insertion_technik_term):

             $i++;    
            // do not print a comma before the first value
            if ($i > 1):
                $insertion_technik_term_ids = $insertion_technik_term_ids . ', ' . $insertion_technik_term->term_id;
            else:
                $insertion_technik_term_ids = $insertion_technik_term->term_id;

            endif;

        endforeach;
    endif;    

    if (isset($insertion_technik_term_ids) && !empty($insertion_technik_term_ids)):  
        $values = array(
            'edit_technik'   => $insertion_technik_term_ids,
        );
        
        return $values;
    endif;    

} 


 

?>  

