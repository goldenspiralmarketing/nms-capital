<?php
remove_action('wp_head', 'index_rel_link'); // Index link                   /** DEPRECATED **/
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link       /** DEPRECATED **/
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link       /** DEPRECATED **/
?>
