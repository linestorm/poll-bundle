define(['jquery', 'bootstrap', 'cms_api'], function ($, bs, api) {
    $(document).ready(function(){
        $('form.poll-form').on('submit', function(e){
            e.preventDefault();
            e.stopPropagation();

            var $form = $(this);

            api.saveForm($form, function(f){

                api.call(f.results, {
                    success: function(o){
                        if(typeof o.options !== 'undefined'){
                            var $results = $form.closest('.poll-container').find('.results-container').empty();
                            var prototype = $results.data('prototype');
                            for(var i in o.options){
                                var option = o.options[i];
                                var oPrototype = prototype.replace(/__count__/gim, option.count).replace(/__answer__/gim, option.answer).replace(/__percent__/gim, ((option.count / o.total) * 100));
                                $results.append(oPrototype);
                            }
                            $form.remove();
                        }
                    },
                    error: function(){
                        alert("Unable to fetch results");
                    }
                });
                alert('Thanks for voting!');
                $form.fadeOut();
            }, function(xhr, e, s){
                var response = xhr.responseJSON;
                alert(response.error);
            });

            return false;
        });
    });
});
