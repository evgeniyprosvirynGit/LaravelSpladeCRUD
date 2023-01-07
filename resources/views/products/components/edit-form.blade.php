<x-splade-form :default="$product" action="{{ route($action, $product) }}" class="mt-8">
    <x-splade-input name="field_name_value" label="Name" />
    <x-splade-input name="field_okdp_value" label="OKDP" class="mt-2"/>
    <x-splade-input name="field_alias_value" label="Alias" class="mt-2"/>
    <x-splade-input type="number" step=".01" name="field_price_value" label="Price" class="mt-2"/>
    <x-splade-checkbox name="visibility" true-value="1" false-value="0" value="{{ (int)$product->visibility }}" label="visibility" class="mt-2" />

    <x-splade-submit class="mt-8" />
</x-splade-form>