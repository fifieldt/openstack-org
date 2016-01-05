<schedule-grid-events>
    <div class="row">
        <div class="col-md-12">
            <schedule-event each={ summit.events[selected_day] } ></schedule-event>
        </div>
    </div>

    <script>

        this.summit                   = opts.summit;
        this.schedule_filters         = opts.schedule_filters;
        this.search_url               = opts.search_url;
        this.schedule_api             = opts.schedule_api;
        this.base_url                 = opts.base_url;
        this.selected_day             = opts.selected_day;
        this.default_event_type_color = opts.default_event_type_color;
        this.clicked_event            = {};
        this.current_filter           = null;
        var self                      = this;

        this.on('mount', function(){

        });

        this.schedule_api.on('beforeEventsRetrieved', function(){
            $('#events-container').ajax_loader();
        });

        this.schedule_api.on('eventsRetrieved',function(data) {
            self.summit.events[data.day] = data.events;
            $('#events-container').ajax_loader('stop');
            self.selected_day = data.day;
            self.applyFilters();
        });

        this.schedule_filters.on('scheduleFiltersChanged', function(filters){
            self.current_filter = filters;
            self.applyFilters();
        });

        applyFilters(){
            if(self.current_filter !== null ){
                $.each(self.summit.events[self.selected_day], function(index, e) {
                    e.show = true;
                    var must_show = [];
                    // event types
                    if(self.current_filter.event_types === null || self.current_filter.event_types.length === 0){
                        must_show.push(true);
                    }
                    else
                    {
                        must_show.push(self.current_filter.event_types.indexOf(e.type_id.toString()) > -1);
                    }
                    // tracks
                    if(self.current_filter.tracks === null || self.current_filter.tracks.length === 0){
                        must_show.push(true);
                    }
                    else
                    {
                        if('track_id' in e)
                            must_show.push(self.current_filter.tracks.indexOf(e.track_id.toString()) > -1);
                        else
                        must_show.push(false);
                    }
                    // tags
                    if(self.current_filter.tags === null || self.current_filter.tags.length === 0){
                        must_show.push(true);
                    }
                    else
                    {
                        must_show.push(e.tags_id.some(function(v) { return self.current_filter.tags.indexOf(v.toString()) != -1; }));
                    }

                    // summit_types
                    if(self.current_filter.summit_types === null || self.current_filter.summit_types.length === 0){
                        must_show.push(true);
                    }
                    else
                    {
                        must_show.push(e.summit_types_id.some(function(v) { return self.current_filter.summit_types.indexOf(v.toString()) != -1; }));
                    }

                    for(var i = 0 ; i < must_show.length; i++){
                        e.show = e.show && must_show[i];
                    }

                });
            }
            self.update();
        }


        this.schedule_api.on('eventAdded2MySchedule',function(event_id) {
            console.log('eventAdded2MySchedule');
            self.clicked_event[event_id].own = true;
            self.update();
         delete self.clicked_event[event_id];
        });

        this.schedule_api.on('eventRemovedFromMySchedule',function(event_id) {
            console.log('eventRemovedFromMySchedule');
            self.clicked_event[event_id].own = false;
            self.update();
            delete self.clicked_event[event_id];
        });

    </script>
</schedule-grid-events>