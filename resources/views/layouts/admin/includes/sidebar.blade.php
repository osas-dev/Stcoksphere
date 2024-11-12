<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="{{route('admin')}}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center {{ request()->routeIs('admin.dashboard') ? 'active-nav-link opacity-100' : 'opacity-75' }} text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a
            class="flex items-center text-white hover:opacity-100 nav-item ml-2 {{ request()->routeIs('admin.stocks') ? 'active-nav-link opacity-100' : 'opacity-75' }}">
            <button type="button"
                class="flex items-center w-full pl-4 py-4 text-base font-normal text-white transition duration-75 group hover:opacity-100 dark:text-white"
                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <span class="ml-3 text-center whitespace-nowrap" sidebar-toggle-item>Stocks</span>
                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2 pl-6">
                <li>
                    <a href="{{ route('admin.stocks') }}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.stocks') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Tradeable
                        Stocks</a>
                </li>
                <li>
                    <a href="{{ route('admin.stocks.history') }}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.stocks.history') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Trade
                        History</a>
                </li>
            </ul>
        </a>
        <a href="{{route('admin.users')}}" class="flex items-center text-white {{ request()->routeIs('admin.users') ? 'active-nav-link opacity-100' : 'opacity-75' }} hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fa-solid fa-user-group mr-3"></i>
            Users
        </a>
        <a class="flex items-center text-white {{ request()->routeIs('admin.plans') ? 'active-nav-link opacity-100' : 'opacity-75' }} hover:opacity-100 nav-item ml-2">
            <button type="button"
                class="flex items-center w-full pl-4 py-4 text-base font-normal text-white transition duration-75 group hover:opacity-100 dark:text-white"
                aria-controls="investments" data-collapse-toggle="investments">
                <i class="fa-solid fa-sack-dollar"></i>
                <span class="ml-3 text-center whitespace-nowrap" sidebar-toggle-item>Investments</span>
                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul id="investments" class="hidden py-2 space-y-2 pl-6">
                <li>
                    <a href="{{route('admin.plans')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.plans') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Plans</a>
                </li>
                <li>
                    <a href="{{route('admin.plans.all')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.plans.all') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">All</a>
                </li>
                <li>
                    <a href="{{route('admin.plans.active')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.plans.active') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Active</a>
                </li>
                <li>
                    <a href="{{route('admin.plans.completed')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.plans.completed') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Completed</a>
                </li>
            </ul>
        </a>
        <a class="flex items-center text-white {{ request()->routeIs('admin.deposits') ? 'active-nav-link opacity-100' : 'opacity-75' }} hover:opacity-100 nav-item ml-2">
            <button type="button"
                class="flex items-center w-full pl-4 py-4 text-base font-normal text-white transition duration-75 group hover:opacity-100 dark:text-white"
                aria-controls="transactions" data-collapse-toggle="transactions">
                <i class="fa-solid fa-building-columns"></i>
                <span class="ml-3 text-center whitespace-nowrap" sidebar-toggle-item>Deposits</span>
                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul id="transactions" class="hidden py-2 space-y-2 pl-4">
                <li>
                    <a href="{{route('admin.deposits.methods')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.deposits.methods') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Deposit Methods</a>
                </li>
                <li>
                    <a href="{{route('admin.deposits')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.deposits') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">All</a>
                </li>
                <li>
                    <a href="{{route('admin.deposits.pending')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.deposits.pending') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Pending</a>
                </li>
                <li>
                    <a href="{{route('admin.deposits.completed')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.deposits.completed') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Completed</a>
                </li>
                <li>
                    <a href="{{route('admin.deposits.rejected')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.deposits.rejected') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Rejected</a>
                </li>
            </ul>
        </a>
        <a class="flex items-center text-white {{ request()->routeIs('admin.withdrawals') ? 'active-nav-link opacity-100' : 'opacity-75' }} hover:opacity-100 nav-item ml-2">
            <button type="button"
                class="flex items-center w-full pl-4 py-4 text-base font-normal text-white transition duration-75 group hover:opacity-100 dark:text-white"
                aria-controls="withdrawal" data-collapse-toggle="withdrawal">
                <i class="fa-solid fa-building-columns"></i>
                <span class="ml-3 text-center whitespace-nowrap" sidebar-toggle-item>Withdrawals</span>
                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul id="withdrawal" class="hidden py-2 space-y-2 pl-4">
                <li>
                    <a href="{{route('admin.withdrawals')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.withdrawals') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">All</a>
                </li>
                <li>
                    <a href="{{route('admin.withdrawals.pending')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.withdrawals.pending') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Pending</a>
                </li>
                <li>
                    <a href="{{route('admin.withdrawals.completed')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.withdrawals.completed') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Completed</a>
                </li>
                <li>
                    <a href="{{route('admin.withdrawals.rejected')}}"
                        class="flex items-center w-full p-2 text-base font-normal text-white transition duration-75 rounded-lg group hover:opacity-100 dark:text-white {{ request()->routeIs('admin.withdrawals.rejected') ? 'active-nav-link opacity-100' : 'opacity-75' }} pl-8">Rejected</a>
                </li>
            </ul>
        </a>
        <a href="{{route('admin.profile.edit')}}" class="flex items-center text-white {{ request()->routeIs('admin.settings') ? 'active-nav-link opacity-100' : 'opacity-75' }} hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fa-solid fa-gear mr-3"></i>
            Settings
        </a>
    </nav>

    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>

</aside>
