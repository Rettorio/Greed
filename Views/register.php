<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
    <title>Pagi wirr</title>
  </head>
  <body class="font-pop relative bg-white">
    <div class="flex">
      <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
          <h1 class="text-2xl font-bold sm:text-3xl">Silahkan Daftar!</h1>

          <p class="mt-4 text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et libero
            nulla eaque error neque ipsa culpa autem, at itaque nostrum!
          </p>
        </div>

        <form method="post" action="/register" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
          <div>
            <label for="nama" class="sr-only">Nama</label>
            <div class="relative">
              <input
                id="nama"
                name="Nama"
                type="text"
                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                placeholder="Masukan Nama"
              />

              <span
                class="absolute inset-y-0 end-0 grid place-content-center px-4"
              >
              </span>
            </div>
          </div>
          <div>
            <label for="alamat" class="sr-only">Alamat</label>
            <div class="relative">
              <input
                id="alamat"
                name="Alamat"
                type="text"
                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                placeholder="Masukan Alamat"
              />

              <span
                class="absolute inset-y-0 end-0 grid place-content-center px-4"
              >
              </span>
            </div>
          </div>
          <div>
            <label for="nohp" class="sr-only">No Hp</label>
            <div class="relative">
              <input
                id="nohp"
                name="NoHP"
                type="number"
                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                placeholder="Masukan NoHP"
              />

              <span
                class="absolute inset-y-0 end-0 grid place-content-center px-4"
              >
              </span>
            </div>
          </div>
          <div>
            <label for="email" class="sr-only">Email</label>

            <div class="relative">
              <input
                name="Email"
                type="email"
                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                placeholder="Masukan email"
              />

              <span
                class="absolute inset-y-0 end-0 grid place-content-center px-4"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 text-gray-400"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                  />
                </svg>
              </span>
            </div>
          </div>

          <div>
            <label for="password" class="sr-only">Password</label>

            <div class="relative">
              <input
                name="Password"
                type="password"
                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                placeholder="Masukan password"
              />

              <span
                class="absolute inset-y-0 end-0 grid place-content-center px-4"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 text-gray-400"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                  />
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                  />
                </svg>
              </span>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">
              Sudah punya akun?
              <a class="underline" href="">Login</a>
            </p>

            <button
              type="submit"
              class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
            >
              Sign up
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
