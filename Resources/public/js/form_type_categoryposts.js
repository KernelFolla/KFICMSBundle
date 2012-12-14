function form_type_categoryposts(elem, autocompleteUrl) {
    var fullName = elem.attr('data-fullname');
    var added = elem.find('.added');
    var autocomplete = elem.find('.autocomplete');

    function init() {
        added.sortable({
            placeholder:"ui-state-highlight",
            axis:'y',
            containment:'parent'
        }).disableSelection();
        autocomplete.autocomplete({
            source:autocompleteUrl,
            minLength:3,
            focus:function (event, ui) {
                $(this).val(ui.item.label);
                return false;
            },
            select:function (event, ui) {
                addItem(ui.item);
                return false;
            }
        }).data("autocomplete")._renderItem = function (ul, item) {
            if (!added.find('input[value=' + item.id + ']').length)
                return $("<li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.label + "</a>")
                    .appendTo(ul);
        };

        bindRemove();
    }

    function bindRemove() {
        added.find('button.remove').unbind('click').click(function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });
    }

    function addItem(item) {
        added.append(
            '<li class="ui-state-default">'
                + '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'
                + item.label
                + '<a href="' + item.edit + '" class="btn btn-mini"><i class="icon-pencil"></i></a>'
                + '<a href="' + item.url + '" class="btn btn-mini"><i class="icon-globe"></i></a>'
                + '<button class="remove btn btn-mini" ><i class="icon-remove"></i></button>'
                + '<input type="hidden" name="' + fullName + '[]" value="' + item.id + '"/>'
                + '</button>'
                + '</li>'
        );
    }

    init();
}
