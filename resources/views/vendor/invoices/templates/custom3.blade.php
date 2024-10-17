<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
            position: relative;
        }

        .header,
        .footer {
            text-align: center;
        }

        .address {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px;
        }

        .content {
            margin-top: 60px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .content th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="address">
            <p>JL. Raden Wijaya No. 14, Mojokerto</p>
            <p>Tanggal: 15/10/2024</p>
        </div>

        <div class="header" style="margin-top:50px">
            <h2>FAKTUR PENJUALAN</h2>
            <p>No. Faktur: 0045202/NSE/2024010130</p>
        </div>

        <div class="content">
            <table>
                <tr>
                    <th>No. Kode</th>
                    <th>Uraian</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td>0005</td>
                    <td>Radiator Coolant Jumbo (4x5)</td>
                    <td>2 Galon</td>
                    <td>60,000</td>
                    <td>120,000</td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>Keterangan</th>
                    <td>Admin Penjualan</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>120,000</td>
                </tr>
                <tr>
                    <th>Terbilang</th>
                    <td>Seratus Dua Puluh Ribu Rupiah</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Diterima oleh pelanggan: ____________</p>
            <p>Sales: ____________</p>
            <p>Halaman 1 dari 1</p>
        </div>
    </div>

</body>
</html>

