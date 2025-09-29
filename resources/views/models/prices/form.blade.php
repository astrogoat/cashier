<x-fab::layouts.page
    :title="$model->name"
    :breadcrumbs="[
        ['title' => 'Home', 'url' => route('lego.dashboard')],
        ['title' => 'Prices', 'url' => route('lego.cashier.prices.index')],
        ['title' => $model->name],
    ]"
    x-data=""
    x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
    x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
>
{{--    <x-slot name="actions">--}}
{{--        @include('lego::models._includes.forms.page-actions')--}}
{{--    </x-slot>--}}

    <x-lego::feedback.errors class="mb-4" />

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel title="Details">
            <div class="cashier-strata-grid cashier-strata-grid-cols-2">
                <x-fab::forms.input
                    wire:model.debounce.500ms="model.checkout_success_route"
                    label="Success Destination"
                    help="Where the customer should be redirected to after a successful transaction."
                />

                <x-fab::forms.input
                    wire:model.debounce.500ms="model.checkout_cancelled_route"
                    label="Cancelled Destination"
                    help="Where the customer should be redirected to if they cancel the transaction."
                />
            </div>
        </x-fab::layouts.panel>

{{--        <x-fab::layouts.panel title="SEO">--}}
{{--            <x-fab::forms.textarea--}}
{{--                wire:model.debounce.500ms="model.meta.description"--}}
{{--                label="Description"--}}
{{--                help="Meta description for search engines like Google and Bing."--}}
{{--            />--}}

{{--            <x-fab::forms.checkbox--}}
{{--                id="should_index"--}}
{{--                label="Should be indexed"--}}
{{--                wire:model="model.indexable"--}}
{{--                help="If checked this will allow search engines (i.e. Google or Bing) to index the page so it can be found when searching on said search engine."--}}
{{--            />--}}

{{--            <x-fab::forms.select--}}
{{--                label="Canonical URL"--}}
{{--                help="A canonical URL is the URL of the page that the search engine (i.e. Google or Bing) thinks is most representative from a set of duplicate pages on your site."--}}
{{--                wire:model="model.canonical_page_id"--}}
{{--            >--}}
{{--                <option value="">Self</option>--}}
{{--                @foreach($this->canonicalPages() as $canonicalPageId => $canonicalPageTitle)--}}
{{--                    <option value="{{ $canonicalPageId }}">{{ $canonicalPageTitle }}</option>--}}
{{--                @endforeach--}}
{{--            </x-fab::forms.select>--}}
{{--        </x-fab::layouts.panel>--}}

{{--        @include('lego::metafields.define', ['metafieldable' => $model])--}}

        <x-slot name="aside">
{{--            <x-fab::layouts.panel title="Structure">--}}
{{--                <x-fab::forms.select--}}
{{--                    wire:model="model.layout"--}}
{{--                    label="Layout"--}}
{{--                    help="The base layout for the model."--}}
{{--                >--}}
{{--                    <option disabled>-- Select layout</option>--}}
{{--                    @foreach(siteLayouts() as $key => $layout)--}}
{{--                        <option value="{{ $key }}">{{ $layout }}</option>--}}
{{--                    @endforeach--}}
{{--                </x-fab::forms.select>--}}

{{--                <x-fab::forms.select--}}
{{--                    wire:model="model.footer_id"--}}
{{--                    label="Footer"--}}
{{--                >--}}
{{--                    <option value="">No footer</option>--}}
{{--                    @foreach($this->footers() as $id => $footer)--}}
{{--                        <option value="{{ $id }}">{{ $footer }}</option>--}}
{{--                    @endforeach--}}
{{--                </x-fab::forms.select>--}}
{{--            </x-fab::layouts.panel>--}}

{{--            <x-fab::layouts.panel class="mt-4">--}}
{{--                <x-fab::forms.checkbox--}}
{{--                    label="Is a landing page"--}}
{{--                    help="Landing pages can be visited without the '/pages/' prefix."--}}
{{--                    wire:model="model.is_landing_page"--}}
{{--                    id="is_landing_page"--}}
{{--                />--}}

{{--                <x-fab::forms.input--}}
{{--                    label="Category"--}}
{{--                    wire:model.debounce.500ms="model.category"--}}
{{--                />--}}
{{--            </x-fab::layouts.panel>--}}

{{--            @include('lego::includes.model-activities', ['model' => $this->model])--}}
        </x-slot>
    </x-fab::layouts.main-with-aside>
</x-fab::layouts.page>
