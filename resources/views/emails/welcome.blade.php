@component('mail::message')
Welcome to ItSolutionStuff.com
      
Name: {{ $mailData['name'] }}<br/>
Email: {{ $mailData['email'] }}
      
Thanks,<br/>
{{ config('app.name') }}
@endcomponent