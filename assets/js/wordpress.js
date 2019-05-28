// jQuery(document).ready( function($){

    /* Ajax functions */
	$(document).on('click','.sunset-load-more:not(.loading)', function(){

        console.log('teste');

		var that = $(this);
		var page = $(this).data('page');
		var newPage = page+1;
		var ajaxurl = that.data('url');

		that.addClass('loading').find('.text').slideUp(320);
		that.find('.sunset-icon').addClass('spin');

		$.ajax({
			url : ajaxurl,
			type : 'post',
			data : {

				page : page,
				action: 'sunset_load_more'

			},
			error : function( response ){
                console.log('error');
				console.log(response);
			},
			success : function( response ){
                console.log('sucesso');
				that.data('page', newPage);
				$('.results-blog').append( response );

				setTimeout(function(){
					that.removeClass('loading').find('.text').slideDown(320);
					that.find('.sunset-icon').removeClass('spin');
				}, 1000);
			}
		});
	});

// });
