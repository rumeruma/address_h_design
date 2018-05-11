@extends('admin.layouts.page')    

@section('content')
<div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="title">
              @hasSection('title')
                  @yield('title')
              @else
                  Add New
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

<form action="{{ route('post.store') }}@yield('edtID')" method="post">
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
            <label class="label">Content</label>
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
                <label class="label">excerpt</label>
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

                <strong>Featured Image</strong>

                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                    <input id="thumbnail" class="form-control" type="hidden" name="meta[posts_featured_image][]" value="@yield('edtFimg')">

                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">


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
            allowedContent: 'a[!href]; ul; li{text-align}(someclass); div(*)'

        };
        CKEDITOR.replace( 'content', options);


    </script>

    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#lfm').filemanager('image');
        });
    </script>
    @yield('edit-scripts')

@endsection
