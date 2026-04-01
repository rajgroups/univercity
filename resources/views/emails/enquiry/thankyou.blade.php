@component('mail::message')
# Thank You for Your Enquiry

Dear {{ $enquiry->name }},

Thank you for reaching out to us. We have received your enquiry with the following details:

- **Email:** {{ $enquiry->email }}
- **Mobile:** {{ $enquiry->mobile }}
- **Philanthropist Interest:** {{ $enquiry->is_philanthropist ? 'Yes' : 'No' }}

We will get back to you shortly.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
