<?php

class Buku {
    private $idBuku;
    private $judul;
    private $penulis;
    private $stok;

    public function __construct($idBuku, $judul, $penulis, $stok) {
        $this->idBuku = $idBuku;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->stok = $stok;
    }

    public function getIdBuku() {
        return $this->idBuku;
    }

    public function getJudul() {
        return $this->judul;
    }

    public function getPenulis() {
        return $this->penulis;
    }

    public function getStok() {
        return $this->stok;
    }

    public function tambahStok() {
        $this->stok++;
    }

    public function kurangiStok() {
        if ($this->stok > 0) {
            $this->stok--;
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanInfo() {
    echo "ID Buku : " . $this->idBuku . "<br>";
    echo "Judul : " . $this->judul . "<br>";
    echo "Penulis : " . $this->penulis . "<br>";
    echo "Stok : " . $this->stok . "<br>";
    }
}

class Anggota {
    private $nama;
    private $nim;

    public function __construct($nama, $nim) {
        $this->nama = $nama;
        $this->nim = $nim;
    }

    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getNim() {
        return $this->nim;
    }

    public function tampilkanInfo() {
        echo "Nama : " . $this->nama . "<br>";
        echo "NIM : " . $this->nim . "<br>";
    }
}

class Peminjaman {
    private $anggota;
    private $buku;
    private $tanggalPinjam;
    private $tanggalKembali;
    private $status;

    public function __construct($anggota, $buku, $tanggalPinjam,) {
        $this->anggota = $anggota;
        $this->buku = $buku;
        $this->tanggalPinjam = $tanggalPinjam;
        $this->tanggalKembali = null;
        $this->status = "Belum Dipinjam";
    }

    public function prosesPeminjaman() {
        if ($this->buku->kurangiStok()) {
            $this->status = "Dipinjam";
            echo "Peminjaman Berhasil.<br>";
        } else {
            echo "Peminjaman gagal, stok buku habis.<br>";
        }
    }

    public function prosesPengembalian($tanggalKembali) {
        if ($this->status == "Dipinjam") {
            $this->buku->tambahStok();
            $this->tanggalKembali = $tanggalKembali;
            $this->status = "Dikembalikan";
            echo "Pengembalian berhasil.<br>";
        } else {
            echo "Pengembalian gagal, buku belum dipinjam.<br>";
        }
    }

    public function getStatus() {
        return $this->status;
    }

    public function tampilkanInfo() {
        echo "Nama Anggota : " . $this->anggota->getNama() . "<br>";
        echo "NIM : " . $this->anggota->getNim() . "<br>";
        echo "Buku : " . $this->buku->getJudul() . "<br>";
        echo "Tanggal Pinjam : " . $this->tanggalPinjam . "<br>";
        echo "Tanggal Kembali : " . ($this->tanggalKembali ?? "-") . "<br>";
        echo "Status : " . $this->status . "<br>";
    }
}

//Mulai
$buku1 = new Buku("BK001", "Dasar Pemrograman PHP", "Budi Santoso", 1);
$anggota1 = new Anggota("Andra", "250030602");

$buku1->tampilkanInfo();

echo "<br>";

$anggota1->tampilkanInfo();

echo "<br>";

$peminjaman1 = new Peminjaman($anggota1, $buku1, "2026-10-27");
$peminjaman1->prosesPeminjaman();

echo "<br>";

$peminjaman2 = new Peminjaman($anggota1, $buku1, "2026-10-28");
$peminjaman2->prosesPeminjaman();

echo "<br>";

$peminjaman1->tampilkanInfo();

echo "<br>";

$peminjaman1->prosesPengembalian("2026-10-30");

echo "<br>";

$peminjaman1->tampilkanInfo();