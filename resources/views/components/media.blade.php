<div class="flex">
    <div class="relative mr-0">
        <div class="relative overflow-hidden bg-gray-100
            {{ $attributes["class"] ?? 'w-16 h-16' }}
            {{ $attributes["loading"] ? 'cursor-wait' : 'cursor-pointer' }}
            {{ $attributes["not-allowed"] ? 'cursor-not-allowed' : 'cursor-pointer' }}
        ">
            {{-- actual image --}}
            @if($attributes["src"])
                <img class="w-full h-full object-cover" src="{{ $attributes["src"] }}">
            @endif

            {{-- colored layer image --}}
            <div class="absolute inset-0
                {{ $attributes["engage"] ? ($attributes["not-allowed"] ? 'bg-red-300 opacity-50' : 'bg-indigo-300 opacity-50') : '' }}
                {{ $attributes["approaching"] ? ($attributes["not-allowed"] ? 'bg-red-300 opacity-25' : 'bg-indigo-300 opacity-25') : '' }}
                {{ $attributes["server-error"] ? 'bg-red-400 opacity-50' : '' }}
            "></div>

            @if($attributes["loading"])
                <div class="absolute inset-0 bg-black opacity-25"></div>
                <div class="absolute inset-0 px-3 flex items-center justify-center">
                    <div class="rounded-full w-full shadow">
                        <div class="h-1 w-full bg-white rounded-full shadow-inner overflow-hidden">
                            <div class="h-full bg-indigo-500" style="width:66%">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- inset help --}}
            @if($attributes["inset"])
            <div class="absolute flex justify-center w-full bottom-0 px-2 pb-3">
                <div class="relative text-xs text-center">
                    <div style="-webkit-mix-blend-mode: multiply; mix-blend-mode: multiply; opacity: {{ ( $attributes["src"] || $attributes["error"] ) ? '.7' : '.075' }}" class="absolute rounded-full inset-0 shadow-inner {{ ($attributes["server-error"] || $attributes["error"]) ? 'bg-red-600' : 'bg-gray-700' }} "></div>
                    <div class="relative px-3 py-1  {{ ( $attributes["src"] || $attributes["error"] ) ? 'text-gray-100' : 'text-gray-700 opacity-75' }}">

                            {{ $attributes["message"] }}

                            @if($attributes["action"])
                                @if($attributes["message"])<span class="opacity-50">•</span> @endif<button class="underline hover:opacity-75">{{ $attributes["action"] }}</button>
                            @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- border --}}
            <div style="border-radius: inherit" class="absolute inset-0 opacity-25 border-2
                {{ $attributes["server-error"] ? 'border-red-600' : '' }}
                {{ $attributes["approaching"] ? ($attributes["not-allowed"] ? 'border-red-600' : 'border-indigo-600') : 'border-gray-500' }}
                {{ $attributes["src"] ? '' : 'border-dashed' }}
            "></div>

            {{-- icons --}}
            <div class="z-10 absolute inset-0 flex items-center justify-center">
                @if($attributes["empty"])
                    <span class="{{ $attributes["small"] ? 'w-6 h-6' : 'w-8 h-8' }} flex items-center justify-center rounded-full shadow bg-white text-indigo-500 text-lg font-mono leading-none">＋</span>
                @endif

                @if($attributes["approaching"])
                    @if($attributes["not-allowed"])
                        <span class="overflow-hidden relative {{ $attributes["small"] ? 'w-6 h-6' : 'w-8 h-8' }} rounded-full flex items-center justify-center shadow bg-white">
                            <span class="{{ $attributes["small"] ? 'w-4 h-4' : 'w-5 h-5' }} overflow-hidden flex items-center justify-center inset-0 rounded-full border-2 border-red-500">
                                <span style="width:2px; transform: skewX(-15deg)" class="h-full bg-red-500"></span>
                            </span>
                        </span>
                    @else
                        <span class="{{ $attributes["small"] ? 'w-6 h-6' : 'w-8 h-8 text-xl' }} flex items-center justify-center rounded-full {{ $attributes["engage"] ? 'shadow-inside text-white bg-indigo-500' : 'shadow-lg bg-white text-indigo-500' }}  font-mono leading-none">
                            {{ $attributes["src"] ? '⥂' : '＋'  }}
                        </span>
                    @endif
                @endif

                @if($attributes["server-error"])
                <span class="{{ $attributes["small"] ? 'w-6 h-6' : 'w-8 h-8 text-xl' }} flex items-center justify-center rounded-full shadow-md bg-red-500 text-red-100 font-mono leading-none">!</span>
                @endif

                @if($attributes["success"])
                <span class="{{ $attributes["small"] ? 'w-6 h-6' : 'w-8 h-8 text-xl' }} flex items-center justify-center rounded-full shadow-md bg-green-500 text-green-100 font-mono leading-none">✓</span>
                @endif
            </div>
        </div>

        @if($attributes["delete"])
            <div class="absolute top-0 right-0">
                <button class="flex w-6 h-6 -mt-3 -mr-3 items-baseline justify-center rounded-full bg-white border border-gray-200 text-gray-600 hover:text-red-600 shadow leading-none font-mono">&times;</button>
            </div>
        @endif
    </div>
</div>

@if(! $attributes["inset"] && ($attributes["message"] || $attributes["action"]))
<div class="py-1 text-xs text-center">
    <span class="{{ ($attributes["server-error"] || $attributes["error"]) ? 'text-red-600' : 'text-gray-600' }}">

        {{ $attributes["message"] }}

        @if($attributes["action"])
            @if($attributes["message"])<span class="opacity-50">•</span> @endif<button class="underline hover:opacity-75">{{ $attributes["action"] }}</button>
        @endif
    </span>
</div>
@endif
