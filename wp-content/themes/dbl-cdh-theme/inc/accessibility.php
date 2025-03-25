<?php
function dbl_cdh_skip_link() {
    echo '<a class="skip-link screen-reader-text" href="#primary">' . esc_html__('Zum Inhalt springen', 'cdh') . '</a>';
}
add_action('wp_body_open', 'dbl_cdh_skip_link');
