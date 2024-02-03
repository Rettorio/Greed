<?php
    $activePage = $_SERVER['REQUEST_URI'];
    $activeClass = "bg-blue-50";
?>

<div
        id="sideMenu"
        class="sm:flex hidden fixed h-screen md:h-screen w-16 flex-col justify-between border-r z-10 bg-white shadow-xl md:shadow-none"
      >
        <div>
          <div class="inline-flex h-16 w-16 items-center justify-center">
            <span
              class="grid h-10 w-10 place-content-center rounded-lg bg-gray-100 text-xs text-gray-600"
              >A</span
            >
          </div>

          <div class="block md:block border-t border-gray-100">
            <nav aria-label="Main Nav" class="flex flex-col p-2">
              <div class="py-4">
                <a
                  href="http://localhost:8000/"
                  class="t group relative flex justify-center rounded px-2 py-1.5 text-blue-700 <?= strpos($activePage, '/utsweb2/buku') !== false ? $activeClass : 'hover:bg-gray-50 hover:text-gray-700' ?>"
                >
                  <svg
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                      id="SVGRepo_tracerCarrier"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                      <path
                        d="M4 8C4 5.17157 4 3.75736 4.87868 2.87868C5.75736 2 7.17157 2 10 2H14C16.8284 2 18.2426 2 19.1213 2.87868C20 3.75736 20 5.17157 20 8V16C20 18.8284 20 20.2426 19.1213 21.1213C18.2426 22 16.8284 22 14 22H10C7.17157 22 5.75736 22 4.87868 21.1213C4 20.2426 4 18.8284 4 16V8Z"
                        stroke="#1C274D"
                        stroke-width="1.5"
                      ></path>
                      <path
                        d="M19.8978 16H7.89778C6.96781 16 6.50282 16 6.12132 16.1022C5.08604 16.3796 4.2774 17.1883 4 18.2235"
                        stroke="#1C274D"
                        stroke-width="1.5"
                      ></path>
                      <path
                        d="M8 7H16"
                        stroke="#1C274D"
                        stroke-width="1.5"
                        stroke-linecap="round"
                      ></path>
                      <path
                        d="M8 10.5H13"
                        stroke="#1C274D"
                        stroke-width="1.5"
                        stroke-linecap="round"
                      ></path>
                      <path
                        d="M19.5 19H8"
                        stroke="#1C274D"
                        stroke-width="1.5"
                        stroke-linecap="round"
                      ></path>
                    </g>
                  </svg>

                  <span
                    class="absolute left-full top-1/2 ml-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100"
                  >
                    Buku
                  </span>
                </a>
              </div>

              <ul class="space-y-1 border-t border-gray-100 pt-4">
                <li>
                  <a
                    href="http://localhost:8000/pinjam"
                    class="group relative flex justify-center rounded px-2 py-1.5 text-gray-500 <?= strpos($activePage, '/pinjam') !== false ? $activeClass : 'hover:bg-gray-50 hover:text-gray-700' ?>"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5 opacity-75"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                      />
                    </svg>

                    <span
                      class="absolute left-full top-1/2 ml-4 -translate-y-1/2 rounded bg-gray-900 px-2 py-1.5 text-xs font-medium text-white opacity-0 group-hover:opacity-100"
                    >
                      Pinjam Buku
                    </span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>