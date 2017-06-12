var $ = jQuery;

function ophalenMaxHoogteHypotheek(percentage, ophalenHoogteModel, callback, str_apikey, str_apiurl){
    console.log('Start opvragen maximale hypotheek'); 
    
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
        ophalenHoogteModel.geboortedatumpartner = moment(ophalenHoogteModel.geboortedatumpartner, 'DD-MM-YYYY').format('YYYY-MM-DD');
    
        var request = str_apiurl + '/calculation/v1/mortgage/maximum-by-income';
        
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
            request += '&person%5B1%5D%5Bincome%5D=' + ophalenHoogteModel.brutoloonpartner;
            request += '&person%5B1%5D%5Bage%5D=' + moment().diff(ophalenHoogteModel.geboortedatumpartner, 'years');
            request += '&person%5B1%5D%5Balimony%5D=0';
            request += '&person%5B1%5D%5Bloans%5D=0';
            request += '&person%5B1%5D%5BstudentLoans%5D=0'
        }
        $('#debug').html(replaceAll(request, '\&', '<br />'));
        $.get(request + '&api_key=' + str_apikey, null ,function(result){
            // result.data.result = 250000;
            
            callback(result.data.result);
        });
        
        function replaceAll(str, find, replace) {
            return str.replace(new RegExp(find, 'g'), replace);
        }
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

function ophalenAdresCall(postcode, huisnummer, str_apikey, str_apiurl) {
    var deferred = $.Deferred();
    
    if(postcode != null && postcode != '' && huisnummer != null && huisnummer != '') {
        $.get(str_apiurl + '/address/v1/address?postalcode=' + postcode + '&housenumber=' + huisnummer + '&api_key=' + str_apikey, null ,function(result){
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

function ophalenRentepercentages(blnNhg, str_apikey, str_apiurl) {
    var deferred = $.Deferred();
    var nhg = '';
    if(blnNhg) {
        nhg = '&ngh=true';
    }

    $.get(str_apiurl + '/interest/v1/interest-top-5' + '?api_key=' + str_apikey, null ,function(result){
        console.log('ophalen rentepercentages');
        console.log(result);
        
        var i = 0;
        var percentage = _.chain(result.data)
        .sortBy('percentage')
        // .filter(function(data) {
        //     if(nhg) {
        //         return data.nhg;
        //     } else {
        //         return true;
        //     }
        // })
        // .filter(function(data) {
            // return data.code === "nieuw";
        // })
        // .filter(function(data) {
        //     return data.productId == 582;
        // })
        // .each(function(a) {
        //     console.log(a);
        // })
        .map(function(rente) {
            return {
                percentage: rente.lowest_interest,
                bank: rente.bank_name,
                logo: rente.bank_logo
            };
        })
        .value();
        
        return deferred.resolve(percentage);
    });
    
    return deferred.promise();
}