
# Gutenberg Custom Block Listing with ACF pro
 ## Description

This project provides a custom **WordPress** block for creating a dynamic listing section using **Advanced Custom Fields (ACF) Pro**. 

// The next lines must be chaged.

- **Color** – Set a solid background color.
- **Image** – Select an image as the background.
- **YouTube** – Enter a YouTube video URL and configure options:
    - ▶️ Autoplay
    - 🔁 Loop video
    - 🔇 Mute video

You can also customize the following content:

- **Title**
- **Subtitle**
- **Description**
- **Link Button** (customize background color, URL and text color)

This allows you to build visually engaging hero sections tailored to your site's needs.
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

- You will need to populate your WP install with some data. On the Admin Panel, you will the on the left the "Events" option and click on the "Add new Even". Fill the:
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
