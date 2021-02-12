@component('mail::message')
# Welcome To Mass TV


{{ $mailData['body'] }}
<br>
This OTP expires in 1 hr. Please verify before that.

Thanks,<br>
Mass TV
@endcomponent
