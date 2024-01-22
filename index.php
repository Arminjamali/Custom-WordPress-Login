<?php

function custom_login_redirect($redirect_to, $request, $user)
{
    // Set the default redirect page to the home URL
    $redirect_page = home_url();

    // If the user is an administrator, redirect to the admin URL
    if (is_array($user->roles) && in_array('administrator', $user->roles)) {
        return admin_url();
    }

    // Check if the mylogin parameter is present and matches a predefined hash, if yes, return the current redirect_to value
    if (isset($_GET['mylogin']) && $_GET['mylogin'] == password_hash('6666', PASSWORD_BCRYPT)) {
        return $redirect_to; // Or any desired value for no redirection
    }

    // Check if the user is an administrator and redirect to the admin URL
    if (is_array($user->roles) && in_array('administrator', $user->roles)) {
        return admin_url();
    }

    // Return the default redirect page
    return $redirect_page;
}

function prevent_wp_login_redirect()
{
    // If the user is trying to access wp-login.php and the armin cookie is not set, return a 404 error
    if (strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false && !is_user_logged_in()) {
        if (!isset($_GET['mylogin']) && $_POST == array()) {
            status_header(404);
            wp_die('404 Not Found - Page not found', '404 Not Found');
        }
    }
}

add_filter('login_redirect', 'custom_login_redirect', 10, 3);
add_action('init', 'prevent_wp_login_redirect');

function custom_rewrite_rule()
{
    // Add a custom rewrite rule for the endpoint wp-armin
    add_rewrite_rule('^wp-armin/?$', 'index.php?mylogin=true', 'top');
}

add_action('init', 'custom_rewrite_rule');

function custom_query_vars($query_vars)
{
    // Add the custom query variable mylogin
    $query_vars[] = 'mylogin';
    return $query_vars;
}

add_filter('query_vars', 'custom_query_vars');

function custom_template_redirect()
{
    // Check if the mylogin query variable is set to true, then redirect to wp-login.php with the hashed value
    $my_login = get_query_var('mylogin');
    if ($my_login === 'true') {
        $mylogin_value = password_hash('6666', PASSWORD_BCRYPT);
        $redirect_url = add_query_arg('mylogin', $mylogin_value, home_url('/wp-login.php'));
        wp_redirect($redirect_url);
        exit();
    }
}

add_action('template_redirect', 'custom_template_redirect');
