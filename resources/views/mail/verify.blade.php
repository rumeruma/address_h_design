@component('vendor.mail.html.message')


# Welcome To {{ config('app.name') }}
Your Account Created Successfully
To Activate Your Account Click Button Below

@component('mail::button', ['url' => route('verify.email', ['email'=>$user['email'],'token'=>$user['verifyToken']])])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
