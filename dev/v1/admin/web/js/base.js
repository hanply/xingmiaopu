if (!("app" in window)) { window.app = {} } 
jQuery(function(a) { 
    window.app.click_event = a.fn.tap ? "tap" : "click" 
});
jQuery(function(a) {
    app.init(jQuery);
    $('body').on('click', 'a[data-url]', function(){
        app.ajaxView.startLoading($(this).data('url'));
    })
});
app.config = {
    cookie_expiry: 604800, 
}
app.init = function() {
    $(".nav-list").on(app.click_event, function(h) {
        var b = navigator.userAgent.match(/OS (5|6|7)(_\d)+ like Mac OS X/i);
        var g = $(h.target).closest("a");
        if (!g || g.length == 0) { return }
        if (!g.hasClass("dropdown-toggle")) {
            g.parent().addClass("active")
            // if (b) { document.location = g.attr("href"); return false }
            return
        }
        var f = g.next().get(0);
        if (!$(f).is(":visible")) {
            var d = $(f.parentNode).closest("ul");
            d.find("> .open > .submenu").each(function() {
                if (this != f && !$(this.parentNode).hasClass("active")) { $(this).slideUp(200).parent().removeClass("open") }
            })
        } else {}
        $(f).slideToggle(200).parent().toggleClass("open");
        return false
    })
    $('body').on('change', ".search-form input,.search-form select", function(){
        app.ajaxView.startLoading($(this).data('url'));


    })

    $('body').on('click', ".checkAll", function(){
        $(".checkbox-item").prop('checked', $(this).is(":checked"));
    })
    $('body').on('click', ".checkbox-item", function(){
        $(".checkAll").prop('checked', $(this).is(":checked") && $('.checkbox-item:checked').length==$(".checkbox-item").length);
    })
}
app.funs = {
    date: function(timestamp) {
        var date = new Date(timestamp * 1000);
        var year = date.getFullYear(),
            month = date.getMonth(),
            day = date.getDate(),
            hour = date.getHours(),
            minute = date.getMinutes(),
            second = date.getSeconds();
        return year+'-'+(month<10?'0'+month:month)+'-'+(day<10?'0'+day:day)+' '+(hour<10?'0'+hour:hour)+':'+(minute<10?'0'+minute:minute)+':'+(second<10?'0'+second:second)
    },
    mergeOption: function (option, set) {
        var result = option;
        for(var i in option) {
            if(set[i]) {
                result[i] = set[i];
            }
        }
        for(var i in set) {
            if(!option[i]) {
                result[i] = set[i];
            }
        }
        return result;
    },
    ajaxChangeStatus: function (url, data) {
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            success: function(response) {
                if(response.code==0) {
                    layer.msg(response.msg, {icon:1}, function(){
                        window.location.reload();
                    });
                }else{
                    layer.msg(response.msg, {icon:5});
                }
            }
        })
    },
    switch: function (that, url, id, _confirm) {
        if (_confirm==1) {
            var title = $(that).attr('title');
            layer.confirm('确定要'+title+'吗？', {title: '提示信息', icon: 3}, function(index) {
                layer.close(index);
                app.funs.ajaxChangeStatus(url, {id: id});
            })
        }else{
            app.funs.ajaxChangeStatus(url, {id: id});
        }
    },
    switchChecked: function (that, url, _confirm) {
        var title = $(that).attr('title');
        if ($(".checkbox-item:checked").length<1) {
            layer.msg('请选择要'+title+'的列表项');
        }else{
            var id = [];
            $(".checkbox-item:checked").each(function(){
                id.push($(this).val());
            })
            if (_confirm==1) {
                layer.confirm('确定要'+title+'吗？', {title: '提示信息', icon: 3}, function(index) {
                    layer.close(index);
                    app.funs.ajaxChangeStatus(url, {id: id.join(',')});
                })
            }else{
                app.funs.ajaxChangeStatus(url, {id: id.join(',')});
            }
        }
    },
}
app.ajaxView = {
    loadTimer: null,
    working: false,
    settings: {
        max_wait: false,
        ajax_cache: false,
    },
    startLoading: function(url) {
        if(app.ajaxView.working) return;
        app.ajaxView.working = true;
        $('body').append('<div class="ajax-loading-overlay"></div>');
        if(this.settings.max_wait !== false) {
            app.ajaxView.loadTimer = setTimeout(function() {
                app.ajaxView.loadTimer = null;
                if(!app.ajaxView.working) return;
                var event
                $('.page-content').trigger(event = $.Event('ajaxloadlong'))
                if (event.isDefaultPrevented()) return;
                self.stopLoading();
            }, app.ajaxView.settings.max_wait * 1000);
        }
        $.ajax({'url': url, 'cache': app.ajaxView.settings.ajax_cache})
        .error(function() {
            $('.page-content').trigger('ajaxloaderror');
            self.stopLoading();
        })
        .done(function(result) {
            $('.page-content').trigger('ajaxloaddone');
            var link_element = null, link_text = '';
            link_element = $('a[data-url="'+url+'"]');
            if(url.length>0 && link_element.length > 0) {
                var nav = link_element.closest('.nav');
                if(nav.length > 0) {
                    nav.find('.active').each(function(){
                        var $class = 'active';
                        $(this).removeClass($class);                            
                    })
                    link_element.closest('li').addClass('active').parents('.nav li').addClass('active open');
                }
            }
            //convert "title" and "link" tags to "div" tags for later processing
            result = String(result)
                .replace(/<(title|link)([\s\>])/gi,'<div class="hidden ajax-append-$1"$2')
                .replace(/<\/(title|link)\>/gi,'</div>')
            $('.page-content').empty().html(result);
            //remove previous stylesheets inserted via ajax
            setTimeout(function() {
                $('head').find('link.ace-ajax-stylesheet').remove();

                var main_selectors = ['link.ace-main-stylesheet', 'link#main-ace-style', 'link[href*="/ace.min.css"]', 'link[href*="/ace.css"]']
                var ace_style = [];
                for(var m = 0; m < main_selectors.length; m++) {
                    ace_style = $('head').find(main_selectors[m]).first();
                    if(ace_style.length > 0) break;
                }
                $('.page-content').find('.ajax-append-link').each(function(e) {
                    var $link = $(this);
                    if ( $link.attr('href') ) {
                        var new_link = jQuery('<link />', {type : 'text/css', rel: 'stylesheet', 'class': 'ace-ajax-stylesheet'})
                        if( ace_style.length > 0 ) new_link.insertBefore(ace_style);
                        else new_link.appendTo('head');
                        new_link.attr('href', $link.attr('href'));//we set "href" after insertion, for IE to work
                    }
                    $link.remove();
                })
            }, 10);
            $('.page-content').trigger('ajaxloadcomplete');
            app.ajaxView.stopLoading();
        })
    },
    stopLoading: function() {
        app.ajaxView.working = false;
        $('.ajax-loading-overlay').remove();
        if(app.ajaxView.loadTimer != null) {
            clearTimeout(app.ajaxView.loadTimer);
            app.ajaxView.loadTimer = null;
        }
    }
}
app.cookie = {
    get: function(c) {
        var d = document.cookie,
            g, f = c + "=",
            a;
        if (!d) { return } a = d.indexOf("; " + f);
        if (a == -1) { a = d.indexOf(f); if (a != 0) { return null } } else { a += 2 } g = d.indexOf(";", a);
        if (g == -1) { g = d.length }
        return decodeURIComponent(d.substring(a + f.length, g))
    },
    set: function(b, e, a, g, c, f) {
        var h = new Date();
        if (typeof(a) == "object" && a.toGMTString) { a = a.toGMTString() } else {
            if (parseInt(a, 10)) {
                h.setTime(h.getTime() + (parseInt(a, 10) * 1000));
                a = h.toGMTString()
            } else { a = "" }
        }
        document.cookie = b + "=" + encodeURIComponent(e) + ((a) ? "; expires=" + a : "") + ((g) ? "; path=" + g : "") + ((c) ? "; domain=" + c : "") + ((f) ? "; secure" : "")
    },
    remove: function(a, b) { this.set(a, "", -1000, b) }
}
app.jqgrid = {
    option: {
        obj: '#jqgridList',
        url: '',
        datatype: "json",
        height: 300,
        autowidth: true,
        rowNum: 20,
        rowList: [20, 50, 100],
        colNames: [],
        colModel: [],
        pager: "#pager",
        viewrecords: true,
        multiselect: true,
        multiselectWidth: 24,
        scrollOffset: 0,
        altRows:true,
        altclass:'alt-class',
        recordpos: 'left'
    },
    init: function(set) {
        $.jgrid.defaults.styleUI = 'Bootstrap';
        var option = app.funs.mergeOption(this.option, set);
        if(!option.url) option.url = location.href;
        $(option.obj).jqGrid(option);
    },
    reload: function(extraParams) {
        $(this.option.obj).jqGrid('setGridParam',{
            postData: extraParams,
        }).trigger("reloadGrid"); 
    }
}
app.jqvalidate = {
    option: {
        errorElement: 'div',
        errorClass: 'help-inline',
        ignore: [],
        debug: false,
        obj: '',
        onfocusout: false,
        rules: {},
        messages: {},
        highlight: function (e) {
            $(e).closest('.form-group').addClass('has-error');
        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {                    
                validator.errorList[0].element.focus();
            }
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
            error.html('<i class="icon-remove-sign red"></i>'+error.html())
            if(element.is(':checkbox') || element.is(':radio')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element);
        },
        submitHandler: function (form) {
            $("#submitBtn").attr("disabled","true");
            $(form).ajaxSubmit({
                dataType : "json",
                success: function(response) {
                    $("#submitBtn").removeAttr('disabled');
                    if(response.code==0) {
                        layer.msg(response.msg, {icon:1}, function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(response.msg, {icon:5});
                    }
                },
                error: function(xhr, status, error) {
                    $("#submitBtn").removeAttr('disabled');
                    if(status==='error'){
                        layer.msg('服务器错误，请重试', {icon:5});
                    }
                }
            });
        }
    },
    init: function (set) {
        var option = app.funs.mergeOption(this.option, set);
        $(option.obj).validate(option);
    }
}