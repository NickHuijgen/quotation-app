<!DOCTYPE html>
<head>
    <title>
        Quotation
    </title>
</head>

<body>
    <div>
        <div>

            <div>
                <h4><u>Recipient:</u></h4>

                <strong>Name:</strong> <div>
                {{ $quotation->customer_first_name }}
                {{ $quotation->customer_last_name }}
                </div> <br>

                <strong>E-mail adress:</strong>

                <div>{{ $quotation->customer_email }}</div> <br>

                <strong>Address:</strong>

                <div>
                {{ $quotation->customer_street }}
                {{ $quotation->customer_house_number }},
                {{ $quotation->customer_city }} <br>
                {{ $quotation->customer_postal_code }}
                </div>
            </div>

            <br><br>

            <div>
                <h4><u>From:</u></h4>

                <strong>Name:</strong> <div>
                    {{ $user->first_name }}
                    {{ $user->last_name }}
                </div> <br>

                <strong>E-mail adress:</strong>

                <div>{{ $user->email}}</div> <br>

                <strong>Address:</strong>

                <div>
                    {{ $user->street }}
                    {{ $user->house_number }},
                    {{ $user->city }} <br>
                    {{ $user->postal_code }}
                </div>
            </div>
        </div>

        <br><br>

        <h4><u>Lines:</u></h4>

        <div>
            @foreach( $quotation->quotationlines as $quotationline )
                <div>
                    {{ $quotationline->amount }} x {{ $quotationline->contents->description }}, €{{ $quotationline->contents->price }}
                    <br>
                    Costs €{{ $quotationline->contents->price*$quotationline->amount }}
                    <br><br>
                </div>
            @endforeach

            Total price €{{ $quotation->total_price }}
         </div>
    </div>
</body>
