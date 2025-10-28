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
    <h1>Listado de Disciplinas </h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Colaborador</th>
                <th>Cédula</th>
                <th>jefe</th>
                <th>Cedula Jefe</th>
                <th>Fase</th>
                <th>Pdf</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($LlamadoAtencion as $Llamado)
                <tr>
                    <td>{{ $Llamado->id }}</td>
                    <td>{{ $Llamado->nombre }}</td>
                    <td>{{ $Llamado->cedula }}</td>
                    <td>{{ $Llamado->jefe }}</td>
                    <td>{{ $Llamado->jefe_cedula }}</td>
                    <td>{{ $Llamado->fase }}</td>
                    <td> <a href="{{ $Llamado->ruta_pdf }}">s</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
