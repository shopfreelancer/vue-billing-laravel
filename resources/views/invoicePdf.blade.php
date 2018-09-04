<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rechnung</title>
    <style>
        body { font-family: DejaVu Sans; }
        .user-address {text-align: right;}
        .invoice-number {font-weight:bold;}
        .invoice-date {text-align: right;}
        .text-top {margin:20px 0 20px 0;}
        .customer-address {margin-bottom:40px;}
        .text-bottom {margin:1rem 0;}
        .sum-total {border-top:1px solid darkgrey}
        .text-payment {margin-top:20px;}
        #footer {position:fixed;bottom:-20px; color: #9e9a91;left: 0px; right: 0px; height: 15px;}
    </style>
</head>
<body>
<div id="footer">
    {{$user->address->fullname}} / {{$user->address->street}} / {{$user->address->zipcode}} {{$user->address->city}} / {{$user->address->country}}
    / Umsatzsteuer-ID: {{$user->address->tax_id}}
</div>

<div class="user-address">
    {{$user->address->fullname}}<br/>
    {{$user->address->street}}<br/>
    {{$user->address->zipcode}} {{$user->address->city}}<br/>
    {{$user->address->country}}<br/><br/>
    {{$user->address->tel}}<br/>
    {{$user->address->email}}<br/>
</div>

<div class="customer-address">
    {{$invoice->customer->fullname}}<br/>
    {{$invoice->customer_address}}
</div>

<div class="invoice-date">Datum {{$invoice->date}}</div>

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
            <th>Preis (brutto)</th>
        </tr>
        </thead>
        <tbody>
        @for ($i = 0; $i < count($invoice->items); $i++)
            <tr>
                <td> {{ $i +1 }}</td>
                <td>
                    <b>{{ $invoice->items[$i]->title }}</b>
                </td>
                <td><?php echo round($invoice->items[$i]->tax_rate). "%"; ?></td>
                <td>@currency($invoice->items[$i]->price)</td>
                <td>@currency($invoice->items[$i]->sumTaxed)</td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $invoice->items[$i]->description }}<br/><br/></td>
                <td></td>
                <td></td>
            </tr>
        @endfor
        <tr>
            <td height="25"></td>
            <td></td>
            <td></td>
            <td>Summe (netto)</td>
            <td>@currency($invoice->sumNet)</td>
        </tr>
        <tr>
            <td height="25"></td>
            <td></td>
            <td></td>
            <td>Umsatzsteuer</td>
            <td>@currency($invoice->sumTaxAmount)</td>
        </tr>
        <tr>
            <td height="25"></td>
            <td></td>
            <td></td>
            <td class="sum-total"><b>Gesamtbetrag</b></td>
            <td class="sum-total"><b>@currency($invoice->sumTotal)</b></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="text-payment">
    <div class="payment-note">Bitte überweisen Sie den offenen Betrag auf folgendes Konto:</div>
    <table>
        <tr><td>Kontoinhaber: {{$user->address->fullname}}</td></tr>
        <tr><td>Verwendungszweck: {{$invoice->invoice_number}}</td></tr>
        <tr><td>IBAN: {{$user->address->iban}}</td></tr>
        <tr><td>SWIFT: {{$user->address->swift}}</td></tr>
        <tr><td>Kreditinstitut: {{$user->address->bankname}}</td></tr>
    </table>
    </div>

<div class="text-bottom">{{$invoice->text_bottom}}</div>

</body>
</html>
