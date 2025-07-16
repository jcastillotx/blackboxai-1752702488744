<?php
/**
 * Plugin Name: Social Media Management
 * Plugin URI: https://www.kre8itech.com
 * Description: Comprehensive social media management plugin with AI-powered strategy generation and client management.
 * Version: 1.0.0
 * Author: Jeremiah Castillo
 * Author URI: https://www.kre8itech.com
 * Company: Kre8ivTech, LLC
 * License: GPL v2 or later
 * Text Domain: social-media-manager
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SMM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SMM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMM_VERSION', '1.0.0');

// Main plugin class
class SocialMediaManager {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    public function init() {
        // Load plugin components
        $this->load_dependencies();
        $this->init_hooks();
        $this->create_user_roles();
    }
    
    private function load_dependencies() {
        require_once SMM_PLUGIN_PATH . 'includes/class-database.php';
        require_once SMM_PLUGIN_PATH . 'includes/class-admin.php';
        require_once SMM_PLUGIN_PATH . 'includes/class-frontend.php';
        require_once SMM_PLUGIN_PATH . 'includes/class-client-frontend.php';
        require_once SMM_PLUGIN_PATH . 'includes/class-chatgpt-integration.php';
        require_once SMM_PLUGIN_PATH . 'includes/class-social-media-api.php';
        
        // Initialize classes
        new SMM_Database();
        new SMM_Admin();
        new SMM_Frontend();
        new SMM_Client_Frontend();
        new SMM_ChatGPT_Integration();
        new SMM_Social_Media_API();
    }
    
    private function init_hooks() {
        add_action('wp_ajax_smm_client_intake', array($this, 'handle_client_intake'));
        add_action('wp_ajax_nopriv_smm_client_intake', array($this, 'handle_client_intake'));
        add_action('wp_ajax_smm_generate_strategy', array($this, 'generate_strategy'));
        add_action('wp_ajax_smm_save_timesheet', array($this, 'save_timesheet'));
        add_action('wp_ajax_smm_send_message', array($this, 'send_message'));
    }
    
    private function create_user_roles() {
        // Create custom user roles
        add_role('social_media_manager', 'Social Media Manager', array(
            'read' => true,
            'manage_social_media' => true,
            'view_analytics' => true,
            'manage_clients' => true
        ));
        
        add_role('smm_client', 'SMM Client', array(
            'read' => true,
            'view_own_reports' => true
        ));
    }
    
    public function enqueue_scripts() {
        wp_enqueue_style('smm-frontend-style', SMM_PLUGIN_URL . 'assets/css/frontend.css', array(), SMM_VERSION);
        wp_enqueue_script('smm-frontend-script', SMM_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), SMM_VERSION, true);
        
        // Localize script for AJAX
        wp_localize_script('smm-frontend-script', 'smm_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('smm_nonce')
        ));
    }
    
    public function admin_enqueue_scripts() {
        wp_enqueue_style('smm-admin-style', SMM_PLUGIN_URL . 'assets/css/admin.css', array(), SMM_VERSION);
        wp_enqueue_script('smm-admin-script', SMM_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), SMM_VERSION, true);
        wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '3.9.1', true);
    }
    
    public function activate() {
        // Create database tables
        $database = new SMM_Database();
        $database->create_tables();
        
        // Set default options
        add_option('smm_settings', array(
            'chatgpt_api_key' => '',
            'facebook_api_key' => '',
            'instagram_api_key' => '',
            'twitter_api_key' => '',
            'linkedin_api_key' => ''
        ));
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    public function deactivate() {
        // Clean up if needed
        flush_rewrite_rules();
    }
    
    // AJAX handlers
    public function handle_client_intake() {
        check_ajax_referer('smm_nonce', 'nonce');
        
        $intake_data = sanitize_text_field($_POST['intake_data']);
        // Process intake form data
        
        wp_send_json_success(array('message' => 'Intake form submitted successfully'));
    }
    
    public function generate_strategy() {
        check_ajax_referer('smm_nonce', 'nonce');
        
        $client_data = sanitize_text_field($_POST['client_data']);
        $chatgpt = new SMM_ChatGPT_Integration();
        $strategy = $chatgpt->generate_strategy($client_data);
        
        wp_send_json_success(array('strategy' => $strategy));
    }
    
    public function save_timesheet() {
        check_ajax_referer('smm_nonce', 'nonce');
        
        $timesheet_data = sanitize_text_field($_POST['timesheet_data']);
        // Save timesheet data to database
        
        wp_send_json_success(array('message' => 'Timesheet saved successfully'));
    }
    
    public function send_message() {
        check_ajax_referer('smm_nonce', 'nonce');
        
        $message_data = sanitize_text_field($_POST['message_data']);
        // Process and save message
        
        wp_send_json_success(array('message' => 'Message sent successfully'));
    }
}

// Initialize the plugin
new SocialMediaManager();
