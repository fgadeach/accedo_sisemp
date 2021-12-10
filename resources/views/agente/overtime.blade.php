<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{\App\Models\Campaign::where('id', auth()->user()->agent->campaign_id)->first()->name}}
        </h2>
    </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-center text-3xl m-4 font-bold font-mono">Overtime</h1>
                <div class="grid grid-cols-7 gap-4 my-2">
                    @foreach ($weeks as $week)
                        <div>
                            <div class="p-auto m-3 py-4 bg-indigo-400 text-center text-xl font-bold rounded-lg tracking-wide text-white">
                                <h1> {{$week->name}}</h1>
                            </div>
                            <div class="grid gap-4 my-2 text-center  p-auto m-3 ">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-7 gap-4 my-2">
                @foreach($weeks as $week)
                    <div>
                        @foreach($scheduls as $schedule)
                            @php
                                $scheduleWeek = \App\Models\Schedule_Week::where('week_id',$week->id)->where('schedule_id',$schedule->id)->first();
                                $campaign_schedule = \App\Models\campaign_schedule::where('campaign_id',auth()->user()->agent->campaign_id)->where('schedule_week_id',$scheduleWeek->id)->first();
                                $extratime = \App\Models\Agent_Extratime::where('agent_id',auth()->user()->agent->id)->where('schedule_week_id',$scheduleWeek->id)->first();
                                $selected = false;
                                if($extratime){
                                    $selected = true;
                                }
                            @endphp
                                @if($campaign_schedule->manpower - $campaign_schedule->headcount >= 10)
                                    @if ($selected)
                                    <div class="grid gap-4 text-center m-3 p-auto hover:bg-green-400 text-white p-auto cursor-pointer text-xl rounded-lg {{ $selected ? 'bg-green-400' : 'bg-gray-400'}}">
                                        <h1><a href="/extraschedule/{{$week->id}}/{{$schedule->id}}">{{$schedule->hour}}</a></h1>
                                    </div>
                                    @endif
                                @endif
                                @if($campaign_schedule->manpower - $campaign_schedule->headcount < 10)
                                <div class="grid gap-4 text-center m-3 p-auto hover:bg-green-400 text-white p-auto cursor-pointer text-xl rounded-lg {{ $selected ? 'bg-green-400' : 'bg-gray-400'}}">
                                        <h1><a href="/extraschedule/{{$week->id}}/{{$schedule->id}}">{{$schedule->hour}}</a></h1>
                                </div>
                                @endif
                        </a>
                        @endforeach
                        </div>
                @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
            