<?php
    echo "<h3>Identiteitsgegevens</h3>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"bsn\">Burgerservicenummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"bsn\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"soortlegitimatie\">Soort legitimatiebewijs</label>";
        echo "<select id=\"soortlegitimatie\" class=\"form-breedte75-procent text_input is_empty\">";
            echo "<option value=\"\"></option>";
            echo "<option value=\"Nederlands paspoort\">Nederlands paspoort</option>";
            echo "<option value=\"Nederlandse identiteitskaart\">Nederlandse identiteitskaart</option>";
        echo "</select>";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"documentnummer\">Documentnummer legitimatiebewijs</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"documentnummer\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"datumgeldigheid\">Tot wanneer is je legitimatiebewijs geldig</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"datumgeldigheid\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"gemeente\">In welke gemeente is je legitimatiebewijs afgegeven</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"gemeente\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"geboorteplaats\">Geboorteplaats</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"geboorteplaats\" />";
    echo "</div>";

    echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap3\" value=\"Terug\" />";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap5\" value=\"Naar stap 5\" />";
?>