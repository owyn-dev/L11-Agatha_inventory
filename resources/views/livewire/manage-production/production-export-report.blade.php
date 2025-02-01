<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Production Report</title>
    <style>
      body {
        font-size: 0.9rem;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100vw;
      }

      h2,
      p {
        text-align: center;
        margin: 10px 0;
      }

      .table-container {
        width: 100vw;
        overflow-x: auto;
        display: flex;
        justify-content: center;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
      }

      th,
      td {
        border: 1px solid #000;
        padding: 6px;
      }

      th {
        background-color: #343a40;
        color: white;
      }
    </style>
  </head>

  <body>
    <h2>Production Report</h2>
    <p>From: {{ $startDate }} - To: {{ $endDate }}</p>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Batch Code</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Variant</th>
            <th>Prod. Date</th>
            <th>Exp. Date</th>
            <th>Stock</th>
          </tr>
        </thead>
        <tbody>
          @forelse($reports as $report)
            @foreach ($report->detailProductions as $detail)
              <tr>
                <td>{{ $detail->batch_code }}</td>
                <td>{{ $detail->product->code }}</td>
                <td class="text-start">{{ $detail->product->name }}</td>
                <td>{{ $detail->product->variant->label() }}</td>
                <td>{{ \Carbon\Carbon::parse($report->production_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($report->production_date)->addDays($detail->product->expired_day)->format('Y-m-d') }}</td>
                <td>{{ $detail->quantity }}</td>
              </tr>
            @endforeach
          @empty
            <tr>
              <td colspan="7">No Data Available</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </body>

</html>
