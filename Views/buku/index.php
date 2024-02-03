<?php
$max = date("Y");
?>

<div class="w-full">
    <div class="max-w-xl md:max-w-3xl mx-auto">
      <h2 class="mt-8 text-2xl text-center font-medium">
        Data Master Buku
      </h2>
      <?= $auth->role === "admin" ? '
      <form method="post" class="max-w-xl mt-6 mx-auto flex flex-col" action="/buku/save">
        <div class="grid gap-4 grid-cols-3 w-full">
          <div class="col-span-2">
            <label
              for="judul"
              class="block text-xs font-medium text-gray-700"
            >
              Judul Buku
            </label>

            <input
              type="text"
              id="judul"
              name="JudulBuku"
              placeholder="Masukan judul Buku"
              required
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div>
            <label
              for="pengarang"
              class="block text-xs font-medium text-gray-700"
            >
              Pengarang
            </label>

            <input
              type="text"
              id="pengarang"
              name="PengarangBuku"
              required
              placeholder="Masukan pengarang"
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div>
            <label
              for="penerbit"
              class="block text-xs font-medium text-gray-700"
            >
              Penerbit
            </label>

            <input
              type="text"
              id="penerbit"
              name="PenerbitBuku"
              placeholder="Gramedia.."
              required
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div>
            <label
              for="Tahun"
              class="block text-xs font-medium text-gray-700"
            >
              Tahun Terbit
            </label>'."
            <input
              type=\"number\"
              id=\"Tahun\"
              name=\"TahunBuku\"
              placeholder=\"YYYY\"
              min=\"1950\"
              max=\"$max\"
              required
              class=\"mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm\"
            />".'
          </div>
          <div class="self-end">
            <button
              class="inline-block rounded border border-indigo-600 bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
              type="submit"
            >
              Tambah Buku
            </button>
          </div>
        </div>
      </form>' : ''; ?>
      <div class="mt-8">
            <div
              class="w-full max-w-3xl rounded-md bg-white shadow-md border border-gray-200"
            >
              <header class="px-5 py-4 border-b border-gray-100">
                <div class="flex justify-between flex-col md:flex-row">
                  <div class="flex">
                    <div class="flex self-center">
                      <select
                        id="quantz"
                        class="text-xs pr-4 py-1 bg-right max-h-7"
                        id="showQuants"
                      >
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </div>
                    <div class="flex self-center mx-4">
                      <a
                        class="relative font-medium text-sm text-gray-600 before:absolute before:-bottom-1 before:h-0.5 before:w-full before:origin-left before:scale-x-0 before:bg-gray-800 before:transition hover:before:scale-100"
                        href="#"
                      >
                        Export
                      </a>
                    </div>
                    <div class="flex self-center">
                      <a
                        class="relative font-medium text-sm text-gray-600 before:absolute before:-bottom-1 before:h-0.5 before:w-full before:origin-right before:scale-x-0 before:bg-gray-800 before:transition hover:before:scale-100"
                        href="#"
                      >
                        Import
                      </a>
                    </div>
                  </div>
                  <div class="mt-2 md:mt-0">
                    <form method="POST" action="/search" role="search">
                      <input
                        name="cari"
                        type="text"
                        value="<?= !empty($cari) ? $cari : null ?>"
                        placeholder="Search.."
                        class="rounded-md border-gray-200 text-sm"
                      />
                      <button type="submit" class="sr-only">submit</button>
                    </form>
                  </div>
                </div>
              </header>
              <div class="p-3">
                <div class="max-h-[45vh] overflow-x-auto overflow-y-auto">
                  <table id="table" class="table-auto w-full">
                    <thead
                      class="text-xs font-semibold uppercase text-gray-400 bg-gray-50 sticky top-0"
                    >
                      <tr>
                        <th class="p-2 whitespace-nowrap">
                          <div class="font-semibold text-left">No</div>
                        </th>
                        <th
                          aria-label="col_1"
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Judul Buku</div>
                        </th>
                        <th
                          aria-label="col_2"
                          aria-sort="descending"
                          class="p-2.5 whitespace-nowrap relative sorting sortDesc cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Pengarang</div>
                        </th>
                        <th
                          aria-label="col_3"
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Penerbit</div>
                        </th>
                        <th
                          aria-label="col_4"
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Tahun</div>
                        </th>
                        <th
                          aria-label="col_4"
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                        <?= $auth->role === "admin" ? '<div class="font-semibold text-left">Action</div>' : '';  ?>
                        </th>
                      </tr>
                    </thead>
                    <tbody
                      id="tableBody"
                      class="text-sm divide-y divide-gray-100"
                    >
                    <?php
                      foreach($buku as $index => $row) {
                       $number = $index+1;
                       echo "<tr class=\"hover:bg-violet-100\">
                        <td class=\"p-2 whitespace-nowrap\">$number</td>
                        <td class=\"p-2 max-w-[280px] truncate whitespace-nowrap\">
                          $row[JudulBuku]
                        </td>
                        <td class=\"p-2 whitespace-nowrap\">$row[PengarangBuku]</td>
                        <td class=\"p-2 text-left\">$row[PenerbitBuku]</td>
                        <td class=\"p-2 text-left\">$row[TahunBuku]</td>
                      ";
                      if($auth->role === "admin") {echo "
                        <td class=\"p-2 whitespace-nowrap flex\">
                        <a class=\"inline-block rounded bg-yellow-500 px-2 py-1 text-xs font-medium text-white hover:bg-yellow-600 mr-1\"
                          href=\"/buku/edit/$row[BukuID]\"
                          >Edit</a
                        >
                        <a
                          onclick=AreYouSure()
                          class=\"inline-block rounded bg-red-600 px-2 py-1 text-xs font-medium text-white hover:bg-red-700\"
                          href=\"/buku/delete/$row[BukuID]\"
                        >
                          <svg
                            width=\"18px\"
                            height=\"18px\"
                            viewBox=\"0 0 24 24\"
                            fill=\"none\"
                            xmlns=\"http://www.w3.org/2000/svg\"
                          >
                            <g id=\"SVGRepo_bgCarrier\" stroke-width=\"0\"></g>
                            <g
                              id=\"SVGRepo_tracerCarrier\"
                              stroke-linecap=\"round\"
                              stroke-linejoin=\"round\"
                            ></g>
                            <g id=\"SVGRepo_iconCarrier\">
                              <path
                                d=\"M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16\"
                                stroke=\"#ffffff\"
                                stroke-width=\"2\"
                                stroke-linecap=\"round\"
                                stroke-linejoin=\"round\"
                              ></path>
                            </g>
                          </svg>
                        </a>
                      </td></tr>";} else {echo"</tr>";} 
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <footer
                id="tableFooter"
                class="px-5 py-4 border-t border-gray-100"
              >
                <div class="w-full flex justify-end">
                  <ol
                    id="pages"
                    class="flex justify-center gap-1 text-xs font-medium"
                  ></ol>
                </div>
              </footer>
            </div>
          </div>
    </div>
</div>