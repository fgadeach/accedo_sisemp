<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $campaign->name}}
            </h2>
        </x-slot>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <h1 class="text-center text-3xl m-4 font-bold font-mono">Manpower</h1>
                        <h1 class="text-center text-md m-4 font-bold font-mono">12/12/2021 - 18/12/2021</h1>
                        <div class="grid grid-cols-6">
                                @foreach($campaigns as $camp)
                                        <a class="p-auto m-1 my-5 py-4 bg-gray-800 text-center text-xl font-bold rounded-lg tracking-wide text-white" href="/CampaignSchedule/{{$camp->id}}">{{$camp->name}}</a>
                                @endforeach
                                        <a class="p-auto m-1 my-5 py-4 text-center text-xl font-bold rounded-lg tracking-wide text-gray-800" href="/CreateCampaign "> Create</a>
                                       {{--<a class="p-auto cursor-pointer m-1 py-4 text-center text-xl font-bold rounded-lg tracking-wide text-gray-700" href="/UpdateHeadcount/{{$campaign->id}}"> Update</a>--}}
                        </div>
                                <div class="grid grid-cols-8 gap-4 my-2">
                                        <div>
                                                @if($schedules->count()>0)
                                                <div class="p-auto m-1 my-5 py-4 bg-indigo-400 text-center text-xl font-bold rounded-lg tracking-wide text-white">

                                                        <h1>Time</h1>
                                                
                                                </div>
                                                @endif
                                                @foreach($schedules as $schedule)
                                                        <h1 class="grid gap-4 my-3 text-center bg-gray-400 text-white p-auto m-3 p-auto text-lg rounded-lg ">{{$schedule->hour}}</h1>
                                                @endforeach
                                        </div>
                                        @foreach($weeks as $week)
                                        <div>
                                                <div class="p-auto m-1 my-5 py-4 bg-indigo-400 text-center text-xl font-bold rounded-lg tracking-wide text-white">
                                                        <h1>{{$week->name}}</h1>
                                                </div>
                                                @foreach($week->schedule_week as $sw)
                                                @if($sw->campaign_schedule)
                                                                @php
                                                                        $color = 'bg-green-400';
                                                                        if($sw->campaign_schedule->manpower - $sw->campaign_schedule->headcount< 10){
                                                                                $color = 'bg-yellow-400';
                                                                        }
                                                                        if($sw->campaign_schedule->manpower - $sw->campaign_schedule->headcount < 0){
                                                                                $color = 'bg-red-400';
                                                                        }
                                                                @endphp 

                                                                <h1 class="grid gap-4 my-3 text-center p-auto m-3 p-auto text-lg rounded-lg {{$color}}">{{$sw->campaign_schedule->manpower - $sw->campaign_schedule->headcount}}</h1>
                                                                @endif
                                                @endforeach
                                                
                                        </div>
                                        @endforeach
                                        
                                </div>
                        </div> 
                </div>
            </div>
    </x-app-layout>
            
           