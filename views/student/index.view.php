<?php require base_path("views/partials/head.php") ?>
<main class="w-full h-screen flex items-center justify-center">
    <div class="lg:w-[60%] w-full border p-4 shadow-lg lg:rounded-xl">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"><?= htmlspecialchars($profile["name"]) ?></h2>
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 ">Logout</button>
                    </form>
                </div>


                <div class="flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="flex items-center text-sm text-gray-700">
                        <p class="mr-2 font-semibold">Course and Year:</p>
                        <?= htmlspecialchars($profile["course"]) ?> -
                        <?= htmlspecialchars($profile["year"]) ?>
                    </div>
                    <div class="flex items-center text-sm text-gray-700">
                        <p class="mr-2 font-semibold">Division: </p>
                        <?= htmlspecialchars($profile["divisionName"]) ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="mt-4 lg:pr-8 lg:pl-8">
            <h3 class="font-bold text-4xl mb-4">Clearance Status</h3>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Office name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th></th>
                            <th></th>
                            <!-- <th scope="col" class="px-6 py-3">
                                    Category
                                </th> -->
                            <!-- <th scope="col" class="px-6 py-3">
                    Price
                 </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($status as $key => $val) : ?>
                            <tr class="bg-white border-b ">
                                <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap ">
                                    <?= $key ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php if ($val == 0) : ?>
                                        <span class="text-red-600">
                                            Pending
                                        </span>
                                    <?php else : ?>
                                        <span class="text-green-600">
                                            Approved
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <!-- <td class="px-6 py-4">
                                        Laptop
                                    </td> -->
                                <td class="px-6 py-4">
                                    <?php if ($val == 0) : ?>
                                        <div class="ml-4 w-6">
                                            <img src="/assets/image/pending-check.svg" alt="">
                                        </div>
                                    <?php else : ?>
                                        <div class="ml-4 w-6">
                                            <img src="/assets/image/approved-check.svg" alt="">
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php require base_path("views/partials/footer.php") ?>