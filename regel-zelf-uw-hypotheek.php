<?php
/*
Plugin Name: Regel zelf uw hypotheek
Plugin URI: http://www.heidotting.nl/
Description: Plugin voor Regel zelf uw hypotheek
Version: 1.0
Author: Patrick Heidotting
Author URI: http://www.heidotting.nl/
License: GPL2
*/
function scripts_with_jquery() {
    // Register the script like this for a plugin:
    wp_register_script('max-hypotheek-bepalen', plugins_url('/js/max-hypotheek-bepalen.js', __FILE__ ), array('jquery'));
    wp_register_script('aanvragen', plugins_url('/js/aanvragen.js', __FILE__ ), array('jquery'));
    wp_register_script('moment', plugins_url('/js/moment-with-locales.js', __FILE__ ));
    wp_register_script('underscore', plugins_url('/js/underscore-min.js', __FILE__ ));
    wp_register_script('api-calls', plugins_url('/js/api-calls.js', __FILE__ ), array('jquery'));
    // or
    // Register the script like this for a theme:
    wp_register_script('max-hypotheek-bepalen.js', get_template_directory_uri() . '/js/max-hypotheek-bepalen.js', array('jquery'));
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script('moment');
    wp_enqueue_script('underscore');
    wp_enqueue_script('api-calls');

    $simulatie = false;
}


function form_creation_max_hypotheek($atts = []){
    // wp_enqueue_script('max-hypotheek-bepalen');
    wp_enqueue_script('aanvragen');

    ob_start();

    echo "<div id=\"emailadresbeheerder\" style=\"display:none;\">".$atts['adres']."</div>";
    echo "<div id=\"apikey\" style=\"display:none;\">".$atts['apikey']."</div>";
    echo "<div id=\"apiurl\" style=\"display:none;\">".$atts['apiurl']."</div>";
    
    echo "<input id=\"rentevasteperiode\" style=\"display: none;\" />";

    $simulatie = true;
    include_once(dirname(__FILE__) . '/php/stap1/stap1-html.php');
    
    return ob_get_clean();
}

function form_creation_aanvragen($atts = []) {
    wp_enqueue_script('aanvragen');
    
    ob_start();
    
    echo "<div id=\"emailadresbeheerder\" style=\"display:none;\">".$atts['adres']."</div>";
    echo "<div id=\"apikey\" style=\"display:none;\">".$atts['apikey']."</div>";
    echo "<div id=\"apiurl\" style=\"display:none;\">".$atts['apiurl']."</div>";

    echo "<div class=\"stappenteller\" id=\"stappenteller\">Stap <span id=\"huidigestap\">1</span> van 7</div>";
    
    echo "<div class=\"links\">";
        echo "<div id=\"foutmelding-niet-alle-verplichte-velden-gevuld\" style=\"display: none; color:red; font-weight: bold;\">Niet alle verplichte velden zijn gevuld</div>";
    
        echo "<div id=\"stap1\">";
            include_once(dirname(__FILE__) . '/php/stap1/stap1-html.php');
        echo "</div>";
        echo "<div id=\"stap2\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap2/stap2-html.php');
        echo "</div>";
        echo "<div id=\"stap3\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap3/stap3-html.php');
        echo "</div>";
        echo "<div id=\"stap4\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap4/stap4-html.php');
        echo "</div>";
        echo "<div id=\"stap5\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap5/stap5-html.php');
        echo "</div>";
        echo "<div id=\"stap6\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap6/stap6-html.php');
        echo "</div>";
        echo "<div id=\"bevestigen\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap7/stap7-html.php');
        echo "</div>";
        echo "<div id=\"ontvangen\" style=\"display:none;\">";
            echo "We hebben uw aanvraag ontvangen.";
        echo "</div>";
    echo "</div>";//links
    echo "<div class=\"rechts\">";
        include_once(dirname(__FILE__) . '/php/hypotheek-berekening/hypotheek-berekening-html.php');
    echo "</div>";//rechts
    
    // <!--<div id=\"debug\"></div>-->
    
    return ob_get_clean();
}

function verzamel_gegevens_en_verstuur_mail() {
    function wpse27856_set_content_type(){
        return "text/html";
    }
    add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

    // wp_mail('gerben@dejongefinancieelconsult.nl', 'Nieuwe aanvraag', $_POST['mail-tekst']);
    wp_mail($_POST['emailadres'], 'Nieuwe aanvraag', $_POST['mail-tekst']);
}

add_shortcode('hypotheek-aanvragen', 'form_creation_aanvragen');
add_shortcode('max-hypotheek-berekenen', 'form_creation_max_hypotheek');

add_action( 'wp_ajax_aanvragen', 'verzamel_gegevens_en_verstuur_mail' );
add_action( 'wp_enqueue_scripts', 'scripts_with_jquery' );

?>