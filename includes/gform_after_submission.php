<?php

$configuration_data = set_gform_Configuration_update ();

add_action( 'gform_after_submission_' . $configuration_data['INSERAT_BEARBEITEN_FORM_ID'], 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {


    global $post;
    

    // get data from gravity forms    
    $configuration_data = set_gform_Configuration_update();
    $new_post = get_post($post->id);

    
    /* #### Postmeta ### */
    if(isset($entry[$configuration_data['insertion_description']]) && !empty($entry[$configuration_data['insertion_description']])):
        update_post_meta( $new_post->ID, 'insertion_description', $entry[$configuration_data['insertion_description']] );
    endif; 

    if(isset($entry[$configuration_data['insertion_dominante_farbe']]) && !empty($entry[$configuration_data['insertion_dominante_farbe']])):
        update_post_meta( $new_post->ID, 'insertion_color', $entry[$configuration_data['insertion_dominante_farbe']] );
    endif;   

    if(isset($entry[$configuration_data['insertion_begleit_farbe']]) && !empty($entry[$configuration_data['insertion_begleit_farbe']])):
     update_post_meta( $new_post->ID, 'insertion_secondary_color', $entry[$configuration_data['insertion_begleit_farbe']]   );
    endif;   

    if(isset($entry[$configuration_data['insertion_price']]) && !empty($entry[$configuration_data['insertion_price']])):
     update_post_meta( $new_post->ID, 'insertion_price', $entry[$configuration_data['insertion_price']] );
    endif;   

    if(isset($entry[$configuration_data['insertion_breite']] ) && !empty($entry[$configuration_data['insertion_breite']] )):
     update_post_meta( $new_post->ID, 'insertion_width', $entry[$configuration_data['insertion_breite']] );
    endif;   

    if(isset($entry[$configuration_data['insertion_hoehe']]) && !empty($entry[$configuration_data['insertion_hoehe']])):
        update_post_meta( $new_post->ID, 'insertion_height', $entry[$configuration_data['insertion_hoehe']] );  
    endif;   

    if(isset($entry[$configuration_data['insertion_logistics']]) && !empty($entry[$configuration_data['insertion_logistics']])):
    update_post_meta( $new_post->ID, 'insertion_logistics', $entry[$configuration_data['insertion_logistics']] );  
    endif;   


          
    
    /* #### Terms ### */
    
    // delete terms from post (the post should only have the new terms after form submission, the old terms are not required anymore, thats why we delete them)
    custom_deletePostTerms($new_post);

    // add terms
    if(isset($entry[$configuration_data['insertion_malgrund']]) && !empty($entry[$configuration_data['insertion_malgrund']])):
        custom_setPostTerms($entry[$configuration_data['insertion_malgrund']], 'malgrund', $new_post);    
    endif;   

    if(isset($entry[$configuration_data['insertion_techniken']]) && !empty($entry[$configuration_data['insertion_techniken']])):
        custom_setPostTerms($entry[$configuration_data['insertion_techniken']], 'techniken', $new_post);    
    endif;   

    if(isset($entry[$configuration_data['insertion_formate']]) && !empty($entry[$configuration_data['insertion_formate']])):
        custom_setPostTerms($entry[$configuration_data['insertion_formate']], 'formate', $new_post);    
    endif;   

    if(isset($entry[$configuration_data['insertion_stil']]) && !empty($entry[$configuration_data['insertion_stil']])):
        custom_setPostTerms($entry[$configuration_data['insertion_stil']], 'stil', $new_post);
    endif;   

    if(isset($entry[$configuration_data['insertion_stueckelung']]) && !empty($entry[$configuration_data['insertion_stueckelung']])):
        custom_setPostTerms($entry[$configuration_data['insertion_stueckelung']], 'stueckelung', $new_post);
    endif;   

   
    
    
    
    
    


    
    /* #### Post Title ### */    

    if(isset($entry[$configuration_data['insertion_title']]) && !empty($entry[$configuration_data['insertion_title']])):
        $new_post->post_title = $entry[$configuration_data['insertion_title']];
        $new_post->post_name = $entry[$configuration_data['insertion_title']];
    endif;   



    


    /* #### Images ### */        
    if(isset($entry[$configuration_data['insertion_moreImages']]) && !empty($entry[$configuration_data['insertion_moreImages']])):
       $entry_more_images =  $entry[$configuration_data['insertion_moreImages']];
    endif;      

    if(isset($entry[$configuration_data['insertion_titelbild']]) && !empty($entry[$configuration_data['insertion_titelbild']])):
        $entry_titelbild =  $entry[$configuration_data['insertion_titelbild']];
    endif;      
    
    
    // only update image data if user uploads new images
    if (isset($entry[$configuration_data['decision_newImages']]) && !empty($entry[$configuration_data['decision_newImages']])):

        if ($entry[$configuration_data['decision_newImages']] == 'ja'):
        // delete the Post Attachements, if Images are beeing new set by the user
            custom_deletePostAttachement($new_post);

            /* Call the function from wpplugin.domi-vernissage-createPostswithGravity */
            // the fourth parameter is to define wheter the image should be set as titelbild
            
            if(isset($entry_titelbild) && !empty($entry_titelbild)):
                custom_create_Post_attachment($entry_titelbild, $new_post, $entry, true);
            endif;   
            
            if(isset($entry_more_images) && !empty($entry_more_images)):
                custom_create_Post_attachment($entry_more_images, $new_post, $entry, false);
            endif;               
            
        endif;    
    endif;        

    /* #### Post Status ### */    
    $new_post->post_status = $configuration_data['INSERATE_AFTER_BEARBEITEN_STATUS'];

    /* #### Post Time modified ### */        
    $new_post->post_modified = $entry[$configuration_data['insertion_updateDateTime']];
    $new_post->post_modified_gmt = get_gmt_from_date( $entry[$configuration_data['insertion_updateDateTime']]);   


    wp_update_post( $new_post, true );

 
}
?>  
