( function ( $ ) {

	if ( 'undefined' == typeof colormagInfiniteScrollParams ) {
		return;
	}

	let infiniteScrollParams = colormagInfiniteScrollParams; // Localized data.

	let infiniteTotal       = parseInt( infiniteScrollParams['infiniteTotal'] ),
		infiniteCount       = parseInt( infiniteScrollParams['infiniteCount'] ),
		ajaxUrl             = infiniteScrollParams['ajaxUrl'],
		infiniteNonce       = infiniteScrollParams['infiniteNonce'],
		pagination          = infiniteScrollParams['pagination'],
		loadStatus          = true,
		infiniteScrollEvent = infiniteScrollParams['infiniteScrollEvent'],
		nextPostLoadEvent   = infiniteScrollParams['nextPostLoadEvent'],
		message             = infiniteScrollParams['allPostsLoadedMessage'],
		catId               = infiniteScrollParams['catId'],
		catQueryVars        = infiniteScrollParams['catQueryVars'],
		curPostId           = infiniteScrollParams['curPostId'],
		isSingle            = 1 === parseInt( infiniteScrollParams['isSinglePost'] );

	function loadArticles( pageNumber ) {

		let data = {
				action: isSingle ? 'colormag_next_post_load_response' : 'tg_infinite_scroll',
				page_no: pageNumber,
				nonce: infiniteNonce,
				cat_id: catId,
				query_vars: isSingle ? catQueryVars : infiniteScrollParams['queryVars'],
				cur_post_id: curPostId,
			},
			loadMore = $( '.tg-load-more' );

		loadMore.addClass( 'loading' );

		$.post( ajaxUrl, data, function( data ) {

			let posts = $( data );

			loadMore.removeClass( 'loading' );

			if ( isSingle ) {

				let postWrapper = document.createElement( 'div' );
				postWrapper.setAttribute( 'class', 'colormag-ajax-post-wrapper' );

				$( '#primary .tg-load-next-post' ).append( postWrapper );
				$( '#primary .tg-load-next-post .colormag-ajax-post-wrapper:last-of-type' ).append( posts );

                $( window ).trigger( 'colormagAjaxSinglePostLoaded' );

			} else {
				$( '#primary .article-container' ).append( posts );

				if( infiniteCount > infiniteTotal ) {

					loadMore.addClass( 'tg-no-more-post' );
					loadMore.html( '<span class="tg-no-more-post-text">' + message + '</span>' );
				}
			}

			loadStatus = true;

		} );
	}

	function inViewPort( el, callback, options = {} ) {

		return new IntersectionObserver( function( entries ) {

				entries.forEach( function( entry ) {
						callback( entry );
					}
				);
			},
			options
		).observe( document.querySelector( el ) );
	}

	if ( 'infinite_scroll' === pagination ) {

		switch ( infiniteScrollEvent ) {

			case 'button':

				$( document ).on( 'click', '.tg-load-more-btn', function( e ) {

					e.preventDefault();

					if( infiniteCount && infiniteTotal ) {

						if ( infiniteCount > infiniteTotal ) {
							return false;
						}

						loadArticles( infiniteCount );
						infiniteCount++;
					}
				} );

				break;

			case 'scroll' :

				if ( $( '#primary .article-container' ).find( 'article:last' ).length > 0 ) {

					if ( infiniteCount > infiniteTotal ) {
						return false;
					}

					inViewPort( '.tg-infinite-pagination', function( element ) {

						if ( element.isIntersecting ) {

							if ( loadStatus && ( infiniteCount <= infiniteTotal ) ) {

								loadArticles( infiniteCount );
								infiniteCount++;
								loadStatus = false;
							}
						}
					}, {} );
				}

				break;
		}
	}

	if ( isSingle ) {

		switch ( nextPostLoadEvent ) {

			case 'button':

				$( document ).on( 'click', '.tg-load-more-btn', function( e ) {

					e.preventDefault();

					if( infiniteCount && infiniteTotal ) {

						if ( infiniteCount > infiniteTotal ) {
							return false;
						}

						loadArticles( infiniteCount );
						infiniteCount++;
					}
				} );

				break;

			case 'scroll' :

				if ( infiniteCount > infiniteTotal ) {
					return false;
				}

				inViewPort( '.tg-infinite-pagination', function( element ) {

					if ( element.isIntersecting ) {

						if ( loadStatus && ( infiniteCount <= infiniteTotal ) ) {

							loadArticles( infiniteCount );
							infiniteCount++;
							loadStatus = false;
						}
					}
				}, {} );

				break;
		}
	}

} )( jQuery );
