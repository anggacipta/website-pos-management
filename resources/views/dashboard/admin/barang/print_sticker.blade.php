<!DOCTYPE html>
<html>
<head>
    <title>Barang Sticker</title>
    <style>
        .sticker {
            width: 100mm;
            height: 50mm;
            border: 1px solid #000;
            padding: 10mm;
            font-size: 14pt;
        }
    </style>
</head>
<body>
<div class="sticker">
    <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
    <p><strong>Kode Barang:</strong> {{ $barang->kode_barang }}</p>
    <p><strong>Deskripsi:</strong> {{ $barang->keterangan }}</p>
</div>
</body>
</html>
