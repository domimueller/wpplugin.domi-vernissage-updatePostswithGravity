<?php



add_action( 'gform_after_submission_4', 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {
 
    global $post;
    

    // get data from gravity forms    
    $configuration_data = set_gform_Configuration($entry);
    $new_post = get_post($post->id);

    
    /* #### Postmeta ### */
    update_post_meta( $new_post->ID, 'insertion_description', $configuration_data['insertion_description'] );
    update_post_meta( $new_post->ID, 'insertion_color', $configuration_data['insertion_dominante_farbe'] );
    update_post_meta( $new_post->ID, 'insertion_secondary_color', $configuration_data['insertion_begleit_farbe']   );
    update_post_meta( $new_post->ID, 'insertion_price', $configuration_data['insertion_price'] );
    update_post_meta( $new_post->ID, 'insertion_width', $configuration_data['insertion_breite'] );
    update_post_meta( $new_post->ID, 'insertion_height', $configuration_data['insertion_hoehe'] );
    update_post_meta( $new_post->ID, 'insertion_sold', 'verkauft' );    
    update_post_meta( $new_post->ID, 'insertion_logistics', $configuration_data['insertion_logistics'] );
          
    
    /* #### Terms ### */
    
    // delete terms from post (the post should only have the new terms after form submission, the old terms are not required anymore, thats why we delete them)
    custom_deletePostTerms($new_post);

    // add terms
    custom_setPostTerms($configuration_data['insertion_malgrund'], 'malgrund', $new_post);
    custom_setPostTerms($configuration_data['insertion_techniken'], 'techniken', $new_post);
    custom_setPostTerms($configuration_data['insertion_formate'], 'formate', $new_post);
    custom_setPostTerms($configuration_data['insertion_stil'], 'stil', $new_post);
    custom_setPostTerms($configuration_data['insertion_stueckelung'], 'stueckelung', $new_post);


    
    /* #### Post Title ### */    
    $new_post->post_title = $configuration_data['insertion_title'];
    $new_post->post_name = $configuration_data['insertion_title'];

    /* #### Images ### */        
    $entry_more_images =  $configuration_data['insertion_moreImages'];
    $entry_titelbild =  $configuration_data['insertion_titelbild'];
    
    // delete the Post Attachements, if Images are beeing new set by the user
    custom_deletePostAttachement($new_post);

    /* Call the function from wpplugin.domi-vernissage-createPostswithGravity */
    // the fourth parameter is to define wheter the image should be set as titelbild
    custom_create_Post_attachment($entry_titelbild, $new_post, $entry, true);
    custom_create_Post_attachment($entry_more_images, $new_post, $entry, false);    

    /* #### Post Status ### */    
    $new_post->post_status = $configuration_data['INSERATE_AFTER_BEARBEITEN_STATUS'];

    /* #### Post Time modified ### */        
    $new_post->post_modified = $configuration_data['insertion_updateDateTime'];
    $new_post->post_modified_gmt = get_gmt_from_date( $configuration_data['insertion_updateDateTime']);   

    wp_update_post( $new_post, true );

 
}
?>  
