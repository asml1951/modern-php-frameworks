var data = [
    {
        id: 0,
        text: 'Москва'
    },
    {
        id: 1,
        text: 'Минск'
    },
    {
        id: 2,
        text: 'Московская область'
    },
    {
        id: 3,
        text: 'Новая Москва'
    },
    {
        id: 4,
        text: 'Минская область'
    },
    {
        id: 5,
        text: 'Минеральные воды'
    },
    {
        id: 6,
        text: 'Новый Уренгой'
    },
];
$(".js-example-data-array").select2({
    data: data
});

function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
        return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
        return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.text += ' (matched)';

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}

$(".js-example-matcher").select2({
    matcher: matchCustom
});
$(".js-example-data-array").select2({
    data: data
});
