<?php



// function to set Post Terms according to the values in gfroms. 
// Params: gravity forms Entry ID of Taxonomy, Taxonomy Name, Post Variable of the new Post
function custom_setPostTerms($gravityFormsEntryID, $taxonomy_to_update, $post_to_update ) {
      /*malgrund*/
    preg_match_all('!\d+\.*\d*!', $gravityFormsEntryID, $term_ids); 

   

    // get the term_ids from the entry field "Malgrund"
    if (isset($term_ids[0]) && !empty($term_ids[0])):
        
        foreach ($term_ids[0] as $term_id):
            //set post term by term id
            wp_set_post_terms( $post_to_update->ID, get_term_by('term_id',$term_id, $taxonomy_to_update )->name, $taxonomy_to_update, true);
        endforeach;
    endif; 

}


// function to delete Post Terms. This is needed, because only the new terms should be applied to the post. Old values can be deleted..
// Example: Malgrund alt = Holz, Malgrund neu =  Papier. Holz is no longer needed. Only papier is applied

function custom_deletePostTerms($post_to_update) {
  $taxonomiesToDelete = array('techniken', 
                        'formate',
                        'stueckelung',
                        'malgrund',
                        'stil'
                        );
    foreach($taxonomiesToDelete as $taxonomyToDelete):
        $termsToRemove = wp_get_post_terms($post_to_update->ID,$taxonomyToDelete);    
        $term_ids_remove = array();
        
        foreach ($termsToRemove as $termToRemove):
            array_push($term_ids_remove, $termToRemove->term_id);
        endforeach;   

        //remove all existing terms from the post
        wp_remove_object_terms( $post_to_update->ID, $term_ids_remove, $taxonomyToDelete );                

    endforeach; 
}


function custom_deletePostAttachement($post_to_update) {   
    
    // if the images of a post are beeing updated, the old images can be deleted.
    $args = array(
                'post_parent'    => $post_to_update->ID,
                'post_type'      => 'attachment',
                'numberposts'    => -1, // show all
                'post_status'    => 'any',
                'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC'
           );

    $attachements = get_posts($args);

    foreach($attachements as $attachement):
        // delete attachement of post with post type attachement.
        wp_delete_attachment($attachement->ID);
        wp_delete_post($attachement->ID);
    endforeach;
}
?>  

