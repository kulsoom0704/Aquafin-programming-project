<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen flex">

    <aside class="w-72 bg-[#005b96] text-white flex flex-col shadow-2xl">
        <div class="p-8">
            <h2 class="text-2xl font-black">AQUAFIN</h2>
            <p class="text-blue-200 text-xs uppercase">Admin Portaal</p>
        </div>

        <nav class="flex-grow px-4 space-y-2">
            <a href="/admin/dashboard" class="block px-4 py-3 rounded-xl hover:bg-white/10">Dashboard</a>
            <a href="/admin/users" class="block px-4 py-3 rounded-xl hover:bg-white/10">Gebruikers</a>
            <a href="/admin/reports" class="block px-4 py-3 rounded-xl hover:bg-white/10">Rapporten</a>
            <a href="/admin/storingen" class="block px-4 py-3 rounded-xl hover:bg-white/10">Storingen</a>
            <a href="/admin/helpdesk" class="block px-4 py-3 rounded-xl bg-white/10 font-bold">Helpdesk</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <h1 class="text-4xl font-black mb-8">Helpdesk</h1>

        <div class="bg-white rounded-3xl shadow p-6">
            <h2 class="text-xl font-bold mb-4">Openstaande vragen</h2>

            <div class="border rounded-xl p-4 mb-4">
                <h3 class="font-bold">Jan Peeters</h3>
                <p>Pomp werkt niet correct.</p>
                <span class="text-red-500 font-semibold">Open</span>
            </div>

            <div class="border rounded-xl p-4">
                <h3 class="font-bold">Tom Janssens</h3>
                <p>Vraag over installatie.</p>
                <span class="text-green-500 font-semibold">Beantwoord</span>
            </div>
        </div>
    </main>

</body>
</html>