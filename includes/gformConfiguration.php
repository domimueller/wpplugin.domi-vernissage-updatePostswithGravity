<?php

    /* Configuration*/


function set_gform_Configuration($entry){
  
    $configuration_data = array();

    // From ID of Inserat bearbeiten
    $configuration_data['INSERAT_BEARBEITEN_FORM_ID'] = 4;

    /* GLOBAL VARIABLES */
    $configuration_data['INSERATE_ERFASSEN_FORM_ID'] = 1;
    $configuration_data['INSERATE_AFTER_BEARBEITEN_STATUS'] = 'DRAFT';

    //Map gfrom entry IDs to Variable Names
    $configuration_data['insertion_title'] = $entry[75];
    $configuration_data['insertion_updateDateTime'] = $entry['date_updated'];
    $configuration_data['insertion_description'] = $entry[76];
    $configuration_data['insertion_dominante_farbe'] = $entry[51];    
    $configuration_data['insertion_begleit_farbe'] = $entry[65];
    $configuration_data['insertion_breite'] = $entry[40];
    $configuration_data['insertion_hoehe'] = $entry[39];
    $configuration_data['insertion_logistics'] = $entry[55];    
    $configuration_data['insertion_price'] = $entry[38];    
    $configuration_data['insertion_titelbild'] = $entry[78];
    $configuration_data['insertion_moreImages'] = $entry[80];


    $configuration_data['insertion_malgrund'] = $entry[58];
    $configuration_data['insertion_techniken'] =$entry[63];
    $configuration_data['insertion_formate'] = $entry[62];
    $configuration_data['insertion_stil'] = $entry[64];
    $configuration_data['insertion_stueckelung'] = $entry[53];

return $configuration_data;
}
?>  

