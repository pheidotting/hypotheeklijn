<?php
    echo "<h3>Hypotheek samenstellen</h3>";
    echo "<h2>Risicopercentage <span id=\"risico-percentage\"></span></h2>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"koopsom\">Koopsom van de woning</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"koopsom\" />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-koopsom-question\" />";
        echo "<div id=\"stap2-koopsom-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-koopsom-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        $tekstStap2koopsom = $atts['stap2-koopsom'] == '' ? 'stap2-koopsom' : $atts['stap2-koopsom'];
        echo "<div style=\"padding:15px;\">".$tekstStap2koopsom."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"verbouwen-ja-nee\">Wil je gaan verbouwen in de nieuwe woning</label><br />";
        echo "<input type=\"radio\" name=\"verbouwen-ja-nee\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"verbouwen-ja-nee\" value=\"nee\">Nee<br />";
        echo "<div id=\"verbouwen-ja\" style=\"display:none;\">";
            echo "Om te kunnen bepalen of je een bouwdepot mee kunt nemen in je aanvraag is het van belang dat je even gaat sparren met onze specialisten. Zij kunnen je vertellen of dit kunt opgeven in de aanvraag. ";
            echo "<label for=\"verbouwingskosten\">Wat zijn de geschatte verbouwingskosten</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"verbouwingskosten\" />";
        echo "</div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"waardehuis\">Waarde van de woning</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"waardehuis\" />";
    echo "</div>";
    
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"overdrachtsbelasting\">Overdrachtsbelasting</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"overdrachtsbelasting\" disabled=\"disabled\" />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-overdrachtsbelasting-question\" />";
        echo "<div id=\"stap2-overdrachtsbelasting-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-overdrachtsbelasting-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        $tekstStap2Overdrachtsbelasting = $atts['stap2-overdrachtsbelasting'] == '' ? 'stap2-overdrachtsbelasting' : $atts['stap2-overdrachtsbelasting'];
        echo "<div style=\"padding:15px;\">".$tekstStap2Overdrachtsbelasting."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"leveringsakte-notaris\">Kosten leveringsakte notaris</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"leveringsakte-notaris\" value=\"800\" />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-leveringsakte-question\" />";
        echo "<div id=\"stap2-leveringsakte-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-leveringsakte-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        $tekstStap2Leveringsakte = $atts['stap2-leveringsakte'] == '' ? 'stap2-leveringsakte' : $atts['stap2-leveringsakte'];
        echo "<div style=\"padding:15px;\">".$tekstStap2Leveringsakte."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"hypotheekakte-notaris\">Kosten hypotheekakte notaris</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hypotheekakte-notaris\" value=\"800\" />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-hypotheekakte-question\" />";
        echo "<div id=\"stap2-hypotheekakte-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-hypotheekakte-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        $tekstStap2Hypotheekakte = $atts['stap2-hypotheekakte'] == '' ? 'stap2-hypotheekakte' : $atts['stap2-hypotheekakte'];
        echo "<div style=\"padding:15px;\">".$tekstStap2Hypotheekakte."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"taxatie\">Kosten taxatie</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"taxatie\" value=\"500\" />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-taxatie-question\" />";
        echo "<div id=\"stap2-taxatie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-taxatie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        $tekstStap2Taxatie = $atts['stap2-taxatie'] == '' ? 'stap2-taxatie' : $atts['stap2-taxatie'];
        echo "<div style=\"padding:15px;\">".$tekstStap2Taxatie."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"commissie\">Kosten Hypotheeklijn</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"commissie\" value=\"700\" disabled=\"disabled\" />";
        echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-commissie-question\" />";
        echo "<div id=\"stap2-commissie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-commissie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        $tekstStap2Commissie = $atts['stap2-commissie'] == '' ? 'stap2-commissie' : $atts['stap2-commissie'];
        echo "<div style=\"padding:15px;\">".$tekstStap2Commissie."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"rentevasteperiode\">Rentevaste periode</label>";
        echo "<select class=\"form-breedte75-procent text_input is_empty\" id=\"rentevasteperiode\" />";
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

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"soorthypotheek\">Soort hypotheek</label>";
        echo "<select class=\"form-breedte75-procent text_input is_empty\" id=\"soorthypotheek\" />";
            echo "<option value=\"\"></option>";
            echo "<option value=\"annuity\">Annuïteiten</option>";
            echo "<option value=\"linear\">Lineair</option>";
        echo "</select>";
        // echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-commissie-question\" />";
        // echo "<div id=\"stap2-commissie-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-commissie-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
        // $tekstStap2Commissie = $atts['stap2-commissie'] == '' ? 'stap2-commissie' : $atts['stap2-commissie'];
        // echo "<div style=\"padding:15px;\">".$tekstStap2Commissie."</div></div>";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<div id=\"nhg-vraag\">";
            echo "<input type=\"checkbox\" id=\"nhg\">Wil je een hypotheek met Nationale Hypotheek Garantie, ja of nee?";
            echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-nhg-question\" />";
            echo "<div id=\"stap2-nhg-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-nhg-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
            $tekstStap2nhg = $atts['stap2-nhg'] == '' ? 'stap2-nhg' : $atts['stap2-nhg'];
            echo "<div style=\"padding:15px;\">".$tekstStap2nhg."</div></div>";
            echo "<div id=\"metNHG\" style=\"display:none;\">";
                echo "<label for=\"nhgkosten\">Kosten NHG</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"nhgkosten\" disabled=\"disabled\" />";
            echo "</div><br />";
        echo "</div>";
    echo "</div>";

    // echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "Kies een geldverstrekker uit de lijst:";
        echo "<br />";
        echo "<div id=\"aanbieders\"></div>";
    // echo "</div>";
    
    echo "<table>";
        echo "<tr>";
            echo "<td>Leencapaciteit op basis van je loon</td><td><span id=\"result\"></span><span id=\"result-getal\" style=\"display:none;\"></span></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Leencapaciteit op basis van de waarde van de woning</td><td><span id=\"max-hypotheek\"></span><span id=\"max-hypotheek-getal\" style=\"display:none;\"></span></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Hoeveel hypotheek heb je nodig om je woning te kunnen financieren? </td><td><span id=\"benodigdehypotheek\"></span><span id=\"benodigdehypotheek-getal\" style=\"display:none;\"></span></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Dat betekent dat je aan eigen middelen moet inbrengen</td><td><span id=\"eigen-middelen-bedrag\"></span><span id=\"eigen-middelen-bedrag-getal\" style=\"display:none;\"></span></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Wil je meer dan het verplichte bedrag inbrengen?</td><td><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveeleigengeld-getal\" /></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Jouw hypotheek wordt</td><td><span id=\"telenen\"></span><span id=\"telenen-getal\" style=\"display:none;\"></span></td>";
        echo "</tr>";
    echo "</table>";

    echo "<div id=\"orv-gegevens\">";
        echo "<h3>Overlijdensrisicoverzekering</h3>";
        echo "Je hebt een hypotheek aangevraagd van <span id=\"telenen-orv\"></span><span id=\"orv-met-nhg\" style=\"display:none;\"> met Nationale Hypotheek Garantie</span>. ";
        echo "Aangezien de hypotheek hoger is dan 80% van de waarde van de woning, moet je dit gedeelte afdekken met een overlijdensrisicoverzekering (orv). ";
        echo "Het minimaal te verzekeren bedrag betreft: <span name=\"orv-bedrag\"></span>. Heb je een partner ingevoerd, dan dient dit bedrag tevens voor de partner te zijn afgedekt. ";
        echo "Heb je al een orv afgesloten?<br />";
        echo "<input type=\"radio\" name=\"orv-ja-nee\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"orv-ja-nee\" value=\"nee\">Nee<br />";
        echo "<div id=\"orv-ja\" style=\"display:none;\">";
            echo "Is het bedrag wat je hebt verzekerd minimaal <span name=\"orv-bedrag\"></span><br />";
            echo "<input type=\"radio\" name=\"orv-ja-minimaal-bedrag-ja-nee\" value=\"ja\">Ja<br />";
            echo "<input type=\"radio\" name=\"orv-ja-minimaal-bedrag-ja-nee\" value=\"nee\">Nee<br />";
            echo "<div id=\"orv-ja-minimaal-bedrag-ja\" style=\"display:none;\">";
                echo "We zullen een kopie polis bij je opvragen nadat de aanvraag bij ons in behandeling is genomen.";
            echo "</div>";
        echo "</div>";
        echo "<div id=\"orv-ja-minimaal-bedrag-nee\" style=\"display:none;\">";
            echo "Hypotheeklijn kan voor jou kijken wat de goedkoopste premie is bij een verzekerd kapitaal van <span name=\"orv-bedrag\"></span> met gelijkblijvende dekking. Wens je dit?<br />";
            echo "<input type=\"radio\" name=\"orv-ja-minimaal-bedrag-nee-wens-ja-nee\" value=\"ja\">Ja<br />";
            echo "<input type=\"radio\" name=\"orv-ja-minimaal-bedrag-nee-wens-ja-nee\" value=\"nee\">Nee<br />";
            echo "<div id=\"orv-ja-minimaal-bedrag-nee-wens-ja\" style=\"display:none;\">";
                echo "Wij verzekeren minimaal het bedrag van <span name=\"orv-bedrag\"></span>, echter kan het zijn dat je meer wilt verzekeren. ";
                echo "In dat geval kan je opgeven hoeveel je wilt verzekeren. Wij zullen je een premievoorstel doen.<br />";
                echo "<input type=\"radio\" name=\"orv-ja-minimaal-bedrag-nee-wens-ja-minimum-bedrag\" value=\"minimum-bedrag\">Ik wil het minimale bedrag verzekeren<br />";
                echo "<input type=\"radio\" name=\"orv-ja-minimaal-bedrag-nee-wens-ja-hoger-bedrag\" value=\"hoger-bedrag\">Ik wil een hoger bedrag verzekeren, namelijk : <br />";
                echo "<input type=\"number\" id=\"hoger-bedrag-verzekeren\" class=\"form-breedte75-procent text_input is_empty\" />";
                echo "<div class=\"first_form form_element form_fullwidth\">";
                    echo "<label for=\"soorthypotheek\">1 of 2 levens verzekeren</label>";
                    echo "<select class=\"form-breedte75-procent text_input is_empty\" id=\"een-of-twee-levens\" />";
                        echo "<option value=\"\"></option>";
                        echo "<option value=\"1\">1</option>";
                        echo "<option value=\"2\">2</option>";
                    echo "</select>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        echo "<br />";
    echo "</div>";
    

    // echo "<div class=\"first_form form_element form_fullwidth\">";
    //     echo "<div id=\"max-hypotheek\" style=\"display:none;\">0</div>";
    //     echo "<div id=\"percentage\" style=\"display:none;\">0</div>";
    //     echo "<div id=\"resultaat\" style=\"display:none;\"><span id=\"result\"></span></div>";

    //     echo "<label for=\"benodigdehypotheek\">Hoeveel hypotheek ben je nodig</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"benodigdehypotheek\" />";
    // echo "</div>";

    // echo "<td><div id=\"resultaat\" style=\"display:none;\">Je maximale hypotheek is : </td><td><span id=\"result\"></span></div></td>";
    

    // <!--<div id=\"text-benodigde-hypotheek\"></div>-->
    // echo "<div id=\"resultaat\" style=\"display:none;\">Je maximale hypotheek is : <span id=\"result\"></span></div>";
    // echo "<div id=\"eigen-middelen\" style=\"display:none;\">Dat betekent dat je als eigen middelen moet inbrengen : <span id=\"eigen-middelen-bedrag\"></span></div>";
    // echo "<span id=\"eigen-middelen-bedrag-backup\" style=\"display:none;\"></span>";

    // echo "<div class=\"first_form form_element form_fullwidth\">";
    //     echo "<input type=\"checkbox\" id=\"eigengeldinbrengen\">Wil je eigen geld inbrengen?";
    //     echo "<img src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/help.png\" style=\"float:right; padding-top:5px; cursor: pointer;\" id=\"stap2-eigen-geld-question\" />";
    // echo "</div>";
    // echo "<div id=\"stap2-eigen-geld-help\" style=\"clear:both; background-color:#dedede; display:none;\"><img id=\"stap2-eigen-geld-kruis\" src=\"../wp-content/plugins/regel-zelf-uw-hypotheek/png/cross.png\" style=\"float:right; cursor: pointer;\" />";
    // $tekstStap2EigenGeld = $atts['eigen-geld'] == '' ? 'eigen-geld' : $atts['eigen-geld'];
    // echo "<div style=\"padding:15px;\">".$tekstStap2EigenGeld."</div></div>";
    // // echo "<div id=\"hoeveeleigengelddiv\">";
    // echo "<label for=\"hoeveeleigengeld\">Inbreng eigen geld</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"hoeveeleigengeld\" />";
    // // echo "</div>";
    // echo "<div>Te lenen : <span id=\"telenen\"></span></div>";

    // <!--<h3>Hypotheekvorm</h3>-->
    // <!--<input class=\"form-breedte75-procent text_input is_empty\" type=\"radio\" id=\"annuiteiten\" name=\"hypotheekvorm\">Annuiteiten-->
    // <!--<input class=\"form-breedte75-procent text_input is_empty\" type=\"radio\" id=\"lineair\" name=\"hypotheekvorm\">Lineair-->
    // <!--<label for=\"rentevasteperiode\">Rentevaste periode</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"number\" id=\"rentevasteperiode\" />-->

    echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap1\" value=\"Terug\" />";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap3\" value=\"Naar stap 3\" />";
?>