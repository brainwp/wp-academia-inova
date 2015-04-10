//responsive menu
/*! http://tinynav.viljamis.com v1.2 by @viljamis */
(function(a,k,g){a.fn.tinyNav=function(l){var c=a.extend({active:"selected",header:"",indent:"- ",label:""},l);return this.each(function(){g++;var h=a(this),b="tinynav"+g,f=".l_"+b,e=a("<select/>").attr("id",b).addClass("tinynav "+b);if(h.is("ul,ol")){""!==c.header&&e.append(a("<option/>").text(c.header));var d="";h.addClass("l_"+b).find("a").each(function(){d+='<option value="'+a(this).attr("href")+'">';var b;for(b=0;b<a(this).parents("ul, ol").length-1;b++)d+=c.indent;d+=a(this).text()+"</option>"});
e.append(d);c.header||e.find(":eq("+a(f+" li").index(a(f+" li."+c.active))+")").attr("selected",!0);e.change(function(){k.location.href=a(this).val()});a(f).after(e);c.label&&e.before(a("<label/>").attr("for",b).addClass("tinynav_label "+b+"_label").append(c.label))}})}})(jQuery,this,0);

if(!Date.prototype.toISOString) 
{
    Date.prototype.toISOString = function() 
	{
        function pad(n) {return n < 10 ? '0' + n : n}
        return this.getUTCFullYear() + '-'
            + pad(this.getUTCMonth() + 1) + '-'
                + pad(this.getUTCDate()) + 'T'
                    + pad(this.getUTCHours()) + ':'
                        + pad(this.getUTCMinutes()) + ':'
                            + pad(this.getUTCSeconds()) + 'Z';
    };
}
function onAfterSlide(prevSlide, currentSlide)
{
	jQuery("#" + jQuery(currentSlide).attr("id") + "_content").fadeIn();
	jQuery(".slider_navigation .more").css("display", "none");
	jQuery("#" + jQuery(currentSlide).attr("id") + "_url").css("display", "block");
}
function onBeforeSlide()
{
	jQuery(".slider_content").fadeOut();
}
jQuery(document).ready(function($){
	//mobile menu
	$(".sf-menu").tinyNav({
	    header: 'Menu', // String: Specify text for "header" and show header instead of the active item
        indent: '- ', // String: Specify text for indenting sub-items
    });

	$('.tabs ul.tabs_navigation li a').on('click',function(e){
		console.log('ahoyyyyyyyyyyyyyyyyyy');
		e.preventDefault();
		if($(this).attr('href')){
			var _filter_hash = $(this).attr('href');
			var _filter = _filter_hash.replace('#','');
			$('.tabs div').each(function(){
				if($(this).attr('id') == _filter){
					$(this).fadeIn('slow');
				}
				else{
					$(this).fadeOut('slow');
				}
			});
		}
	});
	//upcoming classes
	//browser history
	$(".tabs .ui-tabs-nav a").click(function(){
		if ( $(this).hasClass("no-tab") )
			window.location = $(this).attr("href");
		else if(typeof($.data(this, "href.tabs"))=="undefined")
			$.bbq.pushState($(this).attr("href"));
		else
			window.location.href = $.data(this, "href.tabs");
	});
	$(".ui-accordion .ui-accordion-header").click(function(){
	    $.bbq.pushState("#" + $(this).attr("id").replace("accordion-", ""));
   	});
	
	//hashchange
	$(window).bind("hashchange", function(event){
		var hashSplit = $.param.fragment().split("-");
		$(".ui-accordion .ui-accordion-header#accordion-" + $.param.fragment()).trigger("change");
		$(".ui-accordion .ui-accordion-header#accordion-" + hashSplit[0]).trigger("change");
		$(".tabs .ui-tabs-nav [href='#" + $.param.fragment() + "']").trigger("change");
		
		// get options object from hash
		var hashOptions = $.deparam.fragment();

		if(typeof(hashOptions.filter)!="undefined")
		{
			// apply options from hash
			$(".isotope_filters a").removeClass("selected");
			if($(".isotope_filters a[href='#filter="+hashOptions.filter+"']").length)
				$(".isotope_filters a[href='#filter="+hashOptions.filter+"']").addClass("selected");
			else
				$(".isotope_filters li:first a").addClass("selected");
			$(".gallery").isotope(hashOptions);
			$(".timetable_isotope").isotope(hashOptions);
		}
		
		if(location.hash.substr(1,7)=="comment")
		{
			if($(location.hash).length)
			{
				var offset = $(location.hash).offset();
				$("html, body").animate({scrollTop: offset.top-10}, 400);
			}
		}
		
		if(location.hash.substr(1,4)=="page")
		{
			$.ajax({
				url: config.ajaxurl,
				data: "action=theme_get_comments&post_id=" + $("#comment_form [name='post_id']").val() + "&paged="+parseInt(location.hash.substr(6)),
				type: "get",
				dataType: "json",
				success: function(json){
					if(typeof(json.html)!="undefined")
						$("#comments").html(json.html);
					var hashSplit = location.hash.split("/");
					var offset = null;
					if(hashSplit.length==2 && hashSplit[1]!="")
						offset = $("#" + hashSplit[1]).offset();
					else
						offset = $("#comments").offset();
					if(offset!=null)
						$("html, body").animate({scrollTop: offset.top-10}, 400);
				}
			});
			return;
		}
		
		//open gallery details
		if(location.hash.substr(1,21)=="gallery-details-close" || typeof(hashOptions.filter)!="undefined")
		{
			$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint', complete:function(){
				$(this).css("display", "none")
				$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			}
			});
		}
		else if(location.hash.substr(1,15)=="gallehttps://thethemefoundry.com/wordpress-themes/make/ry-details")
		{
			var detailsBlock = $(location.hash);
			$(".gallery_item_details_list .gallery_item_details").css("display", "none");
			detailsBlock.css("display", "block");
			var galleryItem = $("#gallery-item-" + location.hash.substr(17));
			detailsBlock.find(".prev").attr("href", (galleryItem.prevAll(":not('.isotope-hidden')").first().length ? galleryItem.prevAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".gallery").children(":not('.isotope-hidden')").last().find(".open_details").attr("href")));
			detailsBlock.find(".next").attr("href", (galleryItem.nextAll(":not('.isotope-hidden')").first().length ? galleryItem.nextAll(":not('.isotope-hidden')").first().find(".open_details").attr("href") : $(".gallery").children(":not('.isotope-hidden')").first().find(".open_details").attr("href")));
			var visible=parseInt($(".gallery_item_details_list").css("height"))==0 ? false : true;
			var galleryItemDetailsOffset;
			if(!visible)
			{
				$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()}, 500, 'easeOutQuint', function(){
					$(this).css("height", "100%");
				});
				galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
				$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
			}
			else
			{
				/*$(".gallery_item_details_list").animate({height:'0'},{duration:200,easing:'easeOutQuint',complete:function() 
				{
					$(this).css("display", "none")*/
					//$(".gallery_item_details_list").css("height", "100%");
					galleryItemDetailsOffset = $(".gallery_item_details_list").offset();
					$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-10}, 400);
					/*$(".gallery_item_details_list").css("display", "block").animate({height:detailsBlock.height()},{duration:500,easing:'easeOutQuint'});
				}});*/
			}
		}
	}).trigger("hashchange");
	
	//timeago
	$("abbr.timeago").timeago();
	
	$(".footer_recent_posts").trigger("configuration", {
		items: {
			visible: ($(".footer_recent_posts").children().length>2 ? 3 : $(".footer_recent_posts").children().length)
		},
		prev: '#footer_recent_posts_prev',
		next: '#footer_recent_posts_next'
	});
	$(".most_commented").trigger("configuration", {
		items: {
			visible: ($(".most_commented").children().length>2 ? 3 : $(".most_commented").children().length)
		},
		prev: '#most_commented_prev',
		next: '#most_commented_next'
	});
	$(".most_viewed").trigger("configuration", {
		items: {
			visible: ($(".most_viewed").children().length>2 ? 3 : $(".most_viewed").children().length)
		},
		prev: '#most_viewed_prev',
		next: '#most_viewed_next'
	});
	
	//window resize
	$(window).resize(function(){
		$(".accordion").accordion("resize");
	});
	
	//scroll top
	$("a[href='#top']").click(function() {
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});
	
	//hint
	$(".search input[type='text'], .comment_form input[type='text'], .comment_form textarea, .contact_form input[type='text'], .contact_form textarea").hint();
	
	//tooltip
	$(".tooltip").bind("mouseover click", function(){
		var position = $(this).position();
		var tooltip_text = $(this).children(".tooltip_text");
		tooltip_text.css("width", $(this).outerWidth() + "px");
		tooltip_text.css("height", tooltip_text.height() + "px");
		tooltip_text.css({"top": position.top-tooltip_text.innerHeight() + "px", "left": position.left + "px"});
	});
	
	//isotope
	$(".gallery").isotope();
	$(".timetable_isotope").isotope();
	
	//fancybox
	$(".fancybox").attr("rel", "gallery");
	$(".fancybox").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic'
	});
	$(".fancybox-video").bind('click',function() 
	{
		$.fancybox(
		{
			'autoScale':false,
			'speedIn': 600, 
			'speedOut': 200,
			'transitionIn': 'elastic',
			'width':(this.href.indexOf("vimeo")!=-1 ? 600 : 680),
			'height':(this.href.indexOf("vimeo")!=-1 ? 338 : 495),
			'href':(this.href.indexOf("vimeo")!=-1 ? this.href : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/')),
			'type':(this.href.indexOf("vimeo")!=-1 ? 'iframe' : 'swf'),
			'swf':
			{
				'wmode':'transparent',
				'allowfullscreen':'true'
			}
		});
		return false;
	});
	$(".fancybox-iframe").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'width' : '75%',
		'height' : '75%',
		'autoScale' : false,
		'titleShow': false,
		'type' : 'iframe'
	});
	
	//comment form, contact form
	$(".comment_form, .contact_form").submit(function(event){
		event.preventDefault();
		var data = $(this).serializeArray();
		var id = $(this).attr("id");
		$("#"+id+" .block").block({
			message: false,
			overlayCSS: {opacity:'0.3'}
		});
		$.ajax({
			url: config.ajaxurl,
			data: data,
			type: "post",
			dataType: "json",
			success: function(json){
				$("#"+id+" [name='submit'], #"+id+" [name='name'], #"+id+" [name='email'], #"+id+" [name='message']").qtip('destroy');
				if(typeof(json.isOk)!="undefined" && json.isOk)
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#"+id+" [name='submit']").qtip(
						{
							style: {
								classes: 'ui-tooltip-success'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
						if(id=="comment_form" && typeof(json.html)!="undefined")
						{
							$("#comments").html(json.html);
							$("#comment_form [name='comment_parent_id']").val(0);
							if(typeof(json.change_url)!="undefined")
								window.location.href = json.change_url;
							if(typeof(json.comment_id)!="undefined")
							{
								var offset = $("#comment-" + json.comment_id).offset();
								$("html, body").animate({scrollTop: offset.top-10}, 400);
							}
						}
						$("#"+id)[0].reset();
						$("#cancel_comment").css("display", "none");
						$("#"+id+" [name='name'], #"+id+" [name='email'], #"+id+" [name='website'], #"+id+" [name='message']").addClass("hint");
					}
				}
				else
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#"+id+" [name='submit']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_name)!="undefined" && json.error_name!="")
					{
						$("#"+id+" [name='name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_email)!="undefined" && json.error_email!="")
					{
						$("#"+id+" [name='email']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_email 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_message)!="undefined" && json.error_message!="")
					{
						$("#"+id+" [name='message']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_message 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
				}
				$("#"+id).unblock();
			}
		});
	});
});