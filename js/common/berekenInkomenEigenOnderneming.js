var $ = jQuery;

function berekenInkomenEigenOnderneming(inkomenEen, inkomenTwee, inkomenDrie, resultVeld, resultVeldOpgemaakt, apikey, apiurl) {
    var jaarEen = parseInt(inkomenEen.val());
    if (isNaN(jaarEen)) {
        jaarEen = 0;
    }
    var jaarTwee = parseInt(inkomenTwee.val());
    if (isNaN(jaarTwee)) {
        jaarTwee = 0;
    }
    var jaarDrie = parseInt(inkomenDrie.val());
    if (isNaN(jaarDrie)) {
        jaarDrie = 0;
    }

    opvragenBrutoinkomenOndernemer(jaarEen, jaarTwee, jaarDrie, apikey, apiurl).done(function(result) {
        resultVeld.text(result);
        resultVeldOpgemaakt.text(maakBedragOp(result));
    });
}
