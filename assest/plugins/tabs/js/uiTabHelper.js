/**
 * 
 * @todo translate messages and use notification 
 * tabHelper.addTab(title,href,"tab_"+title);
 */
var tabHooks = {};
var tabHelper =
        {
            tabTitle: $("#tab_title"),
            tabContent: $("#tab_content"),
            tabTemplate: "<li data-unsaved='false' id='{id}'><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close'></span><span class='ui-icon ui-icon-refresh'></span></li>",
            tabCounter: 1,
            error: false,
            getTabs: function () {
                return $('#tabs, #tabs2');
            },
            addTab: function (title, href, id, tabClass, closable, cbClose) {

                if (closable == null)
                {
                    closable = true;
                }
  
                
                titleEllipsis = '';
                titleEllipsis1 = '';
                titleEllipsis2 = '';

                if (title.search('<br>') != -1)
                {
                    title = title.split('<br>');
                    if (title[0].length > 20) {
                        titleEllipsis1 = '...';
                    }

                    if (title[1].search('</span>') != -1)
                    {
                        title = title[0].substring(0, 19) + titleEllipsis1 + '<br>' + title[1];
                    } else {
                        if (title[1].length > 20) {
                            titleEllipsis2 = '...';
                        }
                        title = title[0].substring(0, 19) + titleEllipsis1 + '<br>' + title[1].substring(0, 19) + titleEllipsis2;
                    }

                } else {
                    if (title.length > 20) {
                        titleEllipsis = '...';
                    }
                    title = title.substring(0, 19) + titleEllipsis;
                }

                var tabs = tabHelper.getTabs();


                //Select Tab if exist
                if ($('#' + id).length > 0) {
                    $("#tabs_navi").find("li").removeClass("ui-tabs-active ui-state-active");
                    $('#' + id).addClass("ui-tabs-active ui-state-active");

                    $(".ui-tabs-panel").hide();
                    var panel = $('#' + id).attr('aria-controls');
                    $("#" + panel).show();


                    return id;
                }
                else {

                    //create new tab
                    var li = $(tabHelper.tabTemplate.replace(/#\{href\}/g, href).replace(/#\{label\}/g, title).replace(/\{id\}/g, id));

                    if (closable == false) {
                        $('span.ui-icon-close', li).remove();
                    }
                    
                    $.ajax({
                        start: function (event) {
                            return event;
                        },
                        loader: 'default',
                        url:href,
                        success: function(data,status,xhr){
                            try {
                                
                                data = JSON.parse(data);
                                if(data.error == true){
                                    
                                   tabHelper.closeTab(id);
                                   PNotify.removeAll();
                                   showNotification('error', data.msgTitle, data.msgTxt);
                                   tabHelper.error = true;
                                   xhr.abort();

                                }
                            } catch(error) {
                                //nothing to catch here
                                tabHelper.error = false;
                                $("#tabs_navi").append(li);
                                tabs.tabs('refresh'); 
                                tabHelper.tabCounter++;
                                tabHelper.buildIndexes();      
                                tabs.show();
                            }                                

                        }
                    }).done(function (data) {
                         elId = $(li).attr("aria-controls");
                         
                         $("#"+elId).html("");
                         

                         $(li).attr('data-loaded', 'true');

                              
                         tabs.tabs('option', 'active', $('#' + id).attr('data-tab-index'));
                         $("#"+elId).html('<div style="text-align:center"><span><img title="c_loader.gif" src="default/img/loaders/c_loader.gif"></span></div>')
                                 .delay('500').queue(function(n) {
                                    $("#"+elId).html(data);
                                 });
        
                         
                         $('#' + id).addClass(tabClass);  
                        
                         
                         //// Delete Tab

                         $("#" + id + " span.ui-icon-close").bind("click", function ()
                         {
                             var tabId = $(this).closest("li").attr('id');

                             if (tabId !== 'tab_dashboard') {
                                 var panelId = $(this).closest("li").remove().attr("aria-controls");

                                 //set to false that we can open this tab again
                                 //allReadyLoadedTabs[tabId] = false;

                                 $.each(tabHooks, function (k, meth) {
                                     if ($.isFunction(meth)) {
                                         meth(tabId);
                                     }
                                 })

                                 // call own callback
                                 if (cbClose != null)
                                     setTimeout(cbClose, 0);

                                 $("#" + panelId).remove();
                                 tabs.tabs("refresh");
                                 otherTabExist = tabs.find('li').attr('id');
                                 if(null == otherTabExist)
                                     tabs.hide();
                             } else { // On click delete all tabs except basic tab

                                 var $otherTabs = $(this).closest("li").siblings();
                                 tabHelper.closeAllTabs($otherTabs);

                             }
                         });

                         $(".ui-tabs-anchor").bind("click", function (e){
                             //
                             var tabObj = $(this).closest("li");
                             tabHelper.checkTabExist(tabObj);
                             //e.preventDefault();
                         });

                         // Refresh Tab
                         $("#" + id + " span.ui-icon-refresh").click(function ()
                         {

                             var tabHref = $(this).parent().find('a').attr('href');
                             var unsafedData = $(this).parent().attr('data-unsaved');
                             var ariaControls = $(this).parent().attr('aria-controls');

                             if (tabHref === "#tab-1")
                                 return;

                             var askForLoad = (unsafedData == "true") ? confirm("reload?") : true;

                             if (askForLoad)
                             {
                                 $.ajax({
                                     start: function (event) {
                                         return event;
                                     },
                                     loader: 'default',
                                     type: 'post',
                                     url: tabHref
                                 }).done(function (data) {

                                     $('#' + ariaControls).html("");
                                     $('#' + ariaControls).html(data);
                                 })
                             }
                         });



                         if (id == 'tab_dashboard') { // Add thick red x for closing all tabs except basic tab
                             $('#' + id + " span.ui-icon-close").addClass('ui-icon-closethick');
                             $("#" + id + " span.ui-icon-close").css("background", 'url("' + settings.baseUrl + '/default/img/close.png")');
                             $("#" + id + " span.ui-icon-close").css("background-repeat", 'no-repeat');
                             $("#" + id + " span.ui-icon-close").css("background-position", '2%');

                         }
                         
                    })
                    

                    
                    return id;
                }
            },
            buildIndexes: function () {
                $.each($('#tabs ul li a'), function (key, val) {
                    $(val).parent().attr('data-tab-index', key);
                })
            },
            showTab: function (tabID) {
                var tabs = $('#tabs');
                tabs.tabs().tabs('option', 'active', $('#' + tabID).attr('data-tab-index'));
                return;
            },
            checkTabExist: function (thisObj) {

                var panel = $(thisObj).attr('id');
                var divId = $(thisObj).attr('aria-controls');
                $("#tabs_navi").find("li").removeClass("ui-tabs-active ui-state-active");
                $("#" + panel).parent('li').addClass("ui-tabs-active ui-state-active");

                $(".ui-tabs-panel").hide();

                $("#" + panel).show();
                $("#"+divId).show();

                return;
            },
            /**
             * Close a Tab by ID
             * @param {string} id
             * @returns {Boolean} true on succes
             * @author Max Bebök <max.beboek@lewilew.com>
             */
            closeTab: function (id)
            {
                var node = $("#tabs #" + id + " span.ui-icon-close");
                if (node.length != 0)
                {
                    $("#tabs #" + id + " span.ui-icon-close").trigger("click");
                    return true;
                }
                return false;
            },
            closeAllTabs: function ($tabs) {

                $.each($tabs, function (index, element) {
                    var elementPanelId = $(element).remove().attr("aria-controls");
                    $("#" + elementPanelId).remove();
                });
                elementPanelId = $('#tabs_navi').find('li:first').attr('aria-controls');
                $("#" + elementPanelId).show();
            }

        }



$(function () {
    error= false;
    $("#tabs").tabs({
        
        beforeLoad: function (event, ui) {

            ui.ajaxSettings.success = function(data, status, xhr) {
                try {
                    data = JSON.parse(data);
                    if(data.error == true){
                       tabHelper.closeTab($(ui.tab[0]).attr('id'));
                       PNotify.removeAll();
                       showNotification('error', data.msgTitle, data.msgTxt);
                       error = true;
                       tabHelper.error = true;
                       xhr.abort();
                       
                    }
                } catch(error) {
                    //nothing to catch here
                    error = false;
                }                

            };
            var li = ui.tab[0];
            var panelId = $(li).attr("data-loaded");
            if (panelId == 'true') {
                
                event.preventDefault();
            }
        },
        load: function (event, ui) {
            tabHelper.error = false;
            $(ui.tab[0]).attr('data-loaded', 'true');
                   
        },
        
        create: function( event, ui ) {}

    });
});
