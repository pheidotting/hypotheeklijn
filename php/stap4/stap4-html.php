<?php
    echo "<h3>ID gegevens</h3>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"bsn\">Burgerservicenummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"bsn\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"documentnummer\">Documentnummer identificatie</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"documentnummer\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"datumgeldigheid\">Datum geldigheid identificatie</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"datumgeldigheid\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"gemeente\">Gemeente afgifte identificatie</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"gemeente\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"geboorteplaats\">Geboorteplaats</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"geboorteplaats\" />";
    echo "</div>";

    echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap3\" value=\"Terug\" />";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap5\" value=\"Naar stap 5\" />";
?>