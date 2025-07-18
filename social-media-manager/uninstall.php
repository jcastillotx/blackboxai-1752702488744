<?php
/**
 * Uninstall Social Media Manager Plugin
 * 
 * This file is executed when the plugin is deleted from WordPress admin.
 * It cleans up all plugin data including database tables and options.
 *
 * @package SocialMediaManager
 * @version 2.0.0
 */

// If uninstall not called from WordPress, then exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Security check
if (!current_user_can('activate_plugins')) {
    return;
}

// Check if we should remove data on uninstall
$remove_data = get_option('smm_remove_data_on_uninstall', false);

if ($remove_data) {
    global $wpdb;
    
    // Remove custom database tables
    $tables = array(
        $wpdb->prefix . 'smm_clients',
        $wpdb->prefix . 'smm_campaigns', 
        $wpdb->prefix . 'smm_posts',
        $wpdb->prefix . 'smm_analytics',
        $wpdb->prefix . 'smm_timesheets',
        $wpdb->prefix . 'smm_messages',
        $wpdb->prefix . 'smm_invoices'
    );
    
    foreach ($tables as $table) {
        $wpdb->query("DROP TABLE IF EXISTS $table");
    }
    
    // Remove plugin options
    delete_option('smm_settings');
    delete_option('smm_version');
    delete_option('smm_remove_data_on_uninstall');
    
    // Remove user settings (all users)
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'smm_user_settings_%'");
    
    // Remove custom user roles
    remove_role('social_media_manager');
    remove_role('smm_client');
    
    // Clear any cached data
    wp_cache_flush();
    
    // Log the uninstall
    error_log('Social Media Manager Plugin: All data removed during uninstall');
} else {
    // Just log that plugin was uninstalled but data preserved
    error_log('Social Media Manager Plugin: Uninstalled but data preserved');
}

// Clear any remaining transients
delete_transient('smm_dashboard_data');
delete_transient('smm_analytics_cache');

// Final cleanup
wp_cache_flush();
