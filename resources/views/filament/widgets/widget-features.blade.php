<x-filament-widgets::widget @class(['hidden' => !$feature])>
    <x-filament::section collapsible icon="heroicon-o-computer-desktop" icon-color="primary">
        <x-slot name="heading">
            MAIN FEATURES
        </x-slot>
        <x-filament::grid :default="$grid['default'] ?? 1" :sm="$grid['sm'] ?? null" :md="$grid['md'] ?? null" :lg="$grid['lg'] ?? null" :xl="$grid['xl'] ?? null"
            class="gap-6">
            @foreach ($feature as $resource)
                <x-filament::grid.column>
                    <x-filament::section>
                        <!-- component -->
                        <a href="{{ $resource->url }}">
                            <div class="relative flex w-96 flex-col rounded-xl text-gray-700 shadow-md">
                                <x-filament::icon-button icon="{{ $resource->icon }}" size="xl"
                                    wire:click="openNewUserModal"
                                    class="w-auto h-24 absolute left-0 top-8 text-primary-500 opacity-20 dark:opacity-20 transition group-hover:scale-110 group-hover:-rotate-12 group-hover:opacity-40 dark:group-hover:opacity-80"
                                    style="position: absolute; top: 0; right: 0; width: 75px; height: 75px;" />

                                <div class="relative z-10 p-2">
                                    <h5 class="mb-2 font-sans text-xl font-semibold tracking-normal dark:text-white">
                                        {{ $resource->name }}
                                    </h5>
                                    <p
                                        class="block font-sans text-sm font-light leading-relaxed text-inherit dark:text-white">
                                        {{ $resource->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </x-filament::section>
                </x-filament::grid.column>
            @endforeach
        </x-filament::grid>
    </x-filament::section>
</x-filament-widgets::widget>
