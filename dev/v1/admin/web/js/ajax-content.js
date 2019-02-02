function AceAjax() {
	var self = this;
	this.settings = {
		max_wait: false,
		cache: false,
	};
	var working = false;
	var loadTimer = null;
	this.loader = function() {
		var url = $.trim(window.location.hash);
		url = url.replace(/^(\#\!)?\#/, '');
		if(working) return;
		working = true;
		$('body').append('<div class="ajax-loading-overlay"></div>');
		if(this.settings.max_wait !== false) {
			loadTimer = setTimeout(function() {
				loadTimer = null;
				if(!working) return;
				var event
				$('.page-content').trigger(event = $.Event('ajaxloadlong'))
				if (event.isDefaultPrevented()) return;
				self.stopLoading();
			}, this.settings.max_wait * 1000);
		}
		$.ajax({'url': url, 'cache': self.settings.catch})
		.error(function() {
			$('.page-content').trigger('ajaxloaderror');
			self.stopLoading();
		})
		.done(function(result) {
			$('.page-content').trigger('ajaxloaddone');
			var link_element = null, link_text = '';
			link_element = $('a[data-url="'+url+'"]');
			if(link_element.length > 0) {
				var nav = link_element.closest('.nav');
				if(nav.length > 0) {
					nav.find('.active').each(function(){
						var $class = 'active';
						$(this).removeClass($class);							
					})
					link_element.closest('li').addClass('active').parents('.nav li').addClass('active open');
				}
			}
			//convert "title" and "link" tags to "div" tags for later processing
			result = String(result)
				.replace(/<(title|link)([\s\>])/gi,'<div class="hidden ajax-append-$1"$2')
				.replace(/<\/(title|link)\>/gi,'</div>')
			$('.page-content').empty().html(result);
			//remove previous stylesheets inserted via ajax
			setTimeout(function() {
				$('head').find('link.ace-ajax-stylesheet').remove();

				var main_selectors = ['link.ace-main-stylesheet', 'link#main-ace-style', 'link[href*="/ace.min.css"]', 'link[href*="/ace.css"]']
				var ace_style = [];
				for(var m = 0; m < main_selectors.length; m++) {
					ace_style = $('head').find(main_selectors[m]).first();
					if(ace_style.length > 0) break;
				}
				$('.page-content').find('.ajax-append-link').each(function(e) {
					var $link = $(this);
					if ( $link.attr('href') ) {
						var new_link = jQuery('<link />', {type : 'text/css', rel: 'stylesheet', 'class': 'ace-ajax-stylesheet'})
						if( ace_style.length > 0 ) new_link.insertBefore(ace_style);
						else new_link.appendTo('head');
						new_link.attr('href', $link.attr('href'));//we set "href" after insertion, for IE to work
					}
					$link.remove();
				})
			}, 10);
			$('.page-content').trigger('ajaxloadcomplete');
			self.stopLoading();
		})
	}
	this.stopLoading = function() {
		working = false;
		$('.ajax-loading-overlay').remove();
		if(loadTimer != null) {
			clearTimeout(loadTimer);
			loadTimer = null;
		}
	}
	$(window).on('hashchange', function() {
		self.loader();
	}).trigger('hashchange');
}