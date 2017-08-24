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
}


function form_creation_max_hypotheek(){
    wp_enqueue_script('max-hypotheek-bepalen');

    ob_start();

    echo "<input type=\"checkbox\" id=\"nhg\">Nationale Hypotheek Garantie?<br />";
    echo "<label for=\"brutoloon\">Je bruto jaarloon</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloon\" />";
    // <!--<input type=\"checkbox\" id=\"ondernemer\">Ben je zelfstandig ondernemer?-->
    echo "<label for=\"geboortedatum\">Je geboortedatum</label><input class=\"form-breedte250\" type=\"date\" id=\"geboortedatum\" />";
    
    echo "<input type=\"checkbox\" id=\"partner\">Met partner?";
    echo "<div id=\"metPartner\" style=\"display: none\">";
        echo "<label for=\"brutoloonpartner\">Bruto jaarloon van je eventuele partner</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloonpartner\" />";
        echo "<label for=\"geboortedatumpartner\">Geboortedatum van je partner</label><input class=\"form-breedte250\" type=\"date\" id=\"geboortedatumpartner\" />";
    echo "</div>";
    
    echo "<input type=\"checkbox\" id=\"studieschuld\">Heb je een studieschuld?<br />";
    echo "<div id=\"hoeveelstudieschuldDiv\" style=\"display: none\">";
        echo "<label for=\"hoeveelstudieschuld\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelstudieschuld\" />";
    echo "</div>";
    
    echo "<input type=\"checkbox\" id=\"roodstaan\">Mag je rood staan?<br />";
    echo "<div id=\"hoeveelroodstaanDiv\" style=\"display: none\">";
        echo "<label for=\"hoeveelroodstaan\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelroodstaan\" />";
    echo "</div>";
    
    echo "<input type=\"checkbox\" id=\"creditcard\">Heb je een creditcard?<br />";
    echo "<div id=\"hoeveelcreditcardDiv\" style=\"display: none\">";
        echo "<label for=\"hoeveelcreditcard\">Wat is de limiet?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelcreditcard\" />";
    echo "</div>";
    
    echo "<input type=\"checkbox\" id=\"partneralimentatie\">Betaal je partneralimentatie?<br />";
    echo "<div id=\"hoeveelpartneralimentatieDiv\" style=\"display: none\">";
        echo "<label for=\"hoeveelpartneralimentatie\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelpartneralimentatie\" />";
    echo "</div>";
    
    echo "<input type=\"checkbox\" id=\"overigeleningen\">Heb je overige leningen of kredieten?<br />";
    echo "<div id=\"hoeveeloverigeleningenDiv\" style=\"display: none\">";
        echo "<label for=\"hoeveeloverigeleningen\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveeloverigeleningen\" />";
    echo "</div>";
    
    echo "<div id=\"foutmelding-niet-alles-gevuld\" style=\"display: none; color:red; font-weight: bold;\">Niet alle verplichte velden zijn gevuld</div>";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"opvragen\">Opvragen</button>";
    
    echo "<div id=\"resultaat\" style=\"display:none;\">Je maximale hypotheek is : <span id=\"result\"></span></div>";
    
    // <!--<div id=\"debug\"></div>-->
    
    return ob_get_clean();
}

function form_creation_aanvragen($atts = []) {
    wp_enqueue_script('aanvragen');
    
    ob_start();
    
    echo "<div id=\"emailadresbeheerder\" style=\"display:none;\">".$atts['adres']."</div>";
    echo "<div id=\"apikey\" style=\"display:none;\">".$atts['apikey']."</div>";
    echo "<div id=\"apiurl\" style=\"display:none;\">".$atts['apiurl']."</div>";

    echo "<div class=\"links\">";
        echo "<div id=\"foutmelding-niet-alles-gevuld\" style=\"display: none; color:red; font-weight: bold;\">Niet alle verplichte velden zijn gevuld</div>";
    
        echo "<div class=\"stappenteller\" id=\"stappenteller\">Stap <span id=\"huidigestap\">1</span> van 6</div>";
    
        echo "<div id=\"stap1\">";
            include_once(dirname(__FILE__) . '/php/stap1/stap1-html.php');
        echo "</div>";
        echo "<div id=\"stap2\" style=\"display:none;\">";
            include_once(dirname(__FILE__) . '/php/stap2/stap2-html.php');
        echo "</div>";
        echo "<div id=\"stap3\" style=\"display:none;\">";
            echo "<h3>NAW gegevens</h3>";
            echo "<label for=\"naam\">Naam</label><input class=\"form-breedte250\" type=\"text\" id=\"naam\" />";
            echo "<label for=\"postcode\">Postcode</label><input class=\"form-breedte250\" type=\"text\" id=\"postcode\" />";
            echo "<label for=\"huisnummer\">Huisnummer</label><input class=\"form-breedte250\" type=\"text\" id=\"huisnummer\" />";
            echo "<label for=\"straatnaam\">Adres</label><input class=\"form-breedte250\" type=\"text\" id=\"straatnaam\" />";
            echo "<label for=\"woonplaats\">Woonplaats</label><input class=\"form-breedte250\" type=\"text\" id=\"woonplaats\" />";
    
            echo "<label for=\"telefoonnummer\">Telefoonnummer</label><input class=\"form-breedte250\" type=\"text\" id=\"telefoonnummer\" />";
            echo "<label for=\"emailadres\">E-mail adres</label><input class=\"form-breedte250\" type=\"text\" id=\"emailadres\" />";
        
            echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap2\" value=\"Terug\" />";
            echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap4\" value=\"Naar stap 4\" />";
        echo "</div>";
        echo "<div id=\"stap4\" style=\"display:none;\">";
            echo "<h3>ID gegevens</h3>";
            echo "<label for=\"bsn\">Burgerservicenummer</label><input class=\"form-breedte250\" type=\"text\" id=\"bsn\" />";
            echo "<label for=\"documentnummer\">Documentnummer identificatie</label><input class=\"form-breedte250\" type=\"text\" id=\"documentnummer\" />";
            echo "<label for=\"datumgeldigheid\">Datum geldigheid identificatie</label><input class=\"form-breedte250\" type=\"text\" id=\"datumgeldigheid\" />";
            echo "<label for=\"gemeente\">Gemeente afgifte identificatie</label><input class=\"form-breedte250\" type=\"text\" id=\"gemeente\" />";
            echo "<label for=\"geboorteplaats\">Geboorteplaats</label><input class=\"form-breedte250\" type=\"text\" id=\"geboorteplaats\" />";
        
            echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap3\" value=\"Terug\" />";
            echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap5\" value=\"Naar stap 5\" />";
        echo "</div>";
        echo "<div id=\"stap5\" style=\"display:none;\">";
            echo "<h3>Betaal gegevens</h3>";
            echo "<label for=\"iban\">Iban</label><input class=\"form-breedte250\" type=\"text\" id=\"iban\" maxlength=\"18\" />";
        
            echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap4\" value=\"Terug\" />";
            echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap6\" value=\"Naar stap 6\" />";
        echo "</div>";
        echo "<div id=\"stap6\" style=\"display:none;\">";
            echo "<h3>Werk gegevens</h3>";
            echo "<label for=\"beroep\">Beroep/Functie</label><input class=\"form-breedte250\" type=\"text\" id=\"beroep\" />";
            echo "<label for=\"datumindiensttreding\">Datum indiensttreding</label><input class=\"form-breedte250\" type=\"text\" id=\"datumindiensttreding\" />";
            echo "<label for=\"einddatumcontract\">Einddatum contract</label><input class=\"form-breedte250\" type=\"text\" id=\"einddatumcontract\" />";
            echo "<label for=\"naamwerkgever\">Naam werkgever</label><input class=\"form-breedte250\" type=\"text\" id=\"naamwerkgever\" />";
            echo "<label for=\"postcodewerkgever\">Postcode werkgever</label><input class=\"form-breedte250\" type=\"text\" id=\"postcodewerkgever\" />";
            echo "<label for=\"huisnummerwerkgever\">Huisnummer werkgever</label><input class=\"form-breedte250\" type=\"text\" id=\"huisnummerwerkgever\" />";
            echo "<label for=\"straatnaamwerkgever\">Straatnaam werkgever</label><input class=\"form-breedte250\" type=\"text\" id=\"straatnaamwerkgever\" />";
            echo "<label for=\"plaatswerkgever\">Plaats werkgever</label><input class=\"form-breedte250\" type=\"text\" id=\"plaatswerkgever\" />";
    
            echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap5\" value=\"Terug\" />";
            echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-bevestigen\" value=\"Naar stap 7\" />";
        echo "</div>";
        echo "<div id=\"bevestigen\" style=\"display:none;\">";
            echo "<div id=\"tekst-mail\" style=\"display:none;\"></div>";
    
            echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap6\" value=\"Terug\" />";
            echo "<input type=\"submit\" class=\"button-primary\" id=\"aanvragen\" value=\"Aanvragen\" />";
        echo "</div>";
        echo "<div id=\"ontvangen\" style=\"display:none;\">";
            echo "We hebben uw aanvraag ontvangen.";
        echo "</div>";
    echo "</div>";//links
    echo "<div class=\"rechts\">";
        echo "<h3>Jouw hypotheek berekening</h3>";
        echo "<table>";
            echo "<tr>";
                echo "<td>Leencapaciteit o.b.v. je financiële situatie</td>";
                echo "<td><span id=\"sidebar-max-hypotheek\">€ 0</span></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Leencapaciteit o.b.v. de koopprijs</td>";
                echo "<td><span id=\"sidebar-max-hypotheek-koopsom\">€ 0</span></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td colspan=\"2\"><hr /></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Bruto maandlast</td>";
                echo "<td><span id=\"brutomaandlast-sidebar\">€ 0</span></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Netto maandlast (eerste maand)</td>";
                echo "<td><span id=\"nettomaandlast-sidebar\">€ 0</span></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td colspan=\"2\"><hr /></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Rente percentage</td>";
                echo "<td><span id=\"rentepercentage-sidebar\">0</span>%</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Rentevaste periode</td>";
                echo "<td><span id=\"rentevasteperiode-sidebar\">10</span> jaar</td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Soort hypotheek</td>";
                echo "<td><span id=\"soorthypotheek-sidebar\">Annuïteiten<span></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Nationale Hypotheek Garantie</td>";
                echo "<td><span id=\"nhg-sidebar\">Nee</span></td>";
            echo "</tr>";
        echo "</table>";
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