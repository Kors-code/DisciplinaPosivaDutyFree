<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Importar Excel</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        input[type=file] {
            margin: 15px 0;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Importar Usuarios desde Excel</h2>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx,.xls,.csv" required>
            <br>
            <button type="submit">Subir e importar</button>
        </form>
    </div>
</body>
</html>
