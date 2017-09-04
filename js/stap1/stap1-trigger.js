jQuery(document).ready(function($) { 
    var geboortedatum;
    $('#huidigestap').text('1');
    
    $('[name=\'jaarEenTekst\']').text(moment().clone().subtract(3, 'years').format('YYYY'));
    $('[name=\'jaarTweeTekst\']').text(moment().clone().subtract(2, 'years').format('YYYY'));
    $('[name=\'jaarDrieTekst\']').text(moment().clone().subtract(1, 'years').format('YYYY'));
    
    $('#brutomaandloon').click(function() {
        $('#brutomaandloon').val(stripBedragOpmaak($('#brutomaandloon').val()));
    });
    $('#brutomaandloon').blur(function(){
        berekenBrutojaarloon($('#brutomaandloon'), $('#dertiendemaand'), $('#vakantiegeld'), $('#brutoloon'), $('#apikey').html(), $('#apiurl').html());

        $('#brutomaandloon').val(maakBedragOp($('#brutomaandloon').val()));
    });
    $('#dertiendemaand').change(function(){
        berekenBrutojaarloon($('#brutomaandloon'), $('#dertiendemaand'), $('#vakantiegeld'), $('#brutoloon'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#vakantiegeld').change(function(){
        berekenBrutojaarloon($('#brutomaandloon'), $('#dertiendemaand'), $('#vakantiegeld'), $('#brutoloon'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#brutomaandloonpartner').change(function(){
        berekenBrutojaarloon($('#brutomaandloonpartner'), $('#dertiendemaandpartner'), $('#vakantiegeldpartner'), $('#brutoloonpartner'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#dertiendemaandpartner').change(function(){
        berekenBrutojaarloon($('#brutomaandloonpartner'), $('#dertiendemaandpartner'), $('#vakantiegeldpartner'), $('#brutoloonpartner'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#vakantiegeldpartner').change(function(){
        berekenBrutojaarloon($('#brutomaandloonpartner'), $('#dertiendemaandpartner'), $('#vakantiegeldpartner'), $('#brutoloonpartner'), $('#apikey').html(), $('#apiurl').html());
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
        berekenInkomenEigenOnderneming($('#inkomenEen'), $('#inkomenTwee'), $('#inkomenDrie'), $('#brutoloon-onderneming'), $('#brutoloon-onderneming-opgemaakt'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#inkomenTwee').change(function() {
        berekenInkomenEigenOnderneming($('#inkomenEen'), $('#inkomenTwee'), $('#inkomenDrie'), $('#brutoloon-onderneming'), $('#brutoloon-onderneming-opgemaakt'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#inkomenDrie').change(function() {
        berekenInkomenEigenOnderneming($('#inkomenEen'), $('#inkomenTwee'), $('#inkomenDrie'), $('#brutoloon-onderneming'), $('#brutoloon-onderneming-opgemaakt'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#inkomenEenPartner').change(function() {
        berekenInkomenEigenOnderneming($('#inkomenEenPartner'), $('#inkomenTweePartner'), $('#inkomenDriePartner'), $('#brutoloon-onderneming-partner'), $('#brutoloon-onderneming-opgemaakt-partner'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#inkomenTweePartner').change(function() {
        berekenInkomenEigenOnderneming($('#inkomenEenPartner'), $('#inkomenTweePartner'), $('#inkomenDriePartner'), $('#brutoloon-onderneming-partner'), $('#brutoloon-onderneming-opgemaakt-partner'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#inkomenDriePartner').change(function() {
        berekenInkomenEigenOnderneming($('#inkomenEenPartner'), $('#inkomenTweePartner'), $('#inkomenDriePartner'), $('#brutoloon-onderneming-partner'), $('#brutoloon-onderneming-opgemaakt-partner'), $('#apikey').html(), $('#apiurl').html());
    });
    $('#geboortedatum').change(function(){
        var input = $('#geboortedatum').val();
        
        geboortedatum = moment(input, 'DD-MM-YYYY');
        
        if(!geboortedatum._isValid) {
            $('#geboortedatum').val('');
        }
        
        $('#geboortedatum').val(geboortedatum.format('DD-MM-YYYY'));
    });
    $('#geboortedatumpartner').change(function(){
        var input = $('#geboortedatumpartner').val();
        
        geboortedatum = moment(input, 'DD-MM-YYYY');
        
        if(!geboortedatum._isValid) {
            $('#geboortedatumpartner').val('');
        }
        
        $('#geboortedatumpartner').val(geboortedatum.format('DD-MM-YYYY'));
    });
    $('#soort-inkomsten').change(function() {
        if($('#soort-inkomsten').val() !== '') {
            if($('#soort-inkomsten').val() === 'loondienst') {
                $('#loon-uit-loondienst').show();
                $('#loon-uit-onderneming').hide();
            } else {
                $('#loon-uit-loondienst').hide();
                $('#loon-uit-onderneming').show();
            }
        } else {
            $('#loon-uit-loondienst').hide();
            $('#loon-uit-onderneming').hide();
        }
    });
    $('#soort-inkomsten-partner').change(function() {
        if($('#soort-inkomsten-partner').val() !== '') {
            if($('#soort-inkomsten-partner').val() === 'loondienst') {
                $('#loon-uit-loondienst-partner').show();
                $('#loon-uit-onderneming-partner').hide();
            } else {
                $('#loon-uit-loondienst-partner').hide();
                $('#loon-uit-onderneming-partner').show();
            }
        } else {
            $('#loon-uit-loondienst-partner').hide();
            $('#loon-uit-onderneming-partner').hide();
        }
    });
});
