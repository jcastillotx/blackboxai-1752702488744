<?php
/**
 * Admin dashboard management class
 */

if (!defined('ABSPATH')) {
    exit;
}

class SMM_Admin {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'admin_init'));
        add_action('wp_ajax_smm_filter_posts', array($this, 'ajax_filter_posts'));
        add_action('wp_ajax_smm_refresh_dashboard_data', array($this, 'ajax_refresh_dashboard_data'));
    }
    
    public function add_admin_menu() {
        add_menu_page(
            'Social Media Manager',
            'Social Media Manager',
            'manage_options',
            'social-media-manager',
            array($this, 'admin_page'),
            'dashicons-share',
            30
        );
        
        add_submenu_page(
            'social-media-manager',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'social-media-manager',
            array($this, 'admin_page')
        );
        
        add_submenu_page(
            'social-media-manager',
            'Clients',
            'Clients',
            'manage_options',
            'smm-clients',
            array($this, 'clients_page')
        );
        
        add_submenu_page(
            'social-media-manager',
            'Client Welcome',
            'Client Welcome',
            'manage_options',
            'smm-client-welcome',
            array($this, 'client_welcome_page')
        );
        
        add_submenu_page(
            'social-media-manager',
            'Settings',
            'Settings',
            'manage_options',
            'smm-settings',
            array($this, 'settings_page')
        );
    }
    
    public function admin_init() {
        register_setting('smm_settings', 'smm_settings');
    }
    
    public function admin_page() {
        ?>
        <div class="wrap smm-admin-wrap">
            <h1>Social Media Manager Dashboard</h1>
            <?php $this->render_dashboard(); ?>
        </div>
        <?php
    }
    
    public function clients_page() {
        global $wpdb;
        $table = $wpdb->prefix . 'smm_clients';

        $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        $per_page = 10;
        $offset = ($paged - 1) * $per_page;

        $total_clients = $wpdb->get_var("SELECT COUNT(*) FROM $table");
        $clients = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table ORDER BY created_at DESC LIMIT %d OFFSET %d", $per_page, $offset));
        $total_pages = ceil($total_clients / $per_page);

        ?>
        <div class="wrap">
            <h1>Clients Management</h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Industry</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($clients) : ?>
                        <?php foreach ($clients as $client) : ?>
                            <tr>
                                <td><?php echo esc_html($client->id); ?></td>
                                <td><?php echo esc_html($client->company_name); ?></td>
                                <td><?php echo esc_html($client->industry); ?></td>
                                <td><?php echo esc_html($client->created_at); ?></td>
                                <td>
                                    <a href="<?php echo admin_url('admin.php?page=smm-clients&action=view&id=' . intval($client->id)); ?>">View</a> |
                                    <a href="<?php echo admin_url('admin.php?page=smm-clients&action=edit&id=' . intval($client->id)); ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No clients found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    public function client_welcome_page() {
        // Implementation of client welcome message management page
    }
    
    public function settings_page() {
        // Implementation of settings page with app token management
    }
    
    public function ajax_filter_posts() {
        // AJAX handler for filtering posts
    }
    
    public function ajax_refresh_dashboard_data() {
        // AJAX handler for refreshing dashboard data
    }
}
