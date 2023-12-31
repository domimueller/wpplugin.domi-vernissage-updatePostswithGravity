# Functionality
This Plugin allows to prefill gravity forms with post data and updates the values accordingly.

If in the Wordpress backend you select multiple values, but the template can only display one value (f.e. a dropdown), the filed will not be populated. example: you put multiple formats for an inserat in the vernissage backend 

# Plugin does not Provid Output
This plugin does not provide the output of the data. This must be done via template in theme.

# Implementation very strongly dependant on gravity forms configuration
the Plugin has two functions, that transform the output from gravity forms and generate paths to the image location. if the output of gravity form changes in future versions, this code probabbly has to be transformed as well.
custom_format_get_url_from_gform_entry()
custom_format_get_upload_path_from_gform_entry()

# Dependency to other Plugins
The Plugin wpplugin.domi-vernissage-createPostswithGravity has to be installed in order to perform this plugin.

# Known Tradeoffs
In Version 1, additional Images were Uploaded via PostMeta insertion_images.
In Verstion 2, additional Immages where uploaded as Post-Attachement. That allows better manaagement of the images via Media Gallery.

When additional Images are beeing changed, the old  Images are being deleted and only the newly Images are visible. But this only counts for Post attachements. Additional Images uploaded in Version 1 are still visible.

# Configuration Possibilities (Staging)
The Gform Mapping can be done for both Test- and Produktivumgebung. 
- gformMappingProduktivumgebung.php
- gformMappingTestumgebung.php
