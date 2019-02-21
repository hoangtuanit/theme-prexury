<?php

/*
* Change text thanks in wp admin - footer
* @author hoangtuan
* @date: 24/05/2018
* @bugs: no
*/

function ht_change_footer_admin () 
{
    echo '<span id="footer-thankyou"> Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi </span>';
}
 
add_filter('admin_footer_text', 'ht_change_footer_admin');

/*
* Redirect after login with role = administrator
* @author hoangtuan
* @date: 24/05/2018
* @bugs: no
*/

// add_action('wp_login', 'new_dashboard_home', 10, 2);

function new_dashboard_home($username, $user){
    if(array_key_exists('administrator', $user->caps)){
        wp_redirect(admin_url('admin.php?page=wps_overview_page', 'http'), 301);
        exit;
    }
}
