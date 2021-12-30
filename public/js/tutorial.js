const tutorial = [
    {
        id: 0,
        tutorial: "Tutorial Register", 
        tipe: "umum",
        langkah: [
            "Akses menu register pada halaman utama.",
            "Isi data yang diperlukan dari nama sampai nomor telpon.",
            "Pilih sebagai pemilik rumah atau penyewa rumah.",
            "Tekan button register."
        ],
    },
    {
        id: 1,
        tutorial: "Tutorial Login",
        tipe: "umum",
        langkah: [
            "Isi data username dan password.",
            "Pastikan username dan password benar.",
            "Tekan login, jika username dan password benar maka akan masuk ke halaman utama sebagai roles yang dipilih."
        ],
    },
    {
        id: 2,
        tutorial: "Tutorial Pencarian Biasa",
        tipe: "umum",
        langkah: [
            "Pengguna dapat langsung mencari melalui search bar diatas dengan mengetikan alamat yang ingin di tuju."
        ]
    },
    {
        id: 3,
        tutorial: "Tutorial Pencarian AHP",
        tipe: "umum",
        langkah: [
            "Pengguna dapat mengisi filter yang disediakan.",
            "Pengguna dapat memilih kriteria yang diisi.",
            "Setelah mengisi kriteria tekan tombol cari dibawah.",
            "Setelah itu pengguna ditampilkan dengan nilai bobot kriteria yang dapat diubah sesuai keinginan.",
            "Atau pengguna dapat langsung memakai nilai yang di set oleh admin untukmenemukan rumah.",
            "Tekan tombol bandingkan untuk menampilkan rekomendasi rumah."
        ]
    },
    {
        id: 4,
        tutorial: "Tutorial Memesan Rumah",
        tipe: "penyewa",
        langkah: [
            "Memilih rumah yang sesuai.",
            "Membuka detail rumah dengan cara menekan rumah yang sesuai.",
            "Scroll ke bawah, tekan button sewa rumah.",
            "Isi form sewa : lama sewa / tahun, mulai sewa. Setelah itu akan muncul detail sewa untuk mengetahui total sewa dan lama sewa.",
            "Tekan kirim untuk selanjutnya untuk mengirim ke admin"
        ]
    },
    {
        id: 5,
        tutorial: "Tutorial Membayar",
        tipe: "penyewa",
        langkah: [
            "Mentransfer ke rekening admin.",
            "Upload bukti pembayaran pada halaman transaksi.",
            "Akses menu transaksi, lalu tekan verifikasi pembayaran.",
            "Upload bukti pembayaran (transfer) ,kirim.",
            "Tunggu verifikasi admin, disetujui atau tidak akan mendapatkan notifikasi dari admin/",
        ]
    },
    {
        id: 6,
        tutorial: "Tutorial Mengisi Rekening",
        tipe: "penyewa",
        langkah: [
            "Akses menu akun saya untuk menambahkan rekening.",
            "Isi bank dan no rekening.",
            "Klik button ubah."
        ]
    },
    {
        id: 7,
        tutorial: "Tutorial Menambah Reminder",
        tipe: "penyewa",
        langkah: [
            "Akses menu reminder.",
            "Klik tombol + dibawah kanan.",
            "Isi nama acara, tanggal, dan waktu. Lalu klik tambah."
        ]
    },
    {
        id: 8,
        tutorial: "Tutorial Chat",
        tipe: "penyewa",
        langkah: [
            "Tekan rumah yang diinginkan untuk menghubungi pemilik rumah.",
            "Pada halaman detail rumah, tekan icon chat untuk menghubungi pemilik.",
            "Maka penyewa akan hubungankan ke halaman chat, dan penyewa dapat memulai percakapan."
        ]
    },
    {
        id: 9,
        tutorial: "Tutorial Menyimpan Rumah",
        tipe: "penyewa",
        langkah: [
            "Tekan rumah yang ingin disimpan.",
            "Pada halama detail rumah, tekan icon hati untuk menyimpan rumah.",
            "Rumah akan tersimpan jika icon berubah warna menjadi merah",
            "Akses menu favorit pada menu utama untuk mengetahui rumah yang sudah disimpan."
        ]
    },
    {
        id: 10,
        tutorial: "Tutorial Mengisi Rekening",
        tipe: "pemilik",
        langkah: [
            "Akses menu akun saya untuk menambahkan rekening.",
            "Isi bank dan no rekening.",
            "Klik button ubah."
        ]
    },
    {
        id: 11,
        tutorial: "Tutorial Menambah Reminder",
        tipe: "pemilik",
        langkah: [
            "Akses menu reminder.",
            "Klik tombol + dibawah kanan.",
            "Isi nama acara, tanggal dan waktu. Lalu klik tambah."
        ]
    },
    {
        id: 12,
        tutorial: "Tutorial Menambah Rumah",
        tipe: "pemilik",
        langkah: [
            "Klik pojok kanan bawah button +.",
            "Isi data rumah mulai dari alamat sampai upload gambar.",
            "Klik simpan.",
            "Menunggu admin untuk verifikasi data rumah, disetujui tidak nya admin akan memberi notifikasi."
        ]
    }
    
]