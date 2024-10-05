// Add nice 2 select for all the selects in the site
jQuery( document ).ready(function(){


   if (typeof NiceSelect !== 'undefined' && NiceSelect.bind) {
    $.each($('select'), function (index, selector) {
        const id = $(selector).attr('id');
        const searchable = $(selector).attr('searchable');

        // Skip the select elements with specific classes
        if ($(selector).hasClass('trading-history-table_length')) {
            return true; // This continues to the next iteration, skipping the current one
        }

        const options = {
            searchable: searchable == 'true' || false,
            placeholder: 'select',
            searchtext: 'Search',
            selectedtext: 'geselecteerd',
        };

        NiceSelect.bind(document.getElementById(id), options);
    });
}
 


if( jQuery('#site-main-nav').length > 0 ) {
    var main_nav_li = '';
	fetch(apiUrlCrypto)
	  	.then(response => {
	    	if (!response.ok) {
	    		return false;
	       }
	    	return response.json();  
	  	})
	  	.then(data => {
	    	const container = document.getElementById('site-main-nav');
	      	container.innerHTML = '';
	      	data.forEach(pair => {
	  		 	main_nav_li += '<li>';
	  			main_nav_li += '<div class="price-card d-flex flex-column">';
	  			main_nav_li += '<div class="d-flex justify-content-between align-items-center g-10">';
	  			main_nav_li += '<div class="country-name d-flex align-items-center g-8">';
	  			main_nav_li += '<img src="'+pair.image+'" alt="'+pair.name+' logo" class="flag">';
	  			main_nav_li += '<span>'+pair.symbol.toUpperCase()+'/USD</span>';
	  			main_nav_li += '</div>';
	  			main_nav_li += '<div class="price">$'+pair.current_price.toFixed(2)+'</div>';
	  			main_nav_li += '</div>';
	  			main_nav_li += '<div class="percentage-area d-flex align-items-center g-8">';
				main_nav_li += '<i class="fa-solid ' + (pair.price_change_percentage_24h >= 0 ? 'fa-chevron-up' : 'fa-chevron-down') + '"></i>';
				main_nav_li += '<span class="percentage ' + (pair.price_change_percentage_24h >= 0 ? 'text-success' : 'text-danger') + '">'+ pair.price_change_percentage_24h.toFixed(2) + '%</span>';	
				main_nav_li += '</div>';
	  			main_nav_li += '</div>';
	  			main_nav_li += '</li>';
	  		});
	  		container.innerHTML = main_nav_li;
	  	})
	  	.catch(error => {
	    	console.error('There was a problem with the fetch operation:', error);
	  	});
	}
});


