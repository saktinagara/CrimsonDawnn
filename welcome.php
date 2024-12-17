<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crimson Dawn - Jaringan Keamanan Publik</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body class="bg-gray-100 text-gray-900">
    <header class="bg-red-600 text-white shadow-md">
      <div
        class="container mx-auto px-4 py-4 flex justify-between items-center"
      >
        <h1 class="text-3xl font-bold tracking-tight">Crimson Dawn</h1>
        <nav class="hidden md:flex space-x-4">
          <a href="#beranda" class="hover:text-red-200 transition-colors"
            >Beranda</a
          >
          <a href="#kesiapsiagaan" class="hover:text-red-200 transition-colors"
            >Kesiapsiagaan</a
          >
          <a href="#laporan" class="hover:text-red-200 transition-colors"
            >Laporan</a
          >
        </nav>
        <div class="flex items-center space-x-4">
          <a
            href="Register.html"
            class="bg-white text-red-600 px-4 py-2 rounded-full hover:bg-red-50 transition-colors"
          >
            Daftar
          </a>
          <button class="md:hidden text-white" id="mobile-menu-toggle">
            <svg
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              ></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu (Hidden by Default) -->
      <nav id="mobile-menu" class="hidden bg-red-500 md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
          <a href="#beranda" class="block px-3 py-2 rounded-md hover:bg-red-600"
            >Beranda</a
          >
          <a
            href="#kesiapsiagaan"
            class="block px-3 py-2 rounded-md hover:bg-red-600"
            >Kesiapsiagaan</a
          >
          <a href="#laporan" class="block px-3 py-2 rounded-md hover:bg-red-600"
            >Laporan</a
          >
        </div>
      </nav>
    </header>

    <main class="container mx-auto px-4 py-8 grid md:grid-cols-3 gap-6">
      <section
        id="beranda"
        class="bg-white rounded-lg shadow-md p-6 md:col-span-2"
      >
        <h2 class="text-2xl font-bold mb-4 text-red-600">
          Selamat Datang di Jaringan Keamanan Publik
        </h2>
        <p class="text-gray-700 leading-relaxed">
          Crimson Dawn hadir sebagai platform inovatif untuk membangun keamanan
          berbasis komunitas. Kami menyediakan sarana komunikasi, pelaporan, dan
          informasi yang memungkinkan warga berpartisipasi aktif dalam menjaga
          keamanan lingkungan.
        </p>
        <div class="mt-6 grid md:grid-cols-2 gap-4">
          <div class="bg-red-50 p-4 rounded-md">
            <h3 class="font-semibold text-red-700 mb-2">Misi Kami</h3>
            <p class="text-sm text-gray-600">
              Memberdayakan masyarakat melalui teknologi untuk menciptakan
              lingkungan yang lebih aman dan responsif.
            </p>
          </div>
          <div class="bg-red-50 p-4 rounded-md">
            <h3 class="font-semibold text-red-700 mb-2">Visi Kami</h3>
            <p class="text-sm text-gray-600">
              Membangun ekosistem keamanan yang transparan, partisipatif, dan
              berbasis data.
            </p>
          </div>
        </div>
      </section>

      <div class="grid gap-6">
        <section id="kesiapsiagaan" class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-bold mb-4 text-red-600">
            Berita Kriminalitas
          </h2>
          <p class="text-gray-700 mb-4">
            Dapatkan informasi terkini seputar keamanan dan kejadian di sekitar
            Anda.
          </p>
          <a
            href="Info.html"
            class="block w-full text-center bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-colors"
          >
            Lihat Berita
          </a>
        </section>

        <section id="laporan" class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-bold mb-4 text-red-600">Laporan Anonim</h2>
          <p class="text-gray-700 mb-4">
            Bantu kami menjaga keamanan dengan melaporkan aktivitas mencurigakan
            secara anonim.
          </p>
          <a
            href="Lapor.php"
            class="block w-full text-center bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-colors"
          >
            Buat Laporan
          </a>
        </section>
      </div>
    </main>

    <footer class="bg-red-700 text-white py-6 mt-8">
      <div class="container mx-auto px-4 text-center">
        <p>&copy; 2024 Crimson Dawn. Hak Cipta Dilindungi.</p>
      </div>
    </footer>

    <script>
      // Mobile Menu Toggle
      document
        .getElementById("mobile-menu-toggle")
        .addEventListener("click", function () {
          const mobileMenu = document.getElementById("mobile-menu");
          mobileMenu.classList.toggle("hidden");
        });
    </script>
  </body>
</html>
