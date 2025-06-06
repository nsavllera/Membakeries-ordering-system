<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membakeries Inventory Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Membakeries Inventory Report</h1>

     <p>
        From: {{ request('from_date') ?? 'N/A' }} &nbsp; | &nbsp; To: {{ request('to_date') ?? 'N/A' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Items id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price (RM)</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventory as $index => $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>
                    <td>{{ $item->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="no-data">No items found for the selected date range.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer>
        &copy; {{ date('Y') }} Membakeries Cakes and Desserts. All rights reserved.
    </footer>
    <button onclick="window.location.href='{{ route('report.salesreport.index') }}'"class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
    Back to Main Menu</button>
</body>
</html>
