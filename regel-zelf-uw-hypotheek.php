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
            echo "<label for=\"brutoloon\">Je bruto jaarloon</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloon\" />";
            echo "<label for=\"geboortedatum\">Je geboortedatum</label><input class=\"form-breedte250\" type=\"text\" id=\"geboortedatum\" />";
            
            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"partner\">Met partner?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-met-partner-question\" />";
            echo "</div>";
            echo "<div id=\"stap1-met-partner-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-met-partner-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap1MetPartner = $atts['stap1-met-partner'] == '' ? 'stap1-met-partner' : $atts['stap1-met-partner'];
            echo "<div style=\"padding:15px;\">".$tekstStap1MetPartner."</div></div>";
            echo "<div id=\"metPartner\" style=\"display: none\">";
                echo "<label for=\"brutoloonpartner\">Bruto jaarloon van je eventuele partner</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloonpartner\" />";
                echo "<label for=\"geboortedatumpartner\">Geboortedatum van je partner</label>";
                echo "<input class=\"form-breedte250\" type=\"text\" id=\"geboortedatumpartner\" />";
            echo "</div>";
            
            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"studieschuld\">Heb je een studieschuld?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-studieschuld-question\" />";
            echo "</div>";
            echo "<div id=\"stap1-studieschuld-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-studieschuld-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap1Studieschuld = $atts['stap1-studieschuld'] == '' ? 'stap1-studieschuld' : $atts['stap1-studieschuld'];
            echo "<div style=\"padding:15px;\">".$tekstStap1Studieschuld."</div></div>";
            echo "<div id=\"hoeveelstudieschuldDiv\" style=\"display: none\">";
                echo "<label for=\"hoeveelstudieschuld\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelstudieschuld\" />";
            echo "</div>";
            
            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"roodstaan\">Mag je rood staan?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-roodstaan-question\" />";
            echo "</div>";
            echo "<div id=\"stap1-roodstaan-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-roodstaan-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap1Roodstaan = $atts['stap1-roodstaan'] == '' ? 'stap1-roodstaan' : $atts['stap1-roodstaan'];
            echo "<div style=\"padding:15px;\">".$tekstStap1Roodstaan."</div></div>";
            echo "<div id=\"hoeveelroodstaanDiv\" style=\"display: none\">";
                echo "<label for=\"hoeveelroodstaan\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelroodstaan\" />";
            echo "</div>";
            
            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"creditcard\">Heb je een creditcard?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-creditcard-question\" />";
            echo "</div>";
            echo "<div id=\"stap1-creditcard-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-creditcard-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap1Creditcard = $atts['stap1-creditcard'] == '' ? 'stap1-creditcard' : $atts['stap1-creditcard'];
            echo "<div style=\"padding:15px;\">".$tekstStap1Creditcard."</div></div>";
            echo "<div id=\"hoeveelcreditcardDiv\" style=\"display: none\">";
                echo "<label for=\"hoeveelcreditcard\">Wat is de limiet?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelcreditcard\" />";
            echo "</div>";
            
            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"partneralimentatie\">Betaal je partneralimentatie?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-partneralimentatie-question\" />";
            echo "</div>";
            echo "<div id=\"stap1-partneralimentatie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-partneralimentatie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap1Partneralimentatie = $atts['stap1-partneralimentatie'] == '' ? 'stap1-partneralimentatie' : $atts['stap1-partneralimentatie'];
            echo "<div style=\"padding:15px;\">".$tekstStap1Partneralimentatie."</div></div>";
            echo "<div id=\"hoeveelpartneralimentatieDiv\" style=\"display: none\">";
                echo "<label for=\"hoeveelpartneralimentatie\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveelpartneralimentatie\" />";
            echo "</div>";
            
            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"overigeleningen\">Heb je overige leningen of kredieten?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-overigeleningen-question\" />";
            echo "</div>";
            echo "<div id=\"stap1-overigeleningen-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-overigeleningen-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap1Overigeleningen = $atts['stap1-overigeleningen'] == '' ? 'stap1-overigeleningen' : $atts['stap1-overigeleningen'];
            echo "<div style=\"padding:15px;\">".$tekstStap1Overigeleningen."</div></div>";
            echo "<div id=\"hoeveeloverigeleningenDiv\" style=\"display: none\">";
                echo "<label for=\"hoeveeloverigeleningen\">Hoeveel?</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveeloverigeleningen\" />";
            echo "</div>";
            
            // <!--<input type=\"submit\" class=\"button-primary\" id=\"opvragen\">Opvragen</button>-->
            
            
            // <!--<div id=\"debug\"></div>-->
            
            echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap2\"  value=\"Naar stap 2\" />";
        echo "</div>";
        echo "<div id=\"stap2\" style=\"display:none;\">";
            
            echo "<h3>Hypotheeksom</h3>";
            // <!--<h3>Persoonlijke gegevens</h3>-->
            // <!--<label for=\"brutoloon\">Je bruto jaarloon</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloon\" />-->
            // <!--<label for=\"geboortedatum\">Je geboortedatum</label><input class=\"form-breedte250\" type=\"date\" id=\"geboortedatum\" />-->
            
            // <!--<input type=\"checkbox\" id=\"partner\">Met partner?-->
            // <!--<div id=\"metPartner\" style=\"display: none\">-->
            // <!--    <label for=\"brutoloonpartner\">Bruto jaarloon van je partner</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloonpartner\" />-->
            // <!--    <label for=\"geboortedatumpartner\">Geboortedatum van je partner</label><input class=\"form-breedte250\" type=\"date\" id=\"geboortedatumpartner\" />-->
            // <!--</div>-->
            
            echo "<div class=\"form-breedte250\">";
    //            echo "<label for=\"postcodehuis\">Postcode van het huis</label><input class=\"form-breedte250\" type=\"text\" id=\"postcodehuis\" style=\"display: inline-block; width: 95%;\" />";
    //            echo "<label for=\"huisnummerhuis\">Huisnummer van het huis</label><input class=\"form-breedte250\" type=\"number\" id=\"huisnummerhuis\" style=\"display: inline-block; width: 95%;\" />";
    
                echo "<label for=\"waardehuis\">Waarde van het huis</label><input class=\"form-breedte250\" type=\"number\" id=\"waardehuis\" style=\"display: inline-block; width: 95%;\" />";
    
            echo "</div>";
            
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"koopsom\">Koopsom van het huis</label><input class=\"form-breedte250\" type=\"number\" id=\"koopsom\" style=\"display: inline-block; width: 95%;\" />";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-koopsom-question\" />";
                echo "<div id=\"stap2-koopsom-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-koopsom-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                $tekstStap2koopsom = $atts['stap2-koopsom'] == '' ? 'stap2-koopsom' : $atts['stap2-koopsom'];
                echo "<div style=\"padding:15px;\">".$tekstStap2koopsom."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"overdrachtsbelasting\">Overdrachtsbelasting</label><input class=\"form-breedte250\" type=\"number\" id=\"overdrachtsbelasting\" disabled=\"disabled\" style=\"display: inline-block; width: 95%;\" />";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-overdrachtsbelasting-question\" />";
                echo "<div id=\"stap2-overdrachtsbelasting-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-overdrachtsbelasting-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                $tekstStap2Overdrachtsbelasting = $atts['stap2-overdrachtsbelasting'] == '' ? 'stap2-overdrachtsbelasting' : $atts['stap2-overdrachtsbelasting'];
                echo "<div style=\"padding:15px;\">".$tekstStap2Overdrachtsbelasting."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"leveringsakte-notaris\">Kosten leveringsakte notaris</label><input class=\"form-breedte250\" type=\"number\" id=\"leveringsakte-notaris\" value=\"800\" style=\"display: inline-block; width: 95%;\" />";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-leveringsakte-question\" />";
                echo "<div id=\"stap2-leveringsakte-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-leveringsakte-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                $tekstStap2Leveringsakte = $atts['stap2-leveringsakte'] == '' ? 'stap2-leveringsakte' : $atts['stap2-leveringsakte'];
                echo "<div style=\"padding:15px;\">".$tekstStap2Leveringsakte."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"hypotheekakte-notaris\">Kosten hypotheekakte notaris</label><input class=\"form-breedte250\" type=\"number\" id=\"hypotheekakte-notaris\" value=\"800\" style=\"display: inline-block; width: 95%;\" />";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-hypotheekakte-question\" />";
                echo "<div id=\"stap2-hypotheekakte-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-hypotheekakte-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                $tekstStap2Hypotheekakte = $atts['stap2-hypotheekakte'] == '' ? 'stap2-hypotheekakte' : $atts['stap2-hypotheekakte'];
                echo "<div style=\"padding:15px;\">".$tekstStap2Hypotheekakte."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"taxatie\">Kosten taxatie</label><input class=\"form-breedte250\" type=\"number\" id=\"taxatie\" value=\"500\" style=\"display: inline-block; width: 95%;\" />";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-taxatie-question\" />";
                echo "<div id=\"stap2-taxatie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-taxatie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                $tekstStap2Taxatie = $atts['stap2-taxatie'] == '' ? 'stap2-taxatie' : $atts['stap2-taxatie'];
                echo "<div style=\"padding:15px;\">".$tekstStap2Taxatie."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"commissie\">Kosten commissie</label><input class=\"form-breedte250\" type=\"number\" id=\"commissie\" value=\"700\" disabled=\"disabled\" style=\"display: inline-block; width: 95%;\" />";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-commissie-question\" />";
                echo "<div id=\"stap2-commissie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-commissie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                $tekstStap2Commissie = $atts['stap2-commissie'] == '' ? 'stap2-commissie' : $atts['stap2-commissie'];
                echo "<div style=\"padding:15px;\">".$tekstStap2Commissie."</div></div>";
            echo "</div>";

            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"rentevasteperiode\">Rentevaste periode</label>";
                echo "<select class=\"form-breedte250\" id=\"rentevasteperiode\" style=\"display: inline-block; width: 95%;\" />";
                    echo "<option value=\"1\">1</option>";
                    echo "<option value=\"5\">5</option>";
                    echo "<option value=\"10\" selected>10</option>";
                    echo "<option value=\"20\">20</option>";
                    echo "<option value=\"30\">30</option>";
                echo "</select>";

                // echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-commissie-question\" />";
                // echo "<div id=\"stap2-commissie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-commissie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                // $tekstStap2Commissie = $atts['stap2-commissie'] == '' ? 'stap2-commissie' : $atts['stap2-commissie'];
                // echo "<div style=\"padding:15px;\">".$tekstStap2Commissie."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<label for=\"soorthypotheek\">Soort hypotheek</label>";
                echo "<select class=\"form-breedte250\" id=\"soorthypotheek\" style=\"display: inline-block; width: 95%;\" />";
                    echo "<option value=\"annuity\">Annuïteiten</option>";
                    echo "<option value=\"linear\">Lineair</option>";
                echo "</select>";
                // echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-commissie-question\" />";
                // echo "<div id=\"stap2-commissie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-commissie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                // $tekstStap2Commissie = $atts['stap2-commissie'] == '' ? 'stap2-commissie' : $atts['stap2-commissie'];
                // echo "<div style=\"padding:15px;\">".$tekstStap2Commissie."</div></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<div id=\"nhg-vraag\">";
                    echo "<input type=\"checkbox\" id=\"nhg\">Nationale Hypotheek Garantie?";
                    echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-nhg-question\" />";
                    echo "<div id=\"stap2-nhg-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-nhg-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
                    $tekstStap2nhg = $atts['stap2-nhg'] == '' ? 'stap2-nhg' : $atts['stap2-nhg'];
                    echo "<div style=\"padding:15px;\">".$tekstStap2nhg."</div></div>";
                    echo "<div id=\"metNHG\" style=\"display:none;\">";
                        echo "<label for=\"nhgkosten\">Kosten NHG</label><input class=\"form-breedte250\" type=\"number\" id=\"nhgkosten\" disabled=\"disabled\" />";
                    echo "</div><br />";
                echo "</div>";
            echo "</div>";

            echo "<div class=\"form-breedte250\">";
                echo "<input type=\"checkbox\" id=\"eigengeldinbrengen\">Wil je eigen geld inbrengen?";
                echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-eigen-geld-question\" />";
            echo "</div>";
            echo "<div id=\"stap2-eigen-geld-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-eigen-geld-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap2EigenGeld = $atts['eigen-geld'] == '' ? 'eigen-geld' : $atts['eigen-geld'];
            echo "<div style=\"padding:15px;\">".$tekstStap2EigenGeld."</div></div>";
            echo "<div id=\"hoeveeleigengelddiv\" style=\"display: none\">";
                echo "<label for=\"hoeveeleigengeld\">Hoeveel eigen geld wil je inbrengen</label><input class=\"form-breedte250\" type=\"number\" id=\"hoeveeleigengeld\" />";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "Kies een aanbieder uit de lijst:";
                echo "<div id=\"aanbieders\"></div>";
            echo "</div>";
    
            echo "<div class=\"form-breedte250\">";
                echo "<div id=\"max-hypotheek\" style=\"display:none;\">0</div>";
                echo "<div id=\"percentage\" style=\"display:none;\">0</div>";
                echo "<div id=\"resultaat\" style=\"display:none;\"><span id=\"result\"></span></div>";
        
                echo "<label for=\"benodigdehypotheek\">Hoeveel hypotheek ben je nodig</label><input class=\"form-breedte250\" type=\"number\" id=\"benodigdehypotheek\" />";
            echo "</div>";
    
            // <!--<div id=\"text-benodigde-hypotheek\"></div>-->
            echo "<div id=\"resultaat\" style=\"display:none;\">Je maximale hypotheek is : <span id=\"result\"></span></div>";
            echo "<div id=\"eigen-middelen\" style=\"display:none;\">Dat betekent dat je als eigen middelen moet inbrengen : <span id=\"eigen-middelen-bedrag\"></span></div>";
    
            // <!--<h3>Hypotheekvorm</h3>-->
            // <!--<input class=\"form-breedte250\" type=\"radio\" id=\"annuiteiten\" name=\"hypotheekvorm\">Annuiteiten-->
            // <!--<input class=\"form-breedte250\" type=\"radio\" id=\"lineair\" name=\"hypotheekvorm\">Lineair-->
            // <!--<label for=\"rentevasteperiode\">Rentevaste periode</label><input class=\"form-breedte250\" type=\"number\" id=\"rentevasteperiode\" />-->
        
            echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap1\" value=\"Terug\" />";
            echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap3\" value=\"Naar stap 3\" />";
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
                echo "<td><span id=\"brutomaandlast-sidebar\">€0</span></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td>Netto maandlast (eerste maand)</td>";
                echo "<td><span id=\"nettomaandlast-sidebar\">€0</span></td>";
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