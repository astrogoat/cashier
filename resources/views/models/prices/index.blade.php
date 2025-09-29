<x-fab::layouts.page
    title="Prices"
    :breadcrumbs="[
        ['title' => 'Home', 'url' => route('lego.dashboard')],
        ['title' => 'Prices'],
    ]"
    x-data="{ showColumnFilters: false }"
>
    @include('lego::models._includes.indexes.filters')

    <x-fab::lists.table>
        <x-slot name="headers">
            @include('lego::models._includes.indexes.headers')
            <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
        </x-slot>

        @include('lego::models._includes.indexes.header-filters')
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />

        @foreach($models as $price)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('stripe_id'))
                    <x-fab::lists.table.column primary full>
                        <a href="{{ route('lego.cashier.prices.form', $price) }}">{{ $price->name }} <span class="text-gray-500 font-normal">({{ $price->product->name }})</span></a>
                    </x-fab::lists.table.column>
                @endif

{{--                @if($this->shouldShowColumn('email'))--}}
{{--                    <x-fab::lists.table.column>--}}
{{--                        <a href="{{ route('lego.users.edit', $price) }}">{{ $price->email }}</a>--}}
{{--                    </x-fab::lists.table.column>--}}
{{--                @endif--}}

{{--                @if($this->shouldShowColumn('roles'))--}}
{{--                    <x-fab::lists.table.column>--}}
{{--                        {{ $this->listRoles($price) }}--}}
{{--                    </x-fab::lists.table.column>--}}
{{--                @endisset--}}

                @if($this->shouldShowColumn('updated_at'))
                    <x-fab::lists.table.column align="right">
                        {{ $price->updated_at->toFormattedDateString() }}
                    </x-fab::lists.table.column>
                @endisset

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route('lego.users.edit', $price) }}">Edit</a>
                </x-fab::lists.table.column>
            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')
</x-fab::layouts.page>
