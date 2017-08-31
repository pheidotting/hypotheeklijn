jQuery(document).ready(function($) { 
    var geboortedatum;
    $('#huidigestap').text('1');
    
    $('[name=\'jaarEenTekst\']').text(moment().clone().subtract(3, 'years').format('YYYY'));
    $('[name=\'jaarTweeTekst\']').text(moment().clone().subtract(2, 'years').format('YYYY'));
    $('[name=\'jaarDrieTekst\']').text(moment().clone().subtract(1, 'years').format('YYYY'));
    
    $('#brutomaandloon').change(function(){
        berekenBrutojaarloon($('#brutomaandloon'), $('#dertiendemaand'), $('#vakantiegeld'), $('#brutoloon'));
    });
    $('#dertiendemaand').change(function(){
        berekenBrutojaarloon($('#brutomaandloon'), $('#dertiendemaand'), $('#vakantiegeld'), $('#brutoloon'));
    });
    $('#vakantiegeld').change(function(){
        berekenBrutojaarloon($('#brutomaandloon'), $('#dertiendemaand'), $('#vakantiegeld'), $('#brutoloon'));
    });
    $('#brutomaandloonpartner').change(function(){
        berekenBrutojaarloonPartner();
    });
    $('#dertiendemaandpartner').change(function(){
        berekenBrutojaarloonPartner();
    });
    $('#vakantiegeldpartner').change(function(){
        berekenBrutojaarloonPartner();
    });
    $('#loon-uit-onderneming-check').click(function(){
        if($('#loon-uit-onderneming-check').is(':checked')) {
            $('#loon-uit-onderneming').show();
        } else {
            $('#loon-uit-onderneming').hide();
        }
    });
    $('#loon-uit-loondienst-check').click(function(){
        if($('#loon-uit-loondienst-check').is(':checked')) {
            $('#loon-uit-loondienst').show();
        } else {
            $('#loon-uit-loondienst').hide();
        }
    });
    $('#loon-uit-onderneming-partner-check').click(function(){
        if($('#loon-uit-onderneming-partner-check').is(':checked')) {
            $('#loon-uit-onderneming-partner').show();
        } else {
            $('#loon-uit-onderneming-partner').hide();
        }
    });
    $('#loon-uit-loondienst-partner-check').click(function(){
        if($('#loon-uit-loondienst-partner-check').is(':checked')) {
            $('#loon-uit-loondienst-partner').show();
        } else {
            $('#loon-uit-loondienst-partner').hide();
        }
    });
    $('#partner').click(function(){
        if($('#partner').is(':checked')) {
            $('#metPartner').show();
        } else {
            $('#metPartner').hide();
        }
    });
    $('#studieschuld').click(function(){
        if($('#studieschuld').is(':checked')) {
            $('#hoeveelstudieschuldDiv').show();
        } else {
            $('#hoeveelstudieschuldDiv').hide();
        }
    });
    $('#roodstaan').click(function(){
        if($('#roodstaan').is(':checked')) {
            $('#hoeveelroodstaanDiv').show();
        } else {
            $('#hoeveelroodstaanDiv').hide();
        }
    });
    $('#creditcard').click(function(){
        if($('#creditcard').is(':checked')) {
            $('#hoeveelcreditcardDiv').show();
        } else {
            $('#hoeveelcreditcardDiv').hide();
        }
    });
    $('#partneralimentatie').click(function(){
        if($('#partneralimentatie').is(':checked')) {
            $('#hoeveelpartneralimentatieDiv').show();
        } else {
            $('#hoeveelpartneralimentatieDiv').hide();
        }
    });
    $('#overigeleningen').click(function(){
        if($('#overigeleningen').is(':checked')) {
            $('#hoeveeloverigeleningenDiv').show();
        } else {
            $('#hoeveeloverigeleningenDiv').hide();
        }
    });
    $('#naar-stap2').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap1')) {
            $('#huidigestap').text('2');
            hoogteHypotheek(null, true);
    
            $('#stap1').hide();
            $('#stap2').show();
            
            $('#text-benodigde-hypotheek').html('Benodigd bedrag : ' + maakBedragOp($('#benodigdehypotheek').val()));
        }
    });
    $('#inkomenEen').change(function() {
        berekenInkomenEigenOnderneming();
    });
    $('#inkomenTwee').change(function() {
        berekenInkomenEigenOnderneming();
    });
    $('#inkomenDrie').change(function() {
        berekenInkomenEigenOnderneming();
    });
    $('#inkomenEenPartner').change(function() {
        berekenInkomenEigenOndernemingPartner();
    });
    $('#inkomenTweePartner').change(function() {
        berekenInkomenEigenOndernemingPartner();
    });
    $('#inkomenDriePartner').change(function() {
        berekenInkomenEigenOndernemingPartner();
    });
});
