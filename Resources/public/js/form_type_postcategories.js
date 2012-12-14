function form_type_postcategories(elem) {
    var fullName = elem.attr('data-fullname');
    var added = $(elem.find('.added'));
    var list = $(elem.find('.dropdown-menu'));

    function init() {
        added.sortable({
            placeholder:"ui-state-highlight",
            axis:'y',
            containment:'parent'
        }).disableSelection();

        list.find('a').click(function (e) {
            e.preventDefault();
            //elem = $(e.target);
            var id = $(this).attr('data-id');
            if (added.find('input[value=' + id + ']').length)
                return;
            addItem(
                id,
                $(this).attr('data-breadcrumbs'),
                $(this).attr('data-edit'),
                $(this).attr('data-url')
            );
            bindRemove();
        });
        bindRemove();
    }

    function bindRemove() {
        added.find('button.remove').unbind('click').click(function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });
    }

    function addItem(id, label, edit, url) {
        added.append(
            '<li class="ui-state-default">'
                + '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'
                + label
                + '<a href="' + edit + '" class="btn btn-mini"><i class="icon-pencil"></i></a>'
                + '<a href="' + url + '" class="btn btn-mini"><i class="icon-globe"></i></a>'
                + '<button class="remove btn btn-mini" ><i class="icon-remove"></i></button>'
                + '<input type="hidden" name="' + fullName + '[]" value="' + id + '"/>'
                + '</button>'
                + '</li>'
        );
    }

    init();
}
