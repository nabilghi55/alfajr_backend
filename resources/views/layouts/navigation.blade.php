<nav class="space-y-2">

    <a href="/dashboard"
        class="flex items-center gap-3 p-3 rounded-lg transition
              {{ request()->is('dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
        <span class="material-icons">dashboard</span>
        <span>Dashboard</span>
    </a>

    <!-- MENU PAKET UMROH -->
    <a href="{{ route('paket.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg transition
              {{ request()->is('paket*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
        <span class="material-icons">holiday_village</span>
        <span>Paket Umroh</span>
    </a>
    <a href="{{ route('marketing.index') }}"
        class="flex items-center gap-3 p-3 rounded-lg transition
          {{ request()->is('marketing*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
        <span class="material-icons">phone_in_talk</span>
        <span>Nomor Marketing</span>
    </a>

    <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 text-gray-300 transition">
        <span class="material-icons">person</span>
        <span>Users</span>
    </a>

    <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 text-gray-300 transition">
        <span class="material-icons">settings</span>
        <span>Settings</span>
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-red-600 text-gray-300 hover:text-white transition text-left mt-10">
            <span class="material-icons">logout</span>
            <span>Logout</span>
        </button>
    </form>

</nav>
