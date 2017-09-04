<?php
    echo "<h3>Persoonlijke gegevens</h3>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"naam\">Naam</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"naam\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"postcode\">Postcode</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"postcode\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"huisnummer\">Huisnummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"huisnummer\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"straatnaam\">Adres</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"straatnaam\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"woonplaats\">Woonplaats</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"woonplaats\" />";
    echo "</div>";

    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"telefoonnummer\">Telefoonnummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"telefoonnummer\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"emailadres\">E-mail adres</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"emailadres\" />";
    echo "</div>";

    echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap2\" value=\"Terug\" />";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-stap4\" value=\"Naar stap 4\" />";
?>