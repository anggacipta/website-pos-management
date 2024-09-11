<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
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
        .items, .total {
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
    </style>
</head>
<body>
<div class="container">
    <div class="title">
        Duta Chicken
    </div>
    <div class="details">
        Jl. Raya Ijen No. 18<br>
        Kota Mojokerto<br>
        085806081617
    </div>
    <div class="items">
        <table>
            <tr>
                <td>Alacarte B Geprek (Paha Atas/Dada)</td>
                <td>1x 11.000</td>
            </tr>
        </table>
    </div>
    <div class="total">
        <table>
            <tr>
                <td>Total</td>
                <td>Rp 11.000</td>
            </tr>
            <tr>
                <td>Tunai</td>
                <td>Rp 20.000</td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td>Rp 9.000</td>
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
