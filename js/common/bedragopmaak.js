var $ = jQuery;

function maakBedragOp(bedrag) {
	if(bedrag !== undefined && bedrag !== null && bedrag !== ''){
	    var strBedrag = String(bedrag).replace('.', ',');
	    
	    if(isNaN(parseInt(strBedrag))) {
	        return '';
	    }
	    
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
	    
		var opgemaaktBedrag = parts[0] + ',' + naDeKomma.substr(0, 2);

		return '\u20AC ' + opgemaaktBedrag.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
	}
}

function stripBedragOpmaak(opgemaaktBedrag) {
    return opgemaaktBedrag.replace('\u20AC', '').replace(',00', '').replace('.', '').trim();    
}