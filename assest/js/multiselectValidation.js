    function checkMultiselectValidation(field, rules, i, options){
         if (!($('ul.multiselect-container').children().hasClass('active'))) {
            rules.push('required');
        }
    }
