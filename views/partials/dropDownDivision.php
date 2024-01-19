<div>
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs p-2 text-center inline-flex items-center" type="button"> <span class="sm:hidden">Division</span> <span class="max-sm:hidden">Filter by Division</span><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div class="absolute">
        <div id="dropdown" class="z-10 hidden relative bg-white divide-gray-100 rounded-lg shadow w-32">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">

                <?php for ($x = 0; $x < count($division); $x++) : ?>
                    <li>
                        <a href="/<?= $_SESSION["user"]["level"] ?>?division-name=<?= $division[$x]["divisionName"] ?>" class="block px-4 py-2 hover:bg-gray-100"> <?= $division[$x]["divisionName"] ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>

</div>