<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            max-width: 240px;
        }
    </style>
</head>
<body>
<div style="position:absolute; left:0pt; top: 2pt; width:250pt;">
    <img class="img-rounded" src="{{ $invoice->logo }}" height="{{ $invoice->logo_height }}">
</div>
<div style="position:absolute; left:70pt; top: 2pt; width:250pt; font-size: 10pt">
    <p style="font-weight: bold">Warung Barokah 313 <br>
           <span style="position: absolute; left: 40pt">X</span> <br>
        Bakso Barokah 313 <br>
    </p>
</div>
<h1 style="margin-top: 5rem">Invoice #{{ $invoice->number }}</h1>
<p>Date: {{ $invoice->date }}</p>
<p>Customer: {{ $invoice->customer_details->get('name') }}</p>
<table>
    <thead>
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice->items as $item)
        <tr>
            <td>{{ $item->get('name') }}</td>
            @if($invoice->shouldDisplayImageColumn())
                <td>@if(!is_null($item->get('imageUrl'))) <img src="{{ url($item->get('imageUrl')) }}" />@endif</td>
            @endif
            <td>{{ $item->get('price') }}</td>
            <td>{{ $invoice->formatCurrency()->symbol }} {{ rtrim(rtrim($item->get('totalPrice'), '0'), '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<p style="position: absolute; left: 55pt">Total: {{ $invoice->formatCurrency()->symbol }} {{ rtrim(rtrim($invoice->totalPriceFormatted(), '0'), '.') }}</p>
</body>
</html>
