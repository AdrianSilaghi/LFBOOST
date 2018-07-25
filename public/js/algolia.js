(function(){
    var client = algoliasearch('H65DQLKL4Z', '27681bbfda84746abdab6a3c9fd059c9');
    var index = client.initIndex('posts');
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
    { hint: false }, {
        source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
        //value to be displayed in input control after user's suggestion selection
        displayKey: 'name',
        //hash of templates used when rendering dataset
        templates: {
            //'suggestion' templating function used to render a single suggestion
            header: '<div class="aa-suggestions-category">Results</div>',
            suggestion: function(suggestion) {
              return '<span>' +
                suggestion._highlightResult.title.value + '</span><span>' +
                suggestion.cat_name + '</span>';

                
            },
            empty: function(result) {
                return 'Sorry we did not find any resutls with "' + result.query + "'";
            }
        }
    }).on('autocomplete:selected', function(event,suggestion,dataset){
        window.location.href = window.location.origin + '/'+suggestion.username+'/' + suggestion.slug;
    });
})();