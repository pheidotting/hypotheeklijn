<?php
echo "<form class=\"avia_ajax_form av-form-labels-visible   avia-builder-el-11  avia-builder-el-no-sibling\"><fieldset>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"geboortedatum\">Wat is je geboortedatum?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"geboortedatum\" />";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"soort-inkomsten\">Waaruit ontvang je inkomsten?</label>";
        echo "<select id=\"soort-inkomsten\" class=\"form-breedte75-procent text_input is_empty\">";
        echo "<option value=\"\"></option>";
        echo "<option value=\"loondienst\">Loon uit vast dienstverband</option>";
        echo "<option value=\"loondienst\">Loon uit tijdelijk dienstverband met intentieverklaring</option>";
        echo "<option value=\"onbepaalde-tijd\">Loon uit tijdelijk dienstverband zonder intentieverklaring</option>";
        echo "<option value=\"onderneming\">Loon uit onderneming</option>";
        echo "</select>";

        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-soort-inkomsten-question\" />";
        echo "<div id=\"stap1-soort-inkomsten-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-soort-inkomsten-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">";
            echo "<b><u>Werk je in loondienst?</u></b>";
            echo "<br />";
            echo "<br />";
            echo "Maak dan de keuze uit het dienstverband. Dit moet overeenkomen met de werkgeversverklaring. Verdien je per maand, 4 weken of in een ander tijdvak? Deel dan het bedrag van het bruto jaarsalaris op de werkgeversverklaring door 12 maanden. Vul dit bedrag in bij het bruto maandsalaris.";
            echo "<br />";
            echo "<br />";
            echo "Ontvang je vakantiegeld en/ of 13emaanddan kan je dit aanvinken. Ontvang je ander inkomen dan deze inkomensbestandsdelen, vul dan het totaal van deze bestandsdelen in bij het veld “Ontvang je andere vaste inkomsten?”. Let op: Dit inkomen dient vast te zijn en kan worden overgenomen van de werkgeversverklaring.";
            echo "<br />";
            echo "<br />";
            echo "<b><u>Ben je ondernemer?</u></b>";
            echo "<br />";
            echo "<br />";
            echo "Vul danhet <b><u>saldo fiscale winst</u></b> uit de inkomstenbelastingaangifte in. Let op: vul van de afgelopen 3 hele jaren het saldo fiscale winst apart in. Bijvoorbeeld 2014, 2015, 2016. Heb je vragen over de jaarrekeningen en IB aangiften en weet je niet waar je de fiscale winst kunt vinden? Onze hypotheekspecialisten helpen je graag verder.";
        echo "</div></div>";
    echo "</div>";
    
    echo "<div id=\"loon-uit-loondienst\" style=\"display:none;\">";
        echo "<div class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"brutomaandloon\">Wat is je bruto maandsalaris?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"brutomaandloon\" />";
        echo "</div><br />";
        echo "Ontvang je een dertiende maand ?&nbsp;<input type=\"checkbox\" id=\"dertiendemaand\" /><br />";
        echo "Ontvang je vakantiegeld ?&nbsp;<input type=\"checkbox\" id=\"vakantiegeld\" /><br />";

        echo "<div class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"andereinkomsten\">Ontvang je andere vaste inkomsten?</label><input id=\"andereinkomsten\"class=\"form-breedte75-procent text_input is_empty\" type=\"number\" />";
        echo "</div>";

        echo "<div class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"brutoloon\">Je bruto jaarsalaris bedraagt</label><input id=\"brutoloon\"class=\"form-breedte75-procent text_input is_empty\" type=\"number\" />";
        echo "</div>";
    echo "</div>";

    echo "<div id=\"loon-uit-onderneming\" style=\"display:none;\">";
        echo "<p class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"inkomenEen\">Inkomen uit <span name=\"jaarEenTekst\"></span></label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"inkomenEen\" />";
        echo "</p>";
        echo "<p class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"inkomenTwee\">Inkomen uit <span name=\"jaarTweeTekst\"></span></label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"inkomenTwee\" />";
        echo "</p>";
        echo "<p class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"inkomenDrie\">Inkomen uit <span name=\"jaarDrieTekst\"></span></label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"inkomenDrie\" />";
        echo "</p>";

        echo "Je bruto jaarloon : <span id=\"brutoloon-onderneming-opgemaakt\"></span><span id=\"brutoloon-onderneming\" style=\"display:none;\"></span><br />";
    echo "</div>";
    
    echo "<br />";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"partner\">Ga je een woning aankopen met je partner?</label>";
        echo "<input type=\"radio\" name=\"partner\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"partner\" value=\"nee\">Nee<br />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-met-partner-question\" />";
        
        echo "<div id=\"stap1-met-partner-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-met-partner-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">Als je een woning gaat aankopen met je partner dan kan je zeer waarschijnlijk meer lenen als je partner ook inkomen heeft. Het inkomen van je partner heeft dus invloed op de maximale hypotheek.</div></div>";
    echo "</div>";

    echo "<div id=\"metPartner\" style=\"display: none\">";
        echo "<br />";
    
        echo "<div class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"geboortedatumpartner\">Geboortedatum van je partner</label>";
            echo "<input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"geboortedatumpartner\" />";
        echo "</div>";

        echo "<div class=\"first_form form_element form_fullwidth\">";
            echo "<label for=\"soort-inkomsten-partner\">Kies soort inkomsten</label>";
            echo "<select id=\"soort-inkomsten-partner\" class=\"form-breedte75-procent text_input is_empty\">";
            echo "<option value=\"\"></option>";
            echo "<option value=\"loondienst\">Loon uit vast dienstverband</option>";
            echo "<option value=\"loondienst\">Loon uit tijdelijk dienstverband met intentieverklaring</option>";
            echo "<option value=\"onbepaalde-tijd\">Loon uit tijdelijk dienstverband zonder intentieverklaring</option>";
            echo "<option value=\"onderneming\">Loon uit onderneming</option>";
            echo "</select>";
        echo "</div>";
        
        // echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-soort-inkomsten-question\" />";
        // echo "<div id=\"stap1-soort-inkomsten-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-soort-inkomsten-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        // $tekstStap1SoortInkomsten = $atts['stap1-soort-inkomsten'] == '' ? 'stap1-soort-inkomsten' : $atts['stap1-soort-inkomsten'];
        // echo "<div style=\"padding:15px;\">".$tekstStap1SoortInkomsten."</div></div>";
    
        echo "<div id=\"loon-uit-loondienst-partner\" style=\"display:none;\">";
            echo "<div class=\"first_form form_element form_fullwidth\">";
                echo "<label for=\"brutomaandloon\">Wat is je partners bruto maandsalaris?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"brutomaandloonpartner\" />";
            echo "</div><br />";
            echo "Ontvangt je partner een dertiende maand ?&nbsp;<input type=\"checkbox\" id=\"dertiendemaandpartner\" /><br />";
            echo "Ontvangt je partner vakantiegeld ?&nbsp;<input type=\"checkbox\" id=\"vakantiegeldpartner\" /><br />";

            echo "<div class=\"first_form form_element form_fullwidth\">";
                echo "<label for=\"andereinkomstenpartner\">Ontvangt je partner andere vaste inkomsten?</label><input id=\"andereinkomstenpartner\"class=\"form-breedte75-procent text_input is_empty\" type=\"number\" />";
            echo "</div>";
    
            echo "<div class=\"first_form form_element form_fullwidth\">";
                echo "<label for=\"brutoloon\">Je partner bruto jaarsalaris bedraagt</label><input id=\"brutoloonpartner\"class=\"form-breedte75-procent text_input is_empty\" type=\"number\" />";
            echo "</div>";
        echo "</div>";
    
        echo "<div id=\"loon-uit-onderneming-partner\" style=\"display:none;\">";
            echo "<div class=\"first_form form_element form_fullwidth\">";
                echo "<label for=\"inkomenEen\">Inkomen uit <span name=\"jaarEenTekst\"></span></label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"inkomenEenPartner\" />";
            echo "</div>";
            echo "<div class=\"first_form form_element form_fullwidth\">";
                echo "<label for=\"inkomenTwee\">Inkomen uit <span name=\"jaarTweeTekst\"></span></label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"inkomenTweePartner\" />";
            echo "</div>";
            echo "<div class=\"first_form form_element form_fullwidth\">";
                echo "<label for=\"inkomenDrie\">Inkomen uit <span name=\"jaarDrieTekst\"></span></label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"inkomenDriePartner\" />";
            echo "</div>";
    
            echo "Je bruto jaarloon : <span id=\"brutoloon-onderneming-opgemaakt-partner\"></span><span id=\"brutoloon-onderneming-partner\" style=\"display:none;\"></span><br />";
        echo "</div>";
        echo "<br />";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"studieschuld\">Heb je een studieschuld?</label>";
        echo "<input type=\"radio\" name=\"studieschuld\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"studieschuld\" value=\"nee\">Nee<br />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-studieschuld-question\" />";
        echo "<div id=\"stap1-studieschuld-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-studieschuld-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">Als je een studieschuld hebt, wordt dit momenteel niet geregistreerd bij het Bureau Krediet Registratie (BKR). Echter heeft dit wel invloed op je financiële situatie en daarom ben je verplicht deze aan ons te melden. Dit zal ook van invloed zijn op de maximale hypotheek wat je kunt lenen. De hoogte van de oorspronkelijke studieschuld kan je invullen, echter zal een acceptant hierover contact met je opnemen.</div></div>";
        echo "<div id=\"hoeveelstudieschuldDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelstudieschuld\">Hoeveel?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveelstudieschuld\" />";
        echo "</div>";
    echo "</div>";
    
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"roodstaan\">Mag je rood staan?</label>";
        echo "<input type=\"radio\" name=\"roodstaan\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"roodstaan\" value=\"nee\">Nee<br />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-roodstaan-question\" />";
        echo "<div id=\"stap1-roodstaan-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-roodstaan-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">Als je rood mag staan op je betaalrekening, dan heb je een soort van krediet. Immers is het een lening bij de bank waar je debetrente over betaald. Daarom weegt roodstand mee in de berekening van je maximale hypotheek. Deze roodstand wordt ook geregistreerd bij het Bureau Krediet Registratie (BKR).Vul daarom het bedrag in dat je rood mag staan.</div></div>";
        echo "<div id=\"hoeveelroodstaanDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelroodstaan\">Hoeveel?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveelroodstaan\" />";
        echo "</div>";
    echo "</div>";
    
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"creditcard\">Heb je een creditcard?</label>";
        echo "<input type=\"radio\" name=\"creditcard\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"creditcard\" value=\"nee\">Nee<br />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-creditcard-question\" />";
        echo "<div id=\"stap1-creditcard-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-creditcard-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">Heb je een creditcard waarbij je de mogelijkheid hebt om het openstaande saldo gespreid te betalen, geef dan het limiet op. Een creditcard waarbij gespreid betalen mogelijk is, heeft invloed op de maximale hypotheek die je kan lenen. Heb je een creditcard waarbij het uitstaande saldo ineens wordt geïncasseerd, bijv. maandelijks dan hoef je dit <u>niet</u> op te geven in de aanvraag. </div></div>";
        echo "<div id=\"hoeveelcreditcardDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelcreditcard\">Wat is de limiet?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveelcreditcard\" />";
        echo "</div>";
    echo "</div>";
    
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"partneralimentatie\">Betaal je partneralimentatie?</label>";
        echo "<input type=\"radio\" name=\"partneralimentatie\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"partneralimentatie\" value=\"nee\">Nee<br />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-partneralimentatie-question\" />";
        echo "<div id=\"stap1-partneralimentatie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-partneralimentatie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">Betaal je op dit moment alimentatie  voor je ex-partner, geef dan het bedrag dat je per jaar betaald op in de aanvraag. Partneralimentatie heeft invloed op de maximale hypotheek die je kan lenen. Let op: kinderalimentatie hoeft niet te worden opgegeven.</div></div>";
        echo "<div id=\"hoeveelpartneralimentatieDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveelpartneralimentatie\">Hoeveel?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveelpartneralimentatie\" />";
        echo "</div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"overigeleningen\">Heb je overige leningen of kredieten?</label>";
        echo "<input type=\"radio\" name=\"overigeleningen\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"overigeleningen\" value=\"nee\">Nee<br />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:2px; cursor: pointer;\" id=\"stap1-overigeleningen-question\" />";
        echo "<div id=\"stap1-overigeleningen-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-overigeleningen-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        echo "<div style=\"padding:15px;\">Het kan zijn dat je een lening of krediet hebt wat hierboven nietgenoemd wordt. Denk hierbij aan bijv. een persoonlijke lening, doorlopend krediet, autolease (private lease), telefoon op afbetaling, etc. Neem van de lening of het krediet de oorspronkelijke kredietsom en vul deze in. Heb je meerdere leningen of kredieten tel dan de kredietsommen bij elkaar op en geef het totaal op in de aanvraag. Deze leningen of kredieten worden ook geregistreerd bij het Bureau Krediet Registratie (BKR).</div></div>";
        echo "<div id=\"hoeveeloverigeleningenDiv\" style=\"display: none\">";
            echo "<label for=\"hoeveeloverigeleningen\">Hoeveel?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveeloverigeleningen\" />";
        echo "</div>";
    echo "</div>";
    
    echo "</fieldset></form>";
    if ($simulatie) {
        echo "<p class=\"form_element\">";
            echo "<input type=\"submit\" class=\"button\" id=\"bereken-max-hypotheek\" value=\"Bereken mijn maximale hypotheek\" />";
        echo "</p>";
        echo "<br />";
        echo "<br />";
        echo "<div class=\"stappenteller\" id=\"stappenteller\">Jouw maximale hypotheek is : <span id=\"sidebar-max-hypotheek\"></span></div>";
    } else {
        echo "<p class=\"form_element\">";
            echo "<input type=\"submit\" class=\"button`\" id=\"naar-stap2\" value=\"Naar stap 2\" />";
        echo "</p>";
    }
?>