<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Auth Helper Functions
 */

if (!function_exists('is_logged_in')) {
    /**
     * Check if user is logged in
     */
    function is_logged_in()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
}

if (!function_exists('get_user_id')) {
    /**
     * Get current user ID
     */
    function get_user_id()
    {
        return $_SESSION['user_id'] ?? null;
    }
}

if (!function_exists('get_user_name')) {
    /**
     * Get current user name
     */
    function get_user_name()
    {
        return $_SESSION['username'] ?? null;
    }
}

if (!function_exists('get_user_email')) {
    /**
     * Get current user email
     */
    function get_user_email()
    {
        return $_SESSION['user_email'] ?? null;
    }
}

if (!function_exists('get_user_role')) {
    /**
     * Get current user role
     */
    function get_user_role()
    {
        return $_SESSION['user_role'] ?? null;
    }
}

if (!function_exists('has_role')) {
    /**
     * Check if user has specific role
     */
    function has_role($role)
    {
        return get_user_role() === $role;
    }
}

if (!function_exists('require_login')) {
    /**
     * Redirect to login if not logged in
     */
    function require_login()
    {
        if (!is_logged_in()) {
            redirect('login');
        }
    }
}

if (!function_exists('require_role')) {
    /**
     * Redirect if user doesn't have required role
     */
    function require_role($role)
    {
        require_login();
        if (!has_role($role)) {
            // Redirect to appropriate dashboard based on actual role
            $current_role = get_user_role();
            switch ($current_role) {
                case 'admin':
                    redirect('admin/dashboard');
                    break;
                case 'instructor':
                    redirect('instructor/dashboard');
                    break;
                case 'staff':
                    redirect('staff/dashboard');
                    break;
                case 'trainee':
                default:
                    redirect('trainee/dashboard');
                    break;
            }
        }
    }
}
