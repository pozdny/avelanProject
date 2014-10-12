/**
 * Created by Valentina on 18.09.14.
 */
+function($){
    'use strict';
    var Carousel = function (element, options) {
        this.options   = options;
        this.$element  = $(element);

    }
    Carousel.DEFAULTS = {
        visible: 3,
        rotateBy: 1,
        speed: 500,
        btnNext: null,
        btnPrev: null,
        auto: null,
        backSlide: false
    }

    $.fn.myCarousel = function(options) {
        var settings = Carousel.DEFAULTS;

        return this.each(function() {
            if (options) {
                $.extend(settings, options);
            }

            var $this = $(this);
            var $carousel = $this.children(':first');
            var itemWidth = $carousel.children().outerWidth();
            var itemsTotal = $carousel.children().length;
            var running = false;
            var intID = null;

            $this.css({
                'position': 'relative',
                'overflow': 'hidden',
                'width': settings.visible * itemWidth + 'px'
            });

            $carousel.css({
                'position': 'relative',
                'width': 32767 + 'px',
                'left': 0
            });

            function slide(dir) {
                var direction = !dir ? -1 : 1;
                var leftIndent = 0;

                if (!running) {
                    running = true;

                    if (intID) {
                        window.clearInterval(intID);
                    }

                    if (!dir) {
                        $carousel.children(':last').after($carousel.children().slice(0, settings.rotateBy).clone(true));
                    } else {
                        $carousel.children(':first').before($carousel.children().slice(itemsTotal - settings.rotateBy, itemsTotal).clone(true));
                        $carousel.css('left', -itemWidth * settings.rotateBy + 'px');
                    }

                    leftIndent = parseInt($carousel.css('left')) + (itemWidth * settings.rotateBy * direction);

                    $carousel.animate({'left': leftIndent}, {queue: false, duration: settings.speed, complete: function() {
                        if (!dir) {
                            $carousel.children().slice(0, settings.rotateBy).remove();
                            $carousel.css('left', 0);
                        } else {
                            $carousel.children().slice(itemsTotal, itemsTotal + settings.rotateBy).remove();
                        }

                        if (settings.auto) {
                            intID = window.setInterval(function() { slide(settings.backslide); }, settings.auto);
                        }

                        running = false;
                    }});
                }

                return false;
            }

            $(settings.btnNext).click(function() {
                return slide(false);
            });

            $(settings.btnPrev).click(function() {
                return slide(true);
            });

            if (settings.auto) {
                intID = window.setInterval(function() { slide(settings.backslide); }, settings.auto);
            }
        });
    };
    $.fn.myCarousel.Constructor = Carousel;
    $('.main-carousel').myCarousel({
        btnNext: '.next',
        btnPrev: '.prev',
        visible: 3,
        rotateBy: 1,
        auto: 3000
    });
}(jQuery);

/* ========================================================================
 * Bootstrap: dropdown.js v3.1.1
 * http://getbootstrap.com/javascript/#dropdowns
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
    'use strict';

    // LEFTNAV CLASS DEFINITION
    // =========================
    var outer = '[data-toggle=outer-menu]'
    var blockCatalog   = '[data-toggle=catalog-menu]';
    var toggle   = '[data-toggle=dropdown]';
    var Leftnav = function (element, options) {
        this.$element    = $(element);
        this.options     = options;
    }
    Leftnav.DEFAULTS = {
        isActive : false,
        redLabel : true,
        closeBtn : true,
        openBtn  : true,
        menuOpen : false,
        fixedDiv : null,

        // HTML templates
        tpl: {
            redLabel  : '<a title="Открыть/закрыть каталог" id="red-label" href="javascript:;"></a>',
            closeBtn : '<a title="Закрыть каталог" class="leftnav-item leftnav-btn-close" href="javascript:;"></a>',
            openBtn  : '<a title="Открыть/закрыть каталог" class="leftnav-item leftnav-btn-open" href="javascript:;"></a>',
            fixedDiv  : '<div id="fixed-div"></div>'
        }
    }
    Leftnav.prototype.init = function(elem, opts){
        var wrap = $('body');
        if(opts.isActive){
            if($(blockCatalog).hasClass("out")){
                $(blockCatalog).addClass("open");
                opts.menuOpen = true;
                autoHeight();
            }
            else{
                elem.css({width:"0px"});
                $(blockCatalog).find("li.dropdown").css({whiteSpace:"nowrap"});
            }
        }
        else{
            elem.css({width:"0px"});
            $(blockCatalog).find("li.dropdown").css({whiteSpace:"nowrap"});
        }
        // Create a red-label button
        if (opts.redLabel) {
            $(opts.tpl.redLabel).appendTo($(outer)).on('click.bs.leftnav', function(e) {
                if($(blockCatalog).hasClass('open')) Close(e);
                else Open(e);
            });
        }
        if(opts.openBtn){
            $(opts.tpl.openBtn).appendTo($(outer)).on('click.bs.leftnav', function(e) {
                if($(blockCatalog).hasClass('open')) Close(e);
                else Open(e);
            });
        }
        if(opts.closeBtn){
            $(opts.tpl.closeBtn).appendTo($(blockCatalog)).on('click.bs.leftnav', function(e) {
                Close(e);
            });
        }
        opts.fixedDiv = $(opts.tpl.fixedDiv).appendTo(wrap);
       // console.log(opts);
    }

    Leftnav.prototype.toggle = function(e){
        e.stopPropagation();
        var $this = $(this);
        if(e.type == 'mouseover'){
            var opts = $(outer).data('bs.leftnav').options;
            var $parent  = getParent($this);
            var isActive = $parent.hasClass('open');
            var $child = getChild($parent);
            var $li_subsubmenu = $child.find("li");

            //Subsubmenu offset

            var postop = getPostop($this, $child);
            $child.css('top', postop);

            $child.on('mouseover', function(e){
                e.stopPropagation();
            })
            /*$li_subsubmenu.each(function(e){
                $(this).on('mouseover', function(e){
                    e.stopPropagation();
                    console.log($li_subsubmenu.length)
                })

            })*/
            var isActiveChild = $child.hasClass('open');
            if(!isActiveChild){
                clearMenus();
            }
            //
            if(!isActive){
                $parent.addClass('open')
                $child.addClass('open');

                //$child.css({backgroundColor:"red"})
            }
            $this.focus();
            //var opts = $(outer).data('bs.leftnav').options;
        }
        else if(e.type == 'click'){
            location.href = $this.attr('href');
        }

    }
    function Open(e){
        $(outer).css({width:"275px"});
        $(blockCatalog).animate({width:"show"},{complete:function(){
            $(blockCatalog).find("li.dropdown").css({whiteSpace:"normal"});
            $(blockCatalog).addClass("open");

        }}, 500);
        autoHeight();

    }
    function Close(e){
        clearMenus();
        $(blockCatalog).find("li.dropdown").css({whiteSpace:"nowrap"})
        $(blockCatalog).animate({width:"hide"},{complete:function(){
            $(outer).css({width:"0px"});
            $(blockCatalog).removeClass("open");
        }}, 500);

    }
    function getParent($this) {
        var selector = $this.attr('data-target');

        if (!selector) {
            selector = $this.attr('href')
            selector = selector && /#[A-Za-z]/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
        }

        var $parent = selector && $(selector);
        return $parent && $parent.length ? $parent : $this.parent()
    }
    function getChild($this){
        var $child = $this.find(".dropdown-menu");
        return $child;
    }
    function clearMenus(e) {
        $(toggle).each(function () {
            var $parent = getParent($(this))
            var $child = getChild($parent);
            if (!$parent.hasClass('open')) return
            $parent.removeClass('open');
            $child.removeClass('open');
        })
    }
    function autoHeight(){
        var $parent  = getParent($(outer));
        var elemHeight = $(outer).height();
        var parentHeight = $parent.height();
        var elemPositionTop = $(outer).position().top;
        var dopHeight = 0;
        var opts = $(outer).data('bs.leftnav').options;
        (opts.isActive)? dopHeight = 52 : dopHeight = 0;
        if(parentHeight < elemHeight){
            $parent.height(elemHeight + (elemPositionTop - 10) + dopHeight);
        }
    }

    function getPostop($this, $child){
        var opts = $(outer).data('bs.leftnav').options;
        var fixedDiv = opts.fixedDiv;//console.log(fixedDiv );
        var offsetFixDiv = fixedDiv.offset();
        var topFixDiv = offsetFixDiv.top;
        var getPosition = $this.position();
        var getOffset = $this.offset();
        var getOfftop = getOffset.top;
        var getPostop = getPosition.top;
        var childH = 0;
        var sumH = 0;
        var zazor = 0;
        getPostop = getPostop - 5 + 'px';
        childH = $child.height();
        sumH = getOfftop + childH;
        zazor = topFixDiv - sumH;
        if(zazor < 0)
        {
            zazor = Math.abs(zazor);
            getPostop = (getPosition.top - 12 - zazor) + 'px';
        }
        return getPostop;
    }
    // DROPDOWN PLUGIN DEFINITION
    // ==========================

    var old = $.fn.leftnav

    $.fn.leftnav = function(option){
        return this.each(function () {
            var $this = $(this);
            var data    = $this.data('bs.leftnav');
            var options = $.extend({}, Leftnav.DEFAULTS, option, $this.data());
            if (!data) $this.data('bs.leftnav', (data = new Leftnav(this, options)));
            if(typeof option == 'object' || !option){
                //console.log($this.data(option));
                Leftnav.prototype.init($this, options);
            }
            if (typeof option == 'string'){
                data[option].call($this)
            }
        });
    }

    $.fn.leftnav.Constructor = Leftnav


    // Leftnav NO CONFLICT
    // ====================

    $.fn.leftnav.noConflict = function () {
        $.fn.leftnav = old
        return this
    }


    // APPLY TO STANDARD Leftnav ELEMENTS
    // ===================================
    $(document)
        .on('click.bs.leftnav', Close)
        .on('mouseover.bs.leftnav', clearMenus)
        .on('click.bs.leftnav', outer + ', .navbar-block', function(e){
            e.stopPropagation();
        })
        .on('mouseover.bs.leftnav, click.bs.leftnav', toggle, Leftnav.prototype.toggle)

    //LEFTNAV
    $('#outer-menu').leftnav(
        {isActive:true}
    );
}(jQuery);

