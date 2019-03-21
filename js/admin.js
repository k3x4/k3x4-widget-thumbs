(function($) {
    
    var ids = [];
    $('#widgets-right .widget[id*="media_image"]').each(function(){
        /*ids.push(this.id + '|' + $('[data-property="attachment_id"]', this).val());*/
        ids.push($('[data-property="attachment_id"]', this).val());
    });

    if(ids.length > 0){
        ids = ids.join(',');
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                'action': 'k3x4_widgets_imgs',
                'ids': ids,
                /*'action':                   'query-attachments',
                'post__in':                  ids,
                'query[posts_per_page]':    -1,*/
            },
            success: function(response) {
                var items = $.parseJSON(response);
                var i;
                var id;
                var $item;
                for (i = 0; i < items.length; i++) { 
                    id = items[i].id;
                    img = items[i].url;
                    $item = $('.media-widget-instance-property[value="'+id+'"]').closest('#widgets-right .widget[id*="media_image"]');
                    $item.find('.widget-top').css('height', '100px').prepend('<img src="'+img+'" width="100px" height="100px" style="display:inline-block;float:left;" />');
                    $item.find('.widget-top .ui-sortable-handle').css('height', '100px');
                }
            },
        });
    }
      
})( jQuery );