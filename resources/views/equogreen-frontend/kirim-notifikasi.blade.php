<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta charset="utf-8"/>
  <title>Kirim Notifikasi - Equogreen</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4039c9',
            accent:  '#002eff',
          },
          fontFamily: {
            inter: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-[#eef3ff] min-h-screen flex">

  <!-- ===== SIDEBAR ===== -->
  <aside class="w-[280px] min-h-screen bg-white flex-shrink-0 flex flex-col shadow-md">

    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 pt-8 pb-6 border-b border-gray-100">
      <img src="gambar/logo.png" alt="Logo Equogreen" class="w-14 h-14 rounded-full object-cover"/>
      <span class="text-2xl font-bold text-gray-800">Equogreen</span>
    </div>

    <!-- Nav Menu -->
    <nav class="flex-1 px-4 py-6 flex flex-col gap-1">

      <!-- Dashboard -->
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/dashboard layout.png" alt="Dashboard" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert"/>
        Dashboard
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Periksa Barang -->
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/search database.png" alt="Periksa Barang" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert"/>
        Periksa Barang
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Kelola Notifikasi (ACTIVE) -->
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/Add Reminder.png" alt="Kelola Notifikasi" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert"/>
        Kelola Notifikasi
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Validasi Vendor -->
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/validasi.png" alt="Validasi Vendor" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert"/>
        Validasi Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Pengaturan -->
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/Settings.png" alt="Pengaturan" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert"/>
        Pengaturan
      </a>

    </nav>

    <!-- Logout -->
    <div class="px-4 pb-8 border-t border-gray-100 pt-4">
      <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
        <img src="gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain"/>
        Logout
      </a>
    </div>
  </aside>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 overflow-y-auto">

    <!-- Top Header -->
    <header class="flex items-center justify-between">
      <div class="flex items-center gap-4">
        <!-- Back Button -->
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
        </a>
        <div>
          <h1 class="text-3xl lg:text-4xl font-black text-gray-800 tracking-tight" style="font-family:'Futura-Bold',Helvetica,sans-serif;">Kelola Notifikasi</h1>
        </div>
      </div>

      <!-- Profile Section -->
      <div class="flex items-center gap-3">
        <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
          <img src="gambar/bell-black.png" alt="Notifikasi" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert"/>
        </button>
        <img src="gambar/Profileup.png" alt="Profil" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer"/>
        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
        <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
      </div>
    </header>

    <!-- ===== FORM CARD ===== -->
    <section class="bg-white rounded-2xl shadow-md p-6 lg:p-8 flex flex-col gap-5">

      <!-- Judul Notifikasi -->
      <div class="flex flex-col gap-1.5">
        <label class="text-sm font-bold text-gray-800" for="judul-notifikasi">Judul Notifikasi</label>
        <input type="text" id="judul-notifikasi" placeholder=""
          class="w-full px-4 py-3 rounded-xl border border-gray-800 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"/>
      </div>

      <!-- Isi Pesan -->
      <div class="flex flex-col gap-1.5">
        <label class="text-sm font-bold text-gray-800" for="isi-pesan">Isi Pesan</label>
        <textarea id="isi-pesan" rows="5" placeholder=""
          class="w-full px-4 py-3 rounded-xl border border-gray-800 bg-white text-sm text-gray-700 outline-none resize-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"></textarea>
      </div>

      <!-- Tanggal -->
      <div class="flex flex-col gap-1.5">
        <label class="text-sm font-bold text-gray-800" for="tanggal">Tanggal</label>
        <input type="date" id="tanggal"
          class="w-full px-4 py-3 rounded-xl border border-gray-800 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"/>
      </div>

      <!-- Waktu -->
      <div class="flex flex-col gap-1.5">
        <label class="text-sm font-bold text-gray-800" for="waktu">Waktu</label>
        <input type="time" id="waktu" value="00:00"
          class="w-full px-4 py-3 rounded-xl border border-gray-800 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"/>
      </div>

      <!-- Tombol Kirim -->
      <button id="btn-kirim"
        class="w-full py-3.5 rounded-xl bg-accent text-white font-bold text-base hover:bg-[#0023cc] active:scale-[0.98] transition-all duration-200 shadow hover:shadow-lg mt-1">
        Kirim
      </button>

    </section>
  </main>

  <!-- ========== TOAST ========== -->
  <div id="toast"
    class="fixed bottom-6 right-6 z-[60] bg-primary text-white px-5 py-3 rounded-xl shadow-lg text-sm font-bold opacity-0 pointer-events-none transition-all duration-300 flex items-center gap-2">
    <span id="toast-icon">✓</span>
    <span id="toast-msg">Berhasil!</span>
  </div>

  <script>
    document.getElementById('btn-kirim').addEventListener('click', () => {
      const judul = document.getElementById('judul-notifikasi').value.trim();
      const pesan = document.getElementById('isi-pesan').value.trim();
      const tanggal = document.getElementById('tanggal').value;
      const waktu = document.getElementById('waktu').value;

      if (!judul) { showToast('Harap isi judul notifikasi!', true); return; }
      if (!pesan) { showToast('Harap isi pesan!', true); return; }
      if (!tanggal) { showToast('Harap isi tanggal!', true); return; }
      if (!waktu) { showToast('Harap isi waktu!', true); return; }

      showToast('Notifikasi berhasil dikirim!');

      // Reset form
      document.getElementById('judul-notifikasi').value = '';
      document.getElementById('isi-pesan').value = '';
      document.getElementById('tanggal').value = '';
      document.getElementById('waktu').value = '00:00';
    });

    function showToast(msg, isError = false) {
      const toast = document.getElementById('toast');
      const toastMsg = document.getElementById('toast-msg');
      const toastIcon = document.getElementById('toast-icon');
      toastMsg.textContent = msg;
      toast.style.background = isError ? '#e53e3e' : '#4039c9';
      toastIcon.textContent = isError ? '!' : '✓';
      toast.style.opacity = '1';
      toast.style.pointerEvents = 'auto';
      setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.pointerEvents = 'none';
      }, 2800);
    }
  </script>

</body>
</html>
