@component('vendor.mail.html.message')
## Applicant Name:
{{ $content['sender'] }}

## Message:
{{ $content['body'] }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
