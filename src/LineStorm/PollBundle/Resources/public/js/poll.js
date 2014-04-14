define(['jquery', 'jckeditor'], function ($, ck) {

    $(document).on('widget-init', '.item-polls', function(){
        $(this).on('click', '.add-poll-option', function(e){
            e.preventDefault();
            e.stopPropagation();

            var $form = $(this).closest('.poll-option-form');
            var $ctr = $form.find('.poll-option-container');
            var indexer = {count: parseInt($form.data('index'))};
            var $newOption = addForm($ctr, $(this).data('prototype'), indexer, '__option_name__');
            $form.data('index', indexer.count);

            $newOption.find('input[name*="[order]"]').val(indexer.count);
            return false;
        }).on('click', '.post-option-remove', function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.poll-option-wrapper').remove();
            return false;
        });

        $(this).find('input[name$="[order]"]').filter(function(){ return this.name.match(/\[polls\]\[\d+\]\[order\]$/) }).val(contentCounts.components);
        $(this).find('textarea.ckeditor-textarea').ckeditor().focus();
    });

    // add ckeditor to all the pre-loaded articles
    $('.post-component-item.item-polls').each(function(){
        $(this).trigger('widget-init');
    });
});
