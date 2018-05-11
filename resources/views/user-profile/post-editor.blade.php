@extends('layouts.page')

@section('content')
    <div class="container">
        <div class="row">
            <div id="user" class="col-md-12 ">

                <div class="panel panel-default">
                    <div class="panel-heading">General Info:
                        @php
                            $contacts = [];
                            $links = [];
                            if(array_key_exists('contacts', $meta)){
                                $contacts = $meta['contacts'];
                            }
                            if(array_key_exists('links', $meta)){
                                $links = $meta['links'];
                            }
                        @endphp

                        <social-number
                                urlz="{{ route('my-business.update.voda') }}"
                                postid="{{ $subscription->post->id  }}"
                                contacts="{{ json_encode($contacts) }}"
                                socials="{{ json_encode($links) }}"
                        ></social-number>
                    </div>
                    <form action="{{ route('my-business.update', [$subscription->post->id]) }}" method="post">

                        <div class="panel-body">

                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-9">

                                    <p class="lead"> Package : {{ $subscription->package->title }} Expiry
                                        : {{ \Carbon\Carbon::createFromFormat('Y-m-d',$subscription->expiry)->format('d M Y') }}</p>
                                    @if(count($errors))
                                        @foreach($errors->all() as $error)
                                            <span class="text-danger">{{ $error }}</span>
                                        @endforeach
                                    @endif


                                    <div class="form-group">
                                        <label for="businessTitle">Business/Institute Title</label>
                                        <input type="text" class="form-control" id="businessTitle"
                                               aria-describedby="businessHelp"
                                               placeholder="Enter Title" name="title"
                                               value="{{ $subscription->post->title }}">
                                        <small id="businessHelp" class="form-text text-muted">your business/institute
                                            name.
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="businessTag">Slogun/Sub Title/Tagline</label>
                                        <input type="text" class="form-control" id="businessTag"
                                               aria-describedby="businessHelp"
                                               placeholder="Slogun/Sub Title/Tagline" name="meta[info][tagline]"
                                               value="{{ posts_meta_collection(posts_meta($meta,'info'), 'tagline') }}">
                                        <small id="businessHelp" class="form-text text-muted">your business/institute
                                            Slogun/Sub Title/Tagline
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="businessEmail">Email</label>
                                        <input type="email" class="form-control" id="businessEmail"
                                               aria-describedby="businessHelp"
                                               placeholder="eg: email@domain.com" name="meta[info][email]"
                                               value="{{ posts_meta_collection(posts_meta($meta,'info'), 'email') }}">
                                        <small id="businessHelp" class="form-text text-muted">your business/institute
                                            Email
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="businessAddress">Address</label>
                                                <input type="text" class="form-control" id="businessAddress"
                                                       aria-describedby="businessHelp"
                                                       placeholder="Address" name="meta[info][address]"
                                                       value="{{ posts_meta_collection(posts_meta($meta,'info'), 'address') }}">
                                                <small id="businessHelp" class="form-text text-muted">your
                                                    business/institute
                                                    Address
                                                </small>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="businessAddress">Geolocation</label>
                                                <button id="show-vodar-map" type="button"
                                                        class="form-control btn btn-xs btn-info">
                                                    Add Geolocation
                                                </button>
                                                <input id="geoLocation" type="hidden"
                                                       value="{{ posts_meta_collection(posts_meta($meta,'info'), 'geolocation') }}"
                                                       name="meta[info][geolocation]">
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="vodar-map">
                                                    <input id="pac-input" class="controls form-control" type="text"
                                                           placeholder="Search Box">
                                                    <div id="map" style="width:100%;height:500px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="businessTitle">Abput us</label>
                                        <textarea id="content"
                                                  name="content">{!! $subscription->post->content !!}</textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="excerpt">Short Description</label>
                                        <textarea class="form-control" id="excerpt" name="excerpt"
                                                  rows="3">{!! $subscription->post->excerpt !!}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="panel panel-default">

                                        <div class="panel-heading">Cover Image</div>
                                        <div class="panel-body">
                                            <div class="input-group">
                                                   <span class="input-group-btn">
                                                     <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary btn-sm">
                                                       <i class="fa fa-picture-o"></i> Choose
                                                     </a>
                                                       <a id="killFeature" data-input="thumbnail" data-preview="holder"
                                                          class="btn btn-danger btn-sm">
                                                       <i class="fa fa-picture-o"></i> Remove
                                                     </a>
                                                   </span>
                                                <input id="thumbnail" class="form-control" type="hidden"
                                                       name="meta[posts_featured_image][image]"
                                                       value="{{ posts_meta_collection(posts_meta($meta,'posts_featured_image'), 'image') }}">

                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">
                                        </div>
                                    </div>

                                    <div class="panel panel-default">

                                        <div class="panel-heading">Logo Image</div>
                                        <div class="panel-body">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                <a id="lfmlogo" data-input="thumbnail-logo"
                                                   data-preview="holder-logo"
                                                   class="btn btn-primary btn-sm">
                                                <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                                <a id="killFeature2"
                                                   class="btn btn-danger btn-sm">
                                                <i class="fa fa-picture-o"></i> Remove
                                                </a>
                                                </span>
                                                <input id="thumbnail-logo" class="form-control" type="hidden"
                                                       name="meta[posts_featured_image][logo]"
                                                       value="{{ posts_meta_collection(posts_meta($meta,'posts_featured_image'), 'logo') }}">

                                            </div>
                                            <img id="holder-logo" style="margin-top:15px;max-height:100px;">
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">Business Category</div>
                                        <div class="panel-body">
                                            <ul id="list-group-cat" class="list-group">
                                                @php
                                                    $res = $subscription->post->business_categories;
                                                @endphp
                                                @if($res)
                                                    @foreach ($res as $r)
                                                        <li class="list-group-item">
                                                            <span class="text-success">
                                                                <i class="fa fa-check-circle text-success"></i>
                                                            </span> {{ $r->bus_category->title }}
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>

                                            <input type="hidden" id="collected-cat" name="category" value="">
                                            <div class="form-group">
                                                <select multiple="multiple" id="select-cat" class="form-control">

                                                    @foreach($categories as $category)
                                                        <optgroup label="{{ $category->title }}">
                                                            @if(count($category->childs))
                                                                {{--@include('business-profile.dumpChild',['childs' => $category->childs])--}}
                                                                @foreach($category->childs as $child)
                                                                    @php
                                                                        $selected = '';
                                                                    @endphp
                                                                    @foreach ($res as $r)
                                                                        @if($r->bus_category->id === $child->id)
                                                                            @php
                                                                                $selected = ' selected="selected" ';
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    <option value="{{ $child->id }}" {{ $selected }}>{{ $child->title }}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach

                                                </select>
                                                <span class="help-block text-info"> Hold down the Ctrl (windows) / Command (Mac) button to select multiple Categories.</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">Images Gallery (this pavkage
                        supports {{ $subscription->package->meta['package_media']['slider_image'] }} images)
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                {{--<div id="preview">--}}
                                {{--<div id="preview-coverflow">--}}
                                {{--@if(array_key_exists('slider', $meta))--}}
                                {{--@foreach($meta['slider'] as $slider)--}}
                                {{--<img class="cover re" src="{{ $slider }}" alt="Los Angeles">--}}
                                {{--@endforeach--}}
                                {{--@else--}}
                                {{--<img class="cover" src="{{ asset('images/demo/22.jpg') }}"--}}
                                {{--alt="Los Angeles">--}}
                                {{--<img class="cover" src="{{ asset('images/demo/22.jpg') }}"--}}
                                {{--alt="Los Angeles">--}}
                                {{--<img class="cover" src="{{ asset('images/demo/22.jpg') }}"--}}
                                {{--alt="Los Angeles">--}}
                                {{--<img class="cover" src="{{ asset('images/demo/22.jpg') }}"--}}
                                {{--alt="Los Angeles">--}}
                                {{--<img class="cover" src="{{ asset('images/demo/22.jpg') }}"--}}
                                {{--alt="Los Angeles">--}}
                                {{--@endif--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<hr/>--}}

                            </div>
                            <div class="col-md-12">
                                <div class="row" id="slideContent">
                                    @if(array_key_exists('slider', $meta))
                                        @foreach($meta['slider'] as $slider)
                                            <div class="col-md-2 sld-thumb">
                                                <img class="img-thumbnail img-sle"
                                                     src="{{ posts_thumbnail_uri($slider) }}">
                                                <a href="#" class="remove_field"></a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" id="addSlide" class="btn btn-info btn-sm">Add Slide</button>
                        <button type="button" id="previewBtn" class="btn btn-primary btn-sm">preview</button>
                        <button type="button" id="saveSlide" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Video Gallery (this pavkage
                        supports {{ $subscription->package->meta['package_media']['vdo'] }} Video URLs)
                    </div>
                    <div class="panel-body">
                        @php
                            $vdo = [];
                            if(array_key_exists('vdo', $meta)){
                                $vdo = $meta['vdo'];
                            }
                        @endphp
                        <video-url
                                vdosize="{{ $subscription->package->meta['package_media']['vdo'] }}"
                                vdosin="{{ json_encode($vdo) }}"
                                urlz="{{ route('my-business.update.voda') }}"
                                postid="{{ $subscription->post->id  }}"
                        ></video-url>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Business Hours</div>
                    <div class="panel-body">
                        <div id="businessHoursContainer3"></div>

                        <textarea id="businessHoursData">{!! json_encode(posts_meta($meta,'business_hours')) !!}</textarea>
                    </div>
                    <div class="panel-footer">
                        <button type="button" id="saveBusinessHours" class="btn btn-success btn-sm">Save Plan</button>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Services</div>
                    <div class="panel-body">
                        @php
                            $services = [];
                            if(array_key_exists('services', $meta)){
                                $services = $meta['services'];
                            }
                        @endphp
                        <services
                                services-in="{{ json_encode($services) }}"
                                urlz="{{ route('my-business.update.voda') }}"
                                postid="{{ $subscription->post->id  }}"
                        ></services>
                    </div>
                </div>

                @php
                    $branches = [];
                    if(array_key_exists('branches', $meta)){
                        $branches = $meta['branches'];
                    }
                @endphp

                <branches
                        urlz="{{ route('my-business.update.voda') }}"
                        postid="{{ $subscription->post->id  }}"
                        dbranches="{{ json_encode($branches) }}"
                ></branches>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    {{--<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>--}}

    <script type="text/javascript">
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            allowedContent: true,
        };
        CKEDITOR.dtd.$removeEmpty['span'] = false;
        CKEDITOR.dtd.$removeEmpty['i'] = false;
        CKEDITOR.replace('content', options);
        CKEDITOR.replace('excerpt', options);


    </script>

    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/jquery.coverflow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/jquery.interpolate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/jquery.touchSwipe.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/coverflow/reflection.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ config('app.gmap') }}&libraries=places&callback=myMap&language=bn&region=BD"
            type="text/javascript"></script>

    <script type="text/javascript" src="{{ asset('vendor/busy-hours/jquery.businessHours.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/timepicker/jquery.timepicker.js') }}"></script>

    <script>
        'use strict';
        // Business Hours
        $(document).ready(function () {
            var b3 = $("#businessHoursContainer3");
            var template = '<div class="dayContainer" style="width: 80px;">' +
                '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"/></div>' +
                '<div class="weekday"></div>' +
                '<div class="operationDayTimeContainer">' +
                '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-sun-o"></i></span><input type="text" name="startTime" class="mini-time form-control operationTimeFrom" value=""/></div>' +
                '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="mini-time form-control operationTimeTill" value=""/></div>' +
                '</div></div>';
            var timeFucker = function(){
                b3.find('.operationTimeFrom, .operationTimeTill').timepicker({
                    'timeFormat': 'g:i A',
                    'step': 15
                });
            }
            var businessHoursManager;


                var businessHours = jQuery.parseJSON($("#businessHoursData").val());
                var abc = [];
                $.each(businessHours,function(index, val){
                   abc.push({"isActive":eatBoolString(val.isActive),"timeFrom":naallBaal(val.timeFrom),"timeTill":naallBaal(val.timeTill)});
                });
                if(businessHours.length > 0){
                    businessHoursManager = b3.businessHours({
                        operationTime: abc,
                        postInit:timeFucker,
                        dayTmpl: template,
                    });
                }else{
                    businessHoursManager = b3.businessHours({
                        postInit:timeFucker,
                        dayTmpl: template,
                        // operationTime:
                    });
                }
            $('#saveBusinessHours').on('click', function () {

                updateVoda({meta: {business_hours: businessHoursManager.serialize()}, post:{{ $subscription->post->id }}})
            });


        });
        function eatBoolString(val){
            if(val === "false"){
                return false;
            }else{
                return true;
            }
        }
        function naallBaal(val) {
            if(val === "null"){
                return null;
            }else{
                return val;
            }
        }
    </script>

    <script>
        'use strict';
        var lat = 0;
        var lng = 0;
        var myLatlng = {lat: 23.777176, lng: 90.399452};
        var savedLatLng = document.getElementById("geoLocation").value;
        if (savedLatLng) {
            var res = savedLatLng.split(",");
            lat = res[0];
            lng = res[1];
            myLatlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        }
        var map;


        $(document).ready(function () {
            $("#holder").attr("src", "{{ posts_meta_collection(posts_meta($meta,'posts_featured_image'), 'image') }}");
            $("#holder-logo").attr("src", "{{ posts_meta_collection(posts_meta($meta,'posts_featured_image'), 'logo') }}");
            $('#lfm').filemanager('image');
            $('#lfmlogo').filemanager('image');


            $('#show-vodar-map').on('click', function () {
                $('.vodar-map').removeClass('vodar-map').addClass('fade-in animated')
            });
        });


        function myMap() {
            var mapCanvas = document.getElementById("map");
            var myCenter = new google.maps.LatLng(23.777176, 90.399452);
            var mapOptions = {center: myLatlng, zoom: 15, mapTypeId: 'roadmap'};
            map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                // draggable:true,
            });

            google.maps.event.addListener(map, 'click', function (event) {
                // placeMarker(map, event.latLng);
                marker.setPosition(event.latLng);
                lat = event.latLng.lat()
                lng = event.latLng.lng()
                document.getElementById("geoLocation").value = lat + ',' + lng;
            });


            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });

        }

        function placeMarker(map, location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            var infowindow = new google.maps.InfoWindow({
                content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
            });
            infowindow.open(map, marker);
        }

        function changeMarkerPosition(marker) {
            marker.setPosition(latlng);
        }

        $("#vodaModal").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
            console.log("trig");
        });
    </script>



    <script>
        $(document).ready(function () {

            // if ($.fn.reflect) {
            //     $('#preview-coverflow .cover').reflect();	// only possible in very specific situations
            // }

            // var cf = $('#preview-coverflow').coverflow({
            //     index: 2,
            //     density: 1,
            //     innerOffset: 30,
            //     innerScale: .7,
            //     animateStep: function (event, cover, offset, isVisible, isMiddle, sin, cos) {
            //         if (isVisible) {
            //             if (isMiddle) {
            //                 $(cover).css({
            //                     'filter': 'none',
            //                     '-webkit-filter': 'none'
            //                 });
            //             } else {
            //                 var brightness = 1 + Math.abs(sin),
            //                     contrast = 1 - Math.abs(sin),
            //                     filter = 'contrast(' + contrast + ') brightness(' + brightness + ')';
            //                 $(cover).css({
            //                     'filter': filter,
            //                     '-webkit-filter': filter
            //                 });
            //             }
            //         }
            //     }
            // });


            var max_fields = {{ $subscription->package->meta['package_media']['slider_image'] }} +1; //maximum input boxes allowed
            var wrapper = $("#slideContent"); //Fields wrapper
            var add_button = $("#addSlide"); //Add button ID
            var voda = {'slider': [], 'vdo': []};
            var x = 1; //initlal text box count


            $(add_button).click(function (e) {
                e.preventDefault();
                var type = 'image';
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (url, file_path) {

                    var thumb_url = file_path.split('/');
                    thumb_url.splice(4, 0, "thumbs");
                    var thumb = thumb_url.join('/');

                    if (x < max_fields) { //max input box allowed
                        x++;
                        // <input type="hidden" name="meta[slide][]" value="'+file_path+'"/>
                        $(wrapper).append('<div class="col-md-2 sld-thumb"><img class="img-thumbnail img-sle" src="' + thumb + '"><a href="#" class="remove_field"></a></div>'); //add input box
                        voda.slider.push(file_path);
                    } else {
                        swal('Max Limit', 'sorry you excided the limit :' + max_fields, 'warning')
                    }

                };

            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                var index = $(this).parent('div').index();
                $(this).parent('div').remove();
                voda.slider.splice(index, 1)
                x--;
            })

            $('#previewBtn').on('click', function () {
                var slideContent = "";
                if (voda.slider.length < 4) {
                    swal('Sorry', 'need minimum 4 images to make preview', 'warning')
                } else {
                    $.each(voda.slider, function (index, value) {
                        slideContent += '<img class="cover" src="' + value + '" alt="Los Angeles" >';
                    });

                }

                $('#preview-coverflow').html(slideContent).coverflow();

            });


            $('#saveSlide').on('click', function () {

                if (voda.slider.length < 4) {
                    swal('Sorry', 'need minimum 4 images to make Slider', 'warning')
                } else {
                    updateVoda({meta: voda, post:{{ $subscription->post->id }}})
                }

            });


            // var selectedCat = [];
            // var resultCat = [];
            // var matchingItems;
            // $('#select-cat').on('change', function () {
            //     var val = $(this).val();
            //     var text = $(this).find('option:selected').text();
            //     selectedCat.push({val: val, text: text});
            //
            //     $.each(selectedCat, function (i, e) {
            //         matchingItems = $.grep(resultCat, function (item) {
            //             return item.val === e.val && item.text === e.text;
            //         });
            //         if (matchingItems.length === 0) {
            //             resultCat.push(e);
            //             $('#collected-cat')
            //             .append('<div class="checkbox"><label><input type="checkbox" name="category[]" checked> Check me out</label></div>');
            //         }
            //     });
            // });

            $('#collected-cat').val($('#select-cat').val());
            $('#select-cat').on('change', function () {
                $('#collected-cat').val($(this).val());
                $('#list-group-cat').html("");
                $('#select-cat option:selected').each(function () {
                    if ($(this).length) {
                        var selText = $(this).text();
                        $('#list-group-cat').append('<li class="list-group-item"><span class="text-success"><i class="fa fa-check-circle text-success"></i></span> ' + selText + '</li>');
                        // fa-check-circle
                    }
                });
            });


        });

        function updateVoda(dhon) {
            $.ajax({
                method: "POST",
                url: "{{ route('my-business.update.voda') }}",
                data: dhon,
                success: function (data) {
                    swal({
                        title: "Updating Profile",
                        text: 'please wait',
                        timer: 5000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        swal(
                            data.success,
                            'Has been updated successfully',
                            'success'
                        )
                    });
                },
                error: function (msg) {
                    var errorMsg = "";
                    if (msg.status === 422) {
                        $.each(msg.responseJSON, function (key, value) {
                            errorMsg += value;
                        });
                        swal(errorMsg);
                    }
                }
            });
        }
    </script>


@endsection


@section('style')
    <link rel="stylesheet" href="{{ asset('js/owl.carousel/dist/assets/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('js/owl.carousel/dist/assets/owl.theme.default.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/busy-hours/jquery.businessHours.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker/jquery.timepicker.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
          type="text/css">

    <style>
        .remove_field {
            position: absolute;
            left: 0;
            top: 0;
            background-image: url({{ asset('images/close.png') }});
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            display: none;
        }

        .sld-thumb:hover .remove_field {
            display: block;
        }

        .sld-thumb:hover .img-sle {
            opacity: 0.7;
        }

        #preview {
            /*padding-top: 5rem;*/
            /*padding-bottom: 5rem;*/
        }

        #preview-coverflow .cover {
            cursor: pointer;
            width: 320px;
            height: auto;
            -webkit-box-shadow: 0px 0px 18px 3px rgba(97, 171, 255, 0.62);
            -moz-box-shadow: 0px 0px 18px 3px rgba(97, 171, 255, 0.62);
            box-shadow: 0px 0px 18px 3px rgba(97, 171, 255, 0.62);
            border-radius: 5px;
        }

        .owl-carousel {
            /*margin: 2rem 0*/
        }

        .owl-carousel .item {
            height: 10rem;
            background: #4DC7A0;
            padding: 1rem
        }

        .owl-carousel .item h4 {
            color: #FFF;
            font-weight: 400;
            margin-top: 0rem
        }

        .owl-carousel .item-video {
            height: 300px
        }

        #setup {
            margin-top: 4rem
        }

        .demo-list h5 {
            margin: 0
        }

        .ev {
            margin: 1rem auto 1rem auto;
        }

        #select-cat {
            height: 20rem;
        }

        /* component Branches.vue*/
        .text-success {
            color: green !important;
        }

        /*MAp FUCKER*/
        /* Always set the map height explicitly to define the size of the div
               * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-top: 12px;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
        }

        .vodar-map,#businessHoursData {
            display: none;
        }

    </style>

@endsection
