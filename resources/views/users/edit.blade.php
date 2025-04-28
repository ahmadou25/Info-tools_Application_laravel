@extends('users.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Carte principale -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- En-tête avec dégradé -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 sm:px-8 sm:py-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Modifier le Commercial N° : {{ $user->id }}</h2>
                        <p class="mt-1 text-blue-100">Mettez à jour les informations de ce commercial</p>
                    </div>
                    <a href="{{ route('users.index') }}" 
                       class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 bg-opacity-20 hover:bg-opacity-30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour
                    </a>
                </div>
            </div>

            <!-- Contenu du formulaire -->
            <div class="px-6 py-8 sm:px-8 sm:py-10">
                <!-- Messages d'erreur -->
                @if($errors->any())
                    <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Il y a {{ $errors->count() }} erreur(s) dans votre formulaire</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Formulaire -->
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Prénom -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="first_name" id="first_name" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                           value="{{ old('first_name', $user->first_name) }}" required>
                                </div>
                            </div>

                            <!-- Nom de famille -->
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="last_name" id="last_name" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                           value="{{ old('last_name', $user->last_name) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input type="email" name="email" id="email" 
                                           class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                           value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <!-- Rôle -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rôle <span class="text-red-500">*</span></label>
                                <select name="role" id="role" 
                                        class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg transition duration-150 ease-in-out" required>
                                    <option value="Salesperson" {{ old('role', $user->role) == 'Salesperson' ? 'selected' : '' }}>Commercial</option>
                                    @if(auth()->user()->role === 'Admin')
                                    <option value="Manager" {{ old('role', $user->role) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Manager (si l'utilisateur est un Admin) -->
                        @if(auth()->user()->role === 'Admin')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="ad_id" class="block text-sm font-medium text-gray-700 mb-1">Manager</label>
                                    <select name="ad_id" id="ad_id" 
                                            class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg transition duration-150 ease-in-out">
                                        <option value="">Aucun</option>
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}" {{ old('ad_id', $user->ad_id) == $manager->id ? 'selected' : '' }}>
                                                {{ $manager->first_name }} {{ $manager->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <!-- Informations supplémentaires -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Adresse -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="address" id="address" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                           value="{{ old('address', $user->address) }}">
                                </div>
                            </div>

                            <!-- Numéro de téléphone -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="phone_number" id="phone_number" 
                                           class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                           value="{{ old('phone_number', $user->phone_number) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Date de début -->
                        <div class="w-full md:w-1/2">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="date" name="start_date" id="start_date" 
                                       class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out" 
                                       value="{{ old('start_date', $user->start_date ? $user->start_date->format('Y-m-d') : '') }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Mot de passe (optionnel) -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe (laisser vide si inchangé)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="password" name="password" id="password" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                </div>
                            </div>

                            <!-- Confirmation du mot de passe -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons de soumission -->
                    <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                        <a href="{{ route('users.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7.707 10.293a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 9.414V16a1 1 0 11-2 0V9.414l-1.293 1.293a1 1 0 01-1.414-1.414z" />
                                <path d="M4 3a1 1 0 011-1h10a1 1 0 011 1v1a1 1 0 01-1 1H5a1 1 0 01-1-1V3z" />
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection