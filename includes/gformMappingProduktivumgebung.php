<?php

    /* Configuration*/


function custom_update_gform_Mapping_Produktivumgebung(){

    $configuration_data = array();

    // From ID of Inserat bearbeiten
    $configuration_data['INSERAT_BEARBEITEN_FORM_ID'] = 8;
    $configuration_data['INSERATE_ERFASSEN_FORM_ID'] = 1;
    $configuration_data['insertion_sold_status'] = 3;
    
    
    //Map gfrom entry IDs to Variable Names
    $configuration_data['insertion_title'] = 75;
    $configuration_data['insertion_updateDateTime'] = 'date_updated';
    $configuration_data['insertion_description'] = 76;
    $configuration_data['insertion_dominante_farbe'] = 51;    
    $configuration_data['insertion_begleit_farbe'] = 65;
    $configuration_data['insertion_breite'] = 40;
    $configuration_data['insertion_hoehe'] = 39;
    $configuration_data['insertion_logistics'] = 55;    
    $configuration_data['insertion_price'] = 38;    
    $configuration_data['insertion_titelbild'] = 78;
    $configuration_data['insertion_moreImages'] = 80;
    $configuration_data['decision_newImages'] = 79;


    $configuration_data['insertion_malgrund'] = 58;
    $configuration_data['insertion_techniken'] =63;
    $configuration_data['insertion_formate'] = 62;
    $configuration_data['insertion_stil'] = 64;
    $configuration_data['insertion_stueckelung'] = 53;
    $configuration_data['insertion_sold_status'] = 3;

return $configuration_data;
}
?>  

