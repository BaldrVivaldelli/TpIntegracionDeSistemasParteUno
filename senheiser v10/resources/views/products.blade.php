<!doctype html>
<html>
<head>
</head>
<body>
    <div>
        <ol>
           @foreach ($products as $prod)
                <li>{{ $prod->name }}</li>
            @endforeach
        </ol>
    </div>
</body>
</html>