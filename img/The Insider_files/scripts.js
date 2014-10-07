                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                (function($){ 
	$(document).ready(function () {
		thirds = $(".arlima-content > div.thirds");
		halves = $(".arlima-content > div.halves");
		thirds.filter(function(index) {if (index == 0 || index == 3 || index == 6) return true;}).addClass('d1-d4 t1-t2 m-all');	
		thirds.filter(function(index) {if (index == 1 || index == 4 || index == 7) return true;}).addClass('d5-d8 t3-t4 m-all');	
		thirds.filter(function(index) {if (index == 2 || index == 5 || index == 8) return true;}).addClass('d9-d12 t-all m-all');
		thirds.filter(function(index) {if (index == 8 || index == 9 || index == 10) return true;}).addClass('d9-d12 t-all m-all');	
		halves.filter(function(index) {if (index == 0 || index == 2 || index == 4) return true;}).addClass('d1-d6 t1-t2 m-all');
		halves.filter(function(index) {if (index == 1 || index == 3 || index == 5) return true;}).addClass('d7-d12 t3-t4 m-all');
		news = $(".arlima-content > div.news");
		news.filter(function(index) {if (index == 0) return true;}).prev().prev().children().attr('id', 'news');
		// Spots/Homepage Widget CTA
		spot = $("aside.misc_cta ul > li");
		spot.filter(function(index) {if (index == 0) return true;}).addClass('d1-d4 t1-t2 m-all');
		spot.filter(function(index) {if (index == 1) return true;}).addClass('d5-d8 t3-t4 m-all');
		spot.filter(function(index) {if (index == 2) return true;}).addClass('d9-d12 t-all m-all');
		
		blog = $(".arlima-content > div.blog");
		blog.before('<div class="divider"></div>');
		
		$(".arlima-content > div.blog a").attr('target', '_blank');
	
		
		$('body.single article > p:first').addClass('first');
		$('.arlima-content article div.feeder').hide();
		$('.arlima-content article').mouseenter(function(){
			if($(this).find('div.feeder').length){
				var $feeder=null;
				$feeder = $(this).find('div.feeder');
				var w=($feeder.width() + 10) / 2, h=$feeder.height() + 20;
				$feeder.css({
					'margin-left':'-'+w+'px',		
					'top':'-'+h+'px'
					});
				$feeder.fadeIn();	
			}
		}).mouseleave(function(){
			if($(this).find('div.feeder').length){
				var $feeder=null;
				$feeder = $(this).find('div.feeder');
				$feeder.fadeOut();
			}
		});
		
	});
})(jQuery);





CSCO_WebVPN["flush"]();