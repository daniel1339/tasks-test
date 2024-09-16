<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Lista de Tareas</h1>

        <!-- Botón para crear nueva tarea -->
        <div class="flex justify-end mb-4">
            <a href="/create" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">Crear Nueva Tarea</a>
        </div>

        <!-- Tabla de tareas -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Título</th>
                        <th class="py-3 px-6 text-left">Descripción</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <?php foreach ($tasks as $task): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <span class="font-medium"><?= htmlspecialchars($task['title']) ?></span>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <?= htmlspecialchars($task['description']) ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <!-- Botón para editar -->
                            <a href="/edit?id=<?= $task['id'] ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 mr-2">Editar</a>
                            <!-- Botón para eliminar -->
                            <a href="/delete?id=<?= $task['id'] ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
