$(document).ready(function(){
	$("#sidebar").niceScroll();
	$("#conteudo").niceScroll();

	function addAtributosTooltip () {
		$('.item-side').each( function () {
			$(this).attr('data-placement', 'right');
			$(this).attr('title', ($(this).children('span').text()));
			$(this).tooltip('disable');
		});
	}

				
	function toggleToolTip () {
		$('#sidebar').hasClass('sm') ? $('.item-side').tooltip('enable') : $('.item-side').tooltip('disable');
	}

	function resizeNiceScroll () {
		$("#sidebar").getNiceScroll().resize();
	}

	$("#toggleSidebar").click( function () {
		$("#sidebar").toggleClass("sm");
		$("#sidebar").toggleClass("anima-side");
		$("#conteudo").toggleClass("sm");
		$("#conteudo").toggleClass("anima-side");
		$('.collapse').collapse('hide');
		toggleToolTip();
		setTimeout(resizeNiceScroll, 100);
	});

	$('.item-side').click( function () {
		$('.collapse').collapse('hide');
		$('.item-side').removeClass('selected');
		$(this).addClass('selected');
	});

	$('#sidebar').on('shown.bs.collapse', function () {
		$("#sidebar").getNiceScroll().resize();

	});
	$('#sidebar').on('hidden.bs.collapse', function () {
		$("#sidebar").getNiceScroll().resize();

	});
	
	addAtributosTooltip();

	$('.btn-account').button('toggle');
});