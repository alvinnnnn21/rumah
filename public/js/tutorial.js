const tutorial = [
    {
        id: 0,
        tutorial: "Tutorial Register", 
        tipe: "umum",
        langkah: [
            {
                langkah: "Akses menu register pada halaman utama.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi data yang diperlukan dari nama sampai nomor telpon.",
                image: [
                    "no_image.png"
                ]
            }
            ,
            {
                langkah: "Pilih sebagai pemilik rumah atau penyewa rumah.",
                image: [
                    "no_image.png"
                ]
            }
            ,
            {
                langkah: "Tekan button register.",
                image: [
                    "no_image.png"
                ]
            }
        ],
    },
    {
        id: 1,
        tutorial: "Tutorial Login",
        tipe: "umum",
        langkah: [
            {
                langkah: "Isi data username dan password.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Pastikan username dan password benar.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Tekan login, jika username dan password benar maka akan masuk ke halaman utama sebagai roles yang dipilih.",
                image: [
                    "no_image.png"
                ]
            },
        ],
    },
    {
        id: 2,
        tutorial: "Tutorial Pencarian Biasa",
        tipe: "umum",
        langkah: [
            {
                langkah: "Pengguna dapat langsung mencari melalui search bar diatas dengan mengetikan alamat yang ingin di tuju.",
                image: [
                    "no_image.png"
                ]
            }
        ]
    },
    {
        id: 3,
        tutorial: "Tutorial Pencarian AHP",
        tipe: "umum",
        langkah: [
            {
                langkah: "Pengguna dapat mengisi filter yang disediakan.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Pengguna dapat memilih kriteria yang diisi.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Setelah mengisi kriteria tekan tombol cari dibawah.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Setelah itu pengguna ditampilkan dengan nilai bobot kriteria yang dapat diubah sesuai keinginan.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Atau pengguna dapat langsung memakai nilai yang di set oleh admin untukmenemukan rumah.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Tekan tombol bandingkan untuk menampilkan rekomendasi rumah.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 4,
        tutorial: "Tutorial Memesan Rumah",
        tipe: "penyewa",
        langkah: [
            {
                langkah: "Memilih rumah yang sesuai.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Membuka detail rumah dengan cara menekan rumah yang sesuai.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Scroll ke bawah, tekan button sewa rumah.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi form sewa : lama sewa / tahun, mulai sewa. Setelah itu akan muncul detail sewa untuk mengetahui total sewa dan lama sewa.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Tekan kirim untuk selanjutnya untuk mengirim ke admin",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 5,
        tutorial: "Tutorial Membayar",
        tipe: "penyewa",
        langkah: [
            {
                langkah: "Mentransfer ke rekening admin.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Upload bukti pembayaran pada halaman transaksi.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Akses menu transaksi, lalu tekan verifikasi pembayaran.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Upload bukti pembayaran (transfer) ,kirim.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Tunggu verifikasi admin, disetujui atau tidak akan mendapatkan notifikasi dari admin/",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 6,
        tutorial: "Tutorial Mengisi Rekening",
        tipe: "penyewa",
        langkah: [
            {
                langkah: "Akses menu akun saya untuk menambahkan rekening.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi bank dan no rekening.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Klik button ubah.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 7,
        tutorial: "Tutorial Menambah Reminder",
        tipe: "penyewa",
        langkah: [
            {
                langkah: "Akses menu reminder.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Klik tombol + dibawah kanan.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi nama acara, tanggal, dan waktu. Lalu klik tambah.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 8,
        tutorial: "Tutorial Chat",
        tipe: "penyewa",
        langkah: [
            {
                langkah: "Tekan rumah yang diinginkan untuk menghubungi pemilik rumah.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Pada halaman detail rumah, tekan icon chat untuk menghubungi pemilik.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Maka penyewa akan hubungankan ke halaman chat, dan penyewa dapat memulai percakapan.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 9,
        tutorial: "Tutorial Menyimpan Rumah",
        tipe: "penyewa",
        langkah: [
            {
                langkah: "Tekan rumah yang ingin disimpan.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Pada halama detail rumah, tekan icon hati untuk menyimpan rumah.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Rumah akan tersimpan jika icon berubah warna menjadi merah",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Akses menu favorit pada menu utama untuk mengetahui rumah yang sudah disimpan.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 10,
        tutorial: "Tutorial Mengisi Rekening",
        tipe: "pemilik",
        langkah: [
            {
                langkah: "Akses menu akun saya untuk menambahkan rekening.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi bank dan no rekening.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Klik button ubah.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    },
    {
        id: 11,
        tutorial: "Tutorial Menambah Reminder",
        tipe: "pemilik",
        langkah: [
            {
                langkah: "Akses menu reminder.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Klik tombol + dibawah kanan.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi nama acara, tanggal dan waktu. Lalu klik tambah.",
                image: [
                    "no_image.png"
                ]
            },
            
            
        ]
    },
    {
        id: 12,
        tutorial: "Tutorial Menambah Rumah",
        tipe: "pemilik",
        langkah: [
            {
                langkah: "Klik pojok kanan bawah button +.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Isi data rumah mulai dari alamat sampai upload gambar.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Klik simpan.",
                image: [
                    "no_image.png"
                ]
            },
            {
                langkah: "Menunggu admin untuk verifikasi data rumah, disetujui tidak nya admin akan memberi notifikasi.",
                image: [
                    "no_image.png"
                ]
            },
        ]
    }
    
]