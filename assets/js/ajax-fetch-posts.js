// ===============================
// AJAX for ACF Listing Block
// ===============================
// This code listens for changes on the <select> and updates the cards grid via AJAX, without reloading the page.
jQuery(document).ready(function($) {

    function fetchCards(term, search, number, order, $block, paged) {
        var $grid = $block.find('.acf-listing-grid-inner');
        var $pagination = $block.find('.acf-listing-pagination');
        $grid.html('<div class="acf-listing-loading">Loading...</div>');
        $.ajax({
            url: (typeof acfListingAjax !== 'undefined') ? acfListingAjax.ajax_url : '',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'acf_listing_filter',
                term: term,
                search: search,
                number: number,
                order: order,
                paged: paged || 1
            },
            success: function(response) {
                if (response.success && response.data && response.data.html) {
                    var tempDiv = $('<div>').html(response.data.html);
                    var gridHtml = tempDiv.find('.acf-listing-grid-inner').html();
                    var paginationHtml = tempDiv.find('.acf-listing-pagination').html();
                    if (gridHtml) {
                        $grid.html(gridHtml);
                    } else {
                        $grid.html(response.data.html);
                    }
                    if ($pagination.length && paginationHtml) {
                        $pagination.html(paginationHtml);
                    }
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
    function triggerFetch($block, paged) {
        var term = $block.find('.acf-listing-selector').val() || '';
        var search = $block.find('.acf-listing-search').val() || '';
        var number = $block.find('.acf-listing-number-items').val() || '8';
        var order = $block.find('.acf-listing-order').val() || 'newer';
        fetchCards(term, search, number, order, $block, paged);
    }

    $(document).on('change', '.acf-listing-selector', function(e) {
        var $block = $(this).closest('.acf-listing');
        triggerFetch($block, 1);
    });

    $(document).on('change', '.acf-listing-number-items', function(e) {
        var $block = $(this).closest('.acf-listing');
        triggerFetch($block, 1);
    });

    $(document).on('change', '.acf-listing-order', function(e) {
        var $block = $(this).closest('.acf-listing');
        triggerFetch($block, 1);
    });

    // On search input
    $(document).on('input', '.acf-listing-search', function(e) {
        var $block = $(this).closest('.acf-listing');
        triggerFetch($block, 1);
    });

    // Pagination click (AJAX)
    $(document).on('click', '.acf-listing-pagination a', function(e) {
        e.preventDefault();
        var $block = $(this).closest('.acf-listing');
        var paged = 1;
        var href = $(this).attr('href');
        var match = href.match(/paged=(\d+)/);
        if (match) {
            paged = parseInt(match[1], 10);
        }
        triggerFetch($block, paged);
    });


    // On page load, trigger AJAX to render all cards (empty value)
    $('.acf-listing-selector').each(function() {
        var $block = $(this).closest('.acf-listing');
        triggerFetch($block, 1);
    });
});

