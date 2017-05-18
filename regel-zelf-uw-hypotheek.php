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
    <button id="opvragen">Opvragen</button>
    
    <div id="resultaat" style="display:none;">Je maximale hypotheek is : <span id="result"></span></div>
    
    <!--<div id="debug"></div>-->
    
    <?php
}

function form_creation_aanvragen() {
    wp_enqueue_script('aanvragen');
    ?>
    <div id="stap1">
        <!--<h3>Persoonlijke gegevens</h3>-->
        <!--<label for="brutoloon">Je bruto jaarloon</label><input type="number" id="brutoloon" />-->
        <!--<label for="geboortedatum">Je geboortedatum</label><input type="date" id="geboortedatum" />-->
        
        <!--<input type="checkbox" id="partner">Met partner?-->
        <!--<div id="metPartner" style="display: none">-->
        <!--    <label for="brutoloonpartner">Bruto jaarloon van je partner</label><input type="number" id="brutoloonpartner" />-->
        <!--    <label for="geboortedatumpartner">Geboortedatum van je partner</label><input type="date" id="geboortedatumpartner" />-->
        <!--</div>-->
    
        <h3>Hypotheeksom</h3>
        <label for="koopsom">Koopsom van het huis</label><input type="number" id="koopsom" />
        <label for="overdrachtsbelasting">Overdrachtsbelasting</label><input type="number" id="overdrachtsbelasting" disabled="disabled" />
        <label for="leveringsakte-notaris">Kosten leveringsakte notaris</label><input type="number" id="leveringsakte-notaris" value="800" />
        <label for="hypotheekakte-notaris">Kosten hypotheekakte notaris</label><input type="number" id="hypotheekakte-notaris" value="800" />
        <label for="taxatie">Kosten taxatie</label><input type="number" id="taxatie" value="500" />
        <label for="commissie">Kosten commissie</label><input type="number" id="commissie" value="700" disabled="disabled" />
        <div id="nhg-vraag">
            <input type="checkbox" id="nhg">Nationale Hypotheek Garantie?<br />
            <div id="metNHG" style="display:none;">
                <label for="nhgkosten">Kosten NHG</label><input type="number" id="nhgkosten" disabled="disabled" />
            </div>
        </div>

        <label for="benodigdehypotheek">Hoeveel hypotheek ben je nodig</label><input type="number" id="benodigdehypotheek" />
    
        <!--<h3>Hypotheekvorm</h3>-->
        <!--<input type="radio" id="annuiteiten" name="hypotheekvorm">Annuiteiten-->
        <!--<input type="radio" id="lineair" name="hypotheekvorm">Lineair-->
        <!--<label for="rentevasteperiode">Rentevaste periode</label><input type="number" id="rentevasteperiode" />-->
    
        <button id="naar-stap2">Naar stap 2</button>
    </div>
    <div id="stap2" style="display:none;">
        <label for="brutoloon">Je bruto jaarloon</label><input type="number" id="brutoloon" />
        <!--<input type="checkbox" id="ondernemer">Ben je zelfstandig ondernemer?-->
        <label for="geboortedatum">Je geboortedatum</label><input type="text" id="geboortedatum" />
        
        <input type="checkbox" id="partner">Met partner?
        <div id="metPartner" style="display: none">
            <label for="brutoloonpartner">Bruto jaarloon van je eventuele partner</label><input type="number" id="brutoloonpartner" />
            <label for="geboortedatumpartner">Geboortedatum van je partner</label><input type="text" id="geboortedatumpartner" />
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
        <button id="opvragen">Opvragen</button>
        
        <div id="text-benodigde-hypotheek"></div>
        <div id="resultaat" style="display:none;">Je maximale hypotheek is : <span id="result"></span></div>
        <div id="eigen-middelen" style="display:none;">Dat betekent dat je als eigen middelen moet inbrengen : <span id="eigen-middelen-bedrag"></span></div>
        
        <!--<div id="debug"></div>-->
        
        <div id="aanbieders"></div>
    
        <button id="terug-naar-stap1">Terug</button>
        <button id="naar-stap3">Naar stap 3</button>
    </div>
    <div id="stap3" style="display:none;">
        <h3>NAW gegevens</h3>
        <label for="naam">Naam</label><input type="text" id="naam" />
        <label for="postcode">Postcode</label><input type="text" id="postcode" />
        <label for="huisnummer">Huisnummer</label><input type="text" id="huisnummer" />
        <label for="straatnaam">Adres</label><input type="text" id="straatnaam" />
        <label for="woonplaats">Woonplaats</label><input type="text" id="woonplaats" />

        <label for="telefoonnummer">Telefoonnummer</label><input type="text" id="telefoonnummer" />
        <label for="emailadres">E-mail adres</label><input type="text" id="emailadres" />
    
        <button id="terug-naar-stap2">Terug</button>
        <button id="naar-stap4">Naar stap 4</button>
    </div>
    <div id="stap4" style="display:none;">
        <h3>ID gegevens</h3>
        <label for="bsn">Burgerservicenummer</label><input type="text" id="bsn" />
        <label for="documentnummer">Documentnummer identificatie</label><input type="text" id="documentnummer" />
        <label for="datumgeldigheid">Datum geldigheid identificatie</label><input type="text" id="datumgeldigheid" />
        <label for="gemeente">Gemeente afgifte identificatie</label><input type="text" id="gemeente" />
        <label for="geboorteplaats">Geboorteplaats</label><input type="text" id="geboorteplaats" />
    
        <button id="terug-naar-stap3">Terug</button>
        <button id="naar-stap5">Naar stap 5</button>
    </div>
    <div id="stap5" style="display:none;">
        <h3>Betaal gegevens</h3>
        <label for="iban">Iban</label><input type="text" id="iban" />
    
        <button id="terug-naar-stap4">Terug</button>
        <button id="naar-stap6">Naar stap 6</button>
    </div>
    <div id="stap6" style="display:none;">
        <h3>Werk gegevens</h3>
        <label for="beroep">Beroep/Functie</label><input type="text" id="beroep" />
        <label for="datumindiensttreding">Datum indiensttreding</label><input type="text" id="datumindiensttreding" />
        <label for="einddatumcontract">Einddatum contract</label><input type="text" id="einddatumcontract" />
        <label for="naamwerkgever">Naam werkgever</label><input type="text" id="naamwerkgever" />
        <label for="postcodewerkgever">Postcode werkgever</label><input type="text" id="postcodewerkgever" />
        <label for="huisnummerwerkgever">Huisnummer werkgever</label><input type="text" id="huisnummerwerkgever" />
        <label for="straatnaamwerkgever">Straatnaam werkgever</label><input type="text" id="straatnaamwerkgever" />
        <label for="plaatswerkgever">Plaats werkgever</label><input type="text" id="plaatswerkgever" />

        <button id="terug-naar-stap5">Terug</button>
        <button id="aanvragen">Aanvragen</button>
    </div>
    
    <!--<div id="debug"></div>-->
    
    <?php
}

function verzamel_gegevens_en_verstuur_mail() {
    echo $_POST['jadajada'];
    // wp_mail('patrick@heidotting.nl','test','testmail');
}
add_shortcode('max-hypotheek-berekenen', 'form_creation_max_hypotheek');
add_shortcode('hypotheek-aanvragen', 'form_creation_aanvragen');

add_action( 'wp_ajax_aanvragen', 'verzamel_gegevens_en_verstuur_mail' );
add_action( 'wp_enqueue_scripts', 'scripts_with_jquery' );

?>