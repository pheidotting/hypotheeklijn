var api_key = '&api_key=TEST-KEY!-1943-4518-95ca-ec025e6f79b';
var url = 'https://testapi.hypotheekbond.nl';
var $ = jQuery;

function ophalenMaxHoogteHypotheek(ophalenHoogteModel, callback){
    // console.log($('#geboortedatum').val());
    console.log('Start opvragen maximale hypotheek'); 
    
    // var loan = $('#loan').val();
    // var vakantiegeld = $('#vakantiegeld').is(':checked');
    // var dertiendemaand = $('#dertiendemaand').is(':checked');

    // var partner = $('#partner').is(':checked');
    // var brutoloon = $('#brutoloon').val();
    // // var ondernemer = $('#ondernemer').is(':checked');
    // var geboortedatum = $('#geboortedatum').val();
    // var brutoloonpartner = $('#brutoloonpartner').val();
    // var geboortedatumpartner = $('#geboortedatumpartner').val();
    // var studieschuld = $('#studieschuld').is(':checked');
    // var hoeveelstudieschuld = $('#hoeveelstudieschuld').val();
    // var roodstaan = $('#roodstaan').is(':checked');
    // var hoeveelroodstaan = $('#hoeveelroodstaan').val();
    // var creditcard = $('#creditcard').is(':checked');
    // var hoeveelcreditcard = $('#hoeveelcreditcard').val();
    // var partneralimentatie = $('#partneralimentatie').is(':checked');
    // var hoeveelpartneralimentatie = $('#hoeveelpartneralimentatie').val();
    // var overigeleningen = $('#overigeleningen').is(':checked');
    // var hoeveeloverigeleningen = $('#hoeveeloverigeleningen').val();
    
    $('#foutmelding-niet-alles-gevuld').hide();

    //zijn alle verplichte velden wel gevuld?
    var allesGevuld = true;
    if(ophalenHoogteModel.brutoloon == '') {
        allesGevuld = false;
    }
    if(ophalenHoogteModel.geboortedatum == '') {
        allesGevuld = false;
    }
    if(ophalenHoogteModel.partner) {
        if(ophalenHoogteModel.brutoloonpartner == '') {
            allesGevuld = false;
        }
        if(ophalenHoogteModel.geboortedatumpartner == '') {
            allesGevuld = false;
        }
    }
    
    if(allesGevuld) {
        ophalenHoogteModel.geboortedatum = moment(ophalenHoogteModel.geboortedatum, 'DD-MM-YYYY').format('YYYY-MM-DD');
        console.log('Eerst de rentepercentages opvragen');
        $.get(url + '/interest/v1/interest-rates?bestInterestOnly=false&sortBy=percentage&sortDirection=ASC&limit=25' + api_key, null ,function(result){
            
            var percentage = ophalenHoogteModel.percentage != null ? ophalenHoogteModel.percentage : _.chain(result.data)
            .sortBy('percentage')
            .filter(function(data) {
                if(ophalenHoogteModel.nhg) {
                    return data.nhg;
                } else {
                    return true;
                }
            })
            // .filter(function(data) {
            //     return data.code === "nieuw";
            // })
            // .filter(function(data) {
            //     return data.productId == 582;
            // })
            // .each(function(a) {
            //     console.log(a);
            // })
            .map('percentage')
            .first().value();
    
            console.log('Done : ' + percentage);
            
            if(percentage == null) {
                percentage = 1;
            }
    
            var request = url + '/calculation/v1/mortgage/maximum-by-income';
            
            request += '?nhg=' + ophalenHoogteModel.nhg;
            request += '&duration=360';
            request += '&percentage=' + percentage;
            request += '&rateFixation=10';
            request += '&notDeductible=0';
            request += '&groundRent=0';
            request += '&person%5B0%5D%5Bincome%5D=' + ophalenHoogteModel.brutoloon;
            request += '&person%5B0%5D%5Bage%5D=' + moment().diff(ophalenHoogteModel.geboortedatum, 'years');
            if(ophalenHoogteModel.partneralimentatie) {
                request += '&person%5B0%5D%5Balimony%5D=0';
            }
            if(ophalenHoogteModel.overigeleningen) {
                request += '&person%5B0%5D%5Bloans%5D=0';
            }
            if(ophalenHoogteModel.studieschuld) {
                request += '&person%5B0%5D%5BstudentLoans%5D=0';
            }
            if(ophalenHoogteModel.partner) {
                request += '&person%5B1%5D%5Bincome%5D=0';
                request += '&person%5B1%5D%5Bage%5D=' + moment().diff(ophalenHoogteModel.geboortedatumpartner, 'years');
                request += '&person%5B1%5D%5Balimony%5D=0';
                request += '&person%5B1%5D%5Bloans%5D=0';
                request += '&person%5B1%5D%5BstudentLoans%5D=0'
            }
            $('#debug').html(replaceAll(request, '\&', '<br />'));
            $.get(request + api_key, null ,function(result){
                result.data.result = 250000;
                
                callback(result.data.result);
            });
            
            function replaceAll(str, find, replace) {
                return str.replace(new RegExp(find, 'g'), replace);
            }
        });
    } else {
        console.log('Niet alle verplichte velden zijn gevuld, foutmelding!');

        $('#foutmelding-niet-alles-gevuld').show();
    }
};        

function maakBedragOp(bedrag) {
	if(bedrag !== undefined && bedrag !== null){
		var opgemaaktBedrag = String(bedrag) + ',00';

		return '\u20AC ' + opgemaaktBedrag.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
	}
}

function ophalenAdresCall(postcode, huisnummer) {
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

function ophalenRentepercentages(blnNhg) {
    var deferred = $.Deferred();
    var nhg = '';
    if(blnNhg) {
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
        
        return deferred.resolve(percentage);
    });
    
    return deferred.promise();
}