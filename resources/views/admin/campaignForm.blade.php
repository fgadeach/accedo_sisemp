<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 my-8">
        <div class="bg-white overflow-hidden  content-center shadow-xl sm:rounded-lg">
            <form class="my-5 content-center form m-auto my-2 max-w-lg" action="{{ route('createCampaign.store') }}" method="POST">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 form-group">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Canpaign Name
                        </label>
                        <input name="campaignName" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white form-control" placeholder="Nintendo">
                        <p class="text-red-500 text-xs italic">Please fill out this field.</p>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 form-group">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Start Time
                        </label>
                        <input name="startTime" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control" placeholder="01:00:00">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 form-group">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        End Time
                        </label>
                        <input name="endTime" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control"  placeholder="24:00:00">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 form-group">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                        Manpower
                        </label>
                        <input name="manpower" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control" placeholder="20">
                    </div>
                </div>
                <div class="my-5 form-group">
                    <button type="submit" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> Save</button>
                    <a href="/CampaignSchedule/1?" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>