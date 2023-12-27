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

function custom_uploadPostThumbnail($gravityFormsEntry, $post_to_update, $entry) {
    
    /* #### Transform the image urls ### */
    // delete "[" and "]" that are no needed         
    $image_urls = substr($gravityFormsEntry, 2);
    $image_urls = substr($image_urls, 0, -2);

    // replace unnecassary characters
    $image_urls = str_replace('\\', '', $image_urls);
    $image_urls = str_replace('"', '', $image_urls);
    
    // build array
    $image_urls = explode(',', $image_urls); 
    
    $image_url   = $image_urls; 

    foreach ($image_urls as $image_url):
        $image = pathinfo($image_url);//Extracting information into array. 
        $image_name = $image['basename'];
        $unique_file_name = wp_unique_filename($image['basename'], $image_name);
        $filename = basename($unique_file_name);   
        
        $image_data = file_get_contents($image_url);
        $uploadsPath = GFFormsModel::get_file_upload_path( $entry['form_id'], $filename)['path'];

        // alternative way o determine path but without time information
        //$uploadsPath2 = GFFormsModel::get_upload_path( $entry['form_id']) . '/' . $filename;

        file_put_contents($uploadsPath, $image_data);   
        $wp_filetype = wp_check_filetype( $image_url, null );

        $attachment = [
            'post_mime_type' => $wp_filetype['type'],
            'post_parent'    => $post_to_update->ID,
            'post_title'     => sanitize_file_name(preg_replace( '/\.[^.]+$/', '', $filename )),
            'post_content'   => '',
            'post_status'    => 'inherit',
        ];

        $attachment_id = wp_insert_attachment( $attachment, $uploadsPath);
        require_once ABSPATH . 'wp-admin/includes/image.php';


        $attach_data = wp_generate_attachment_metadata($attachment_id, $uploadsPath);
        
        // Assign metadata to attachment
        wp_update_attachment_metadata($attachment_id, $attach_data);
    endforeach;        

    // set uploaded image as Beitragsbild. Only for beitragsbild, not for weitere Bilder.
    //$thumbnail = set_post_thumbnail($post_to_update, $attachment_id);




}
?>  

