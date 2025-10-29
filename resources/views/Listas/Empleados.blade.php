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
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f7f9;
            color: #333;
            margin: 0;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #840028;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #840028;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #a50030;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #840028;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            font-weight: bold;
            color: #777;
        }
    </style>
</head>
<body>

    <h1>👥 Listado de Empleados</h1>

    <form action="{{ route('empleados.list') }}" method="GET">
        <label for="query">Buscar:</label>
        <input type="text" id="query" name="query" value="{{ request('query') }}" placeholder="Cédula o nombre">


        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="">Todos</option>
            <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Retirado" {{ request('estado') == 'Retirado' ? 'selected' : '' }}>Retirado</option>
        </select>

        <label for="fecha_inicio">Fecha Ingreso Desde:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}">

        <label for="fecha_fin">hasta:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}">

        <button type="submit">Filtrar</button>
    </form>
<form action="{{ route('exportar.empleados') }}" method="GET">
    <input type="hidden" name="query" value="{{ request('query') }}">
    <input type="hidden" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
    <input type="hidden" name="fecha_fin" value="{{ request('fecha_fin') }}">
    <input type="hidden" name="estado" value="{{ request('estado') }}">
    <button type="submit" class="btn btn-success">Exportar Excel</button>
</form>

    @if ($empleados->isEmpty())
        <div class="no-results">No se encontraron empleados con esos criterios.</div>
    @else
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
                    <th>Fecha Ingreso</th>
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
                        <td>{{ Carbon::parse($empleado->fecha_nacimiento)->age }}</td>
                        <td>{{ Carbon::parse($empleado->fecha_ingreso)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
