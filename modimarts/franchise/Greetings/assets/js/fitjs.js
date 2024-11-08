// A super lightweight jQuery plugin to allow an elements font-size 
// to be a percentage of its parent container's width or height.
// https://github.com/MichaelSpencer1995/jquery-fluid-typography

;(function($) {
    $.responsiveFonts = function(elements) {
        for(var element in elements) {
            var currentElement = elements[element];
            var parent = currentElement.parent,
                target = currentElement.target,
                factor = currentElement.factor,
                useContainerWidth = currentElement.useContainerWidth;
                property = currentElement.property;
            setNewCss(parent, target, factor, useContainerWidth, property);
        };
        function containerHeight(container) {
            return parseInt($(container).css('height'));
        };
        function containerWidth(container) {
            return parseInt($(container).css('width'));
        };
        function setNewCss(parent, target, factor, useContainerWidth, property) {
            var dimension = useContainerWidth ? containerWidth(parent) : containerHeight(parent);
            var newFontSize = calcPixelValue(dimension, factor);
            var newCssString = generateNewCssString(target, newFontSize, property);
            setNewInlineCss(target, newCssString);
        };
        function calcPixelValue(dimension, factor) {
            return dimension * factor;
        };
        function generateNewCssString(target, pixelValue, prop) {
            var currentInlineStyle = getCurrentInlineStyle(target);
            var prop = prop || 'font-size';
            prop += ': ';
            return currentInlineStyle + ';' + prop + pixelValue + 'px;';
        };
        function setNewInlineCss(target, styleString){
            $(target).css('cssText', styleString);
        };
        function getCurrentInlineStyle(target) {
            var currentInlineStyle = $(target).attr("style");
            return (currentInlineStyle === undefined) ? '' : currentInlineStyle;
        };
    };
}(window.jQuery));