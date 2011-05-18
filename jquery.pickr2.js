/*
 * Pickr2 v1.0 jQuery plugin
 * 
 * Usage:
 * $(image element).pickr2({class: class of inputs, file: callback file});
 *
 * Copyright (c) 2011 Pale Purple Ltd
 * http://www.palepurple.co.uk
 * 
 * Original Pickr code Copyright (c) Muffin Research Labs
 * http://www.muffinresearch.co.uk/lab/javascript/pickr/
 *
 * Pickr2 is free software; you can redistribute it and/or modify it 
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * Pickr2 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * 
 * If you are not able to view the LICENSE, which should
 * always be possible within a valid and working Pickr release,
 * please write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * to get a copy of the GNU General Public License or to report a
 * possible license violation.
 */

(function($){
    $.pickr2 = function(element, options) {
        this.options = {};

        this.init = function(element, options) {
            this.options = $.extend({}, $.pickr2.defaultOptions, options);
            palette = $(this.options['class']);
            file = this.options['file'];
            var holder = palette[0];
            for ( var i=0; i < palette.length; i++) {
                $(palette[i]).click(function() {
                $(palette).removeClass("colourselected");
                    $(this).addClass("colourselected")
                    holder = this;
                });
            }
    
            $(element).click(function(e){
                var mousexpos = e.pageX - $(this).offset().left;
                var mouseypos = e.pageY - $(this).offset().top;
                $.get(file, {x: mousexpos, y: mouseypos},
                    function(data){
                        $(holder).css('background-color', data);
                        $(holder).attr('value', data);
                    })
            });
        }

        this.init(element, options);
    };

    $.fn.pickr2 = function(options) {
        return this.each(function() {
            (new $.pickr2($(this), options));
        });
    }

    $.pickr2.defaultOptions = {
        class: '.pickrs',
        file:  'pickr.php'
    }
})(jQuery);
