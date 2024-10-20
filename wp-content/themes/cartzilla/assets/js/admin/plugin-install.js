/**
 * admin.js
 *
 * Handles behaviour of the theme
 */
( function( $, window ) {
    'use strict';

    $( document ).on( 'ready', function () {
        appendReqButtons();
    } );

    function appendReqButtons() {
        $( '.js-ocdi-gl-item' ).each( function( index ) {
                            console.log(ocdi_params.cz_hubspot);

            var $item         = $(this),
                name          = $item.data( 'name' ),
                $footer       = $item.find( '.ocdi__gl-item-footer' ),
                importButton  =  $item.find( '.ocdi__gl-item-button.button-primary' ),
                urlParams     = new URLSearchParams( $(importButton).attr( 'href' ) ),
                fileValue     = urlParams.get( 'import' ),
                txtInstall    = ocdi_params.txt_install,
                url           = ocdi_params.tgmpa_url;

                if (  'cartzilla - hubspot' === name ) {
                    if(ocdi_params.cz_hubspot == 'yes' ) {
                        $(".js-ocdi-gl-item[data-name='cartzilla - hubspot']").addClass("d-none");
                        $("a[href='#crmlivechat']").parent().addClass('d-none');
                    } else {
                        $(".js-ocdi-gl-item[data-name='cartzilla - hubspot']").removeClass("d-none");
                        $("a[href='#crmlivechat']").parent().removeClass('d-none');
                    }
                    txtInstall = 'Install Hubspot';
                    
                    $(importButton).hide();
                    $(importButton).after( '<a class="ocdi__gl-item-button button button-primary" href=" ' + url + '">' + txtInstall + '</a>' );
                }                   
        } );
    }

} )( jQuery, window );