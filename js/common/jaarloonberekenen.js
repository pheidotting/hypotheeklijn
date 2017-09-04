var $ = jQuery;

function berekenBrutojaarloon(brutomaandloon, dertiendemaand, vakantiegeld, resultInput, apikey, apiurl) {
    var brutomaandloon = parseInt(brutomaandloon.val());
    var dertiendemaand = dertiendemaand.is(':checked');
    var vakantiegeld = vakantiegeld.is(':checked');

    opvragenBrutoinkomen(brutomaandloon, dertiendemaand, vakantiegeld, $('#apikey').html(), $('#apiurl').html()).done(function(result) {
        resultInput.val(result);
    });
}