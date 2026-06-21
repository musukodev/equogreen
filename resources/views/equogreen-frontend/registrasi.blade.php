<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Online Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans min-h-screen overflow-y-auto">
  <div class="w-full min-h-screen">

    <!-- Header -->
    <header class="bg-black text-white h-[84px] relative">
      <div class="absolute left-6 top-7">
        <button class="w-8 h-8 rounded-full border border-white flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
      </div>

      <div class="flex flex-col items-center justify-center h-full">
        <div class="flex items-center gap-2">
          <img src="/gambar/logo-putih.png" alt="Logo" class="w-12 h-12">
          <h1 class="text-[16px] font-bold leading-none">Equogreen</h1>
        </div>

        <nav class="flex gap-4 mt-3 text-[12px] text-white/90">
          <a href="#" class="hover:underline">Company Email</a>
          <span class="text-white/40 select-none" aria-hidden="true">|</span>
          <a href="#" class="hover:underline">Company number</a>
          <span class="text-white/40 select-none" aria-hidden="true">|</span>
          <a href="#" class="hover:underline">Company website</a>
        </nav>
      </div>
    </header>

    <!-- Content -->
    <main class="px-[60px] pt-6 pb-10">
      <!-- Title -->
      <div class="text-center">
        <h2 class="text-[18px] font-semibold text-black">Online Registration</h2>
        <p class="text-[12px] text-gray-700 mt-1">Please fill out this registration form.</p>
      </div>

      <!-- Form -->
      <form class="mt-10" method="POST" action="{{ route('registrasi-store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-x-10">
          
          <!-- Left -->
          <div class="space-y-3">
            <div>
              <label class="block text-[12px] text-black mb-1">Nama Perusahaan</label>
              <input type="text" name="nama_perusahaan" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none" required />
            </div>

            <div>
              <label class="block text-[12px] text-black mb-1">Email Perusahaan</label>
              <input type="email" name="email_perusahaan" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none" />
            </div>

            <div>
              <label class="block text-[12px] text-black mb-1">No. Handphone Perusahaan</label>
              <input type="text" name="no_hp" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none" required />
            </div>

            <div>
              <label class="block text-[12px] text-black mb-1">Alamat Perusahaan</label>
              <textarea name="alamat" class="w-full h-[100px] border border-gray-400 rounded-[4px] px-2 py-2 text-[12px] resize-none focus:outline-none" required></textarea>
            </div>

            <div>
              <select name="kategori_vendor" class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%2２><polyline points=%2２6 9 12 15 18 9% twenty-two/></svg>')] bg-no-repeat bg-[right_8px_center]"
              required>
                <option value="" disabled selected>Pilih Kategori Vendor</option>
                <option value="supplier">Supplier</option>
                <option value="kontraktor">Kontraktor</option>
                <option value="distributor">Distributor</option>
                <option value="jasa">Jasa</option>
              </select>
            </div>
          </div>

          <!-- Right -->
          <div class="space-y-3">
            <div>
              <label class="block text-[12px] text-black mb-1">Nama Penanggung jawab</label>
              <input type="text" name="penanggung_jawab" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none" required />
            </div>

            <div>
              <label class="block text-[12px] text-black mb-1">Deskripsi Perusahaan</label>
              <textarea name="deskripsi" class="w-full h-[125px] border border-gray-400 rounded-[4px] px-2 py-2 text-[12px] resize-none focus:outline-none" required></textarea>
            </div>

            <!-- PROVINSI -->
            <div>
            <select name="provinsi" id="provinsi"
                class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%2２><polyline points=%2２6 9 12 15 18 9% twenty-two/></svg>')] bg-no-repeat bg-[right_8px_center]"
                required>
                <option value="">Provinsi</option>
            </select>
            </div>

            <!-- KOTA -->
            <div>
            <select name="kota" id="kota"
                class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%2２><polyline points=%2２6 9 12 15 18 9% twenty-two/></svg>')] bg-no-repeat bg-[right_8px_center]"
                required>
                <option value="">Kota</option>
            </select>
            </div>

            <!-- KECAMATAN -->
            <div>
            <select name="kecamatan" id="kecamatan"
                class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%2２><polyline points=%2２6 9 12 15 18 9% twenty-two/></svg>')] bg-no-repeat bg-[right_8px_center]" required>
                <option value="">Kecamatan</option>
            </select>
            </div>

            <!-- KODE POS -->
            <div>
            <input name="kode_pos" id="kodepos" type="text" placeholder="Kode Pos"
                class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none" required>
            </div>
          </div>
        </div>

        <!-- Upload -->
        <div class="mt-2">
          <label class="block text-[12px] text-black mb-1">Portofolio Perusahaan</label>
          <div class="border border-gray-400 rounded-[4px] p-1">
<div class="relative border border-dashed border-gray-400 rounded-[4px] h-[68px] flex flex-col items-center justify-center text-[12px] text-gray-700 overflow-hidden">              <input type="file"
              name="portofolio"
              accept=".pdf,.docx"
              class="absolute w-full h-full opacity-0 cursor-pointer" required />
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mb-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
              </svg>
              <p>You can drag and drop files here to add them.</p>
            </div> 
          </div>
          <p class="text-[12px] text-black mt-1">Accepted files type : .pdf, .docx</p>
        </div>

        <!-- Button -->
        <div class="mt-3">
          <button type="submit" class="w-full h-[32px] bg-blue-700 text-white text-[12px] rounded-[4px] hover:bg-blue-800 transition">
            Registrasi
          </button>
        </div>

        <!-- Login -->
        <div class="text-right mt-2 text-[12px]">
          <span class="text-black">Sudah punya akun?</span>
          <a href="login.html" class="text-blue-600 hover:underline"> Login.</a>
        </div>
        @if(session('success'))
    <div class="mx-[60px] mt-4 p-3 bg-green-100 border border-green-400 text-green-700 text-[12px] rounded">
        {{ session('success') }}
    </div>
@endif
      </form>
    </main>
  </div>
  

    <script>
    const provinsi = document.getElementById("provinsi");
    const kota = document.getElementById("kota");
    const kecamatan = document.getElementById("kecamatan");

    // load provinsi
    fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
    .then(res => res.json())
    .then(data => {
    provinsi.innerHTML = '<option value="">Provinsi</option>';
    data.forEach(p => {
        provinsi.innerHTML += `<option value="${p.id}">${p.name}</option>`;
    });
    });

    // provinsi → kota
    provinsi.addEventListener("change", function () {
    if (!this.value) return;

    kota.innerHTML = '<option>Loading...</option>';
    kecamatan.innerHTML = '<option>Kecamatan</option>';

    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        kota.innerHTML = '<option value="">Kota</option>';
        data.forEach(k => {
        kota.innerHTML += `<option value="${k.id}">${k.name}</option>`;
        });
    });
    });

    // kota → kecamatan
    kota.addEventListener("change", function () {
    if (!this.value) return;

    kecamatan.innerHTML = '<option>Loading...</option>';

    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        kecamatan.innerHTML = '<option value="">Kecamatan</option>';
        data.forEach(d => {
        kecamatan.innerHTML += `<option value="${d.id}">${d.name}</option>`;
        });
    });
    });
    </script>

</body>
</html>
