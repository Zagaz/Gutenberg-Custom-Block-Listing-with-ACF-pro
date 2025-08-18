// ===============================
// AJAX for ACF Listing Block
// ===============================
// This code listens for changes on the <select> and updates the cards grid via AJAX, without reloading the page.
jQuery(document).ready(function($) {

    function fetchCards(term, search, $block) {
        var $grid = $block.find('.acf-listing-grid-inner');
        $grid.html('<div class="acf-listing-loading">Loading...</div>');
        $.ajax({
            url: (typeof acfListingAjax !== 'undefined') ? acfListingAjax.ajax_url : '',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'acf_listing_filter',
                term: term,
                search: search
            },
            success: function(response) {
                if (response.success && response.data && response.data.html) {
                    $grid.html(response.data.html);
                } else {
                    $grid.html('<p>No events found.</p>');
                }
            },
            error: function() {
                $grid.html('<p>Error loading events.</p>');
            }
        });
    }

    // On select change

    $(document).on('change', '.acf-listing-selector', function(e) {
        var term = $(this).val();
        var $block = $(this).closest('.acf-listing');
        var search = $block.find('.acf-listing-search').val() || '';
        fetchCards(term, search, $block);
    });

    // On search input
    $(document).on('input', '.acf-listing-search', function(e) {
        var $block = $(this).closest('.acf-listing');
        var term = $block.find('.acf-listing-selector').val() || '';
        var search = $(this).val();
        fetchCards(term, search, $block);
    });

    // On page load, trigger AJAX to render all cards (empty value)
    $('.acf-listing-selector').each(function() {
        var $block = $(this).closest('.acf-listing');
        var search = $block.find('.acf-listing-search').val() || '';
        fetchCards('', search, $block);
    });
});

