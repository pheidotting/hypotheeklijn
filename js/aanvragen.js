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
        verbergOfToonNhgOptie();
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
        $('#stap3').hide();
        $('#stap4').show();
    });
    $('#naar-stap5').click(function(){
        $('#stap4').hide();
        $('#stap5').show();
    });
    $('#naar-stap6').click(function(){
        $('#stap5').hide();
        $('#stap6').show();
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
    		'jadajada': 'jan'
    	};
    	$.post('../../wp-admin/admin-ajax.php', data, function(response) {
    		console.log('Got this from the server: ' + response);
    	});
    });
    // $("input[name='aanbieders_option']").on('change', function() {
    //     console.log('aoijsoijfs');
    //     _.each($("input[name='aanbieders_option']"), function(element) {
    //         console.log(element.is(':checked'));
    //     });
    // });
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
            
            var benodigd = parseInt($('#benodigdehypotheek').val());
            var eigenmiddelen = benodigd - maxHypotheek;
            
            if(eigenmiddelen > 0) {
                $('#eigen-middelen').show();
                $('#eigen-middelen-bedrag').text(maakBedragOp(eigenmiddelen));
            }
        }


    }
    
    function ophalenAdres(postcode, huisnummer) {
        var deferred = $.Deferred();
        
        if(postcode != null && postcode != '' && huisnummer != null && huisnummer != '') {
            $.get(url + '/address/v1/address?postalcode=' + postcode + '&housenumber=' + huisnummer + api_key, null ,function(result){
                if(result.data.length > 0) {
                    return deferred.resolve({
                        straat: result.data[0].street,
                        plaats: result.data[0].city,
                        postcode: result.data[0].postalcode
                    });
                }
            });
        } else {
            return deferred.resolve({
                straat: '',
                plaats: '',
                postcode: postcode
            });
        }
        
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
        if($('#nhg').is(':checked')) {
            var nghCommissie = totaalBedrag * 0.01;
        }
        
        $('#nhgkosten').val(nghCommissie);
        $('#benodigdehypotheek').val(nghCommissie + totaalBedrag);
    }
    
    function verbergOfToonNhgOptie(){
        var koopsom = parseInt($('#koopsom').val());
        
        if(koopsom > 247500) {
            $('#nhg-vraag').hide();
            $('#nhg').prop('checked', false);
        } else {
            $('#nhg-vraag').show();
        }
    }

    function maakBedragOp(bedrag) {
		if(bedrag !== undefined && bedrag !== null){
			var opgemaaktBedrag = String(bedrag) + ',00';

			return '\u20AC ' + opgemaaktBedrag.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		}
	}
});