<div class="relative mb-3 w-72" data-te-input-wrapper-init>
    <input wire:model.debounce.500ms.live="search" type="search" class="peer block min-h-[auto] w-full rounded border-solid border-1 border-yellow-400 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" id="exampleSearch2" placeholder="Type query" />
    <label for="exampleSearch2" class="pointer-events-none peer-focus:hidden absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Search</label>

    <!-- the condition if search bar not showing up the not results msg before when focus -->
    @if(strlen($search) >= 2)
    <div class="absolute bg-slate-800 rounded w-72 overflow-y-auto max-h-max" style="max-height: 32rem;">
        @if(count($searchResults['results']) > 0)
            <ul>
                @foreach($searchResults['results'] as $result)
                <li class="border-b border-gray-700 text-sm">
                    <a href="{{ route('movie-details', $result['id']) }}" class="hover:bg-gray-700 px-2 py-2 text-yellow-400 flex item-center">
                    @if($result['poster_path'])
                        <img src="https://image.tmdb.org/t/p/w92{{ $result['poster_path'] }}" class="w-18 rounded" alt="poster">
                    @else
                        <img src="assets/images/no-image.jpg" class="rounded" width="92" alt="poster">
                    @endif
                    <span class="mt-12 ml-5 font-bold">{{$result['title']}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        @else
            <div class="px-3 py-3">No Results for "{{$search}}"</div>
        @endif
    </div>
    @endif
</div>

<!-- TODO -->
<!-- 1. exit from area search results when mouse click on other area except search result -->