jQuery(document).ready(function($){
	//upload
	$("[name='gymbase_upload_button']").live('click', function(){
		var self = $(this);
		window.send_to_editor = function(html) 
		{
			var url;
			if($('img',html).length)
			{
				url = $('img',html).attr('src');
				if(self.attr("id")=="logo_url_upload_button")
					url = $(html).attr('href');
			}
			else
				url = $(html).attr('href');
			self.prev().val(url);
			tb_remove();
		}
	 	 
		tb_show('', 'media-upload.php?amp;type=image&amp;TB_iframe=true');
		return false;
	});
	if($("#gymbase-options-tabs").length)
		$("#gymbase-options-tabs").tabs({
			selected: $("#gymbase-options-tabs #gymbase-selected-tab").val()
		});
	$("#gymbase_add_new_button").click(function(){
		$(this).parent().parent().before($(this).parent().parent().prev().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().parent().prev().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().parent().prev().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1)+$(this).parent().parent().prev().clone().wrap('<div>').parent().html().replace($(".slider_image_url_row").length, $(".slider_image_url_row").length+1));
		$(".slider_image_url_row:last [id^='gymbase_slider_image_url_'][type='text']").attr("id", "gymbase_slider_image_url_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_url_row:last [id^='gymbase_slider_image_url_'][type='button']").attr("id", "gymbase_slider_image_url_button_" + $(".slider_image_url_row").length);
		$(".slider_image_title_row:last [id^='gymbase_slider_image_title_'][type='text']").attr("id", "gymbase_slider_image_title_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_subtitle_row:last [id^='gymbase_slider_image_subtitle_'][type='text']").attr("id", "gymbase_slider_image_subtitle_" + $(".slider_image_url_row").length).val('');
		$(".slider_image_link_row:last [id^='gymbase_slider_image_link_'][type='text']").attr("id", "gymbase_slider_image_link_" + $(".slider_image_link_row").length).val('');
	});
	//classes hours
	$("#add_class_hours").click(function(event){
		event.preventDefault();
		if($("#start_hour").val()!='' && $("#end_hour").val()!='')
		{
			$("#class_hours_list").css("display", "block").append('<li>' + $("#weekday_id :selected").html() + ' ' + $("#start_hour").val() + "-" + $("#end_hour").val() + '<input type="hidden" name="weekday_ids[]" value="' + $("#weekday_id").val() + '" /><input type="hidden" name="start_hours[]" value="' + $("#start_hour").val() + '" /><input type="hidden" name="end_hours[]" value="' + $("#end_hour").val() + '" /><img class="delete_button" src="' + config.img_url + 'delete.png" alt="del" /></li>');
			$("#start_hour, #end_hour").val("");
			$("#weekday_id :first").attr("selected", "selected");
		}
	});
	$("#class_hours_list .delete_button").live("click", function(event){
		if(typeof($(this).parent().attr("id"))!="undefined")
			$("#class_hours_list").after('<input type="hidden" name="delete_class_hours_ids[]" value="' + $(this).parent().attr("id").substr(12) + '" />');
		$(this).parent().remove();
		if(!$("#class_hours_list li").length)
			$("#class_hours_list").css("display", "none");
	});
	//colorpicker
	if($(".color").length)
	$(".color").ColorPicker({
		onChange: function(hsb, hex, rgb, el) {
			$(el).val(hex);
		},
		onSubmit: function(hsb, hex, rgb, el){
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function (){
			$(this).ColorPickerSetColor(this.value);
		}
	});
});