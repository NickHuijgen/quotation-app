@component('mail::message')
Congratulations! You have successfully created a quotation in our app

{{ $quotation->customer_first_name }} {{ $quotation->customer_last_name }}, will also be notified.

@component('mail::button', ['url' => ''])
    View quotation
@endcomponent

Thanks,<br>
OutSmart
@endcomponent
