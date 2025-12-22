@component('mail::message')
# New Enquiry Received

You have received a new enquiry. Below are the details:

- **Name:** {{ $enquiry->name }}
- **Email:** {{ $enquiry->email }}
- **Mobile:** {{ $enquiry->mobile }}
- **Is Philanthropist:** {{ $enquiry->is_philanthropist ? 'Yes' : 'No' }}

@component('mail::button', ['url' => url('/')])
Visit Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
