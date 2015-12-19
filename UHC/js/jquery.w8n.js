/**
 * @author Sergio Marrero
 * 
 * jQuery plug-in: Notification system inspired by the notification style of Windows 8
 * 
 * Copyright (c)2013, Sergio Marrero
 * Licensed under the BSD license.
 * http://opensource.org/licenses/BSD-3-Clause
 */
;(function($)
{
    var settings = {
        timeout: 2500
    };

    var methods = {
        init: function(title, message, options) {
            return this.each(function() {
                var $this = $(this);
                $this.data('w8n', {
                    target: $this,
                    settings: {},
                    title: title,
                    message: message
                });

                var data = $this.data('w8n');
                $.extend(data.settings, settings, options);

                // add the notification to the stack
                methods.showNotification($this);
            });
        },

        showNotification: function($this) {
            var data = $this.data('w8n');
                
            // Create notification
            var $notification = $('<div />')           
                .addClass('w8n-box');

            // Create title and message 
            var $title = $('<div />')
                .addClass('title')
                .html(data.title);

            var $message = $('<div />')
                .addClass('message')
                .html(data.message);

            // Add title and message to notification
            $notification.append($title)
                .append($message);

            // Add notification to stack container
            $('.w8n-container').append($notification);            
           
            // Display animation a hide after timeout
            $notification.animate({width: 'show'}, {
                duration: 'slow',
                complete: function () {
                    if (data.settings.timeout > 0) {
                        setTimeout(function () {
                            $notification.animate({width: 'hide'}, {
                                duration: 'fast',
                                complete: function() {
                                    $notification.remove();
                                } 
                            });
                        }, data.settings.timeout);
                    }
                }
            });

            // Close with click
            $notification.on('click', function() {
                $notification.animate({width: 'hide'}, {
                    duration: 'fast',
                    complete: function() {
                        $notification.remove();
                    } 
                });
            });                     
        }
    };

    // Called without selector
    $.w8n = function(title, message, options) {
        // Create container location
        if ($('.w8n-container').length === 0)
        {
            var $body = $('body');
            $('body')
                .append($('<div />')
                .addClass('w8n-container')
                .addClass('top')
                .addClass('right'));
        }

        $('.w8n-container').w8n(title, message, options);
    };

    // plugin setup
    $.fn.w8n = function(message, options) {
        return methods.init.apply(this, arguments);   
    };

})(jQuery);