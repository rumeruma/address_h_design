@extends('admin.layouts.page')    

@section('content')
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="title">Dashboard</div>
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
@endsection