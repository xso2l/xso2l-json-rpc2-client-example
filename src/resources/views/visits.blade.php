<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

</head>
<body>
    <div>
        <div>
            {{ $paginator->links('vendor.pagination.demo') }}
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">URL</th>
                    <th scope="col">Total Visits</th>
                    <th scope="col">Last Visited</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paginator as $item)
                    <tr>
                        <td>{{ $item['url'] }}</td>
                        <td>{{ $item['total'] }}</td>
                        <td>{{ $item['last_visited'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $paginator->links('vendor.pagination.demo') }}
        </div>
    </div>
</body>
</html>
