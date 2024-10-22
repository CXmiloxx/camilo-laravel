<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Uusarios : Camilo </h1>
    <ul>
        @foreach ($usuarios as $user)
            <li>{{ $user->name }} </li>
        @endforeach
    </ul>
</body>
</html>
