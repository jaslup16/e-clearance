<div>
    <button id="statusDropdownDefaultButton" data-dropdown-toggle="statusDropdown" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs p-2 text-center inline-flex items-center " type="button"><span class="sm:hidden">Status</span> <span class="max-sm:hidden">Filter By Status</span><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div class="absolute">
        <div id="statusDropdown" class="z-10 hidden relative bg-white divide-gray-100 rounded-lg shadow w-28 ">
            <ul class="py-2 text-sm text-gray-700 " aria-labelledby="statusDropdownDefaultButton">
                <li>
                    <a href="/<?= $_SESSION["user"]["level"] ?>?status=approved" class="block px-4 py-2 hover:bg-gray-100 ">Approved</a>
                </li>
                <li>
                    <a href="/<?= $_SESSION["user"]["level"] ?>?status=pending" class="block px-4 py-2 hover:bg-gray-100 ">Pending</a>
                </li>
            </ul>
        </div>
    </div>

</div>