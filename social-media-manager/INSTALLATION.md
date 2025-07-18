# Social Media Manager Plugin - Installation Guide

## 📦 Complete WordPress Plugin Package

This is a **complete, production-ready WordPress plugin** with all files included for immediate installation and use.

## 🚀 Quick Installation

### Method 1: Direct Upload
1. **Download** the entire `social-media-manager` folder
2. **Upload** to your WordPress site at `/wp-content/plugins/social-media-manager/`
3. **Activate** the plugin in WordPress Admin → Plugins
4. **Done!** The plugin is ready to use

### Method 2: ZIP Installation
1. **Compress** the `social-media-manager` folder into a ZIP file
2. **Upload** via WordPress Admin → Plugins → Add New → Upload Plugin
3. **Activate** the plugin
4. **Done!** Ready to use

## 🎯 First Steps After Installation

### For Administrators:
1. **Navigate** to WordPress Admin → Social Media Manager
2. **Go to** "Client Welcome" submenu
3. **Select a client** and send your first welcome message
4. **Preview** how it will look on the client dashboard

### For Clients:
1. **Add shortcode** `[smm_client_dashboard]` to any page
2. **Clients can access** their personalized dashboard
3. **Welcome message** appears at the top with their name
4. **Interactive features** allow post approval and communication

## 📋 System Requirements

- **WordPress:** 5.0 or higher
- **PHP:** 7.4 or higher  
- **MySQL:** 5.6 or higher
- **Browser:** Modern browsers (Chrome, Firefox, Safari, Edge)

## 🗄️ Database Setup

The plugin **automatically creates** all necessary database tables on activation:
- `wp_smm_clients` - Client information and welcome messages
- `wp_smm_campaigns` - Campaign management
- `wp_smm_posts` - Post scheduling and approval
- `wp_smm_analytics` - Performance tracking
- `wp_smm_timesheets` - Time tracking
- `wp_smm_messages` - Client communication
- `wp_smm_invoices` - Billing management

## 🎨 Features Available Immediately

### ✅ Client Welcome System
- Personalized welcome messages for each client
- Beautiful background images from Pexels
- Responsive design for all devices
- Admin interface for easy management

### ✅ Interactive Dashboard
- Post content calendar
- Approval workflow for pending posts
- Real-time analytics with Chart.js
- Message center for communication
- Account settings management

### ✅ Admin Interface
- Complete client management
- Welcome message editor with live preview
- Settings configuration
- User role management

## 🔧 Configuration Options

### API Keys (Optional)
Navigate to **Social Media Manager → Settings** to configure:
- ChatGPT API Key (for AI-powered content)
- Facebook API Key
- Instagram API Key  
- Twitter API Key
- LinkedIn API Key

### User Roles
The plugin creates these user roles:
- **Social Media Manager** - Full access to all features
- **SMM Client** - Access to client dashboard only

## 📱 Shortcodes Available

- `[smm_client_intake]` - Client intake form
- `[smm_client_dashboard]` - Complete client dashboard with welcome section

## 🎯 Usage Examples

### Example 1: Client Welcome Page
```php
// Create a page with this shortcode
[smm_client_dashboard]
```

### Example 2: Client Intake Form
```php
// Add to any page for new client onboarding
[smm_client_intake title="Get Your Social Media Strategy"]
```

## 🔒 Security Features

- **Nonce verification** for all forms
- **Input sanitization** using WordPress standards
- **User capability checks** for admin functions
- **SQL injection prevention** with prepared statements
- **XSS protection** with proper escaping

## 🎨 Customization

### Styling
- Edit `assets/css/frontend.css` for client dashboard styling
- Edit `assets/css/admin.css` for admin interface styling
- All styles are responsive and mobile-friendly

### Background Images
- Default uses high-quality Pexels images
- Can be customized in the welcome section code
- Supports any image URL or local uploads

## 🐛 Troubleshooting

### Common Issues:

**Plugin not activating?**
- Check PHP version (requires 7.4+)
- Verify file permissions
- Check WordPress version (requires 5.0+)

**Welcome messages not saving?**
- Verify user has admin capabilities
- Check database permissions
- Ensure nonce verification is working

**Dashboard not loading?**
- Check if shortcode is properly placed
- Verify user is logged in
- Check browser console for JavaScript errors

## 📞 Support

For support and customization:
1. Check the `README.md` for technical documentation
2. View `demo-client-dashboard.html` for feature examples
3. Review the code comments for implementation details

## 🎉 You're Ready!

Your Social Media Manager plugin is now **fully installed and ready to use**. The complete client dashboard with welcome messages, interactive features, and professional design is available immediately.

**Next Steps:**
1. Create your first client welcome message
2. Add the dashboard shortcode to a client page
3. Test the interactive features
4. Customize styling if needed

**Enjoy your professional social media management system!** 🚀
