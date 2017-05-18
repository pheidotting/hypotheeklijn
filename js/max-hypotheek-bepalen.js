function abc(){
    var $ = jQuery;
    console.log($('#geboortedatum').val());
    console.log('hier wel');
}

jQuery(document).ready(function() { 
    jQuery('#partner').click(function(){
        if(jQuery('#partner').is(':checked')) {
            jQuery('#metPartner').show();
        } else {
            jQuery('#metPartner').hide();
        }
    });
    jQuery('#studieschuld').click(function(){
        if(jQuery('#studieschuld').is(':checked')) {
            jQuery('#hoeveelstudieschuldDiv').show();
        } else {
            jQuery('#hoeveelstudieschuldDiv').hide();
        }
    });
    jQuery('#roodstaan').click(function(){
        if(jQuery('#roodstaan').is(':checked')) {
            jQuery('#hoeveelroodstaanDiv').show();
        } else {
            jQuery('#hoeveelroodstaanDiv').hide();
        }
    });
    jQuery('#creditcard').click(function(){
        if(jQuery('#creditcard').is(':checked')) {
            jQuery('#hoeveelcreditcardDiv').show();
        } else {
            jQuery('#hoeveelcreditcardDiv').hide();
        }
    });
    jQuery('#partneralimentatie').click(function(){
        if(jQuery('#partneralimentatie').is(':checked')) {
            jQuery('#hoeveelpartneralimentatieDiv').show();
        } else {
            jQuery('#hoeveelpartneralimentatieDiv').hide();
        }
    });
    jQuery('#overigeleningen').click(function(){
        if(jQuery('#overigeleningen').is(':checked')) {
            jQuery('#hoeveeloverigeleningenDiv').show();
        } else {
            jQuery('#hoeveeloverigeleningenDiv').hide();
        }
    });

    jQuery('#opvragen').click(function(){
        var api_key = '&api_key=TEST-KEY!-1943-4518-95ca-ec025e6f79b';
        var url = 'https://testapi.hypotheekbond.nl';
        console.log('Start opvragen maximale hypotheek'); 
        
        var loan = jQuery('#loan').val();
        var vakantiegeld = jQuery('#vakantiegeld').is(':checked');
        var dertiendemaand = jQuery('#dertiendemaand').is(':checked');

        var partner = jQuery('#partner').is(':checked');
        var brutoloon = jQuery('#brutoloon').val();
        // var ondernemer = jQuery('#ondernemer').is(':checked');
        var geboortedatum = jQuery('#geboortedatum').val();
        var brutoloonpartner = jQuery('#brutoloonpartner').val();
        var geboortedatumpartner = jQuery('#geboortedatumpartner').val();
        var studieschuld = jQuery('#studieschuld').is(':checked');
        var hoeveelstudieschuld = jQuery('#hoeveelstudieschuld').val();
        var roodstaan = jQuery('#roodstaan').is(':checked');
        var hoeveelroodstaan = jQuery('#hoeveelroodstaan').val();
        var creditcard = jQuery('#creditcard').is(':checked');
        var hoeveelcreditcard = jQuery('#hoeveelcreditcard').val();
        var partneralimentatie = jQuery('#partneralimentatie').is(':checked');
        var hoeveelpartneralimentatie = jQuery('#hoeveelpartneralimentatie').val();
        var overigeleningen = jQuery('#overigeleningen').is(':checked');
        var hoeveeloverigeleningen = jQuery('#hoeveeloverigeleningen').val();
        
        jQuery('#foutmelding-niet-alles-gevuld').hide();

        //zijn alle verplichte velden wel gevuld?
        var allesGevuld = true;
        if(brutoloon == '') {
            allesGevuld = false;
        }
        if(geboortedatum == '') {
            allesGevuld = false;
        }
        if(partner) {
            if(brutoloonpartner == '') {
                allesGevuld = false;
            }
            if(geboortedatumpartner == '') {
                allesGevuld = false;
            }
        }
        
        if(allesGevuld) {
            geboortedatum = moment(geboortedatum, 'DD-MM-YYYY').format('YYYY-MM-DD');
            console.log('Eerst de rentepercentages opvragen');
            jQuery.get(url + '/interest/v1/interest-rates?bestInterestOnly=false&sortBy=percentage&sortDirection=ASC&limit=25' + api_key, null ,function(result){
                
                var nhg = jQuery('#nhg').is(':checked');
    
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
                .filter(function(data) {
                    return data.productId == 582;
                })
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
                
                request += '?nhg=' + nhg;
                request += '&duration=360';
                request += '&percentage=' + percentage;
                request += '&rateFixation=10';
                request += '&notDeductible=0';
                request += '&groundRent=0';
                request += '&person%5B0%5D%5Bincome%5D=' + brutoloon;
                request += '&person%5B0%5D%5Bage%5D=' + moment().diff(geboortedatum, 'years');
                if(partneralimentatie) {
                    request += '&person%5B0%5D%5Balimony%5D=0';
                }
                if(overigeleningen) {
                    request += '&person%5B0%5D%5Bloans%5D=0';
                }
                if(studieschuld) {
                    request += '&person%5B0%5D%5BstudentLoans%5D=0';
                }
                if(partner) {
                    request += '&person%5B1%5D%5Bincome%5D=0';
                    request += '&person%5B1%5D%5Bage%5D=' + moment().diff(geboortedatumpartner, 'years');
                    request += '&person%5B1%5D%5Balimony%5D=0';
                    request += '&person%5B1%5D%5Bloans%5D=0';
                    request += '&person%5B1%5D%5BstudentLoans%5D=0'
                }
                jQuery('#debug').html(replaceAll(request, '\&', '<br />'));
                jQuery.get(request + api_key, null ,function(result){
                    result.data.result = 250000;

                    jQuery('#resultaat').show();
                    jQuery('#result').text(maakBedragOp(result.data.result));
                    jQuery('#max-hypotheek').text(result.data.result);
                    
                    var benodigd = parseInt(jQuery('#benodigdehypotheek').val());
                    var eigenmiddelen = benodigd - result.data.result;
                    
                    if(eigenmiddelen > 0) {
                        jQuery('#eigen-middelen').show();
                        jQuery('#eigen-middelen-bedrag').text(maakBedragOp(eigenmiddelen));
                    }
                    
                });
                
                function replaceAll(str, find, replace) {
                    return str.replace(new RegExp(find, 'g'), replace);
                }
            });
        } else {
            console.log('Niet alle verplichte velden zijn gevuld, foutmelding!');

            jQuery('#foutmelding-niet-alles-gevuld').show();
        }
    });        

    function maakBedragOp(bedrag) {
		if(bedrag !== undefined && bedrag !== null){
			var opgemaaktBedrag = String(bedrag) + ',00';

			return '\u20AC ' + opgemaaktBedrag.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
		}
	}
});