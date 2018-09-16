/*!
 * Label In Place Plugin
 * Forked from https://github.com/andreapace/labelinplace
 * Revamped and modified by Kartik Visweswaran, Krajee.com, 2018
 * - Enhancements to display label animation correctly on fast click/double click
 * @package yii2-label-inplace
 * @version 1.2.3
 */
(function ($) {
    "use strict";
    var pluginName = 'labelinplace', LabelInPlace;
    $.fn[pluginName] = '';

    LabelInPlace = function (element, options) {
        var self = this;
        self.element = element;
        self.options = options;
        this.init();
    };

    LabelInPlace.prototype = {
        init: function () {
            var self = this, el = self.element, $el = $(el), settings = self.options, $focusLabel, setFocus, timer;
            $el.each(function () {
                var $inputLabel = $("label[for='" + $el.attr(settings.inputAttr) + "']"),
                    spaceTop = parseInt($el.css("border-top-width")) + parseInt($el.css("padding-top")),
                    spaceLeft = parseInt($el.css("border-left-width")) + parseInt($el.css("padding-left")),
                    spaceBottom = parseInt($el.css("border-bottom-width")) + parseInt($el.css("padding-bottom"));
                $el.data({
                    "height": $el.outerHeight(),
                    "width": $el.outerWidth(),
                    "spaceTop": spaceTop,
                    "spaceBottom": spaceBottom
                });

                //if there is an icon
                switch (settings.labelIconPosition) {
                    case "after":
                        if (settings.labelArrowRight) {
                            $inputLabel.append('<span class="' + settings.classIcon + '">' +
                                settings.labelArrowRight + '</span>');
                        }
                        break;
                    default: //before
                        if (settings.labelArrowRight) {
                            $inputLabel.prepend('<span class="' + settings.classIcon + '">' +
                                settings.labelArrowRight + '</span>');
                        }
                }
                $el.removeAttr("placeholder");
                $inputLabel.css("position", "absolute").css("top", spaceTop + "px")
                    .css("left", spaceLeft + "px").addClass(settings.classPlaceholder);
                if ($(el).val()) {
                    $inputLabel.hide();
                }
                $el.prev("label").addBack().wrapAll('<div class="' + settings.wrapperClass + '"/>');
            });
            $focusLabel = $("label[for='" + $el.attr(settings.inputAttr) + "']");
            setFocus = function () {
                if ($el.data('disableLIP')) {
                    return;
                }
                var inputHeight = parseInt($el.outerHeight()),
                    labelHeight = parseInt($focusLabel.outerHeight()),
                    paddingTop = parseInt($el.css("padding-top"));
                switch (settings.labelPosition) {
                    case "down":
                        $focusLabel.animate({top: inputHeight}, settings.animSpeed, function () {
                            if ((settings.labelArrowUp) && (settings.labelArrowRight)) {
                                $focusLabel.find("." + settings.classIcon).html(settings.labelArrowUp);
                            }
                        });
                        $el.animate({
                            height: inputHeight + labelHeight + paddingTop,
                            "padding-bottom": labelHeight + paddingTop + "px"
                        }, settings.animSpeed, function () {
                            if ($focusLabel.is(":hidden")) {
                                $focusLabel.show();
                            }
                            $focusLabel.removeClass(settings.classPlaceholder).addClass(settings.classLabel);
                        });
                        break;
                    default: //up
                        $el.animate({
                            height: inputHeight + labelHeight + paddingTop,
                            "padding-top": labelHeight + paddingTop + "px"
                        }, settings.animSpeed, function () {
                            if ($focusLabel.is(":hidden")) {
                                $focusLabel.show();
                            }
                            $focusLabel.removeClass(settings.classPlaceholder).addClass(settings.classLabel);
                            if ((settings.labelArrowDown) && (settings.labelArrowRight)) {
                                $focusLabel.find("." + settings.classIcon).html(settings.labelArrowDown);
                            }
                        });
                }
                $el.data('disableLIP', true);
            };
            $focusLabel.on('click', function (e) {
                e.preventDefault();
                $el.data('disableLIP', true);
                if (timer) {
                    clearTimeout(timer);
                }
                timer = setTimeout(function () {
                    if ($focusLabel.hasClass(settings.classPlaceholder)) {
                        $el.data('disableLIP', false);
                        setFocus();
                    }
                }, 300);
            });
            $el.on('focus', function () {
                setFocus();
            }).on('blur', function () {
                var inputHeight = $el.data("height"), paddingTop = parseInt($el.data("spaceTop")),
                    paddingBottom = parseInt($el.data("spaceBottom"));
                $el.data('disableLIP', false);
                switch (settings.labelPosition) {
                    case "down":
                        $el.animate({
                            height: inputHeight,
                            "padding-bottom": paddingBottom + "px"
                        }, settings.animSpeed, function () {
                        });
                        if ($el.val() !== "") {
                            $focusLabel.hide();
                        } else {
                            $focusLabel.animate({top: paddingTop}, 200, function () {
                                if ((settings.labelArrowUp) && (settings.labelArrowRight)) {
                                    $focusLabel.find("." + settings.classIcon).html(settings.labelArrowRight);
                                }
                            }).removeClass(settings.classLabel).addClass(settings.classPlaceholder);
                        }
                        break;
                    default: //up
                        $el.animate({
                            height: inputHeight,
                            "padding-top": paddingTop + "px"
                        }, settings.animSpeed, function () {
                            if ($el.val() !== "") {
                                $focusLabel.hide();
                            } else {
                                $focusLabel.removeClass(settings.classLabel).addClass(settings.classPlaceholder);
                                if ((settings.labelArrowDown) && (settings.labelArrowRight)) {
                                    $focusLabel.find("." + settings.classIcon).html(settings.labelArrowRight);
                                }
                            }
                        });
                }
            });
            $('.' + settings.wrapperClass).on('click', 'label.' + settings.classPlaceholder, function () {
                var $elem  = $('.' + settings.wrapperClass + ' [' + settings.inputAttr + '=' +
                    $(this).attr('for') + ']');
                if ($elem.not(':focus')) {
                    $elem.trigger('focus');
                }
            });
        }
    };

    $.fn[pluginName] = function (option) {
        var args = Array.apply(null, arguments);
        args.shift();
        return this.each(function () {
            var $this = $(this), data = $this.data(pluginName), options = typeof option === 'object' && option;
            if (!data) {
                data = new LabelInPlace(this, $.extend({}, $.fn[pluginName].defaults, options, $(this).data()));
                $this.data(pluginName, data);
            }
            if (typeof option === 'string') {
                data[option].apply(data, args);
            }
        });
    };

    $.fn[pluginName].defaults = {
        labelPosition: 'up',
        classPlaceholder: 'lip-placeholder',
        classLabel: 'lip-label',
        classIcon: 'lip-icon',
        wrapperClass: 'lip-group',
        animSpeed: 200,
        labelArrowDown: null,
        labelArrowUp: null,
        labelArrowRight: null,
        labelIconPosition: 'append',
        inputAttr: 'name'
    };
})(window.jQuery);