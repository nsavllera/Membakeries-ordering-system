
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
    <h1>Inventory Report</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        @if($inventory->isEmpty())
            <p>No items found for the selected date range.</p>
        @else
            @php($i = 0)
            @foreach ($inventory as $item):
            <tr>
                <td><{{$i++}}></td>
                <td>{{$item->name}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->category_id}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
            </tr>
            @endforeach 
        @endif
    </table>
</body>
</html>