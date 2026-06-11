```php
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

    <aside class="w-64 bg-blue-700 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">
            Aquafin
        </h2>

        <nav class="space-y-4">

            <a href="/admin/dashboard" class="block hover:text-blue-200">
                Dashboard
            </a>

            <a href="/admin/users" class="block font-bold">
                Gebruikers
            </a>

            <a href="/admin/reports" class="block hover:text-blue-200">
                Rapporten
            </a>

        </nav>

    </aside>

    <main class="flex-1 p-8">

        <h1 class="text-4xl font-bold mb-6">
            Gebruikersbeheer
        </h1>

        <div class="bg-white rounded-xl shadow p-6 mb-8">

            <h2 class="text-2xl font-bold mb-4">
                Nieuwe gebruiker toevoegen
            </h2>

            <form action="/admin/users" method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input
                        type="text"
                        name="name"
                        placeholder="Naam"
                        required
                        class="border rounded-lg p-3"
                    >

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        class="border rounded-lg p-3"
                    >

                    <select
                        name="role"
                        class="border rounded-lg p-3"
                    >
                        <option value="Admin">Admin</option>
                        <option value="Technieker">Technieker</option>
                        <option value="Magazijnier">Magazijnier</option>
                    </select>

                </div>

                <button
                    type="submit"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg"
                >
                    Gebruiker toevoegen
                </button>

            </form>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="flex justify-between items-center mb-4">

                <h2 class="text-2xl font-bold">
                    Gebruikerslijst
                </h2>

                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg">
                    Totaal: {{ $users->count() }}
                </span>

            </div>

            <table class="w-full">

                <thead>

                <tr class="border-b">

                    <th class="text-left py-3">Naam</th>
                    <th class="text-left py-3">Email</th>
                    <th class="text-left py-3">Rol</th>
                    <th class="text-left py-3">Status</th>
                    <th class="text-left py-3">Acties</th>

                </tr>

                </thead>

                <tbody>

                @foreach($users as $user)

                <tr class="border-b">

                    <td class="py-3">
                        {{ $user->name }}
                    </td>

                    <td class="py-3">
                        {{ $user->email }}
                    </td>

                    <td class="py-3">
                        {{ $user->role }}
                    </td>

                    <td class="py-3">

                        @if($user->active)

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                Actief
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                Gedeactiveerd
                            </span>

                        @endif

                    </td>

                    <td class="py-3 flex gap-2">

                        <form
                            action="/admin/users/{{ $user->id }}/toggle"
                            method="POST"
                            onsubmit="return confirm('Bent u zeker dat u deze gebruiker wilt wijzigen?')"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded"
                            >
                                @if($user->active)
                                    Deactiveren
                                @else
                                    Activeren
                                @endif
                            </button>

                        </form>

                        <form
                            action="/admin/users/{{ $user->id }}"
                            method="POST"
                            onsubmit="return confirm('Bent u zeker dat u deze gebruiker wilt verwijderen?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded"
                            >
                                Verwijderen
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>
```
