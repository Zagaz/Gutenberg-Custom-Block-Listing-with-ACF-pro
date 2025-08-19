

# Gutenberg Custom Block Listing with ACF Pro and AJAX

## Description

This plugin adds a powerful, flexible listing block to the WordPress block editor, allowing you to display custom post types (such as Events) in a modern, filterable, and paginated grid. Built with Advanced Custom Fields (ACF) Pro, it enables you to easily manage and display custom fields, taxonomies, and post data in both the backend and frontend.

**Key Features:**
- Custom Gutenberg block for listing any post type (default: Events)
- AJAX-powered filtering, search, and pagination
- Fully responsive grid layout
- Integrates with ACF Pro for custom fields and flexible content
- Easy to style and extend for your project needs
- Works seamlessly in both the WordPress editor and on the frontend

Ideal for building event listings, directories, portfolios, or any dynamic content section that requires custom fields and advanced filtering.

## Live Demo

Visit the live demo [HERE](https://gutenberg-block-acf-listing.wasmer.app/ "HERE").

## Requirements

- **WordPress** (latest version recommended)
- **ACF Pro** plugin (required for custom block and flexible content support)

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/Zagaz/Gutenberg-Custom-Block-Hero-with-ACF-pro.git
   cd Gutenberg-Custom-Block-Hero-with-ACF-pro
   git checkout main
   ```

2. **Copy the plugin/theme files**
   - Place the `Gutenberg-Custom-Block-Hero-with-ACF-pro` folder inside your WordPress `wp-content/plugins/` or `wp-content/themes/` directory, depending on your setup.
   - Also,you can download the main branch .zip file and install in your WordPress instalation.

3. **Install and activate ACF Pro**
   - Download ACF Pro from [https://www.advancedcustomfields.com/pro/](https://www.advancedcustomfields.com/pro/)
   - Upload and activate the plugin in your WordPress admin panel.

4. **Activate the block**
   - If using as a plugin, activate "acfblock" from the WordPress Plugins screen.
   - If using as a theme part, ensure your theme loads the block files.

5. **Add the Hero Block**
   - In the WordPress block editor, add the "Hero" block to your page or template.
   - Configure the background type as YouTube, Image, or Color.
   - For YouTube, paste a valid YouTube video URL and adjust options (autoplay, loop, mute, etc.).

## Testing

- You will need to populate your WP install with some data. On the Admin Panel, you will the on the left the "Events" option and click on the "Add new Even" and fill the fields:
   - Add Title
   - Add a Content.
   - Choose one of the tags: on the right side block settings (Concerts,conferences or Workshop).
- Add this block (ACF Listing) wherever you want.(I strongly suggest to add it on the main page).

## Notes

- **ACF Pro is required** for block registration and flexible content fields.
- The block is designed to be responsive and work in both the frontend and the WordPress block editor.
- For best results, use high-quality YouTube videos with a 16:9 aspect ratio.

## Support

For issues or questions, please open an issue on this repository.
