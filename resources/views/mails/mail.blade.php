
@component('mail::message')
# Introduction
 
<h3>Name:</h3> {{$inputs['name']}}
						<h3>Email:</h3> {{$inputs['email']}}
						<h3>Message:</h3> {{$inputs['message']}}
 
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent