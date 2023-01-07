<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <Link href="{{ route('products.create') }}" class="bg-green-500 text-white font-semibold py-2 px-4 border rounded">
                        <i class="btn fa fa-plus"></i> Create
                    </Link>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-table :for="$products" striped>
                        @cell('price', $product)
                            <span class="text-yellow-400">{{ $product->price }}</span>
                        @endcell
                        @cell('priceVip', $product)
                            <span class="text-red-400">{{ $product->priceVip }}</span>
                        @endcell
                        @cell('visibility', $product)
                            <span>{{ ($product->visibility) ? 'yes' : 'no' }}</span>
                        @endcell
                        @cell('created_at', $product)
                            <span>{{ $product->created_at->format('d.m.Y H:i:s') }}</span>
                        @endcell
                        @cell('action', $product)
                            <div class="flex">
                                <Link href="{{ route('products.show', $product) }}" class="flex justify-center items-center inline bg-transparent hover:bg-green-500 hover:text-neutral-100 font-semibold px-2 border border-gray-300 hover:border-transparent rounded">
                                    <i class="btn fa fa-eye"></i>
                                </Link>
                                <Link href="{{ route('products.edit', $product) }}" class="ml-2 flex justify-center items-center inline bg-transparent hover:bg-blue-500 hover:text-neutral-100 font-semibold px-2 border border-gray-300 hover:border-transparent rounded">
                                    <i class="btn fa fa-pencil"></i>
                                </Link>
                                <x-splade-form :default="$product" action="{{ route('products.destroy', $product) }}" confirm="Do you really want to delete ?">
                                    <x-splade-submit label="" :spinner="false" class="fa fa-trash inline px-2 bg-red-500 hover:bg-red-700 ml-2" />
                                </x-splade-form>
                            </div>
                        @endcell
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
