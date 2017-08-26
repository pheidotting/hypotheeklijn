<?php
    echo "<input type=\"checkbox\" id=\"loon-uit-onderneming-check\">Loon uit eigen onderneming toevoegen?<br />";
    echo "<div id=\"loon-uit-onderneming\" style=\"display:none;\">";
        echo "<label for=\"inkomenEen\">Inkomen uit <span name=\"jaarEenTekst\">b</span></label><input class=\"form-breedte250\" type=\"number\" id=\"inkomenEen\" />";
        echo "<label for=\"inkomenTwee\">Inkomen uit <span name=\"jaarTweeTekst\"></span></label><input class=\"form-breedte250\" type=\"number\" id=\"inkomenTwee\" />";
        echo "<label for=\"inkomenDrie\">Inkomen uit <span name=\"jaarDrieTekst\"></span></label><input class=\"form-breedte250\" type=\"number\" id=\"inkomenDrie\" />";

        echo "Je bruto jaarloon uit onderneming :<span id=\"brutoloon-onderneming\"></span><br />";
    echo "</div>";

    echo "<input type=\"checkbox\" id=\"loon-uit-loondienst-check\">Loon uit loondienst toevoegen?<br />";
    echo "<div id=\"loon-uit-loondienst\" style=\"display:none;\">";
        echo "<label for=\"brutomaandloon\">Je bruto maandloon</label><input class=\"form-breedte250\" type=\"number\" id=\"brutomaandloon\" />";
        echo "Ontvang je een dertiende maand ?&nbsp;<input type=\"checkbox\" id=\"dertiendemaand\" /><br />";
        echo "Ontvang je vakantiegeld ?&nbsp;<input type=\"checkbox\" id=\"vakantiegeld\" /><br />";

        echo "<label for=\"brutoloon\">Je bruto jaarloon :</label><input id=\"brutoloon\"class=\"form-breedte250\" type=\"number\" />";
    echo "</div>";
    
    echo "<label for=\"geboortedatum\">Je geboortedatum</label><input class=\"form-breedte250\" type=\"text\" id=\"geboortedatum\" />";
    
    echo "<div class=\"form-breedte250\">";
        echo "<input type=\"checkbox\" id=\"partner\">Met partner?";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap1-met-partner-question\" />";
    echo "</div>";
    echo "<div id=\"stap1-met-partner-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap1-met-partner-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
    $tekstStap1MetPartner = $atts['stap1-met-partner'] == '' ? 'stap1-met-partner' : $atts['stap1-met-partner'];
    echo "<div style=\"padding:15px;\">".$tekstStap1MetPartner."</div></div>";

    echo "<div id=\"metPartner\" style=\"display: none\">";
        echo "<input type=\"checkbox\" id=\"loon-uit-onderneming-partner-check\">Loon uit eigen onderneming toevoegen?<br />";
        echo "<div id=\"loon-uit-onderneming-partner\" style=\"display:none;\">";
            echo "<label for=\"inkomenEenPartner\">Inkomen uit <span name=\"jaarEenTekst\"></span></label><input class=\"form-breedte250\" type=\"number\" id=\"inkomenEenPartner\" />";
            echo "<label for=\"inkomenTweePartner\">Inkomen uit <span name=\"jaarTweeTekst\"></span></label><input class=\"form-breedte250\" type=\"number\" id=\"inkomenTweePartner\" />";
            echo "<label for=\"inkomenDriePartner\">Inkomen uit <span name=\"jaarDrieTekst\"></span></label><input class=\"form-breedte250\" type=\"number\" id=\"inkomenDriePartner\" />";

            echo "Je partners bruto jaarloon uit onderneming :<span id=\"brutoloon-onderneming-partner\"></span><br />";
        echo "</div>";

        echo "<input type=\"checkbox\" id=\"loon-uit-loondienst-partner-check\">Loon uit loondienst toevoegen?<br />";
        echo "<div id=\"loon-uit-loondienst-partner\" style=\"display:none;\">";
            echo "<label for=\"brutomaandloonpartner\">Je partners bruto maandloon</label><input class=\"form-breedte250\" type=\"number\" id=\"brutomaandloonpartner\" />";
            echo "Ontvangt je partner een dertiende maand ?&nbsp;<input type=\"checkbox\" id=\"dertiendemaandpartner\" /><br />";
            echo "Ontvangt je partner vakantiegeld ?&nbsp;<input type=\"checkbox\" id=\"vakantiegeldpartner\" /><br />";

            echo "<label for=\"brutoloonpartner\">Je partners bruto jaarloon :</label><input id=\"brutoloonpartner\"class=\"form-breedte250\" type=\"number\" />";
        echo "</div>";

        // echo "<label for=\"brutoloonpartner\">Bruto jaarloon van je eventuele partner</label><input class=\"form-breedte250\" type=\"number\" id=\"brutoloonpartner\" />";
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
    
    if ($simulatie) {
        echo "<input type=\"submit\" class=\"button-primary\" id=\"bereken-max-hypotheek\" value=\"Bereken mijn maximale hypotheek\" />";
        echo "<br />";        
        echo "Jouw maximale hypotheek is : <span id=\"sidebar-max-hypotheek\"></span>";
    } else {
        echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap2\" value=\"Naar stap 2\" />";
    }
?>