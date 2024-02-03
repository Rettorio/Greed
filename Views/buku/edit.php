<?php
// var_dump($buku["JudulBuku"]);
?>

<div class="w-full">
        <div class="max-w-xl md:max-w-3xl mx-auto">
          <h2 class="mt-8 text-2xl text-center font-medium">
            Data Master Buku
          </h2>
          <form method="post" class="max-w-xl mt-6 mx-auto flex flex-col" action="/buku/update/<?= $buku['BukuID']?>">
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
                  value="<?= $buku['JudulBuku'] ?>"
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
                  value="<?= $buku['PengarangBuku'] ?>"
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
                  value="<?= $buku['PenerbitBuku'] ?>"
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
                </label>

                <input
                  type="number"
                  id="Tahun"
                  name="TahunBuku"
                  placeholder="YYYY"
                  value="<?= $buku['TahunBuku'] ?>"
                  min="1950"
                  max="<?= date('Y') ?>"
                  required
                  class="mt-1 w-full rounded-md border-gray-200 shadow-sm sm:text-sm"
                />
              </div>
              <div class="self-end">
                <button
                  class="inline-block rounded border border-indigo-600 bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
                  type="submit"
                >
                  Update Buku
                </button>
              </div>
            </div>
          </form>
        </div>
</div>