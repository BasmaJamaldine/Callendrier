<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Créer un nouveau post</h2>
                            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="text" class="block text-gray-700 text-sm font-semibold mb-2">Contenu du post</label>
                                    <textarea name="text" id="text" rows="4"
                                        class="shadow-sm border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Que voulez-vous partager ?" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="block text-gray-700 text-sm font-semibold mb-2">Image</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-500 transition-colors duration-300">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Télécharger une image</span>
                                                    <input id="image" name="image_post" type="file" class="sr-only" accept="image/*">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end">
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                                        Publier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Fil d'actualité</h2>
                    @foreach ($posts->reverse() as $post)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6  hover:shadow-xl w-[50vw]">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <img class="h-12 w-12 rounded-full object-cover mr-4 border-2 border-blue-500" 
                                        src="{{ asset('storage/' . $post->user->profile_image) }}" 
                                        alt="{{ $post->user->name }}">
                                    <div class="flex-grow">
                                        <h3 class="font-bold text-lg text-gray-800">{{ $post->user->name }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        @can('post_user', $post)
                                        <form action="" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-700  text-3xl">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                            <form action="{{ route('post.destroy' , $post ) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700  text-lg" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')">
                                                <svg class="h-5 w-5 text-2xl" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        @endcan
                                        
                                    </div>
                                </div>
                                <p class="text-gray-800 mb-4 leading-relaxed">{{ $post->text }}</p>
                                @if ($post->image_post)  
                                    <img class="w-full rounded-lg shadow-md" src="{{ asset('storage/' . $post->image_post) }}" alt="Image du post">
                                @endif
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>