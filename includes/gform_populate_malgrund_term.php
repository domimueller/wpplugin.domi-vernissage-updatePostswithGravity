<?php


// populate malgrund Term
add_filter( 'gform_field_value_edit_malgrund', 'edit_inserat_populate_malgrund_term', 10, 3 );

function edit_inserat_populate_malgrund_term( $value  ) {  

    global $post;
    /* get Terms */
    $insertion_malgrund_terms = get_the_terms($post->ID,'malgrund');
    
    // loop through terms and put them comma seperated togeter
    $i = 0;
  
    if (isset($insertion_malgrund_terms) && !empty($insertion_malgrund_terms)):   
        foreach ($insertion_malgrund_terms as $insertion_malgrund_term):

             $i++;    
            // do not print a comma before the first value
            if ($i > 1):
                $insertion_malgrund_term_ids = $insertion_malgrund_term_ids . ', ' . $insertion_malgrund_term->term_id;
            else:
                $insertion_malgrund_term_ids = $insertion_malgrund_term->term_id;

            endif;

        endforeach;
    endif;

    if (isset($insertion_malgrund_term_ids) && !empty($insertion_malgrund_term_ids)):
        $values = array(
            'edit_malgrund'   => $insertion_malgrund_term_ids,
        );
    
        return $values;
    endif;   
        } 

 

?>  

