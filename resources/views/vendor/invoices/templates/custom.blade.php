<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            /*max-width: 300px;*/
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            /*padding: 20px;*/
            border: 1px solid #ddd;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .details, .items, .total, .footer {
            margin-top: 10px;
        }
        .items {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
        }
        .items table, .total table {
            width: 100%;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            max-width: 100px;
        }
        hr {
            border: none;
            border-top: 1px dashed #000;
            width: 100%;
            /*border-bottom: 1px dashed #000;*/
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{ $invoice->logo }}" alt="Logo">
    </div>
    <div class="title">
        Warung Barokah 313
    </div>
    <div class="details">
        @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
            {{ array_values($invoice->getCustomData())[0] }}
        @else
            {{ $invoice->getCustomData('alamat') }}
        @endif
        <br>
        Kota @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                {{ array_values($invoice->getCustomData())[4] }}
            @else
                {{ $invoice->getCustomData('kota') }}
            @endif
            <br>
            @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                {{ array_values($invoice->getCustomData())[3] }}
            @else
                {{ $invoice->getCustomData('no_telp') }}
            @endif
    </div>
    <div class="details">
        <strong>Kasir:</strong> {{ $invoice->buyer->name }}<br>
        <strong>Email:</strong> {{ $invoice->buyer->custom_fields['email'] }}
    </div>
    <div class="items">
        <table>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->quantity }}x {{ number_format($item->price_per_unit, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->sub_total_price, '0', ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="total">
        <table>
            <tr>
                <td>Diskon</td>
                <td>
                    @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                        {{ number_format(array_values($invoice->getCustomData())[5], 0, ',', '.') }}
                    @else
                        {{ $invoice->getCustomData('diskon') }}
                    @endif
                    %
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td>Rp
                    @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                        {{ number_format(array_values($invoice->getCustomData())[7], 0, ',', '.') }}
                    @else
                        {{ $invoice->getCustomData('diskon') }}
                    @endif
                </td>
            </tr>
            <hr>
            <tr>
                <td class="">Pajak'</td>
                <td>
                    @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                        {{ number_format(array_values($invoice->getCustomData())[6], 0, ',', '.') }}
                    @else
                        {{ $invoice->getCustomData('pajak') }}
                    @endif
                    %
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td>Rp
                    @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                        {{ number_format(array_values($invoice->getCustomData())[8], 0, ',', '.') }}
                    @else
                        {{ $invoice->getCustomData('diskon') }}
                    @endif
                </td>
            </tr>
            <hr>
            <tr class="hr"></tr>
            <tr>
                <td>Total</td>
                <td>Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunai</td>
                <td>Rp
                    @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                        {{ number_format(array_values($invoice->getCustomData())[1], 0, ',', '.') }}
                    @else
                        {{ $invoice->getCustomData('uang_diterima') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td>Rp
                    @if (is_array($invoice->getCustomData()) && !empty($invoice->getCustomData()))
                        {{ number_format(array_values($invoice->getCustomData())[2], 0, ',', '.') }}
                    @else
                        {{ $invoice->getCustomData('kembalian') }}
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="footer">
        Terima kasih<br>
        Semoga puas dengan pelayanan kami
    </div>
</div>
</body>
</html>
