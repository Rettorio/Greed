<div class="max-w-xl md:max-w-3xl mx-auto">
      <h2 class="mt-8 text-2xl text-center font-medium">
        Form Peminjaman Buku
      </h2>
      <form method="post" class="max-w-xl mt-6 mx-auto flex flex-col" action="/pinjam/save">
        <div class="grid gap-2 grid-cols-4 w-full">
          <div class="col-span-2">
            <label for="Nama" class="block text-xs font-medium text-gray-700">
              Nama
            </label>

            <input
              type="text"
              id="Nama"
              name="NamaPeminjam"
              placeholder="John doe"
              required
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div class="col-span-2">
            <label for="Nohp" class="block text-xs font-medium text-gray-700">
              No HP
            </label>

            <input
              type="number"
              id="Nohp"
              name="NoPeminjam"
              required
              placeholder="0850xxxxx"
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div class="col-span-2">
            <label for="Email" class="block text-xs font-medium text-gray-700">
              Email
            </label>

            <input
              type="email"
              id="Email"
              name="EmailPeminjam"
              placeholder="johndoe@mail.com"
              required
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div class="col-span-2">
            <label
              for="Tanggal"
              class="block text-xs font-medium text-gray-700"
            >
              Tanggal Pengembalian
            </label>

            <input
              type="Date"
              id="Tanggal"
              name="TanggalPengembalian"
              placeholder="johndoe@mail.com"
              min="<?= date('Y-m-d', strtotime('+1 days')) ?>"
              max="<?= date('Y-m-d', strtotime('+7 days')) ?>"
              required
              class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
            />
          </div>
          <div class="col-span-3">
            <label
              for="HeadlineAct"
              class="block text-sm font-medium text-gray-900"
            >
              Judul Buku
            </label>

            <div class="relative mt-1.5">
              <input
                type="text"
                list="BukuID"
                id="HeadlineAct"
                class="w-full rounded-lg border-gray-300 pe-10 text-gray-700 sm:text-sm [&::-webkit-calendar-picker-indicator]:opacity-0"
                name="BukuID"
                placeholder="Pilih Buku"
              />

              <span class="absolute inset-y-0 end-0 flex w-8 items-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-5 w-5 text-gray-500"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                  />
                </svg>
              </span>
            </div>

            <datalist name="HeadlineAct" id="BukuID">
              <?php
                foreach($buku as $row) {
                  echo "<option value=$row[BukuID]>$row[JudulBuku]</option>";
                }
              ?>
            </datalist>
          </div>
          <div class="self-end">
            <button
              class="inline-block rounded border border-indigo-600 bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
              type="submit"
            >
              Pinjam Buku
            </button>
          </div>
        </div>
      </form>
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
                    <form method="get" role="search">
                      <input
                        name="cari"
                        type="text"
                        value="<?= isset($cari) ? $cari : null ?>"
                        placeholder="Search.."
                        class="rounded-md border-gray-200 text-sm"
                      />
                      <button type="submit" class="sr-only">submit</button>
                    </form>
                  </div>
                </div>
              </header>
              <div class="p-3">
                <div class="max-h-[60vh] overflow-x-auto overflow-y-auto">
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
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Nama Peminjam</div>
                        </th>
                        <th
                          aria-label="col_3"
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Email Peminjam</div>
                        </th>
                        <th
                          aria-label="col_4"
                          class="p-2.5 whitespace-nowrap relative sorting cursor-pointer select-none"
                        >
                          <div class="font-semibold text-left">Tgl Pengembalian</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody
                      id="tableBody"
                      class="text-sm divide-y divide-gray-100"
                    >
                    <?php
                      foreach($pinjam as $index => $row) {
                       $number = $index + 1;
                       echo "<tr class=\"hover:bg-violet-100\">
                        <td class=\"p-2 whitespace-nowrap\">$number</td>
                        <td class=\"p-2 min-w-[250px] max-w-[250px] truncate whitespace-nowrap\">
                          $row[JudulBuku]
                        </td>
                        <td class=\"p-2 text-left\">$row[NamaPeminjam]</td>
                        <td class=\"p-2 text-left\">$row[EmailPeminjam]</td>
                        <td class=\"p-2 text-center whitespace-nowrap\">
                          $row[TanggalPengembalian]
                        </td>
                      </tr>";
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