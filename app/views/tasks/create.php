<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .input-error {
            border-color: #f87171; 
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Agregar Nueva Tarea</h1>

        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
            <form action="/store" method="POST" class="space-y-6">
               
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título de la tarea</label>
                    <input type="text" id="title" name="title" placeholder="Título de la tarea" value="<?php echo htmlspecialchars($_SESSION['form_data']['title'] ?? ''); ?>" 
                           class="mt-1 block w-full px-4 py-2 border <?php echo isset($_SESSION['errors']['title']) ? 'input-error' : 'border-gray-300'; ?> rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <?php if (isset($_SESSION['errors']['title'])): ?>
                        <p class="text-red-500 text-xs mt-1 error-message"><?php echo htmlspecialchars($_SESSION['errors']['title']); ?></p>
                    <?php endif; ?>
                </div>

                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="description" name="description" placeholder="Descripción" 
                              class="mt-1 block w-full px-4 py-2 border <?php echo isset($_SESSION['errors']['description']) ? 'input-error' : 'border-gray-300'; ?> rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?php echo htmlspecialchars($_SESSION['form_data']['description'] ?? ''); ?></textarea>
                    <?php if (isset($_SESSION['errors']['description'])): ?>
                        <p class="text-red-500 text-xs mt-1 error-message"><?php echo htmlspecialchars($_SESSION['errors']['description']); ?></p>
                    <?php endif; ?>
                </div>

                
                <div>
                    <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg shadow hover:bg-green-600 focus:ring-4 focus:ring-green-300">Agregar Tarea</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const clearError = (element) => {
                element.classList.remove('input-error');
                const errorMessage = element.nextElementSibling;
                if (errorMessage && errorMessage.classList.contains('error-message')) {
                    errorMessage.style.display = 'none';
                }
            };

            const handleInput = (event) => {
                clearError(event.target);
            };

            document.getElementById('title').addEventListener('input', handleInput);
            document.getElementById('description').addEventListener('input', handleInput);

            document.getElementById('title').addEventListener('focus', handleInput);
            document.getElementById('description').addEventListener('focus', handleInput);
        });
    </script>

    <?php
    
    unset($_SESSION['errors']);
    unset($_SESSION['form_data']);
    ?>

</body>
</html>
