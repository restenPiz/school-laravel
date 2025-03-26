<div class="px-4 sm:px-6 py-3 flex items-center justify-between shadow h-16 fixed top-0 left-0 right-0 z-50" style="background-color:#1a1879">
    <div class="flex items-center text-white">
        <svg class="h-6 w-6 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 640 512">
            <path d="M320 0c-17.7 0-32 14.3-32 32v192h64V32c0-17.7-14.3-32-32-32zm-79.5 192.5c-6.7-7.2-17.5-7.7-24.7-1L0 272v160c0 35.3 28.7 64 64 64h256V260.8L240.5 192.5zM320 512h256c35.3 0 64-28.7 64-64V272L424.2 191.5c-7.2-6.7-18-6.2-24.7 1L320 260.8V512zM608 64H32c-17.7 0-32 14.3-32 32v32c0 17.7 14.3 32 32 32h576c17.7 0 32-14.3 32-32V96c0-17.7-14.3-32-32-32z"/>
        </svg>
        <span class="font-semibold text-sm sm:text-xl tracking-tight">EducaAqui</span>
    </div>

    <div class="relative flex items-center space-x-4">
        <!-- Dropdown de Idioma -->
        <div class="relative" style="margin-right:2rem">
            <button id="language-btn" class="flex items-center text-white focus:outline-none">
                <span id="selected-language">
                    🇵🇹 {{--Português--}}
                </span>
                <svg class="w-4 h-4 ml-1 text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div id="language-menu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50">
                <ul class="py-1 text-gray-800">
                    <li>
                        <button onclick="changeLanguage('🇵🇹 Português')" class="flex items-center px-4 py-2 hover:bg-gray-200 w-full text-left">
                            🇵🇹 {{--Português--}}
                        </button>
                    </li>
                    <li>
                        <button onclick="changeLanguage('🇬🇧 English')" class="flex items-center px-4 py-2 hover:bg-gray-200 w-full text-left">
                            🇬🇧 {{--English--}}
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        @auth
            <div class="relative">
                <div class="flex items-center cursor-pointer" id="opennavdropdown">
                    @if(auth()->user()->profile_picture)
                        <img class="w-8 h-8 rounded-full mr-2" src="{{ asset('images/profile/' . auth()->user()->profile_picture) }}" alt="Imagem de Perfil">
                    @else
                        <img src="{{ asset('images/dif.jpg') }}" class="w-8 h-8 rounded-full mr-2">
                    @endif
                    <p class="text-sm text-white font-semibold leading-none">{{ auth()->user()->name }}</p>
                    <svg class="w-4 h-4 stroke-current text-gray-200 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                
                <div style="background-color:#1a1879" class="bg-blue-700 absolute top-0 right-0 mt-12 -mr-6 shadow rounded-bl rounded-br">
                    <div class="hidden h-24 w-48" id="navdropdown">
                        <div class="px-8 py-4 border-t border-blue-800">
                            <a href="{{ route('profile') }}" class="flex items-center pb-3 text-sm text-gray-200 font-semibold">
                                <svg class="h-4 w-4 mr-2 fill-current text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm96-96c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zm128-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2-16-16-16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2-16-16-16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                <span>Profile</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="pb-2">
                                @csrf
                                <button class="flex items-center text-sm text-gray-200 font-semibold focus:outline-none" type="submit">
                                    <svg class="h-4 w-4 mr-2 fill-current text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"/></svg>
                                    <span>{{ __('Logout') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</div>

<script>
    function changeLanguage(lang) {
        document.getElementById("selected-language").innerText = lang;
        document.getElementById("language-menu").classList.add("hidden");
    }

    document.getElementById("language-btn").addEventListener("click", function() {
        document.getElementById("language-menu").classList.toggle("hidden");
    });
</script>
