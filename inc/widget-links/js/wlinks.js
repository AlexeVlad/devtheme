jQuery(document).ready(function($) {
	if(!$('body').hasClass('widgets_access')){
		wlinksSetupList($);
		$('.wlinks-edit-item').addClass('toggled-off');
		wlinksSetupHandlers($);
	}
	
	$(document).ajaxSuccess(function() {
		wlinksSetupList($);
		$('.wlinks-edit-item').addClass('toggled-off');
	});
});

function wlinksSetupList($){
	$( ".simple-link-list" ).sortable({
		items: '.list-item',
		opacity: 0.6,
		cursor: 'n-resize',
		axis: 'y',
		handle: '.moving-handle',
		placeholder: 'sortable-placeholder',
		start: function (event, ui) {
			ui.placeholder.height(ui.helper.height());
		},
		update: function() {
			updateOrder($(this));
		}
	});
	
	$( ".simple-link-list .moving-handle" ).disableSelection();
}


// All Event handlers
function wlinksSetupHandlers($){
	$("body").on('click.wlinks','.wlinks-delete',function() { 
		$(this).parent().parent().fadeOut(500,function(){
			var wlinks = $(this).parents(".widget-content");
			$(this).remove();
			wlinks.find('.order').val(wlinks.find('.simple-link-list').sortable('toArray'));
			var num = wlinks.find(".simple-link-list .list-item").length;
			var amount = wlinks.find(".amount");
			amount.val(num);
		});
	});
	
	$("body").on('click.wlinks','.wlinks-add',function() { 
		var wlinks = $(this).parent().parent();
		var num = wlinks.find('.simple-link-list .list-item').length + 1;
		
		wlinks.find('.amount').val(num);
		
		var item = wlinks.find('.simple-link-list .list-item:last-child').clone();
		var item_id = item.attr('id');
		item.attr('id',increment_last_num(item_id));

		$('.toggled-off',item).removeClass('toggled-off');
		$('.number',item).html(num);
		$('.item-title',item).html('');
		
		$('label',item).each(function() {
			var for_val = $(this).attr('for');
			$(this).attr('for',increment_last_num(for_val));
		});
		
		$('input',item).each(function() {
			var id_val = $(this).attr('id');
			var name_val = $(this).attr('name');
			$(this).attr('id',increment_last_num(id_val));
			$(this).attr('name',increment_last_num(name_val));
			if($(':checked',this)){
			   $(this).removeAttr('checked');
			}
			$(this).val('');
		});
		
		wlinks.find('.simple-link-list').append(item);
		wlinks.find('.order').val(wlinks.find('.simple-link-list').sortable('toArray'));
	});
	
	$('body').on('click.wlinks','.moving-handle', function() {
		$(this).parent().find('.wlinks-edit-item').slideToggle(200);
	} );
}

function increment_last_num(v) {
    return v.replace(/[0-9]+(?!.*[0-9])/, function(match) {
        return parseInt(match, 10)+1;
    });
}

function updateOrder(self){
	var wlinks = self.parents(".widget-content");
	wlinks.find('.order').val(wlinks.find('.simple-link-list').sortable('toArray'));
}