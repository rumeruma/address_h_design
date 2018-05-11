@component('vendor.mail.html.message')
# Introduction

# Welcome To {{ config('app.name') }}
you have a new account<br>

## Follow the steps below to make your account active

* first follow this link (click this button) to verify your email :
@component('mail::button', ['url' => route('user.verify', ['email'=>$admin['email'],'token'=>$admin['verifyToken']])])
Button Text
@endcomponent

* Use This __**email**__ and __**password to**__ logged in. your account credintials:
@component('mail::panel')
 ### User name : {{ $admin['name'] }}
 ### email : {{ $admin['email'] }}
 ### password : {{ $admin['password'] }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
