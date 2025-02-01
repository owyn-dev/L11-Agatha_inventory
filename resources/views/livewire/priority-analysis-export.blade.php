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
        margin-top: 10px;
      }

      th,
      td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>

  <body>
    <h2>{{ $title }}</h2>
    <p>{{ $text_subtitle }}</p>
    <table>
      <thead>
        <tr>
          <th>Code Product</th>
          <th>Name</th>
          <th>Variant</th>
          <th>Percentage of Amount</th>
          <th>Percentage of Sales</th>
          <th>Total Percentage</th>
          <th>Priority Group</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($results as $result)
          <tr>
            <td>{{ $result['code'] }}</td>
            <td>{{ $result['product'] }}</td>
            <td>{{ $result['variant'] }}</td>
            <td>{{ $result['percentage_quantity'] }}%</td>
            <td>{{ $result['percentage_sales'] }}%</td>
            <td>{{ $result['total_percentage'] }}%</td>
            <td>{{ $result['classification'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>

</html>
