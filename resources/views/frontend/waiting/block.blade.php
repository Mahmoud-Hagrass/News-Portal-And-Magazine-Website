<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> wait</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
    <div class="max-w-md bg-white p-8 rounded-lg shadow-lg text-center" style="min-width: 80ch">
        <div class="mb-6">
            <svg class="animate-spin h-12 w-12 text-blue-500 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A8.003 8.003 0 0112 4.018V0C6.477 0 2 4.477 2 10h4zm2 6.764V20c5.523 0 10-4.477 10-10h-4a6 6 0 00-6 6z">
                </path>
            </svg>
            <div class="message"><a style="color: red" href="{{ route('frontend.index')}}"
                    class="btn btn-primary">Refresh </a></div>
            <br>
            <h2 class="text-2xl font-semibold mb-2">ًWait </h2>
            <p class="text-gray-700">
                Opps!! you are blocked !
            </p>
        </div>
        <hr class="my-4 border-gray-300" />
        <p class="text-sm text-gray-600">
            this wating page
        </p>
    </div>
</body>
</html>
