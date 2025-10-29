<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas Positivas</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f7f9;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        h1 {
            color: #840028;
            text-align: center;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        form label {
            font-weight: 600;
        }

        form input {
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        form button {
            background-color: #840028;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        form button:hover {
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

        a {
            color: #840028;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
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

    <h1>📋 Disciplinas Positivas</h1>

    <form action="{{ route('Disciplinas.list') }}" method="GET">
        <label for="fecha_inicio">Fecha inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}">

        <label for="fecha_fin">Fecha fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}">

        <label for="query">Búsqueda:</label>
        <input type="text" id="query" name="query" value="{{ request('query') }}" placeholder="Cédula, nombre o ID">

       


        <button type="submit">Filtrar</button>
    </form>

        <form action="{{ route('disciplinas.export') }}" method="GET">
    <input type="hidden" name="query" value="{{ request('query') }}">
    <input type="hidden" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
    <input type="hidden" name="fecha_fin" value="{{ request('fecha_fin') }}">
    
    <button type="submit" class="btn btn-success">
        Exportar Excel
    </button>
</form>


    @if ($LlamadoAtencion->isEmpty())
        <div class="no-results">No se encontraron resultados.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Colaborador</th>
                    <th>Cédula</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Jefe</th>
                    <th>Cédula Jefe</th>
                    <th>Fase</th>
                    <th>Grupo</th>
                    <th>Orientación</th>
                    <th>Detalle</th>
                    <th>Archivo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($LlamadoAtencion as $Llamado)
                    <tr>
                        <td>{{ $Llamado->id }}</td>
                        <td>{{ $Llamado->nombre }}</td>
                        <td>{{ $Llamado->cedula }}</td>
                        <td>{{ $Llamado->codigo }}</td>
                        <td>{{ $Llamado->descripcion }}</td>
                        <td>{{ $Llamado->jefe }}</td>
                        <td>{{ $Llamado->jefe_cedula }}</td>
                        <td>{{ $Llamado->fase }}</td>
                        <td>{{ $Llamado->grupo }}</td>
                        <td>{{ $Llamado->orientacion }}</td>
                        <td>{{ $Llamado->detalle }}</td>
                        <td>
                            @if ($Llamado->ruta_pdf)
                                <a href="{{ route('descargar.pdf', ['path' => $Llamado->ruta_pdf]) }}">📄 Descargar</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $Llamado->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
