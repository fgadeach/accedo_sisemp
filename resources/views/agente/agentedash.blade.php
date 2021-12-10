<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <h1 class="text-center text-3xl m-4 font-bold font-mono">Select Holidays</h1>
        <h1 class="text-center text-lg m-4 font-bold font-mono">Shift: ({{auth()->user()->agent->startTime}} - {{auth()->user()->agent->endTime}})</h1>
        <h1 class="text-center text-md m-4 font-bold font-mono">12/12/2021 - 18/12/2021</h1>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($weeks as $week)
                <a class="p-auto cursor-pointer hover:bg-indigo-400 m-5 py-4 text-center text-xl font-bold rounded-lg tracking-wide text-white {{ $week->agent_week ? 'bg-indigo-400' : 'bg-green-400'  }}"
                   href="/AgentWeek/{{ $week->id }}">
                    <div>
                        <h1> {{$week->name}}</h1>
                    </div>
                </a>
            @endforeach
            <div class="p-auto m-5 py-4 bg-gray-700 text-center text-xl font-bold rounded-lg tracking-wide text-white">
                <div>
                    <h1> Total Hours: {{ (7 - \App\Models\Agent_Week::where('agent_id', auth()->user()->agent->id)->count()) * 8 }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl m-3 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div class="p-auto m-5 py-4 bg-gray-700 text-center text-xl font-bold rounded-lg tracking-wide text-white">
    <a href="/AgentOvertime/{{auth()->user()->agent->id}}"><h1> Overtime: {{ (7  - \App\Models\Agent_Week::where('agent_id', auth()->user()->agent->id)->count()) * 8 + \App\Models\Agent_Extratime::where('agent_id', auth()->user()->agent->id)->count() -40}} (hours)</h1></a>
</div>
    </div>
</div>