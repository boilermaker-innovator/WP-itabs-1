<?php
/**
 * Plugin Name: Thumbs Reaction Widget
 * Plugin URI:  https://yourwebsite.com
 * Description: A simple widget for reactions and stats.
 * Version:     1.0
 * Author:      Tangles
 * Author URI:  https://yourwebsite.com
 * License:     GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Enqueue styles and scripts
function thumbs_reaction_enqueue_assets() {
    wp_enqueue_style('thumbs-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('thumbs-script', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'thumbs_reaction_enqueue_assets');

// Add widget HTML via shortcode
function thumbs_reaction_widget() {
    ob_start();
    ?>
    <div id="thumbs-widget">
        <div id="thumbs-button" onclick="toggleThumbs()">👍<div id="i-indicator">i</div></div>
        
        <div id="reactions-popup" class="thumbs-popup">
            <div class="popup-title">What do you think?</div>
            <div class="reaction-option" onclick="saveReaction('reaction1')"><span class="emoji">👍</span> This is helpful</div>
            <div class="reaction-option" onclick="saveReaction('reaction2')"><span class="emoji">❤️</span> I love this</div>
            <div class="reaction-option" onclick="saveReaction('reaction3')"><span class="emoji">🔥</span> This is amazing</div>
            <div class="reaction-option" onclick="saveReaction('reaction4')"><span class="emoji">💡</span> Very informative</div>
            <div class="thumbs-close-button" onclick="closeThumbsPopups()">Close</div>
        </div>
        
        <div id="stats-popup" class="thumbs-popup">
            <div class="popup-title">Reaction Statistics</div>
            <div id="stats-content"><p>No reactions yet</p></div>
            <div class="stats-buttons">
                <button class="stats-code-button" onclick="openCodePopup()">Get Code</button>
                <div class="thumbs-close-button" onclick="closeThumbsPopups()">Close</div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('thumbs_reaction', 'thumbs_reaction_widget');

