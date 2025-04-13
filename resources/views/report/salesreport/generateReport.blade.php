
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Sales Report</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Order Id</th>
            <th>Number of Items</th>
            <th>Subtotal</th>
        </tr>
        @if($sales->isEmpty())
            <p>No items found for the selected date range.</p>
        @else
            @php($i = 0)
            @foreach ($sales as $order):
            <tr>
                <td><{{$i++}}></td>
                <td>{{$order->id}}</td>
                <td>{{$order->item->quantity}}</td>
                <td>{{$order->total}}</td>
            </tr>
            @endforeach 
        @endif
    </table>
</body>
</html>