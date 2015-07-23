(function( $ ) {

    if(typeof $MD5SUM == 'undefined'){
    	alert('En feil oppsto. Nå vet vi ikke når vi skal oppdatere oss :S');
    	return;
    }

    var delay = 1000;

    var updateor = function(){

    	$.getJSON('/remote', function( data ){
    		if($MD5SUM !== data.md5){
    			document.location.reload(true);
    		}
    	});

    	setTimeout(updateor, delay);
    };

    updateor();

}( jQuery ));