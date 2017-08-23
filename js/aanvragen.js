jQuery(document).ready(function($) { 
    var geboortedatum;
    $('#huidigestap').text('1');
    $('#brutomaandloon').change(function(){
        berekenBrutojaarloon();
    });
    $('#dertiendemaand').change(function(){
        berekenBrutojaarloon();
    });
    $('#vakantiegeld').change(function(){
        berekenBrutojaarloon();
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
    $('#eigengeldinbrengen').click(function(){
        if($('#eigengeldinbrengen').is(':checked')) {
            $('#hoeveeleigengelddiv').show();
        } else {
            $('#hoeveeleigengelddiv').hide();
        }
    });
    $('#postcodehuis').change(function() {
        ophalenWaardeWoonhuis(null, null, $('#apikey').html(), $('#apiurl').html());
    });
    $('#huisnummerhuis').change(function() {
        ophalenWaardeWoonhuis(null, null, $('#apikey').html(), $('#apiurl').html());
    });
    $('#waardehuis').change(function(){
        berekenHypotheekBedrag();
        hoogteHypotheek($('#percentage').val());
    });
    $('#koopsom').change(function(){
        berekenHypotheekBedrag();
        hoogteHypotheek($('#percentage').val());
    });
    $('#hypotheekakte-notaris').change(function(){
        berekenHypotheekBedrag();
        berekenEigenMiddelen();
    });
    $('#leveringsakte-notaris').change(function(){
        berekenHypotheekBedrag();
        berekenEigenMiddelen();
    });
    $('#taxatie').change(function(){
        berekenHypotheekBedrag();
        berekenEigenMiddelen();
    });
    $('#commissie').change(function(){
        berekenHypotheekBedrag();
        berekenEigenMiddelen();
    });
    $('#benodigdehypotheek').change(function(){
        verbergOfToonNhgOptie();
        berekenEigenMiddelen();
        berekenTeLenen();
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
    $('#nhg').click(function(){
        var nhg;
        if($('#nhg').is(':checked')) {
            $('#metNHG').show();
            nhg = true;
        } else {
            $('#metNHG').hide();
            nhg = false;
        }
        berekenHypotheekBedrag();
        opvragenRentepercentages();
        zetNhgSidebar(nhg);
    });
    $('#hoeveeleigengeld').change(function(){
        kloptHoeveelEigenGeldWel();
        // berekenHypotheekBedrag();
        // opvragenRentepercentages();
        berekenTeLenen();
    });
    $('#rentevasteperiode').change(function(){
        zetRentevasteperiodeSidebar();
        opvragenRentepercentages();
    });
    $('#soorthypotheek').change(function(){
        zetSoorthypotheekSidebar();
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
    $('#naar-stap3').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap2')) {
            $('#huidigestap').text('3');
            $('#stap2').hide();
            $('#stap3').show();
        }
    });
    $('#naar-stap4').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap3')) {
            $('#huidigestap').text('4');
            $('#stap3').hide();
            $('#stap4').show();
        }
    });
    $('#naar-stap5').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap4')) {
            $('#huidigestap').text('5');
            $('#stap4').hide();
            $('#stap5').show();
        }
    });
    $('#naar-stap6').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap5')) {
            $('#huidigestap').text('6');
            $('#stap5').hide();
            $('#stap6').show();
        }
    });
    $('#naar-bevestigen').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap6')) {
            plaatsAllesOpBevestigenScherm();
            $('#stap6').hide();
            $('#bevestigen').show();
            $('#stappenteller').hide();
        }
    });
    $('#terug-naar-stap1').click(function(){
        $('#huidigestap').text('1');
        $('#stap2').hide();
        $('#stap1').show();
    });
    $('#terug-naar-stap2').click(function(){
        $('#huidigestap').text('2');
        $('#stap3').hide();
        $('#stap2').show();
    });
    $('#terug-naar-stap3').click(function(){
        $('#huidigestap').text('3');
        $('#stap4').hide();
        $('#stap3').show();
    });
    $('#terug-naar-stap4').click(function(){
        $('#huidigestap').text('4');
        $('#stap5').hide();
        $('#stap4').show();
    });
    $('#terug-naar-stap5').click(function(){
        $('#huidigestap').text('5');
        $('#stap6').hide();
        $('#stap5').show();
    });
    $('#terug-naar-stap6').click(function(){
        $('#huidigestap').text('6');
        $('#bevestigen').hide();
        $('#stap6').show();
        $('#stappenteller').show();
    });
    $('#postcode').change(function(){
        ophalenAdres($('#postcode').val(), $('#huisnummer').val()).done(function(adres) {
            $('#straatnaam').val(adres.straat);
            $('#woonplaats').val(adres.plaats);
            $('#postcode').val(adres.postcode);
        });
    });
    $('#huisnummer').change(function(){
        ophalenAdres($('#postcode').val(), $('#huisnummer').val()).done(function(adres) {
            $('#straatnaam').val(adres.straat);
            $('#woonplaats').val(adres.plaats);
            $('#postcode').val(adres.postcode);
        });
    });
    $('#postcodewerkgever').change(function(){
        ophalenAdres($('#postcodewerkgever').val(), $('#huisnummerwerkgever').val()).done(function(adres) {
            $('#straatnaamwerkgever').val(adres.straat);
            $('#plaatswerkgever').val(adres.plaats);
            $('#postcodewerkgever').val(adres.postcode);
        });
    });
    $('#huisnummerwerkgever').change(function(){
        ophalenAdres($('#postcodewerkgever').val(), $('#huisnummerwerkgever').val()).done(function(adres) {
            $('#straatnaamwerkgever').val(adres.straat);
            $('#plaatswerkgever').val(adres.plaats);
            $('#postcodewerkgever').val(adres.postcode);
        });
    });
    $('#aanvragen').click(function(){
        var data = {
    		'action': 'aanvragen',
    		'mail-tekst': $('#tekst-mail').html(),
    		'emailadres': $('#emailadresbeheerder').html()
    	};
    	$.post('../../wp-admin/admin-ajax.php', data, function(response) {
    		console.log('Got this from the server: ' + response);
    	});
        $('#bevestigen').hide();
        $('#ontvangen').show();
    });
    $('#iban').change(function() {
        var rek = $('#iban').val().toUpperCase();

        if(rek !== undefined && rek.length === 18) {
            rek = rek.substring(0, 4) + " " +rek.substring(4, 8) + " " +rek.substring(8, 12) + " " +rek.substring(12, 16) + " " +rek.substring(16, 18);
        }

        $('#iban').val(rek);
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
    
    //hulptekstballonnen
    $('#stap1-met-partner-kruis').click(function(){
        $('#stap1-met-partner-help').hide();
        $('#stap1-met-partner-question').show();
    });
    $('#stap1-met-partner-question').click(function(){
        $('#stap1-met-partner-help').show();
        $('#stap1-met-partner-question').hide();
    });
    $('#stap1-studieschuld-kruis').click(function(){
        $('#stap1-studieschuld-help').hide();
        $('#stap1-studieschuld-question').show();
    });
    $('#stap1-studieschuld-question').click(function(){
        $('#stap1-studieschuld-help').show();
        $('#stap1-studieschuld-question').hide();
    });
    $('#stap1-roodstaan-kruis').click(function(){
        $('#stap1-roodstaan-help').hide();
        $('#stap1-roodstaan-question').show();
    });
    $('#stap1-roodstaan-question').click(function(){
        $('#stap1-roodstaan-help').show();
        $('#stap1-roodstaan-question').hide();
    });
    $('#stap1-creditcard-kruis').click(function(){
        $('#stap1-creditcard-help').hide();
        $('#stap1-creditcard-question').show();
    });
    $('#stap1-creditcard-question').click(function(){
        $('#stap1-creditcard-help').show();
        $('#stap1-creditcard-question').hide();
    });
    $('#stap1-partneralimentatie-kruis').click(function(){
        $('#stap1-partneralimentatie-help').hide();
        $('#stap1-partneralimentatie-question').show();
    });
    $('#stap1-partneralimentatie-question').click(function(){
        $('#stap1-partneralimentatie-help').show();
        $('#stap1-partneralimentatie-question').hide();
    });
    $('#stap1-overigeleningen-kruis').click(function(){
        $('#stap1-overigeleningen-help').hide();
        $('#stap1-overigeleningen-question').show();
    });
    $('#stap1-overigeleningen-question').click(function(){
        $('#stap1-overigeleningen-help').show();
        $('#stap1-overigeleningen-question').hide();
    });
    $('#stap2-koopsom-kruis').click(function(){
        $('#stap2-koopsom-help').hide();
        $('#stap2-koopsom-question').show();
    });
    $('#stap2-koopsom-question').click(function(){
        $('#stap2-koopsom-help').show();
        $('#stap2-koopsom-question').hide();
    });
    $('#stap2-overdrachtsbelasting-kruis').click(function(){
        $('#stap2-overdrachtsbelasting-help').hide();
        $('#stap2-overdrachtsbelasting-question').show();
    });
    $('#stap2-overdrachtsbelasting-question').click(function(){
        $('#stap2-overdrachtsbelasting-help').show();
        $('#stap2-overdrachtsbelasting-question').hide();
    });
    $('#stap2-leveringsakte-kruis').click(function(){
        $('#stap2-leveringsakte-help').hide();
        $('#stap2-leveringsakte-question').show();
    });
    $('#stap2-leveringsakte-question').click(function(){
        $('#stap2-leveringsakte-help').show();
        $('#stap2-leveringsakte-question').hide();
    });
    $('#stap2-hypotheekakte-kruis').click(function(){
        $('#stap2-hypotheekakte-help').hide();
        $('#stap2-hypotheekakte-question').show();
    });
    $('#stap2-hypotheekakte-question').click(function(){
        $('#stap2-hypotheekakte-help').show();
        $('#stap2-hypotheekakte-question').hide();
    });
    $('#stap2-taxatie-kruis').click(function(){
        $('#stap2-taxatie-help').hide();
        $('#stap2-taxatie-question').show();
    });
    $('#stap2-taxatie-question').click(function(){
        $('#stap2-taxatie-help').show();
        $('#stap2-taxatie-question').hide();
    });
    $('#stap2-commissie-kruis').click(function(){
        $('#stap2-commissie-help').hide();
        $('#stap2-commissie-question').show();
    });
    $('#stap2-commissie-question').click(function(){
        $('#stap2-commissie-help').show();
        $('#stap2-commissie-question').hide();
    });
    $('#stap2-nhg-kruis').click(function(){
        $('#stap2-nhg-help').hide();
        $('#stap2-nhg-question').show();
    });
    $('#stap2-nhg-question').click(function(){
        $('#stap2-nhg-help').show();
        $('#stap2-nhg-question').hide();
    });
    $('#stap2-eigen-geld-kruis').click(function(){
        $('#stap2-eigen-geld-help').hide();
        $('#stap2-eigen-geld-question').show();
    });
    $('#stap2-eigen-geld-question').click(function(){
        $('#stap2-eigen-geld-help').show();
        $('#stap2-eigen-geld-question').hide();
    });
    
    opvragenRentepercentages();
    
    function hoogteHypotheek(percentage, voorsidebar){
        var request = {
                loan : $('#loan').val(),
                vakantiegeld : $('#vakantiegeld').is(':checked'),
                dertiendemaand : $('#dertiendemaand').is(':checked'),
                partner : $('#partner').is(':checked'),
                brutoloon : (parseInt($('#brutoloon').text()) + parseInt($('#brutoloon-onderneming').text())),
                geboortedatum : $('#geboortedatum').val(),
                brutoloonpartner : (parseInt('#brutoloonpartner').text() + parseInt('#brutoloon-onderneming-partner').text()),
                geboortedatumpartner : $('#geboortedatumpartner').val(),
                studieschuld : $('#studieschuld').is(':checked'),
                hoeveelstudieschuld : $('#hoeveelstudieschuld').val(),
                roodstaan : $('#roodstaan').is(':checked'),
                hoeveelroodstaan : $('#hoeveelroodstaan').val(),
                creditcard : $('#creditcard').is(':checked'),
                hoeveelcreditcard : $('#hoeveelcreditcard').val(),
                partneralimentatie : $('#partneralimentatie').is(':checked'),
                hoeveelpartneralimentatie : $('#hoeveelpartneralimentatie').val(),
                overigeleningen : $('#overigeleningen').is(':checked'),
                hoeveeloverigeleningen : $('#hoeveeloverigeleningen').val(),
                nhg : $('#nhg').is(':checked'),
                percentage : percentage
        }
        if(percentage == null || percentage == '') {
            $.when(ophalenRentepercentages(request.nhg, $('#rentevasteperiode').val(), $('#apikey').html(), $('#apiurl').html())).then(function(result) {
                percentage = result[0].percentage;

                $('#rentepercentage-sidebar').text(percentage);

                ophalenMaxHoogteHypotheek(percentage, request, resultaatBerekenen, true, $('#apikey').html(), $('#apiurl').html());
            })
        } else {
            $('#rentepercentage-sidebar').text(percentage);

            ophalenMaxHoogteHypotheek(percentage, request, resultaatBerekenen, false, $('#apikey').html(), $('#apiurl').html());
        }
    
        function resultaatBerekenen(maxHypotheek, percentage, voorsidebar) {
            var max = 0;
            if(voorsidebar) {
                $('#sidebar-max-hypotheek').text(maakBedragOp(maxHypotheek));
                var waardehuis = $('#waardehuis').val();
                if(waardehuis != null && waardehuis != ''){
                    var maxHypotheekKoopsom = waardehuis * 1.01;
                    $('#sidebar-max-hypotheek-koopsom').text(maakBedragOp(maxHypotheekKoopsom));
                }
                max = maxHypotheek;
            } else {
                var waardehuis = $('#waardehuis').val();
                if(waardehuis != null && waardehuis != ''){
                    var maxHypotheekKoopsom = waardehuis * 1.01;
    
                    if(maxHypotheek > maxHypotheekKoopsom) {
                        $('#result').text('Je kunt maximaal lenen : ' + maakBedragOp(maxHypotheek) + ', maar op basis van de waarde van het huis kun je lenen : ' + maakBedragOp(maxHypotheekKoopsom));
                        $('#max-hypotheek').text(maxHypotheekKoopsom);
                        max = maxHypotheekKoopsom;
                    } else {
                        $('#result').text('Je kunt maximaal lenen : ' + maakBedragOp(maxHypotheek));
                        $('#max-hypotheek').text(maxHypotheek);
                        max = maxHypotheek;
                    }
                } else {
                    $('#result').text(maakBedragOp(maxHypotheek));
                    $('#max-hypotheek').text(maxHypotheek);
                    max = maxHypotheek;
                }
                $('#sidebar-max-hypotheek').text(maakBedragOp(maxHypotheek));
                $('#sidebar-max-hypotheek-koopsom').text(maakBedragOp(maxHypotheekKoopsom));
                $('#resultaat').show();
                berekenEigenMiddelen();
            }
                
            var waardehuis = parseInt($('#waardehuis').val());
            var rentevasteperiode = parseInt($('#rentevasteperiode').val());
            var soortHypotheek = $('#soorthypotheek').val();

            if(!isNaN(waardehuis)) {
                ophalenMaandelijkeBetalingen(max, rentevasteperiode, soortHypotheek, percentage, request.geboortedatum, request.brutoloon, request.geboortedatumpartner, request.brutoloonpartner, waardehuis, verwerkMaandelijkeBetalingen, $('#apikey').html(), $('#apiurl').html());
            }
            
            function verwerkMaandelijkeBetalingen(result) {
                var eersteMaand = result.data.months[0];
                
                var netto = eersteMaand.repayment + eersteMaand.net;
                var bruto = eersteMaand.repayment + eersteMaand.gross;
                
                $('#nettomaandlast-sidebar').text(maakBedragOp(parseInt(netto)));
                $('#brutomaandlast-sidebar').text(maakBedragOp(parseInt(bruto)));
            }
        }
    }
    
    function berekenEigenMiddelen() {
        var maxHypotheek = parseInt($('#max-hypotheek').html());
        var benodigd = parseInt($('#benodigdehypotheek').val());
        var eigenmiddelen = benodigd - maxHypotheek;
        
        if(eigenmiddelen > 0) {
            $('#eigen-middelen').show();
            $('#eigen-middelen-bedrag').text(maakBedragOp(eigenmiddelen));
            $('#eigen-middelen-bedrag-backup').text(eigenmiddelen);
            $('#hoeveeleigengeld').val(eigenmiddelen);
        } else {
            $('#eigen-middelen').hide();
        }
        berekenTeLenen();
    }
    
    function ophalenAdres(postcode, huisnummer) {
        var deferred = $.Deferred();

        ophalenAdresCall(postcode, huisnummer, $('#apikey').html(), $('#apiurl').html()).done(function(result){
            return deferred.resolve(result);
        });
    
        return deferred.promise();
    }
    
	function opvragenRentepercentages() {
	    $('#aanbieders').html('');
        $('#resultaat').hide();
        $('#result').text('');
        $('#max-hypotheek').text('');
        berekenEigenMiddelen();

	    var nhg = false;
        if($('#nhg').is(':checked')) {
            nhg = true;
        }

        ophalenRentepercentages(nhg, $('#rentevasteperiode').val(), $('#apikey').html(), $('#apiurl').html()).done(function(percentage) {
            var elements = [];
            _.each(percentage, function(p){
                var currentElement = $('<input type="radio" name="aanbieders_option" value="' + p.bank + ' - ' + p.percentage + '">');
                elements.push(currentElement[0]);
                elements.push('<span style="height: 50px; display:inline-block; vertical-align: top; margin-bottom: 5px;"><img style="width:75px;" src="' + p.logo + '" />');
                elements.push(p.bank + ': ' + p.percentage + '%</span>');
                elements.push('<div style="clear: both;">');
            });
            $('#aanbieders').append(elements);
            $("input[name='aanbieders_option']").on('change', function() {
                var input = $("input[name='aanbieders_option']:checked")[0].value;
                console.log(input);
                
                var percentage = input.split(' - ')[1];
                
                $('#percentage').val(percentage);

                hoogteHypotheek(percentage);
                hoogteHypotheek(percentage, true);

                $('#naar-stap2').prop('disabled', false);
            });
        });
	}
	
    function berekenHypotheekBedrag() {
        //eerst Overdrachtsbelasting uitrekenen
        var koopsom = parseInt($('#koopsom').val());
        var overdrachtsbelasting = koopsom * 0.02;
        $('#overdrachtsbelasting').val(overdrachtsbelasting);

        var leveringsakteNotaris = parseInt($('#leveringsakte-notaris').val());
        var hypotheekakteNotaris = parseInt($('#hypotheekakte-notaris').val());
        var taxatie = parseInt($('#taxatie').val());
        var commissie = parseInt($('#commissie').val());
        var eigengeld = parseInt($('#hoeveeleigengeld').val());
        if(isNaN(eigengeld)) {
            eigengeld = 0;
        }
        
        var totaalBedrag = koopsom + leveringsakteNotaris + hypotheekakteNotaris + taxatie + commissie + overdrachtsbelasting;
        
 //        console.log(totaalBedrag);
        
        var nhgCommissie = 0;
        var benodigdehypotheek = $('#benodigdehypotheek').val();
        
        opvragenNhg(totaalBedrag, $('#apikey').html(), $('#apiurl').html()).done(function(opgehaaldeNhgCommissie) {
            //als marktwaarde < koopsom, dan nhg = over marktwaarde, anders koopsom
            if($('#nhg').is(':checked')) {
                var marktwaarde = parseInt($('#waardehuis').val());
                // var nhgCommissie = 0;
                // if(marktwaarde < koopsom) {
                    // nhgCommissie = opvragenNhg(totaalBedrag, $('#apikey').html(), $('#apiurl').html());
                    nhgCommissie = (marktwaarde * 101) * 0.0001;
                    console.log(nhgCommissie);
                // } else {
                //     nhgCommissie = (totaalBedrag * 101) * 0.0001;
                // }
                
                //nhgCommissie afronden
                // nhgCommissie = Math.round(nhgCommissie);
                nhgCommissie = opgehaaldeNhgCommissie;
            }
            
            $('#nhgkosten').val(nhgCommissie);
            if(benodigdehypotheek != '' || isNaN(parseInt(benodigdehypotheek)) || parseInt(benodigdehypotheek) > 0) {
                $('#benodigdehypotheek').val((nhgCommissie + totaalBedrag));
                $('#hoeveeleigengeld').val(eigengeld);
                verbergOfToonNhgOptie();
            }
            berekenEigenMiddelen();
        });
    }
    
    function verbergOfToonNhgOptie(){
        var benodigdehypotheek = parseInt($('#benodigdehypotheek').val());
        
        if(benodigdehypotheek > 247500) {
            $('#nhg-vraag').hide();
            $('#nhg').prop('checked', false);
        } else {
            $('#nhg-vraag').show();
        }
    }

    function maakBedragOp(bedrag) {
		if(bedrag !== undefined && bedrag !== null){
		    var strBedrag = String(bedrag).replace('.', ',');
		    
		    var parts = strBedrag.split(',');
		    var naDeKomma = '00';
		    if(parts.length > 1) {
		        naDeKomma = parts[1];
		        if(naDeKomma.length == 1) {
		            naDeKomma = naDeKomma + '0';
		        } else if(naDeKomma.length == 0) {
		            naDeKomma = '00';
		        }
		    }
		    
			var opgemaaktBedrag = parts[0] + ',' + naDeKomma;

			return '\u20AC ' + opgemaaktBedrag.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		}
	}
	
	function plaatsAllesOpBevestigenScherm(){
	    $('#tekst-mail').text('');
	    
        var tekst = '<table>';
	    //Stap 1
	    tekst = tekst + zetTekst('Je bruto jaarloon', maakBedragOp($('#brutoloon').val()));
        tekst = tekst + zetTekst('Je geboortedatum', $('#geboortedatum').val());

        var metPartner = $('#partner').is(':checked') ? 'Ja' : 'Nee';
        tekst = tekst + zetTekst('Met partner : ', metPartner);
        if(metPartner === 'Ja') {
            tekst = tekst + zetTekst('Bruto jaarloon van je partner : ', maakBedragOp($('#brutoloonpartner').val()));
            tekst = tekst + zetTekst('Geboortedatum van je partner : ', $('#geboortedatumpartner').val());
        }

        var studieschuld = $('#studieschuld').is(':checked') ? 'Ja' : 'Nee';
        tekst = tekst + zetTekst('Heb je een studieschuld?', studieschuld);
        if(studieschuld === 'Ja') {
            tekst = tekst + zetTekst('Hoeveel studieschuld : ', maakBedragOp($('#hoeveelstudieschuld').val()));
        }

        var roodstaan = $('#roodstaan').is(':checked') ? 'Ja' : 'Nee';
        tekst = tekst + zetTekst('Mag je rood staan?', roodstaan);
        if(roodstaan === 'Ja') {
            tekst = tekst + zetTekst('Hoeveel mag je roodstaan : ', maakBedragOp($('#hoeveelroodstaan').val()));
        }

        var creditcard = $('#creditcard').is(':checked') ? 'Ja' : 'Nee';
        tekst = tekst + zetTekst('Heb je een creditcard?', creditcard);
        if(creditcard === 'Ja') {
            tekst = tekst + zetTekst('Wat is de limiet : ', maakBedragOp($('#hoeveelcreditcard').val()));
        }

        var partneralimentatie = $('#partneralimentatie').is(':checked') ? 'Ja' : 'Nee';
        tekst = tekst + zetTekst('Betaal je partneralimentatie?', partneralimentatie);
        if(partneralimentatie === 'Ja') {
            tekst = tekst + zetTekst('Hoeveel betaal je aan partneralimentatie : ', maakBedragOp($('#hoeveelpartneralimentatie').val()));
        }

        var overigeleningen = $('#overigeleningen').is(':checked') ? 'Ja' : 'Nee';
        tekst = tekst + zetTekst('Heb je overige leningen of kredieten?', overigeleningen);
        if(overigeleningen === 'Ja') {
            tekst = tekst + zetTekst('Hoeveel : ', maakBedragOp($('#hoeveeloverigeleningen').val()));
        }

        //Stap 2
	    tekst = tekst + zetTekst('Koopsom van het huis', maakBedragOp($('#koopsom').val()));
        tekst = tekst + zetTekst('Overdrachtsbelasting', maakBedragOp($('#overdrachtsbelasting').val()));
        tekst = tekst + zetTekst('Kosten leveringsakte notaris', maakBedragOp($('#leveringsakte-notaris').val()));
        tekst = tekst + zetTekst('Kosten hypotheekakte notaris', maakBedragOp($('#hypotheekakte-notaris').val()));
        tekst = tekst + zetTekst('Kosten taxatie', maakBedragOp($('#taxatie').val()));
        tekst = tekst + zetTekst('Kosten commissie', maakBedragOp($('#commissie').val()));
        tekst = tekst + zetTekst('Kosten NHG', maakBedragOp($('#nhgkosten').val()));
        tekst = tekst + zetTekst('Gekozen aanbieder en rente', $("input[name='aanbieders_option']").val().replace('-', 'met') + '%');
        tekst = tekst + zetTekst('Hoeveel hypotheek ben je nodig', maakBedragOp($('#benodigdehypotheek').val()));
        tekst = tekst + zetTekst('Je maximale hypotheek is', $('#result').html());
        tekst = tekst + zetTekst('Dat betekent dat je als eigen middelen moet inbrengen', $('#eigen-middelen-bedrag').html());

        //Stap 3
        tekst = tekst + zetTekst('Naam', $('#naam').val());
        tekst = tekst + zetTekst('Postcode', $('#postcode').val());
        tekst = tekst + zetTekst('Huisnummer', $('#huisnummer').val());
        tekst = tekst + zetTekst('Adres', $('#straatnaam').val());
        tekst = tekst + zetTekst('Woonplaats', $('#woonplaats').val());
        tekst = tekst + zetTekst('Telefoonnummer', $('#telefoonnummer').val());
        tekst = tekst + zetTekst('E-mail adres', $('#emailadres').val());

        //Stap 4
        tekst = tekst + zetTekst('Burgerservicenummer', $('#bsn').val());
        tekst = tekst + zetTekst('Documentnummer identificatie', $('#documentnummer').val());
        tekst = tekst + zetTekst('Datum geldigheid identificatie', $('#datumgeldigheid').val());
        tekst = tekst + zetTekst('Gemeente afgifte identificatie', $('#gemeente').val());
        tekst = tekst + zetTekst('Geboorteplaats', $('#geboorteplaats').val());

        //Stap 5
        tekst = tekst + zetTekst('Iban', $('#iban').val());

        //Stap 6
        tekst = tekst + zetTekst('Beroep/Functie', $('#beroep').val());
        tekst = tekst + zetTekst('Datum indiensttreding', $('#datumindiensttreding').val());
        tekst = tekst + zetTekst('Einddatum contract', $('#einddatumcontract').val());
        tekst = tekst + zetTekst('Naam werkgever', $('#naamwerkgever').val());
        tekst = tekst + zetTekst('Postcode werkgever', $('#postcodewerkgever').val());
        tekst = tekst + zetTekst('Huisnummer werkgever', $('#huisnummerwerkgever').val());
        tekst = tekst + zetTekst('Straatnaam werkgever', $('#straatnaamwerkgever').val());
        tekst = tekst + zetTekst('Plaats werkgever', $('#plaatswerkgever').val());

        tekst = tekst + '</table>';
        
        $('#tekst-mail').html(tekst);
        $('#tekst-mail').show();
	}
	
	function zetTekst(voorTekst, tekst) {
	    if(tekst != null && tekst != '' && tekst != '0'  && tekst != '\u20AC 0,00') {
	       return '<tr><td>' + voorTekst + '</td><td>' + tekst + '</td></tr>';
	    } else {
	        return '';
	    }
	}
	
	function zijnDeVerplichteVeldenGevuld(stap) {
	    var allesGevuld = false;
	    if(stap === 'stap1') {
	        var brutoloon = isVeldGevuldEnVeranderRand($('#brutomaandloon'));
	        var geboortedatum = isVeldGevuldEnVeranderRand($('#geboortedatum'));
	        
	        var partnerOk = true;
            if($('#partner').is(':checked')) {
                var brutoloonpartner = isVeldGevuldEnVeranderRand($('#brutomaandloonpartner'));
                var geboortedatumpartner = isVeldGevuldEnVeranderRand($('#geboortedatumpartner'));
                
                partnerOk = brutoloonpartner && geboortedatumpartner;
            }
            
            var studieschuldOk = true;
            if($('#studieschuld').is(':checked')) {
                studieschuldOk = isVeldGevuldEnVeranderRand($('#hoeveelstudieschuld'));
            }
            
            var roodstaanOk = true;
            if($('#roodstaan').is(':checked')) {
                roodstaanOk = isVeldGevuldEnVeranderRand($('#hoeveelroodstaan'));
            }
            
            var creditcardOk = true;
            if($('#creditcard').is(':checked')) {
                creditcardOk = isVeldGevuldEnVeranderRand($('#hoeveelcreditcard'));
            }
            
            var partneralimentatieOk = true;
            if($('#partneralimentatie').is(':checked')) {
                partneralimentatieOk = isVeldGevuldEnVeranderRand($('#hoeveelpartneralimentatie'));
            }
            
            var overigeleningenOk = true;
            if($('#overigeleningen').is(':checked')) {
                overigeleningenOk = isVeldGevuldEnVeranderRand($('#hoeveeloverigeleningen'));
            }
	        
	        allesGevuld = brutoloon && geboortedatum && partnerOk && studieschuldOk && roodstaanOk && creditcardOk && partneralimentatieOk && overigeleningenOk;
	    } else if (stap === 'stap2') {
	        var koopsom = isVeldGevuldEnVeranderRand($('#koopsom'));
	        var benodigdehypotheek = isVeldGevuldEnVeranderRand($('#benodigdehypotheek'));
	        
	        allesGevuld = koopsom && benodigdehypotheek;
	    } else if (stap === 'stap3') {
	        var postcode = isVeldGevuldEnVeranderRand($('#postcode'));
	        var huisnummer = isVeldGevuldEnVeranderRand($('#huisnummer'));
	        var emailadres = isVeldGevuldEnVeranderRand($('#emailadres'));
	        
	        allesGevuld = postcode && huisnummer;// && emailadres;
	    } else if (stap === 'stap4') {
            var bsn = isVeldGevuldEnVeranderRand($('#bsn'));
            var documentnummer = isVeldGevuldEnVeranderRand($('#documentnummer'));
            var datumgeldigheid = isVeldGevuldEnVeranderRand($('#datumgeldigheid'));
            var gemeente = isVeldGevuldEnVeranderRand($('#gemeente'));
            var geboorteplaats = isVeldGevuldEnVeranderRand($('#geboorteplaats'));
            
	        allesGevuld = bsn && documentnummer && datumgeldigheid && gemeente && geboorteplaats;
	    } else if (stap === 'stap5') {
            var iban = isVeldGevuldEnVeranderRand($('#iban'));
            
	        allesGevuld = iban;
	    } else if (stap === 'stap6') {
            var beroep = isVeldGevuldEnVeranderRand($('#beroep'));
            var datumindiensttreding = isVeldGevuldEnVeranderRand($('#datumindiensttreding'));
            var einddatumcontract = isVeldGevuldEnVeranderRand($('#einddatumcontract'));
            var naamwerkgever = isVeldGevuldEnVeranderRand($('#naamwerkgever'));
            var postcodewerkgever = isVeldGevuldEnVeranderRand($('#postcodewerkgever'));
            var huisnummerwerkgever = isVeldGevuldEnVeranderRand($('#huisnummerwerkgever'));

	        allesGevuld = beroep && datumindiensttreding && einddatumcontract && naamwerkgever && postcodewerkgever && huisnummerwerkgever;
	    }
	    
	    if(allesGevuld) {
	        $('#foutmelding-niet-alles-gevuld').hide();
	    } else {
	        $('#foutmelding-niet-alles-gevuld').show();
	    }
	    return allesGevuld;
	}
	
	function isVeldGevuld(tekst) {
	    return tekst != null && tekst != '';
	}
	
	function isVeldGevuldEnVeranderRand(element) {
	    if(isVeldGevuld(element.val())) {
    	    element.css('border', '1px solid #bbb');
    	    return true;
	    } else {
    	    element.css('border', '1px solid #ff0000');
    	    return false;
	    }
	}
	
	function zetNhgSidebar(nhg) {
	    var nhgText = 'Nee';
	    if(nhg) {
	        nhgText = 'Ja';
	    }
	    $('#nhg-sidebar').text(nhgText);
	}
	
	function zetRentevasteperiodeSidebar() {
	    $('#rentevasteperiode-sidebar').text(parseInt($('#rentevasteperiode').val()));
        hoogteHypotheek($('#percentage').val());
        hoogteHypotheek($('#percentage').val(), true);
    }
    
	function zetSoorthypotheekSidebar() {
	    $('#soorthypotheek-sidebar').text($('#soorthypotheek option:selected').text());
        hoogteHypotheek($('#percentage').val());
        hoogteHypotheek($('#percentage').val(), true);
	}
	
	function kloptHoeveelEigenGeldWel() {
	    var nieuwBedrag = parseInt($('#hoeveeleigengeld').val());
	    var minimum = parseInt($('#eigen-middelen-bedrag-backup').text());
	    
	    if (nieuwBedrag < minimum) {
	        $('#hoeveeleigengeld').val(minimum);
	    }
	}
	
	function berekenTeLenen() {
	    var benodigd = parseInt($('#benodigdehypotheek').val());
	    var eigengeld = parseInt($('#hoeveeleigengeld').val());
	    
	    $('#telenen').text(maakBedragOp(benodigd - eigengeld));
	}
	
	function berekenBrutojaarloon() {
	    var brutomaandloon = parseInt($('#brutomaandloon').val());
	    var dertiendemaand = $('#dertiendemaand').is(':checked');
	    var vakantiegeld = $('#vakantiegeld').is(':checked');

        opvragenBrutoinkomen(brutomaandloon, dertiendemaand, vakantiegeld, $('#apikey').html(), $('#apiurl').html()).done(function(result) {
            $('#brutoloon').html(result);
        });
	}
	
	function berekenBrutojaarloonPartner() {
	    var brutomaandloonpartner = parseInt($('#brutomaandloonpartner').val());
	    var dertiendemaandpartner = $('#dertiendemaandpartner').is(':checked');
	    var vakantiegeldpartner = $('#vakantiegeldpartner').is(':checked');

        opvragenBrutoinkomen(brutomaandloonpartner, dertiendemaandpartner, vakantiegeldpartner, $('#apikey').html(), $('#apiurl').html()).done(function(result) {
            $('#brutoloonpartner').text(result);
        });
	}
	
	function berekenInkomenEigenOnderneming() {
	    var jaarEen = parseInt($('#inkomenEen').val());
	    if (isNaN(jaarEen)) {
	        jaarEen = 0;
	    }
	    var jaarTwee = parseInt($('#inkomenTwee').val());
	    if (isNaN(jaarTwee)) {
	        jaarTwee = 0;
	    }
	    var jaarDrie = parseInt($('#inkomenDrie').val());
	    if (isNaN(jaarDrie)) {
	        jaarDrie = 0;
	    }

        opvragenBrutoinkomenOndernemer(jaarEen, jaarTwee, jaarDrie, $('#apikey').html(), $('#apiurl').html()).done(function(result) {
            $('#brutoloon-onderneming').text(result);
        });
	}
	
	function berekenInkomenEigenOndernemingPartner() {
	    var jaarEen = parseInt($('#inkomenEenPartner').val());
	    if (isNaN(jaarEen)) {
	        jaarEen = 0;
	    }
	    var jaarTwee = parseInt($('#inkomenTweePartner').val());
	    if (isNaN(jaarTwee)) {
	        jaarTwee = 0;
	    }
	    var jaarDrie = parseInt($('#inkomenDriePartner').val());
	    if (isNaN(jaarDrie)) {
	        jaarDrie = 0;
	    }

        opvragenBrutoinkomenOndernemer(jaarEen, jaarTwee, jaarDrie, $('#apikey').html(), $('#apiurl').html()).done(function(result) {
            $('#brutoloon-onderneming-partner').text(result);
        });
	}
});
