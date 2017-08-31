<?php
    echo "<h3>Gegevens van het onderpand</h3>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"soortwoning\">Soort woning</label>";
        echo "<select class=\"form-breedte75-procent text_input is_empty\" id=\"soortwoning\">";
        echo "<option value=\"eengezinswoning\">Eengezinswoning</option>";
        echo "<option value=\"appartement\">Appartement</option>";
        echo "</select>";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"postcodewoning\">Postcode</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"postcodewoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"huisnummerwonin\">Huisnummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"huisnummerwoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"adreswoning\">Adres</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"adreswoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"plaatswoning\">Plaats</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"plaatswoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"bouwjaarwoning\">Bouwjaar</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"bouwjaarwoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"kadastralegemeentewoning\">Kadastrale gemeente</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"kadastralegemeentewoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"kadastralesectiewoning\">Kadastrale sectie</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"kadastralesectiewoning\" />";
    echo "</div>";
    echo "<div class=\"first_form form_element form_fullwidth\">";
        echo "<label for=\"kadastralenummerwoning\">Kadastrale nummer</label><input class=\"form-breedte75-procent text_input is_empty\" type=\"text\" id=\"kadastralenummerwoning\" />";
    echo "</div>";
    
    echo "<input type=\"submit\" class=\"button-primary\" id=\"terug-naar-stap6\" value=\"Terug\" />";
    echo "&nbsp;";
    echo "&nbsp;";
    echo "<input type=\"submit\" class=\"button-primary\" id=\"naar-bevestigen\" value=\"Naar stap 8\" />";
?>