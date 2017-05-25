jQuery(document).ready(function($) { 
    var geboortedatum;
    $('#partner').click(function(){
        if($('#partner').is(':checked')) {
            $('#metPartner').show();
        } else {
            $('#metPartner').hide();
        }
    });
    $('#koopsom').change(function(){
        berekenHypotheekBedrag();
    });
    $('#notaris').change(function(){
        berekenHypotheekBedrag();
    });
    $('#taxatie').change(function(){
        berekenHypotheekBedrag();
    });
    $('#commissie').change(function(){
        berekenHypotheekBedrag();
    });
    $('#benodigdehypotheek').change(function(){
        verbergOfToonNhgOptie();
        berekenEigenMiddelen();
    });
    $('#geboortedatum').change(function(){
        var input = $('#geboortedatum').val();
        
        geboortedatum = moment(input, 'DD-MM-YYYY');
        
        if(!geboortedatum._isValid) {
            $('#geboortedatum').val('');
        }
        
        $('#geboortedatum').val(geboortedatum.format('DD-MM-YYYY'));
    });
    $('#nhg').click(function(){
        if($('#nhg').is(':checked')) {
            $('#metNHG').show();
        } else {
            $('#metNHG').hide();
        }
        berekenHypotheekBedrag();
        opvragenRentepercentages();
    });
    $('#naar-stap2').click(function(){
        $('#stap1').hide();
        $('#stap2').show();
        
        $('#text-benodigde-hypotheek').html('Benodigd bedrag : ' + maakBedragOp($('#benodigdehypotheek').val()));
    });
    $('#naar-stap3').click(function(){
        $('#stap2').hide();
        $('#stap3').show();
    });
    $('#naar-stap4').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap3')) {
            $('#stap3').hide();
            $('#stap4').show();
        }
    });
    $('#naar-stap5').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap4')) {
            $('#stap4').hide();
            $('#stap5').show();
        }
    });
    $('#naar-stap6').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap5')) {
            $('#stap5').hide();
            $('#stap6').show();
        }
    });
    $('#naar-bevestigen').click(function(){
        if(zijnDeVerplichteVeldenGevuld('stap6')) {
            plaatsAllesOpBevestigenScherm();
            $('#stap6').hide();
            $('#bevestigen').show();
        }
    });
    $('#terug-naar-stap1').click(function(){
        $('#stap2').hide();
        $('#stap1').show();
    });
    $('#terug-naar-stap2').click(function(){
        $('#stap3').hide();
        $('#stap2').show();
    });
    $('#terug-naar-stap3').click(function(){
        $('#stap4').hide();
        $('#stap3').show();
    });
    $('#terug-naar-stap4').click(function(){
        $('#stap5').hide();
        $('#stap4').show();
    });
    $('#terug-naar-stap5').click(function(){
        $('#stap6').hide();
        $('#stap5').show();
    });
    $('#terug-naar-stap6').click(function(){
        $('#bevestigen').hide();
        $('#stap6').show();
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
    $('#opvragen').click(function(){
        hoogteHypotheek(null);
    });
    $('#aanvragen').click(function(){
        var data = {
    		'action': 'aanvragen',
    		'mail-tekst': $('#tekst-mail').html()
    	};
    	$.post('../../wp-admin/admin-ajax.php', data, function(response) {
    		console.log('Got this from the server: ' + response);
    	});
        $('#bevestigen').hide();
        $('#ontvangen').show();
    });

    var api_key = '&api_key=TEST-KEY!-1943-4518-95ca-ec025e6f79b';
    var url = 'https://testapi.hypotheekbond.nl';
    
    opvragenRentepercentages();
    
    function hoogteHypotheek(percentage){
        var request = {
                loan : $('#loan').val(),
                vakantiegeld : $('#vakantiegeld').is(':checked'),
                dertiendemaand : $('#dertiendemaand').is(':checked'),
                partner : $('#partner').is(':checked'),
                brutoloon : $('#brutoloon').val(),
                geboortedatum : $('#geboortedatum').val(),
                brutoloonpartner : $('#brutoloonpartner').val(),
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
        ophalenMaxHoogteHypotheek(request, resultaatBerekenen);
    
        function resultaatBerekenen(maxHypotheek) {
            $('#resultaat').show();
            $('#result').text(maakBedragOp(maxHypotheek));
            $('#max-hypotheek').text(maxHypotheek);
            
            $('#naar-stap2').prop('disabled', false);
        }
    }
    
    function berekenEigenMiddelen() {
        var maxHypotheek = parseInt($('#max-hypotheek').html());
        var benodigd = parseInt($('#benodigdehypotheek').val());
        var eigenmiddelen = benodigd - maxHypotheek;
        
        if(eigenmiddelen > 0) {
            $('#eigen-middelen').show();
            $('#eigen-middelen-bedrag').text(maakBedragOp(eigenmiddelen));
        } else {
            $('#eigen-middelen').hide();
        }
    }
    
    function ophalenAdres(postcode, huisnummer) {
        var deferred = $.Deferred();

        ophalenAdresCall(postcode, huisnummer).done(function(result){
            return deferred.resolve(result);
        });
    
        return deferred.promise();
    }
    
	function opvragenRentepercentages() {
	    var nhg = '';
        if($('#nhg').is(':checked')) {
            nhg = '&ngh=true';
        }

        $.get(url + '/interest/v1/interest-rates?limit=999' + nhg + api_key, null ,function(result){
            console.log(result);
            console.log('ophalen rentepercentages');
            
            var i = 0;
            var percentage = _.chain(result.data)
            .sortBy('percentage')
            .filter(function(data) {
                if(nhg) {
                    return data.nhg;
                } else {
                    return true;
                }
            })
            .filter(function(data) {
                return data.code === "nieuw";
            })
            // .filter(function(data) {
            //     return data.productId == 582;
            // })
            // .each(function(a) {
            //     console.log(a);
            // })
            .map(function(rente) {
                return {
                    percentage: rente.percentage,
                    bank: rente.providerName
                };
            })
            .value();


            console.log(percentage);
            
            
            var elements = [];
            _.each(percentage, function(p){
                var currentElement = $('<input type="radio" name="aanbieders_option" value="' + p.bank + ' - ' + p.percentage + '">');
                elements.push(currentElement[0]);
                elements.push(p.bank + ': ' + p.percentage + '%');
                var currentElement = $('<input type="radio" name="aanbieders_option" value="' + p.bank + ' - ' + p.percentage + '2">');
                elements.push(currentElement[0]);
                elements.push(p.bank + ': ' + p.percentage + '2%');
            });
            $('#aanbieders').append(elements);
            $("input[name='aanbieders_option']").on('change', function() {
                var input = $("input[name='aanbieders_option']:checked")[0].value;
                console.log(input);
                
                var percentage = input.split(' - ')[1];
                
                hoogteHypotheek(percentage);
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
        
        var totaalBedrag = koopsom + leveringsakteNotaris + hypotheekakteNotaris + taxatie + commissie + overdrachtsbelasting;
        
        console.log(totaalBedrag);
        
        var nghCommissie = 0;
        var benodigdehypotheek = $('#benodigdehypotheek').val();
        if($('#nhg').is(':checked')) {
            var nghCommissie = benodigdehypotheek * 0.01;
        }
        
        $('#nhgkosten').val(nghCommissie);
        if(benodigdehypotheek != '' || isNaN(parseInt(benodigdehypotheek)) || parseInt(benodigdehypotheek) > 0) {
            $('#benodigdehypotheek').val(nghCommissie + totaalBedrag);
            verbergOfToonNhgOptie();
        }
        berekenEigenMiddelen();
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
	    
	    var teksten = [];
	    teksten.push(zetTekst('Koopsom van het huis', maakBedragOp($('#koopsom').val())));
        teksten.push(zetTekst('Overdrachtsbelasting', maakBedragOp($('#overdrachtsbelasting').val())));
        teksten.push(zetTekst('Kosten leveringsakte notaris', maakBedragOp($('#leveringsakte-notaris').val())));
        teksten.push(zetTekst('Kosten hypotheekakte notaris', maakBedragOp($('#hypotheekakte-notaris').val())));
        teksten.push(zetTekst('Kosten taxatie', maakBedragOp($('#taxatie').val())));
        teksten.push(zetTekst('Kosten commissie', maakBedragOp($('#commissie').val())));
        teksten.push(zetTekst('Kosten NHG', maakBedragOp($('#nhgkosten').val())));
        teksten.push(zetTekst('Hoeveel hypotheek ben je nodig', maakBedragOp($('#benodigdehypotheek').val())));
        teksten.push(zetTekst('Je maximale hypotheek is', $('#result').html()));
        teksten.push(zetTekst('Dat betekent dat je als eigen middelen moet inbrengen', $('#eigen-middelen-bedrag').html()));

        teksten.push(zetTekst('Je bruto jaarloon', maakBedragOp($('#brutoloon').val())));
        teksten.push(zetTekst('Je geboortedatum', $('#geboortedatum').val()));

        var tekst = '';
        $.each(teksten, function(i, t) {
            tekst = tekst + t;
        });
        
        $('#tekst-mail').html('<table>' + tekst + '</table>');
        $('#tekst-mail').show();
	}
	
	function zetTekst(voorTekst, tekst) {
	    if(tekst != null && tekst != '' && tekst != '0'  && tekst != '\u20AC 0,00') {
	       return '<tr><td>' + voorTekst + '</td><td>' + tekst + '</td></tr>';
	    }
	}
	
	function zijnDeVerplichteVeldenGevuld(stap) {
	    var allesGevuld = false;
	    if(stap === 'stap3') {
	        var postcode = isVeldGevuldEnVeranderRand($('#postcode'));
	        var huisnummer = isVeldGevuldEnVeranderRand($('#huisnummer'));
	        var emailadres = isVeldGevuldEnVeranderRand($('#emailadres'));
	        
	        allesGevuld = postcode && huisnummer && emailadres;
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
});