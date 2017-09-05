<?php
    echo "<h3>Rekeninggegevens</h3>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"iban\">Wat is je IBAN rekeningnummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"iban\" maxlength=\"18\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"gezamenlijke-rekening-ja-nee\">Betreft dit een gezamenlijke rekening</label><br />";
        echo "<input type=\"radio\" name=\"gezamenlijke-rekening-ja-nee\" value=\"ja\">Ja<br />";
        echo "<input type=\"radio\" name=\"gezamenlijke-rekening-ja-nee\" value=\"nee\">Nee<br />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"tenaamstelling\">Wat is de tenaamstelling van deze IBAN rekening?</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"tenaamstelling\" />";
    echo "</div>";

    echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap4\" value=\"Terug\" />";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap6\" value=\"Naar stap 6\" />";
?>