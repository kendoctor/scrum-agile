(function ($) {
    'use strict';

    function createModel(title, body, url, $trigger)
    {
        var html = "<div id=\"admin_entity_delete_modal\" class=\"modal\">"
            + "<div class=\"modal-dialog\">"
            + "<div class=\"modal-content\">"
            + "<div class=\"modal-header\">"
            + "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>"
            + "<h4 class=\"modal-title\">"+ title +"</h4>"
            + "</div>"
            + "<div class=\"modal-body\">"
            + body
            + "</div>"
            + "<div class=\"modal-footer\">"
            + "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">"+ $trigger.data('btn-close') + "</button>"
            + "<a href=\""+ url + "\" data-delete-confirm=\"inline\" class=\"btn btn-primary\">"+ $trigger.data('btn-confirm') + "</a>"
            + "</div></div></div></div>";
        $(document.body).append(html);

        $('#admin_entity_delete_modal').modal().on('hidden.bs.modal', function(e){
            $('#admin_entity_delete_modal').remove();
        });

        $('#admin_entity_delete_modal').on('click','[data-delete-confirm="inline"]', function(e){
            e.preventDefault();
            window.location.href = url;
        })

    }


    $(document).on('click', '[data-delete="admin"],[data-confirm="admin"]', function(e){
        e.preventDefault();
        var $this = $(this);

        createModel($this.data('title'), $this.data('body'), $this.attr('href'), $this);

    })

})(jQuery);