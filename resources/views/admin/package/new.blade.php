@extends('admin.layouts.page')    

@section('content')
<div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="title">
              @hasSection('title')
                  @yield('title')
              @else
                  Add New Package
              @endif</div>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <button type="button" class="button is-small">
            {{ date('M d Y') }}
          </button>
        </div>
      </div>
    </div>

<form action="{{ route('package.store') }}@yield('edtID')" method="post">
    <div class="columns is-multiline">



      <div class="column is-9">

          <div class="box">
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Page Title</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" placeholder="Title" type="text" name="title" value="@yield('edtTitle')">
              </p>
            </div>
            
          </div>
        </div>
        
        
        
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Long Description</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <textarea class="textarea" id="content" name="content" placeholder="Post Content">
                    @yield('edtContent')
                </textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Short Description</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <textarea class="textarea" id="excerpt" name="excerpt" placeholder="excerpt">@yield('edtExcerpt')</textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
          <div class="field-label">
            <!-- Left empty for spacing -->
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <button type="submit" class="button is-primary">
                  Publish
                </button>
              </div>
            </div>
          </div>
        </div>

          </div>

      </div>

        <div class="column is-3">
            <div class="box">

                <strong>Package Price</strong>

                <div class="field-body">
                    <div class="field">
                        <p class="control is-expanded">
                            <input class="input" placeholder="price" type="text" name="meta[package_price][]" value="@yield('edtPrice')">
                        </p>
                    </div>

                </div>


            </div>

            <div class="box">

                <strong>Package Media</strong>

                <div class="field-body">
                    <div class="field">
                        <label class="label">Slider Image Limit</label>
                        <p class="control is-expanded">
                            <input class="input" placeholder="00" type="number" name="meta[package_media][slider_image]" value="@yield('edtSlider')">
                        </p>
                    </div>

                </div><div class="field-body">
                    <div class="field">
                        <label class="label">Video Limit</label>
                        <p class="control is-expanded">
                            <input class="input" placeholder="00" type="number" name="meta[package_media][vdo]" value="@yield('edtVideo')">
                        </p>
                    </div>

                </div>


            </div>
        </div>


    </div>

    {{ csrf_field() }}
    @section('editMethod')
    @show

</form>
@endsection

@section('scripts')

    <script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    {{--<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>--}}

    <script type="text/javascript">
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            allowedContent: true, //'a[!href]; ul; li{text-align}(someclass); div(*)',
        };
        CKEDITOR.dtd.$removeEmpty['span'] = false;
        CKEDITOR.dtd.$removeEmpty['i'] = false;
        CKEDITOR.replace( 'content', options);
        CKEDITOR.replace( 'excerpt', options);


    </script>

    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#lfm').filemanager('image');
        });
    </script>
    @yield('edit-scripts')

@endsection
