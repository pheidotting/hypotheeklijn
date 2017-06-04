<?php
/*
Plugin Name: Regel zelf uw hypotheek
Plugin URI: http://www.heidottinga.nl/
Description: Plugin voor Regel zelf uw hypotheek
Version: 1.0
Author: Patrick Heidotting
Author URI: http://www.heidotting.nl/
License: GPL2
*/
function scripts_with_jquery() {
    // Register the script like this for a plugin:
    wp_register_script('max-hypotheek-bepalen', plugins_url('/js/max-hypotheek-bepalen.js', __FILE__ ), array('jquery'));
    wp_register_script('aanvragen', plugins_url('/js/aanvragen.js', __FILE__ ), array('jquery'), '1.0', true);
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
    ?>
    <input type="checkbox" id="nhg">Nationale Hypotheek Garantie?<br />
    <label for="brutoloon">Je bruto jaarloon</label><input type="number" id="brutoloon" />
    <!--<input type="checkbox" id="ondernemer">Ben je zelfstandig ondernemer?-->
    <label for="geboortedatum">Je geboortedatum</label><input type="date" id="geboortedatum" />
    
    <input type="checkbox" id="partner">Met partner?
    <div id="metPartner" style="display: none">
        <label for="brutoloonpartner">Bruto jaarloon van je eventuele partner</label><input type="number" id="brutoloonpartner" />
        <label for="geboortedatumpartner">Geboortedatum van je partner</label><input type="date" id="geboortedatumpartner" />
    </div>
    
    <input type="checkbox" id="studieschuld">Heb je een studieschuld?<br />
    <div id="hoeveelstudieschuldDiv" style="display: none">
        <label for="hoeveelstudieschuld">Hoeveel?</label><input type="number" id="hoeveelstudieschuld" />
    </div>
    
    <input type="checkbox" id="roodstaan">Mag je rood staan?<br />
    <div id="hoeveelroodstaanDiv" style="display: none">
        <label for="hoeveelroodstaan">Hoeveel?</label><input type="number" id="hoeveelroodstaan" />
    </div>
    
    <input type="checkbox" id="creditcard">Heb je een creditcard?<br />
    <div id="hoeveelcreditcardDiv" style="display: none">
        <label for="hoeveelcreditcard">Wat is de limiet?</label><input type="number" id="hoeveelcreditcard" />
    </div>
    
    <input type="checkbox" id="partneralimentatie">Betaal je partneralimentatie?<br />
    <div id="hoeveelpartneralimentatieDiv" style="display: none">
        <label for="hoeveelpartneralimentatie">Hoeveel?</label><input type="number" id="hoeveelpartneralimentatie" />
    </div>
    
    <input type="checkbox" id="overigeleningen">Heb je overige leningen of kredieten?<br />
    <div id="hoeveeloverigeleningenDiv" style="display: none">
        <label for="hoeveeloverigeleningen">Hoeveel?</label><input type="number" id="hoeveeloverigeleningen" />
    </div>
    
    <div id="foutmelding-niet-alles-gevuld" style="display: none; color:red; font-weight: bold;">Niet alle verplichte velden zijn gevuld</div>
    <input type="submit" class="button-primary" id="opvragen">Opvragen</button>
    
    <div id="resultaat" style="display:none;">Je maximale hypotheek is : <span id="result"></span></div>
    
    <!--<div id="debug"></div>-->
    
    <?php
}

function form_creation_aanvragen($atts = []) {
    // echo $atts['apikey'];
    // echo $atts['apiurl'];
    // echo $atts['adres'];
    wp_enqueue_script('aanvragen');

    ob_start();
    
    echo "<div id=\"emailadres\" style=\"display:none;\">".$atts['adres']."</div>";
    echo "<div id=\"foutmelding-niet-alles-gevuld\" style=\"display: none; color:red; font-weight: bold;\">Niet alle verplichte velden zijn gevuld</div>";

    echo "<div id=\"stap1\">";
        echo "<label for=\"brutoloon\">Je bruto jaarloon</label><input type=\"number\" id=\"brutoloon\" />";
        echo "<label for=\"geboortedatum\">Je geboortedatum</label><input type=\"text\" id=\"geboortedatum\" />";
        
        echo "<input type=\"checkbox\" id=\"partner\">Met partner?";
        echo "<div id=\"metPartner\" style=\"display: none\">";
            echo "<label for=\"brutoloonpartner\">Bruto jaarloon van je eventuele partner</label><input type=\"number\" id=\"brutoloonpartner\" />";
            echo "<label for=\"geboortedatumpartner\">Geboortedatum van je partner</label><input type=\"text\" id=\"geboortedatumpartner\" />";
        echo "</div>";
        
        echo "<input type=\"checkbox\" id=\"studieschuld\">Heb je een studieschuld?<br />";
        echo "<div id=\"hoeveelstudieschuldDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelstudieschuld\">Hoeveel?</label><input type=\"number\" id=\"hoeveelstudieschuld\" />";
        echo "</div>";
        
        echo "<input type=\"checkbox\" id=\"roodstaan\">Mag je rood staan?<br />";
        echo "<div id=\"hoeveelroodstaanDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelroodstaan\">Hoeveel?</label><input type=\"number\" id=\"hoeveelroodstaan\" />";
        echo "</div>";
        
        echo "<input type=\"checkbox\" id=\"creditcard\">Heb je een creditcard?<br />";
        echo "<div id=\"hoeveelcreditcardDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelcreditcard\">Wat is de limiet?</label><input type=\"number\" id=\"hoeveelcreditcard\" />";
        echo "</div>";
        
        echo "<input type=\"checkbox\" id=\"partneralimentatie\">Betaal je partneralimentatie?<br />";
        echo "<div id=\"hoeveelpartneralimentatieDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelpartneralimentatie\">Hoeveel?</label><input type=\"number\" id=\"hoeveelpartneralimentatie\" />";
        echo "</div>";
        
        echo "<input type=\"checkbox\" id=\"overigeleningen\">Heb je overige leningen of kredieten?<br />";
        echo "<div id=\"hoeveeloverigeleningenDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveeloverigeleningen\">Hoeveel?</label><input type=\"number\" id=\"hoeveeloverigeleningen\" />";
        echo "</div>";
        
        // <!--<input type=\"submit\" class=\"button-primary\" id=\"opvragen\">Opvragen</button>-->
        
        
        // <!--<div id=\"debug\"></div>-->
        
        echo "<div id=\"aanbieders\"></div>";
    
        echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap2\" disabled value=\"Naar stap 2\" />";
    echo "</div>";
    echo "<div id=\"stap2\" style=\"display:none;\">";
        echo "<div id=\"max-hypotheek\" style=\"display:none;\">0</div>";
        echo "<div id=\"resultaat\" style=\"display:none;\">Je maximale hypotheek is : <span id=\"result\"></span></div>";
        // <!--<h3>Persoonlijke gegevens</h3>-->
        // <!--<label for=\"brutoloon\">Je bruto jaarloon</label><input type=\"number\" id=\"brutoloon\" />-->
        // <!--<label for=\"geboortedatum\">Je geboortedatum</label><input type=\"date\" id=\"geboortedatum\" />-->
        
        // <!--<input type=\"checkbox\" id=\"partner\">Met partner?-->
        // <!--<div id=\"metPartner\" style=\"display: none\">-->
        // <!--    <label for=\"brutoloonpartner\">Bruto jaarloon van je partner</label><input type=\"number\" id=\"brutoloonpartner\" />-->
        // <!--    <label for=\"geboortedatumpartner\">Geboortedatum van je partner</label><input type=\"date\" id=\"geboortedatumpartner\" />-->
        // <!--</div>-->
    
        echo "<h3>Hypotheeksom</h3>";
        echo "<label for=\"koopsom\">Koopsom van het huis</label><input type=\"number\" id=\"koopsom\" />";
        echo "<label for=\"overdrachtsbelasting\">Overdrachtsbelasting</label><input type=\"number\" id=\"overdrachtsbelasting\" disabled=\"disabled\" />";
        echo "<label for=\"leveringsakte-notaris\">Kosten leveringsakte notaris</label><input type=\"number\" id=\"leveringsakte-notaris\" value=\"800\" />";
        echo "<label for=\"hypotheekakte-notaris\">Kosten hypotheekakte notaris</label><input type=\"number\" id=\"hypotheekakte-notaris\" value=\"800\" />";
        echo "<label for=\"taxatie\">Kosten taxatie</label><input type=\"number\" id=\"taxatie\" value=\"500\" />";
        echo "<label for=\"commissie\">Kosten commissie</label><input type=\"number\" id=\"commissie\" value=\"700\" disabled=\"disabled\" />";
        echo "<div id=\"nhg-vraag\">";
            echo "<input type=\"checkbox\" id=\"nhg\">Nationale Hypotheek Garantie?<br />";
            echo "<div id=\"metNHG\" style=\"display:none;\">";
                echo "<label for=\"nhgkosten\">Kosten NHG</label><input type=\"number\" id=\"nhgkosten\" disabled=\"disabled\" />";
            echo "</div>";
        echo "</div>";

        echo "<label for=\"benodigdehypotheek\">Hoeveel hypotheek ben je nodig</label><input type=\"number\" id=\"benodigdehypotheek\" />";
    
        // <!--<div id=\"text-benodigde-hypotheek\"></div>-->
        echo "<div id=\"resultaat\" style=\"display:none;\">Je maximale hypotheek is : <span id=\"result\"></span></div>";
        echo "<div id=\"eigen-middelen\" style=\"display:none;\">Dat betekent dat je als eigen middelen moet inbrengen : <span id=\"eigen-middelen-bedrag\"></span></div>";

        // <!--<h3>Hypotheekvorm</h3>-->
        // <!--<input type=\"radio\" id=\"annuiteiten\" name=\"hypotheekvorm\">Annuiteiten-->
        // <!--<input type=\"radio\" id=\"lineair\" name=\"hypotheekvorm\">Lineair-->
        // <!--<label for=\"rentevasteperiode\">Rentevaste periode</label><input type=\"number\" id=\"rentevasteperiode\" />-->
    
        echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap1\" value=\"Terug\" />";
        echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap3\" value=\"Naar stap 3\" />";
    echo "</div>";
    echo "<div id=\"stap3\" style=\"display:none;\">";
        echo "<h3>NAW gegevens</h3>";
        echo "<label for=\"naam\">Naam</label><input type=\"text\" id=\"naam\" />";
        echo "<label for=\"postcode\">Postcode</label><input type=\"text\" id=\"postcode\" />";
        echo "<label for=\"huisnummer\">Huisnummer</label><input type=\"text\" id=\"huisnummer\" />";
        echo "<label for=\"straatnaam\">Adres</label><input type=\"text\" id=\"straatnaam\" />";
        echo "<label for=\"woonplaats\">Woonplaats</label><input type=\"text\" id=\"woonplaats\" />";

        echo "<label for=\"telefoonnummer\">Telefoonnummer</label><input type=\"text\" id=\"telefoonnummer\" />";
        echo "<label for=\"emailadres\">E-mail adres</label><input type=\"text\" id=\"emailadres\" />";
    
        echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap2\" value=\"Terug\" />";
        echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap4\" value=\"Naar stap 4\" />";
    echo "</div>";
    echo "<div id=\"stap4\" style=\"display:none;\">";
        echo "<h3>ID gegevens</h3>";
        echo "<label for=\"bsn\">Burgerservicenummer</label><input type=\"text\" id=\"bsn\" />";
        echo "<label for=\"documentnummer\">Documentnummer identificatie</label><input type=\"text\" id=\"documentnummer\" />";
        echo "<label for=\"datumgeldigheid\">Datum geldigheid identificatie</label><input type=\"text\" id=\"datumgeldigheid\" />";
        echo "<label for=\"gemeente\">Gemeente afgifte identificatie</label><input type=\"text\" id=\"gemeente\" />";
        echo "<label for=\"geboorteplaats\">Geboorteplaats</label><input type=\"text\" id=\"geboorteplaats\" />";
    
        echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap3\" value=\"Terug\" />";
        echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap5\" value=\"Naar stap 5\" />";
    echo "</div>";
    echo "<div id=\"stap5\" style=\"display:none;\">";
        echo "<h3>Betaal gegevens</h3>";
        echo "<label for=\"iban\">Iban</label><input type=\"text\" id=\"iban\" maxlength=\"18\" />";
    
        echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap4\" value=\"Terug\" />";
        echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap6\" value=\"Naar stap 6\" />";
    echo "</div>";
    echo "<div id=\"stap6\" style=\"display:none;\">";
        echo "<h3>Werk gegevens</h3>";
        echo "<label for=\"beroep\">Beroep/Functie</label><input type=\"text\" id=\"beroep\" />";
        echo "<label for=\"datumindiensttreding\">Datum indiensttreding</label><input type=\"text\" id=\"datumindiensttreding\" />";
        echo "<label for=\"einddatumcontract\">Einddatum contract</label><input type=\"text\" id=\"einddatumcontract\" />";
        echo "<label for=\"naamwerkgever\">Naam werkgever</label><input type=\"text\" id=\"naamwerkgever\" />";
        echo "<label for=\"postcodewerkgever\">Postcode werkgever</label><input type=\"text\" id=\"postcodewerkgever\" />";
        echo "<label for=\"huisnummerwerkgever\">Huisnummer werkgever</label><input type=\"text\" id=\"huisnummerwerkgever\" />";
        echo "<label for=\"straatnaamwerkgever\">Straatnaam werkgever</label><input type=\"text\" id=\"straatnaamwerkgever\" />";
        echo "<label for=\"plaatswerkgever\">Plaats werkgever</label><input type=\"text\" id=\"plaatswerkgever\" />";

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
    
    // <!--<div id=\"debug\"></div>-->
    
    return ob_get_clean();
}

function verzamel_gegevens_en_verstuur_mail() {
    function wpse27856_set_content_type(){
        return "text/html";
    }
    add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

    // wp_mail('gerben@dejongefinancieelconsult.nl', 'Nieuwe aanvraag', $_POST['mail-tekst']);
    wp_mail('patrick@heidotting.nl', 'Nieuwe aanvraag', $_POST['mail-tekst']);
}

add_shortcode('hypotheek-aanvragen', 'form_creation_aanvragen');
add_shortcode('max-hypotheek-berekenen', 'form_creation_max_hypotheek');

add_action( 'wp_ajax_aanvragen', 'verzamel_gegevens_en_verstuur_mail' );
add_action( 'wp_enqueue_scripts', 'scripts_with_jquery' );

?>