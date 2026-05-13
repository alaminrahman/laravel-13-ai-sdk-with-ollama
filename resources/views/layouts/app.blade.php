<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Markdown Parser for AI text -->
    <script src="https://cdn.jsdelivr.net/npm/markdown-it@14.1.0/dist/markdown-it.min.js"></script>

    <script>
        // Optional: Configure Tailwind colors to match your brand
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#2563eb', // Example: Blue-600
                    }
                }
            }
        }
    </script>

    <title>Chat</title>
</head>
<body>

    @yield('content')

</body>
</html>
