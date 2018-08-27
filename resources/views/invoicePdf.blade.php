<html>
<head>
    <title>Rechnung</title>
    <style>
        .invoice-number {font-weight:bold;}
        .invoice-date {text-align: right;}
        .invoice-number:after {
            content:"\a";
            white-space: pre;
        }
    </style>
</head>
<body>

{{$invoice->customer->fullname}}<br/>
{{$invoice->customer_address}}

<div class="invoice-date">
    Datum {{$invoice->date}}
</div>

<div class="invoice-number">Rechnungsnummer {{$invoice->invoice_number}}</div>
<div class="text-top">{{$invoice->text_top}}</div>
<div class="container">
    <table>
        <thead>
        <tr>
            <th></th>
            <th>Leistung</th>
            <th>Steuer</th>
            <th>Preis (netto)</th>
        </tr>
        </thead>
        <tbody>
        @for ($i = 0; $i < count($invoice->items); $i++)
            <tr>
                <td> {{ $i +1 }}</td>
                <td>
                    <p><b>{{ $invoice->items[$i]->title }}</b><br/><br/>
                        {{ $invoice->items[$i]->description }}
                    </p>
                </td>
                <td>{{ $invoice->items[$i]->tax_rate }}</td>
                <td>{{ $invoice->items[$i]->price }}</td>
            </tr>
        @endfor
        </tbody>
    </table>
</div>
<div class="text-bottom">{{$invoice->text_bottom}}</div>
</body>
</html>
