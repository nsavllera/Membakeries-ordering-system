
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
    <h1>Orders Report</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>Address</th>
            <th>Created At</th>
        </tr>
        @if($Orders ->isEmpty())
            <p>No items found for the selected date range.</p>
        @else
            @php($i = 0)
            @foreach ($Orders as $order):
            <tr>
                <td><{{$i++}}></td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->category_id}}</td>
                <td>{{$order->delivery_id}}</td>
                <td>{{$order->created_at}}</td>
            </tr>
            @endforeach 
        @endif
    </table>
</body>
</html>