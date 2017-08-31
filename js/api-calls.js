var $ = jQuery;

function ophalenMaxHoogteHypotheek(percentage, ophalenHoogteModel, callback, voorsidebar,   str_apikey, str_apiurl){
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
        
        if(ophalenHoogteModel.geboortedatumpartner === 'Invalid date') {
            ophalenHoogteModel.geboortedatumpartner = undefined;
        }
    
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
            request += '&person%5B0%5D%5Balimony%5D=' + ophalenHoogteModel.hoeveelpartneralimentatie;
        }
        if(ophalenHoogteModel.overigeleningen) {
            request += '&person%5B0%5D%5Bloans%5D=' + ophalenHoogteModel.hoeveeloverigeleningen;
        }
        if(ophalenHoogteModel.studieschuld) {
            request += '&person%5B0%5D%5BstudentLoans%5D=' + ophalenHoogteModel.hoeveelstudieschuld;
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
            callback(result.data.result, percentage, voorsidebar);
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

function ophalenRentepercentages(blnNhg, rentevasteperiode, str_apikey, str_apiurl) {
    var deferred = $.Deferred();
    var nhg = '';
    if(blnNhg) {
        nhg = '&ngh=true';
    }
    //loanToValuePercentage
    var rvp = '&period=' + rentevasteperiode;
    //period

    $.get(str_apiurl + '/interest/v1/interest-top-5?onlyUseIncludedLabels=true&api_key=' + str_apikey + nhg + rvp, null ,function(result){
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

function ophalenWaardeWoonhuis(postcode, huisnummer, str_apikey, str_apiurl) {
    var deferred = $.Deferred();

    $.get(str_apiurl + '/address/v1/estimateHouseValue?postalcode=7894AB&housenumber=41' + '&api_key=' + str_apikey, null ,function(result){
        return deferred.resolve(result);
    });
    
    return deferred.promise();
}

function ophalenMaandelijkeBetalingen(hoogteHypotheek, rentevasteperiode, soortHypotheek, rentepercentage, geboortedatum1, inkomen1, geboortedatum2, inkomen2, woz, callback, str_apikey, str_apiurl){
    var people = [{
        "dob": geboortedatum1,
        "grossIncome": parseInt(inkomen1)
    }];
    
    if(inkomen2 != null && inkomen2 != '') {
        people.push({
            "dob": geboortedatum2,
            "grossIncome": parseInt(inkomen2)
        });
    }
    
    var request = {
        "loanparts": [
            {
                // "startDate": "2017-08-09",
                "amount": hoogteHypotheek,
                "mortgageType": soortHypotheek,
                // "nonDeductableAmount": 0,
                "durationInMonths": 360,
                // "deductablePeriodInMonths": 0,
                "interestPeriods": [
                    {
                        "duration": rentevasteperiode,
                        "interestRate": parseFloat(rentepercentage)
                    }
                // ],
                // "extraDeposits": [
                //     {
                //         "inMonth": 1,
                //         "amount": 0
                //     }
                ]
            }
        ],
        "people": people,
        "WOZ": woz};
    
    $.ajax({
        type: 'POST',
        url: str_apiurl + '/calculation/v1/mortgage/payment?api_key=' + str_apikey,
        data: JSON.stringify(request),
        success: callback,
        contentType: "application/json",
        dataType: 'json'
    });
}

function opvragenNhg(hoogteHypotheek, str_apikey, str_apiurl){
    var deferred = $.Deferred();
    var datum = moment().format('YYYY-MM-DD');

    $.get(str_apiurl + '/calculation/v1/nhg/cost?amount=' + hoogteHypotheek + '&calculationDate=' + datum + '&addNhgToAmount=true' + '&api_key=' + str_apikey, null ,function(result){
        return deferred.resolve(Math.round(result.data.result));
    });
    
    return deferred.promise();
}

function opvragenBrutoinkomen(maandelijksinkomen, dertiendemaand, vakantiegeld, str_apikey, str_apiurl){
    var deferred = $.Deferred();

    $.get(str_apiurl + '/calculation/v1/income/gross?grossMonthlyIncome=' + maandelijksinkomen + '&receivesHolidayPay=' + vakantiegeld + '&receivesThirteenthMonth=' + dertiendemaand + '&api_key=' + str_apikey, null ,function(result){
        return deferred.resolve(Math.round(result.data.result));
    });
    
    return deferred.promise();
}

function opvragenBrutoinkomenOndernemer(jaarEen, jaarTwee, jaarDrie, str_apikey, str_apiurl) {
    var deferred = $.Deferred();

    $.get(str_apiurl + '/calculation/v1/income/entrepreneur?calculationMethod=nhg&incomeYearOne=' + jaarEen + '&incomeYearTwo=' + jaarTwee + '&incomeYearThree=' + jaarDrie + '&thirdYearAPrognoses=false' + '&api_key=' + str_apikey, null ,function(result){
        return deferred.resolve(Math.round(result.data.result));
    });
    
    return deferred.promise();
}