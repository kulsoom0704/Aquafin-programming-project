@extends('layouts.app')

@section('title', 'Logboek - ' . $installatie->naam)

@section('content')

<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('technieker.meldingen') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-900 hover:text-white transition-all shadow-sm active:scale-90">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <div class="flex items-center gap-2 mb-0.5">
                <span class="text-[9px] font-black tracking-widest text-[#005b96] uppercase bg-blue-50 border border-blue-100 px-2 py-0.5 rounded">{{ $installatie->locatie ?? 'Locatie Onbekend' }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">{{ $installatie->naam }}</h1>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
    
    <div class="lg:col-span-5">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden sticky top-24">
            <div class="bg-slate-50/50 border-b border-slate-100 p-5">
                <h2 class="text-base font-black text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Interventie Registreren
                </h2>
            </div>
            
            <form action="{{ route('notitie.store', $installatie->id) }}" method="POST" enctype="multipart/form-data" class="p-5 flex flex-col gap-5">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Technisch Verslag</label>
                    <textarea name="opmerking" rows="4" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-700 focus:outline-none focus:border-[#005b96] focus:bg-white transition-all resize-none" placeholder="Wat heb je gerepareerd of gecontroleerd?"></textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Visueel Bewijs (Foto)</label>
                    
                    <label for="afbeelding" class="flex flex-col items-center justify-center w-full h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl hover:bg-blue-50/50 hover:border-blue-300 transition-colors cursor-pointer group p-4">
                        <div class="text-center">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-[#005b96] mb-2 mx-auto transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                            <p class="text-xs text-slate-500 font-bold group-hover:text-[#005b96] transition-colors">Camera openen of bestand kiezen</p>
                        </div>
                        <input id="afbeelding" name="afbeelding" type="file" accept="image/*" class="hidden" onchange="showFileName(this)" />
                    </label>
                    <p id="fileName" class="text-xs font-black text-[#005b96] mt-2 hidden text-center truncate"></p>
                </div>

                <button type="submit" class="w-full h-12 bg-[#005b96] hover:bg-[#004a7c] text-white font-black rounded-xl shadow-md active:scale-95 transition-all flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    Rapport Indienen & Sluiten
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-7">
        <h2 class="text-base font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Historisch Verloop
        </h2>

        <div class="relative border-l border-slate-200 ml-4 space-y-6 pb-10">
            @forelse($installatie->notities as $notitie)
                <div class="relative pl-8">
                    <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-white border-2 border-[#005b96] ring-4 ring-[#e0f2fe]"></div>
                    
                    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-[0_2px_10px_rgba(0,0,0,0.01)] hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start gap-2 mb-3 border-b border-slate-50 pb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 font-black text-xs">
                                    {{ strtoupper(substr($notitie->technieker->name ?? 'T', 0, 1)) }}
                                </div>
                                <span class="font-extrabold text-slate-800 text-xs">{{ $notitie->technieker->name ?? 'Onbekende Technieker' }}</span>
                            </div>
                            <span class="text-[9px] font-black text-slate-400 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100">{{ $notitie->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        
                        <p class="text-sm text-slate-600 font-medium leading-relaxed whitespace-pre-wrap">{{ $notitie->opmerking }}</p>
                        
                        @if($notitie->afbeelding)
                            <div class="mt-4 rounded-2xl overflow-hidden border border-slate-200 shadow-sm max-w-xs">
                                <img src="{{ asset('storage/' . $notitie->afbeelding) }}" alt="Bewijsmateriaal" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="relative pl-8">
                    <div class="absolute -left-[4px] top-1.5 w-2 h-2 rounded-full bg-slate-300"></div>
                    <div class="bg-white border border-slate-200 border-dashed rounded-2xl p-5 text-center">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Nog geen eerdere interventies.</p>
                    </div>
                </div>
            @endforelse

            <div class="relative pl-8">
                <div class="absolute -left-[4px] top-1.5 w-2 h-2 rounded-full bg-emerald-400 ring-4 ring-emerald-50"></div>
                <div class="text-[10px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-md inline-block uppercase tracking-wider">Systeem Opgestart</div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function showFileName(input) {
        const fileNameElement = document.getElementById('fileName');
        if (input.files && input.files.length > 0) {
            fileNameElement.textContent = "Geselecteerd: " + input.files[0].name;
            fileNameElement.classList.remove('hidden');
        } else {
            fileNameElement.classList.add('hidden');
        }
    }
</script>
@endsection
@endsection