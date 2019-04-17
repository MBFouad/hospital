(function($) {
    $.widget("ui.combobox", {
        options: {
            removeIfInvalid: true,
            width: 'auto',
            spanClass: "",
            disabled: false,
            searchboxReference: null,
            postCreateInput: function(input) {

            },
            onSelect: function() {

            },
            ulWidth: 1,
            sourceCallback: function(label) {
                return label;
            }
        },
        unSelect: function() {

            var that = this;
            that.inputField.val("");
            that.selectField.val("");
        },
        
        disable: function(add_class)
        {
          if(this.options.disabled)return;
          if(add_class == null)add_class = true;
            
          this.options.disabled = true;
          
          this.inputField.autocomplete('disable');
          this.inputField.disableSelection();
          this.inputField[0].disabled = true;
          
          if(add_class)this.wrapper.addClass("combobox-disabled");
          //$(this.wrapper).css("opacity", (opacity != null) ? opacity : 1.0);
        },
        
        enable: function()
        {
          if(!this.options.disabled)return;
          
          this.options.disabled = false;
          
          this.inputField.autocomplete('enable');
          this.inputField.enableSelection();
          this.inputField[0].disabled = false;
          
          this.wrapper.removeClass("combobox-disabled");
          
          $(this.wrapper).css("opacity", 1.0);
        },    
        
        getReference: function()
        {
            return {'options': this.options, element: this.element};
        },
        
        /**
         * select a option (in booth boxes) by the given value and/or text
         * @param {string} value select value
         * @param {string} name value name, override the default option name
         * @param {boolean} trigger_searchbox trigger search event, def: true
         * @returns {boolean} true on success, false on error
         */
        select: function(value, name, trigger_searchbox)
        {
            if(value == null && name == null)return false;

            if(trigger_searchbox !== false && typeof(this.options.searchboxReference) == "object" && this.options.searchboxReference != null)
            {
                if(value == null)return false;
                $(this.inputField).val(value).trigger("focusout");
                return true;
            }
            
            var opt = null;
            var sel_opt = this.element.children();
            for(var e=0; e<sel_opt.length; e++)
            {
                if(sel_opt[e].value == value)opt = sel_opt[e];
            }

            if(opt == null) // no value found, try to search for a matchng text
            {
                var opt = $(this.element).find("option:contains('"+value+"')")[0];
                if(opt == null)return false;
            }
            
            this.bindings[0].selectedIndex = opt.index;
            
            if(name == null)
            {
                name = opt.innerHTML;
            }
            
            $(this.inputField).val(name);
            
            //this.triggerEvent();
            return true;
        },
        
        /**
         * trigger a onchange/select event to call callback functions
         */
        triggerEvent: function()
        {
            this.options.onSelect(null,null);
            
            return;
            /* causes errors, sometimes
            var name = this.bindings[0].children[this.bindings[0].selectedIndex].innerHTML;
            var wid = $(this.inputField.autocomplete("widget"));
            this.inputField.autocomplete('search', name);
            var c = wid.find("a:contains('"+name+"')");//
            c.trigger("click");
            this.inputField.autocomplete('close');*/
        },
        
        emptyInput: function() {
            $(that.inputField).val("");
        },
        _create: function() {

            var input,
                    
                that = this,
                select = this.element.hide(),
                selected = select.children(":selected"),
                value = selected.val() ? selected.text() : "",
                wrapper = this.wrapper = $("<span>")
                    .addClass("ui-combobox "+that.options.spanClass)
                    .insertAfter(select);

            that.selectField = select;
            
            function removeIfInvalid(element, that) {
                var value = $(element).val(),
                        matcher = new RegExp($.ui.autocomplete.escapeRegex(value), "i"),
                        valid = false;

                select.children("option").each(function() {
                    if ($(this).text().match(matcher)) {

                        this.selected = valid = true;
                        that.inputField.val($(this).text());
                        return false;

                    }
                });

                if (!valid) {
                    if (that.options.removeIfInvalid == true) {
                        $(element)
                                .val("")

                                .tooltip("open");
                        select.val("");
                        setTimeout(function() {
                            input.tooltip("close").attr("title", "");
                        }, 2500);
                        input.data("ui-autocomplete").term = "";

                    } else {
                        var option = document.createElement('option');
                        option.value = $(element).val();
                        option.innerHTML = $(element).val();


                        that.element.append(option);
                        $(option).attr('selected', true);
                    }
                }



                return false;
            }

            var input = $("<input>")

                    .appendTo(wrapper)
                    .val(value)
                    .css('width', that.options.width)
                    .attr("title", "")
                    .attr("placeholder", select.attr("title"))
                    .attr("tabindex", select.attr("tabindex"))
                    .addClass("ui-state-default ui-combobox-input")
                    .addClass(select.attr("class"))
                    .autocomplete({
                delay: 0,
                ulWidth: that.options.ulWidth,
                minLength: 0,
                source: function(request, response) {
                    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                    response(select.children("option").not(':disabled').map(function() {
                        var text = $(this).text();
                        if (this.value && (!request.term || matcher.test(text)) && $(this).css('display') !== "none")
                        {
                            var label = text.replace(
                                    new RegExp(
                                    "(?![^&;]+;)(?!<[^<>]*)(" +
                                    $.ui.autocomplete.escapeRegex(request.term) +
                                    ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                    ), "$1");
                            label = that.options.sourceCallback(label);
                            return {
                                label: label,
                                /*
                                 *")(?![^<>]*>)(?![^&;]+;)", "gi"
                                 ), "<strong>$1</strong>"),
                                 */
                                value: text,
                                option: this
                            };
                        }
                    }));
                },
                select: function(event, ui) {                    
                    if(that.options.is_disabled)return;
                    ui.item.option.selected = true;
                    that._trigger("selected", event, {
                        item: ui.item.option
                    });
                    that.options.onSelect(event, {
                        item: ui.item.option
                    }, that);
                },
                change: function(event, ui) {
                    if(that.options.is_disabled)return;
                    if (!ui.item)
                        if (removeIfInvalid(this, that)) {
                            that.options.onSelect(event, {
                                item: ui.item.option
                            }, that);
                            return true;
                        } else {
                            return false;
                        }

                }
            })
                    .addClass("ui-widget ui-widget-content ui-corner-left")
                    .focus(function(event) {
                $(this).select();
            }).blur(function() {

            });
            input.data("ui-autocomplete")._renderItem = function(ul, item) {
                var option = item.option;
                var li = $("<li>");
                li.data("item.autocomplete", item);
                var a = "<a>";
                if($(option).hasClass('has-image') && typeof $(option).data('img-url') !== 'undefined') {
                    a += '<span style="float:right;"><img height="14" src="' + $(option).data('img-url') + '" /></span>';
                }
                a += item.label + "</a>";
                li.append(a).appendTo(ul);

                return li;

//                return $("<li>")
//                        .data("item.autocomplete", item)
//                        .append("<a>" + item.label + "</a>")
//                        .appendTo(ul);
            };

            if ($(select).hasClass('highlight')) {

                $(input).addClass('highlight');
            }
            that.inputField = input;
            that.options.postCreateInput(input, select);

            $("<a>")
                    /*.attr("tabIndex", -1)*/


                    .appendTo(wrapper)
                    .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
                    .removeClass("ui-corner-all")
                    .addClass("ui-corner-right ui-combobox-toggle")
                    .mousedown(function() {
                wasOpen = input.autocomplete("widget").is(":visible");
            })
                    .click(function() {
                // close if already visible

                if (wasOpen) {
                    input.autocomplete("close");
                    removeIfInvalid(input, that);
                    return;
                } else {                    
                    $(this).blur();
                    // pass empty string as value to search for, displaying all results
                    $(input.autocomplete("widget")[0]).css('maxHeight', "200px");
                    $(input.autocomplete("widget")[0]).css('minWidth', $(input).css('width'));
                    input.autocomplete("search", "");                    
                    input.focus();
                }

            });
            input.tooltip({
                position: {
                    of: this.button
                },
                tooltipClass: "ui-state-highlight"
            });
            
            if(this.options.disabled)
            {
                this.disable(true);
            }
            
        },
        destroy: function() {
            this.wrapper.remove();
            this.element.show();
            $.Widget.prototype.destroy.call(this);
        },
        _setOption: function(option, value) {
            $.Widget.prototype._setOption.apply(this, arguments);
        },
        autocomplete : function(value) {
        this.element.val(value);
        this.inputField.val(value);
        return true;
    }


    });
})(jQuery);