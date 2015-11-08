jQuery(document).ready(function(){


    

    $("article.lazy").lazyload({
        threshold : 0
    });

    $("img.lazy").lazyload({
        threshold : 1
    });

    $("div.lazy").lazyload({
        threshold : 200
    });

    $("a.lazy").lazyload({
        threshold : 200
    });
   


    ko.validation.init({
        insertMessages: false,
        decorateInputElement : true,
        decorateElementOnModified: true,
        errorMessageClass: 'err'
    });

    ko.bindingHandlers.fadeVisible = {
        init: function(element, valueAccessor) {
            // Initially set the element to be instantly visible/hidden depending on the value
            var value = valueAccessor();
            $(element).toggle(ko.unwrap(value)); // Use "unwrapObservable" so we can handle values that may or may not be observable
        },
        update: function(element, valueAccessor) {
            // Whenever the value subsequently changes, slowly fade the element in or out
            var value = valueAccessor(),
                unwrappedValue = ko.unwrap(value),
                display = unwrappedValue ? "inline-block" : "none",
                action = unwrappedValue ? "fadeIn" : "fadeOut";

            //this feels like a hack, but works...
            if($(element).closest('.topbar-share').length) {
                $(element)[action]();
            } else {
                $(element)[action]("fast", function() {
                    $(element).attr("style", "display: " + display + " !important");
                });
            }
        }
    };

    ko.bindingHandlers.fade = {
        init: function(element, valueAccessor) {
            var value = valueAccessor();
            $(element).toggle(ko.unwrap(value));
        },
        update: function(element, valueAccessor) {
            var value = valueAccessor(),
                display = ko.unwrap(value) ? "block" : "none",
                action = ko.unwrap(value) ? "fadeIn" : "fadeOut";
            $(element)[action]("fast", function() {
                $(element).attr("style", "display: " + display + " !important");
            });
        }
    };


    ViewModel = function() {
        var self                = this;

        self.user_email         = ko.observable(false);
        postRead                = ko.observable(false);

        self.showToolbarIcons   = ko.observable(false);


        

        self.show_nav           = ko.observable(false);
        self.show_subnav        = ko.observable(false);


       // $('#popup').foundation('reveal', 'open');

        self.is_scrolled        = ko.observable(false);


        self.email              = ko.observable().extend({
                                    required: true,
                                    'email': true,
                                    email: {
                                        params: true,
                                        message: "Email is invalid!"
                                    }
                                });



        //ajax helper
        self.ajax = function(uri, method, data, stringify, spinner) {
          //  console.log(data);
            var request = {
                url: uri,
                type: method,
                contentType: "application/json",
                accepts: "application/json",
                cache: true,
                dataType: 'json',
                data: typeof stringify != 'undefined' ? data: JSON.stringify(data),
                beforeSend: function(xhr){

                    if(spinner) {
                        $(spinner).hide();
                        $(spinner + '-spinner').show();
                    }

                    xhr.setRequestHeader('Authorization', 'bearer 7KJwNcPFhuA2evAlVMEac0T8HPBWaWau3lfMMfyR8bIQi55QMsAH5HJHtKYdhstl');
                },

                error: function(jqXHR) {
                    DEBUG && console.log("ajax error " + jqXHR.status);
                },

                complete: function() {
                    if(spinner) {
                        $(spinner).show();
                        $(spinner + '-spinner').hide();
                    }
                }
            };

            return $.ajax(request);
        };


        toggleShareIcons = function () {
            self.showToolbarIcons(!self.showToolbarIcons());
        }

        self.toggleNav = function() {
            self.show_nav(!self.show_nav());
        }

       

        if ($('#topbar-waypoint').length) {

            var topbar_waypoint = new Waypoint({
                element: document.getElementById('topbar-waypoint'),
                handler: function(direction) {

                    //if down and dropdown is closed
                    if (direction == 'down') {
                        self.is_scrolled(true);
                    }  else {
                        self.is_scrolled(false);
                    }
                },
                offset: '-25%'
            });
        }

        

    }

    viewModel = new ViewModel();
    ko.applyBindings(viewModel);

    //waypoints and stuff

    if ($('#read-waypoint').length) {

        var read_waypoint = new Waypoint({
            element: document.getElementById('read-waypoint'),
            handler: function(direction) {
                viewModel.read(post_id, post_type);
              //  console.log(this.element.id + ' triggers at ' + this.triggerPoint + ' with direction: ' + direction);
            },
            offset: '75%'
        });
    }

    //topbar share icons on/off relative to post body icons
    if ($('#share-waypoint').length) {
        var share_waypoint = new Waypoint({
            element: document.getElementById('share-waypoint'),
            handler: function(direction) {
                //DEBUG && console.log('share waypoint:' + this.triggerPoint + ': ' + direction);
                if (direction == 'down') {
                    $(".topbar-share").addClass('show-topbar-share');
                    $(".topbar-share").removeClass('hide-topbar-share');
                } else {
                    $(".topbar-share").removeClass('show-topbar-share');
                    $(".topbar-share").addClass('hide-topbar-share');
                }

            },
            offset: '7%'

        });
    }

    if ($('#share-waypoint-bottom').length) {

        var share_waypoint_bottom = new Waypoint({
            element: document.getElementById('share-waypoint-bottom'),
            handler: function(direction) {
               // DEBUG && console.log('bottom share waypoint:' + this.triggerPoint + ': ' + direction);
                if (direction == 'down') {
                    $(".topbar-share").removeClass('show-topbar-share');
                    $(".topbar-share").addClass('hide-topbar-share');
                } else {
                    $(".topbar-share").addClass('show-topbar-share');
                    $(".topbar-share").removeClass('hide-topbar-share');
                }

            },
            offset: '80%'

        });
    }

    if ($('#share-waypoint-bottom-off').length) {

         var share_waypoint_bottom_off = new Waypoint({
             element: document.getElementById('share-waypoint-bottom-off'),
             handler: function(direction) {
               //  DEBUG && console.log('bottom share waypoint:' + this.triggerPoint + ': ' + direction);
                 if (direction == 'down') {
                    $(".topbar-share").addClass('show-topbar-share');
                    $(".topbar-share").removeClass('hide-topbar-share');
                } else {
                    $(".topbar-share").removeClass('show-topbar-share');
                    $(".topbar-share").addClass('hide-topbar-share');
                }

             },
             offset: '75%'

         });
    }




});
