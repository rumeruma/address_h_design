@component('vendor.mail.html.message')
# {{ $content['title'] }}
{{ $content['msg'] }}


<br>
{{ config('app.name') }}
@endcomponent
