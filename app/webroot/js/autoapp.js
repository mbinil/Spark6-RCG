// JavaScript Document
jQuery(function($){

var preload_data_editors = [
    { id: '0', text: '012'},
	{ id: '1', text: '123'},
    { id: '2', text: '234'},
    { id: '3', text: '345'},
    { id: '4', text: '456'},
    { id: '5', text: '567'},
    { id: '6', text: '678'},
    { id: '7', text: '789'},
    { id: '8', text: '890'},
	{ id: '9', text: '901'}
];
$('div.multisel div').select2({
    multiple: true,
    query: function (query) {
        var data = {results: []}, preload;
        switch ($(this.element).parent('div').attr('class')) {
            case 'multisel editors':
                preload = preload_data_editors;
                break;
        }
        preload = preload || []
        $.each(preload, function() {
            // if (query.term.length == 0 || this.text.toUpperCase().indexOf(query.term.toUpperCase()) >= 0 ){
                data.results.push({id: this.id, text: this.text });
            // }
        });
        query.callback(data);
    }
})

});