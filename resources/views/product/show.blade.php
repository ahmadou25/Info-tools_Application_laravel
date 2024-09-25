<script>
    @php
    $images = glob(public_path('@/img/*.*'));

    if (!empty($images)) {
        $randomImage = $images[array_rand($images)];
        $randomImage = str_replace(public_path(), '', $randomImage);
    } else {
        $randomImage = null;
    }
    @endphp
</script>
<x-app-layout>
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8 p-4">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Détail du produit') }}
                </h2>
            </x-slot>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6"> <!-- Ajouté padding ici -->
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $product->name }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Détails du produit.
                    </p>
                </div>
                <div class="mt-5 border-t border-gray-200 pt-5"> <!-- Ajouté padding-top ici -->
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <!-- ID du produit -->
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">
                                ID du produit
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $product->product_id }}
                            </dd>
                        </div>

                        <!-- Description -->
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">
                                Description
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $product->description }}
                            </dd>
                        </div>

                        <!-- Prix -->
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">
                                Prix
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </dd>
                        </div>

                        <!-- Stock -->
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">
                                Stock
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $product->stock }}
                            </dd>
                        </div>


                    </dl>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 mt-5"> <!-- Ajouté margin-top ici -->
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition ease-in-out duration-150">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>