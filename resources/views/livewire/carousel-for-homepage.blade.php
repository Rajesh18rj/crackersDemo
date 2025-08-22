<div class="relative w-full max-w-8xl mx-auto overflow-hidden shadow-lg">
    <!-- Slides -->
    <div class="flex transition-transform duration-700"
         style="transform: translateX(-{{ $currentSlide * 100 }}%);">
        @foreach($slides as $pair)
            <div class="w-full flex-shrink-0 grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($pair as $image)
                    <img src="{{ $image }}" class="w-full h-[350px] object-cover rounded-lg">
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Prev Button -->
    <button wire:click="previous"
            class="absolute top-1/2 left-3 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full">‹</button>

    <!-- Next Button -->
    <button wire:click="next"
            class="absolute top-1/2 right-3 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full">›</button>

    <!-- Indicators -->
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2">
        @foreach($slides as $index => $pair)
            <button wire:click="$set('currentSlide', {{ $index }})"
                    class="w-3 h-3 rounded-full {{ $currentSlide == $index ? 'bg-white' : 'bg-gray-400' }}">
            </button>
        @endforeach
    </div>
</div>
