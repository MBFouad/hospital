/*!
 * jQuery form module
 * inline editing for datatables  in travware
 * 
 * 
 * @author: Denny Brandes <denny.brandes@lewilew.com>
 */



;
(function($, window, document, undefined) {



    // Create the defaults once
    var pluginName = 'form',
    defaults = {
        propertyName: "value",
        formMethod: 'post',
        formActionUrl: "",
        newRowTrClass: 'add_new_row',
        newRowFormElements: new Array(),
        formId: '',
        withNew: true,
        fieldInformations: new Object(),
        editMode: false,
        partial: '',
        partialUrl: '',
        editRowBackup: '',
        defaultWidth: "100px",
        beforeSubmit: function(data) {
            return data;
        },
        hookSave: function() {
        }
    },
    formElements = 'select, input, checkbox, radio, file';

    // The actual plugin constructor
    function Plugin(element, options) {
        
        this.element = $(element);

        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = pluginName;
        this._formElements = formElements;

        this.init();
    }

    Plugin.prototype._build_text = function(el, name, fieldOptions, value, blur, row) {
        var that = this;
        var input = document.createElement('input');

        var width = that.options.defaultWidth;
        if (typeof fieldOptions.width !== 'undefined' && fieldOptions.width !== false) {
            width = fieldOptions.width;
        }

        input.type = "text";

        if (typeof fieldOptions.maxLength !== 'undefined' && fieldOptions.maxLength !== false) {
            input.maxLength = fieldOptions.maxLength;
        }

        input.name = name;
        input.className = fieldOptions.validation;
        input.value = value;
        if (blur) {
            $(input).blur();

        }
        $(el).html(input);

        if (typeof fieldOptions.events !== 'undefined' &&
            fieldOptions.events !== false &&
            fieldOptions.events instanceof Array) {

            $.each(fieldOptions.events, function(key, val) {
                $(input).bind(val.type, function(event) {
                    val.action(event, input, row);
                })
            })
        }

        this._bindSubmitEvent(input);
        $(input).css('width', width);
    }
    
    Plugin.prototype._build_file = function(el, name, fieldOptions, value, blur, row) {
        var that = this;
        var input = document.createElement('input');
        var width = that.options.defaultWidth;
        if (typeof fieldOptions.width !== 'undefined' && fieldOptions.width !== false) {
            width = fieldOptions.width;
        }

        input.type = "file";

        if (typeof fieldOptions.maxLength !== 'undefined' && fieldOptions.maxLength !== false) {
            input.maxLength = fieldOptions.maxLength;
        }

        input.name = name;
        input.className = fieldOptions.validation;
        input.value = value;
        if (blur) {
            $(input).blur();

        }
        $(el).html(input);

        if (typeof fieldOptions.events !== 'undefined' &&
            fieldOptions.events !== false &&
            fieldOptions.events instanceof Array) {

            $.each(fieldOptions.events, function(key, val) {
                $(input).bind(val.type, function(event) {
                    val.action(event, input, row);
                })
            })
        }

        this._bindSubmitEvent(input);
            $(input).fileManager();
        }

    Plugin.prototype._build_datepicker = function(el, name, fieldOptions, value, blur, row) {
        var that = this;
        var input = document.createElement('input');

        var width = that.options.defaultWidth;
        if (typeof fieldOptions.width !== 'undefined' && fieldOptions.width !== false) {
            width = fieldOptions.width;
        }

        input.type = "text"; //input.type = "date"; // changed by Dragan #3543...problem in Chrome (doubled picker)

        input.name = name;
        input.className = fieldOptions.validation;
        input.value = value;
        if (blur) {
            $(input).blur();

        }
        $(el).html(input);

        if (typeof fieldOptions.events !== 'undefined' &&
            fieldOptions.events !== false &&
            fieldOptions.events instanceof Array) {

            $.each(fieldOptions.events, function(key, val) {
                $(input).bind(val.type, function(event) {
                    val.action(event, input, row);
                })
            })
        }

        this._bindSubmitEvent(input);
        $(input).css('width', width);


        $(input).datepicker({
            });


        if (typeof fieldOptions.expirationDate !== 'undefined' && fieldOptions.expirationDate !== false) {


            $(input).datepicker('option', 'showButtonPanel', true);
            $(input).datepicker('option', 'onClose', function() {
                if ($(input).val() !== "") {
                    var month = $(input).datepicker('widget').find('.ui-datepicker-month :selected').val();
                    var year = $(input).datepicker('widget').find(".ui-datepicker-year :selected").val();
                    $(input).datepicker('setDate', new Date(year, month, 1));
                }

                window.setTimeout(function() {
                    $(input).datepicker('widget').removeClass('expirationDatepicker');
                }, 500);
            })
            $(input).datepicker('option', 'onChangeMonthYear', function(year1, month1, instance) {
                $(input).datepicker('setDate', new Date(year1, month1-1, 1));
            })

            $(input).datepicker('option', 'beforeShow', function() {
                $(input).datepicker('widget').addClass('expirationDatepicker');
                if ((datestr = $(this).val()).length > 0) {
                    year = datestr.substring(datestr.length - 4);
                    month = datestr.substring(0, 2);
                    $(input).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                    $(input).datepicker('setDate', new Date(year, month-1, 1));
                }
            })
        }

        if (typeof fieldOptions.dateFormat !== 'undefined' && fieldOptions.dateFormat !== false) {
            $(input).datepicker('option', 'dateFormat', fieldOptions.dateFormat);
        }
    }

    Plugin.prototype._build_select = function(el, name, fieldOptions, value, blur) {
        var select = document.createElement('select');
        select.name = name;
        if (blur) {
            $(select).blur();

        }
        $.each(fieldOptions.values, function(key, val) {
            var option = document.createElement('option');
            option.value = val.id;
            option.innerHTML = val.name;

            if (val.id == value) {

                option.selected = "selected";
            }

            select.appendChild(option);
        })

        $(el).html(select);
    }



    Plugin.prototype._build_autocomplete = function(el, name, fieldoptions, value, blur, $row) {

        var that = this;

        var input = document.createElement('input');
        input.id = fieldoptions.id;
        input.name = fieldoptions.name;
        if (typeof fieldoptions.validation !== 'undefined' && fieldoptions.validation !== false) {
            input.className = fieldoptions.validation;
        }

        input.type = "text";
        input.value = value;
        $(el).html(input);
        
        var width = that.options.defaultWidth;
        if (typeof fieldoptions.width !== 'undefined' && fieldoptions.width !== false) {
            width = fieldoptions.width;
        }
        
        $(input).css('width',width);
        $(input).autocomplete({
            source: fieldoptions.ajaxFunction,
            minLength: 3,
            change: function(event, ui) {
                fieldoptions.onSelect(this, $row);
            },
            open: function() {
                $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function() {
                $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });
    },
    Plugin.prototype._build_radio = function(el, name, fieldOptions, value, blur, withSpan) {
        var radioElement = document.createElement('input');
        radioElement.type = "radio";
        radioElement.name = fieldOptions.name;
        radioElement.value = 1;
        if (fieldOptions.checked) {
            radioElement.checked = true;
        }
        
        if (withSpan) {
            var newSpan = document.createElement('span');
            newSpan.appendChild(radioElement);

            $(el).html(newSpan);
        } else {
            $(el).html(radioElement);
        }


    }

    Plugin.prototype._build_checkbox = function(el, name, fieldOptions, value, blur, withSpan) {
        var checkboxElement = document.createElement('input');
        checkboxElement.type = "checkbox";
        checkboxElement.name = fieldOptions.name;
        checkboxElement.value = 1;
        if (fieldOptions.checked) {
            checkboxElement.checked = true;
        }

        if (withSpan) {
            var newSpan = document.createElement('span');
            newSpan.appendChild(checkboxElement);

            $(el).html(newSpan);
        } else {
            $(el).html(checkboxElement);
        }


    }

    Plugin.prototype._build_combobox = function(el, name, fieldOptions, value, blur) {

        var that = this;
        var select = document.createElement('select');
        select.className = fieldOptions.validation;

        var comboboxWidth = that.options.defaultWidth;
        if (typeof fieldOptions.width !== 'undefined' && fieldOptions.width !== false) {
            comboboxWidth = fieldOptions.width;
        }

        select.name = name;
        if (blur) {
            $(select).blur();

        }
        $.each(fieldOptions.values, function(key, val) {

            var option = document.createElement('option');



            if (typeof val.name == 'undefined' || val.name == false) {
                option.value = key;
                option.innerHTML = val;
            } else {
                option.value = val.id;
                option.innerHTML = val.name;
            }

            if (typeof val.name == 'undefined' || val.name == false) {
                if (key == value) {
                    option.selected = "selected";
                }
            } else {
                if (val.id == value) {

                    option.selected = "selected";
                }
            }

            select.appendChild(option);
        })

        $(el).html(select);
        $(select).combobox({
            width: comboboxWidth
        });
    }

    Plugin.prototype._bindSubmitEvent = function(el) {
        var that = this;

        $(el).bind('keyup', function(event) {
            if (event.keyCode == 13) {
                var theRow = $(el).closest('.validationEngineContainer');
                if (theRow.validationEngine('validate')) {
                    if (theRow.hasClass('add_new_row')) {
                        data = theRow.find('*:input').serializeArray();
                        that._ajaxSaveNew(data);
                    } else if (theRow.hasClass('rowInEditMode')) {
                        var data = theRow.find('*:input').serializeArray();
                        that._ajaxSaveExisting(data, theRow.attr('data-id'));
                    }
                }
            } else if (event.keyCode == 27) {
                if (event.stopPropagation) {
                    event.stopPropagation();
                }
                else if (window.event) {
                    window.event.cancelBubble = true;
                }
                var theRow = $(el).closest('.validationEngineContainer');
                if (!theRow.hasClass('add_new_row')) {

                    that._refreshPartial();
                }
            }
        })
    }

    Plugin.prototype._ajaxSaveNew = function(data) {
         
        var that = this;
        if ($.isFunction(that.options.beforeSubmit)) {
            data = that.options.beforeSubmit(data);
        }
        $.ajax({
            type: that.options.formMethod,
            data: data,
            dataType: 'json',
            url: that.options.formActionUrl + "/save-action/new"
        }).done(function(data) {

            setTimeout(function() { 
                that._refreshPartial();
            }, 2000);
            that.options.hookSave(data);
        })
    }

    Plugin.prototype._ajaxSaveExisting = function(data, id) {
        var that = this;
        if ($.isFunction(that.options.beforeSubmit)) {
            data = that.options.beforeSubmit(data);
        }
        $.ajax({
            type: that.options.formMethod,
            data: data,
            dataType: 'json',
            url: that.options.formActionUrl + "/save-action/existing/id/" + id
        }).done(function(data) {
            if (data.status) {
                that._refreshPartial();
                that.options.hookSave();
            } else {
                console.error('callback is not ok');
            }
        })
    }

    Plugin.prototype._refreshPartial = function() {
        
        var that = this;
        if (typeof this.options.partial !== 'undefined' && this.options.partial !== false) {
            
            $(this.options.partial).load(that.options.partialUrl);

        } else {

        }
    }
    //Plugin.prototype._saveNew()

    Plugin.prototype.init = function() {
        var valt = "";
        var that = this;
        //check for id
        if (this.options.formId == "") {
        //alert('you have to pass an id for the form. Use option: formId');
        } else {

            if (!that.element.is('form')) {
                that.element.wrap('<form enctype="multipart/form-data" method="' + that.options.formMethod + '" action="' + that.options.formActionUrl + '" id="' + that.options.formId + '" />');

                that.form = $('#' + that.options.formId);

                //create new Row
                if (that.options.withNew) {
                    that.newRowTr = document.createElement('tr');
                    that.newRowTr.className = that.options.newRowTrClass;
                    
                   
                    $.each(that.options.fieldInformations, function(key, val) {
                        
                        if (typeof val.buttonContainer !== "undefined" && val.buttonContainer !== false) {
                            var newDiv = document.createElement('span');
                            newDiv.className = "buttonContainer";
                        } else {
                            var newDiv = document.createElement('div');
                        }


                        switch (val.type) {
                            case "text":
                                that._build_text(newDiv, key, val, '', false, that.newRowTr);
                                break;
                            case "file":
                                that._build_file(newDiv, key, val, '', false, that.newRowTr);
                                break;
                            case "select":
                                that._build_select(newDiv, key, val, '', false);
                                break;
                            case "checkbox":
                                that._build_checkbox(newDiv, key, val, '', false, true);
                                break;
                            case "autocomplete":
                                that._build_autocomplete(newDiv, key, val, '', false, $(that.newRowTr));
                                break;
                            case "radio":
                                that._build_radio(newDiv, key, val, '', false, $(that.newRowTr), true);
                                break;
                            case "date":
                                that._build_datepicker(newDiv, key, val, '', false, $(that.newRowTr));
                                break;
                            case "combobox":
                                valt = "";
                                if (typeof val.selected != 'undefined' && val.selected != false) {
                                    valt = val.selected;
                                }
                                if (key == "conf_addressor_id") {
                                    valt = "1";
                                }

                                that._build_combobox(newDiv, key, val, valt, false);
                                break;
                            default:
                                break;
                        }
                        ;

                        var newTd = document.createElement('td');
                        if (typeof val.tdClass != "undefined" && val.tdClass != false) {
                            newTd.className = val.tdClass;
                        }

                        if (typeof val.buttonContainer !== "undefined" && val.buttonContainer !== false) {
                            for (var i = 0; i < val.buttonContainer; i++) {
                                var placeholderSpan = document.createElement('span');
                                newDiv.appendChild(placeholderSpan);
                            }

                        }

                        newTd.appendChild(newDiv);
                        that.newRowTr.appendChild(newTd);
                    })


                    that.element.prepend(that.newRowTr);

                    //find new Row Element
                    that.newRowTr = that.element.find('.' + that.options.newRowTrClass);
                    that.newRowTr.addClass('validationEngineContainer');

                    that.newRowTr.validationEngine('attach', {
                        scroll: false,
                        binded: false,
                        autoHidePrompt: true,
                        autoHideDelay: 3000
                    });


                    that.options.newRowFormElements = new Array();
                    if (that.newRowTr.length > 0) {
                        $.each(that.newRowTr.find(that._formElements), function(key, el) {
                            that.options.newRowFormElements.push($(el));
                        })
                    }

                    // add validation to this elments

                    $.each(that.options.newRowFormElements, function(key, el) {
                        if (el.hasClass('submitForm')) {
                            that._bindSubmitEvent(el);
                        }
                    });
                }
                //find function elements

                $.each(that.form.find('*[data-function]'), function(key, val) {

                    $(val).bind('click', function() {
                        var functionName = $(val).data('function');
                        var functionArg = $(val).data('value');
                        if ($.isFunction(eval("that.options." + functionName))) {
                            var functionEval = eval("that.options." + functionName);

                            functionEval(functionArg);
                        } else {
                            console.warn(functionName + ' is not defined');
                        }
                    })
                })

                //find editable Row

                that.form.find('.editableRow').dblclick(function() {
                    $row = this;
                    if (that.form.find('.rowInEditMode').length > 0) {

                        that.form.find('.rowInEditMode').html(that.options.editRowBackup);
                        that.form.find('.rowInEditMode').removeClass("rowInEditMode");

                    }

                    $(this).addClass('validationEngineContainer');
                    $(this).addClass('rowInEditMode');
                    that.options.editRowBackup = $(this).html();

                    $.each($(this).find('*[data-edit-name]'), function(key, el) {
                        var curName = $(el).attr('data-edit-name');
                        if (typeof curName !== 'undefined' && curName !== false) {
                            eval("var fieldOptions = that.options.fieldInformations." + curName);

                            switch (fieldOptions.type) {
                                case "text":
                                    that._build_text(el, curName, fieldOptions, $(el).data('value'), blur, $row);
                                    break;
                                case "file":
                                    that._build_file(el, curName, fieldOptions, $(el).data('value'), blur, $row);
                                    break;
                                case "select":
                                    that._build_select(el, curName, fieldOptions, $(el).data('value'), blur);
                                    break;
                                case "checkbox":
                                    that._build_checkbox(el, curName, fieldOptions, $(el).data('value'), blur);
                                    break;
                                case "combobox":
                                    that._build_combobox(el, curName, fieldOptions, $(el).data('value'), blur);
                                    break;
                                case "autocomplete":
                                    that._build_autocomplete(el, curName, fieldOptions, $(el).data('value'), blur, $row);
                                    break;
                                case "date":
                                    that._build_datepicker(el, curName, fieldOptions, $(el).data('value'), blur, $row);
                                    break;
                                default:
                                    break;
                            }
                        }
                    });
                    $(this).validationEngine('attach', {
                        promptPosition: 'bottomLeft',
                        scroll: false
                    });
                })
            }
        }
    };

    // A really lightweight plugin wrapper around the constructor, 
    // preventing against multiple instantiations
    $.fn[pluginName] = function(options, el) {

        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                    new Plugin(this, options));
            } else {
                $that = $.data(this, 'plugin_' + pluginName);
                if ($.isFunction(eval("$that." + options))) {
                    
                    eval("$that." + options + "(el)");
                } else {
                    alert(eval("$that." + options));
                }

            }
        });
    }

})(jQuery, window, document);
