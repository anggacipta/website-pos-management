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
    <img src="{{ $invoice->getLogo() }}" alt="logo" height="60"></div>
<div style="position:absolute; left:70pt; top: 2pt; width:250pt; font-size: 10pt">
    <p style="font-weight: bold">Warung Barokah 313 <br>
           <span style="position: absolute; left: 40pt">X</span> <br>
        Bakso Barokah 313 <br>
    </p>
</div>
<h1 style="margin-top: 5rem">Invoice</h1>
<p>Date: {{ $invoice->getDate() }}</p>
<p>Customer:</p>
<table>
    <thead>
    <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoice->items as $item)
        <tr>
            <td class="">
                {{ $item->title }}

                @if($item->description)
                    <p class="">{{ $item->description }}</p>
                @endif
            </td>
            <td class="">{{ $item->quantity }}</td>
            <td class="">
                {{ $invoice->formatCurrency($item->price_per_unit) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<p style="position: absolute; left: 55pt">Total: {{ rtrim(rtrim($invoice->formatCurrency($invoice->total_amount), '0'), ',')  }}</p>
</body>
</html>
