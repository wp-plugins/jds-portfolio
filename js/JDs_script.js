/*jQuery(document).ready(function() {
    // Portfolio Filtering
    jQuery('.JDs_category_nav li a').click(function() {
        jQuery(this).css('outline','none');
        jQuery('.JDs_category_nav .current').removeClass('current');
        jQuery(this).parent().addClass('current');
        var filterVal = jQuery(this).attr('rel');
        if(filterVal == 'all') {
            jQuery('.JDs_portfolio_item.hidden').fadeIn('normal').removeClass('hidden');
        } else {
            jQuery('.JDs_portfolio_item').each(function() {
                if(!jQuery(this).hasClass(filterVal)) {
                    jQuery(this).fadeOut('slow').addClass('hidden');
                } else {
                    jQuery(this).fadeIn('slow').removeClass('hidden');
                }
            });
        }
		return false;
    });
});*/