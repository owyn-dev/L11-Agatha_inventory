<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Barcodes</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 20px;
        font-size: 12px;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
      }

      .table td,
      .table th {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
        /* Border pada setiap sel */
        word-wrap: break-word;
        /* Agar teks panjang tidak meluber */
        max-width: 120px;
        /* Mengatur lebar maksimum kolom */
      }

      .barcode-box {
        text-align: center;
        width: 100%;
      }

      .barcode-title {
        font-weight: bold;
        font-size: 12px;
        margin-bottom: 5px;
        word-wrap: break-word;
        /* Agar teks panjang tidak meluber */
      }

      .barcode-expiry {
        font-size: 10px;
        color: #555;
        margin-top: 5px;
      }

      .barcode {
        margin-top: 5px;
      }

      .table td {
        vertical-align: top;
      }

      /* Pastikan page break tidak menghilangkan border bawah */
      .page-break {
        page-break-after: always;
      }

      /* Memberikan border pada bagian bawah tabel, khususnya untuk baris terakhir */
      .table tbody tr:last-child td {
        border-bottom: 1px solid #ddd;
      }

      /* Menambahkan border kanan pada kolom terakhir */
      .table td:last-child {
        border-right: 1px solid #ddd;
      }

      .table-container {
        margin-bottom: 20px;
        /* Memberikan margin bawah antar tabel */
      }

      /* Menghindari border hilang setelah page break */
      .table tr {
        page-break-inside: avoid;
      }

      /* Mengatur lebar kolom agar tabel lebih rapi */
      .table td {
        max-width: 120px;
      }
    </style>
  </head>

  <body>
    <div class="table-container">
      <table class="table table-bordered">
        <tbody>
          @php
            $barcodeChunks = array_chunk($barcodes, 18); // Membagi barcode menjadi grup per halaman (3 kolom x 6 baris)
          @endphp

          @foreach ($barcodeChunks as $barcodePage)
            <tr>
              @foreach ($barcodePage as $barcodeIndex => $barcode)
                <!-- Jika barcodeIndex setiap 3, buat baris baru -->
                @if ($barcodeIndex % 3 === 0 && $barcodeIndex > 0)
            </tr>
            <tr> <!-- Mulai baris baru setelah 3 barcode -->
          @endif
          <td class="barcode-box">
            <div class="barcode-title">{{ $barcode['product_name'] }} ({{ $barcode['code'] }})</div>
            <div class="barcode">
              {!! $barcode['barcode'] !!}
            </div>
            <div class="barcode-expiry">Expiry Date: {{ \Carbon\Carbon::parse($barcode['expiry_date'])->format('d-m-Y') }}</div>
          </td>
          @endforeach
          </tr>

          <!-- Page break jika bukan halaman terakhir -->
          @if (!$loop->last)
            <div class="page-break"></div>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </body>

</html>
