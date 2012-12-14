function form_type_postcategories(uniqID, full_name) {
    function sc_bindRemove() {
        $('#postcategories-added button').unbind('click').click(function (e) {
            e.preventDefault();
            $(this).remove();
        });
    }

    $('#' + uniqID + '_macrocategory').change(function () {
        var macroID = $(this).val();
        $('#postcategories-list li').each(function () {
            $(this).toggle($(this).find('a').attr('data-parent') == macroID);
        });
        $('#postcategories-added button').each(function () {
            $(this).toggleClass(
                'btn-danger',
                $(this).attr('data-parent') != macroID
            );
        });
    }).change();
    $('#postcategories-list a').click(function () {
        var id = $(this).attr('data-id');
        var parent = $(this).attr('data-parent');
        var label = $(this).text();
        if ($('#postcategories-added button[data-id=' + id + ']').length)
            return;
        $('#postcategories-added').append(
            '<button class="btn" data-parent="' + parent + '" data-id="' + id + '">'
                + '<i class="icon-remove"></i>'
                + '<input type="hidden" name="' + full_name + '" value="' + id + '"/>'
                + label + '</button>'
        );
        sc_bindRemove();
    });
    sc_bindRemove();
}