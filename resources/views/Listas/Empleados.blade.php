@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Listado de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            color: #333;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #840028;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        h1 {
            color: #840028;
        }
    </style>
</head>
<body>
    <h1>Listado de Empleados</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Colaborador</th>
                <th>Cédula</th>
                <th>Estado</th>
                <th>RH</th>
                <th>Género</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->colaborador }}</td>
                    <td>{{ $empleado->cedula }}</td>
                    <td>{{ $empleado->estado }}</td>
                    <td>{{ $empleado->rh }}</td>
                    <td>{{ $empleado->genero }}</td>
                    <td>{{ \Carbon\Carbon::parse($empleado->fecha_nacimiento)->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
