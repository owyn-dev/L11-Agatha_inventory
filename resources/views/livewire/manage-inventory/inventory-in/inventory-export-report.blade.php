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
          <th>Shelf Name</th>
          <th>Stock Start</th>
          <th>Current Stock</th>
          <th>Expiration Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($inventoryIn as $item)
          <tr>
            <td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('Y-m-d') }}</td>
            <td>{{ $item->batch_code }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->product->variant->label() }}</td>
            <td>{{ $item->shelf_name }}</td>
            <td>{{ $item->stock_start }}</td>
            <td>{{ $item->current_stock }}</td>
            <td>{{ \Carbon\Carbon::parse($item->expiration_date)->format('Y-m-d') }}</td>
          </tr>
        @empty
          <tr>
            <td style="text-align:center;" colspan="8">No Inventory [IN] data available.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </body>

</html>
