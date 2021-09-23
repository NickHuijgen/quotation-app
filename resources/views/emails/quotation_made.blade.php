@component('mail::message')
Hello, {{ $quotation->customer_first_name }}

A quotation has been addressed to you.

You will find the quotation attached to this email as a pdf file.

@component('mail::button', ['url' => ''])
    View quotation
@endcomponent

Thanks,<br>
Quotation app
@endcomponent
