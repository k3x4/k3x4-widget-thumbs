(function($) {
    
    var elems = [];
    $('#widgets-right .widget[id*="media_image"]').each(function(){
        elems.push({
            elemId: this.id,
            attachId: $('[data-property="attachment_id"]', this).val()
        })
    });

    if(elems.length > 0){
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                'action': 'k3x4_widgets_imgs',
                'ids': elems,
            },
            success: function(response) {
                var items = $.parseJSON(response);
                for (var i = 0; i < items.length; i++) { 
                    $('#'+items[i].elemId).find('.widget-top').prepend('<img class="inject-img" src="'+items[i].attachUrl+'" />');
                }
            },
        });
    }
      
})( jQuery );