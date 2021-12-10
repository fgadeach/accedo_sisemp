<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @role('agent')
             {{\App\Models\Campaign::where('id', auth()->user()->agent->campaign_id)->first()->name}} 
            @endrole
            @role('admin')
            {{'Dashboard'}}
            @endrole
        </h2>
    </x-slot>

    <div class="py-12" id="app">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @role('agent')
            @include('agente/agentedash')
            @endrole
        </div>
    </div>
</x-app-layout>
