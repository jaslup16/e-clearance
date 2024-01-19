<div class="p-2 h-fit mb-4 rounded bg-gray-50 ">
    <form action="/superadmin/store" method="POST" class="lg:w-3/5 w-full">
        <input type="hidden" name="user" value="dean">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-4">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Registration for Dean</h2>
                <p class="text-sm leading-6 text-gray-600"><span class="font-medium">Note: </span>Use a valid email from the dean for their registration. This will be used to notify them after registration.</p>

                <div class="flex justify-between gap-x-6 mt-4">
                    <div class="w-1/2">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Fullname</label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="division" class="block text-sm font-medium leading-6 text-gray-900">Division</label>
                            <div class="mt-1">
                                <select id="division" name="division" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option disabled selected>choose a division</option>
                                    <?php foreach ($assigned as $assign) : ?>
                                        <option value="<?= $assign['divisionId'] ?>"><?= $assign['divisionName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end max-md:justify-center gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900"><a href="/superadmin">Cancel</a></button>
            <button type="submit" class="rounded-md bg-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
        </div>
    </form>

    <div class="overflow-x-auto shadow-md sm:rounded-lg border mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Fullname
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Division
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($infos as $info) : ?>
                    <tr class="odd:bg-white even:bg-gray-50  border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <?= $info["name"] ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $info["email"] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $info["divisionName"] ?>
                        </td>
                        <td class="px-6 py-4">

                            <?php if ($info["login"] == 1) : ?>
                                <span class="text-green-600">Active</span>
                            <?php else : ?>
                                <span class="text-red-400">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="deleteUser(<?= $info['userId'] ?> , '<?= $info['name'] ?>')" type="button" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded text-sm inline-flex items-center px-2 py-1 text-center">
                                Remove
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div id="popup-remove-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed z-50 justify-center items-center w-full inset-0 min-h-full max-h-full border ">
    <div class=" p-4 min-[1440px]:w-1/4 lg:w-1/2 w-3/4">
        <div class=" bg-white rounded-lg shadow-lg border">
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 ">Are you sure you want to remove <span id="user-name" class="text-gray-900 font-semibold"></span> ?</h3>
                <form action="/superadmin/destroy" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="userId" id="user-id" value="">
                    <input type="hidden" name="user" value="dean">
                    <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Yes, I' m sure </button>
                    <button onclick="cancelRemove()" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>


<script src="assets/js/dashboard/modal.js"></script>