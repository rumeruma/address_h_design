@component('vendor.mail.html.message')
# Info Request
## sender: {{ $content['name'] }}
## email: {{ $content['email'] }}
{{ $content['message'] }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
