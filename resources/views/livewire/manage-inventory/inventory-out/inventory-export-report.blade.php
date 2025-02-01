<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
      body {
        font-family: Arial, sans-serif;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th,
      td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>

  <body>
    <h2>{{ $title }}</h2>
    <p>Period: {{ $startDate }} to {{ $endDate }}</p>

    <table>
      <thead>
        <tr>
          <th>Transaction Date</th>
          <th>Batch Code</th>
          <th>Product Name</th>
          <th>Variant</th>
          <th>Unit Price</th>
          <th>Shelf Name</th>
          <th>Stock Out</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($inventoryOut as $item)
          <tr>
            <td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('Y-m-d') }}</td>
            <td>{{ $item->batch_code }}</td>
            <td>{{ $item->inventoryIn->product->name }}</td>
            <td>{{ $item->inventoryIn->product->variant->label() }}</td>
            <td>Rp. {{ number_format($item->inventoryIn->unit_price, 0, ',', '.') }}</td>
            <td>{{ $item->shelf_name }}</td>
            <td>{{ $item->stock_out }}</td>
          </tr>
        @empty
          <tr>
            <td style="text-align:center;" colspan="7">No Inventory [OUT] data available.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </body>

</html>
