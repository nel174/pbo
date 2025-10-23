<?php
// Aplikasi Biodata PBO - Tema Pahlawan Kemerdekaan 🇮🇩
// Oleh: Lionel Keffas | Kelas: 10 RPL 1 | SMK Plus Pelita Nusantara

function clean($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$file = 'data_biodata.txt';
$msg = '';

if (isset($_POST['simpan'])) {
    $nama   = clean($_POST['nama']);
    $mapel  = clean($_POST['mapel']);
    $jk     = clean($_POST['jk']);
    $alamat = clean($_POST['alamat']);
    $agama  = clean($_POST['agama']);

    if (!$nama || !$mapel || !$jk || !$alamat || !$agama) {
        $msg = "Semua data harus diisi!";
    } else {
        $text = "[" . date("Y-m-d H:i:s") . "] Nama: $nama | Mapel: $mapel | JK: $jk | Alamat: $alamat | Agama: $agama" . PHP_EOL;
        file_put_contents($file, $text, FILE_APPEND);
        $msg = "Data berhasil disimpan!";
    }
}

$data = [];
if (file_exists($file)) {
    $data = array_reverse(file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Biodata Pahlawan Kemerdekaan | PBO</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: linear-gradient(180deg, #ff4b4b 0%, #ffffff 100%);
    color: #111;
    overflow-x: hidden;
}
.container {
    max-width: 1100px;
    margin: 40px auto;
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 25px;
}
.card {
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 6px 25px rgba(0,0,0,.08);
}
h1 {
    color: #d32f2f;
    font-size: 24px;
    margin: 0;
}
.subtitle {
    color: #555;
    font-size: 14px;
    margin-bottom: 20px;
}
label { display:block; margin-top:10px; font-weight:600; }
input, textarea, select {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 2px solid #ddd;
    outline: none;
    margin-top: 5px;
    font-size: 14px;
}
input:focus, textarea:focus, select:focus {
    border-color: #d32f2f;
    box-shadow: 0 3px 10px rgba(211,47,47,.15);
}
.radios {
    display: flex;
    gap: 10px;
    margin-top: 5px;
}
button {
    width: 100%;
    background: linear-gradient(90deg,#d32f2f,#b71c1c);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px;
    margin-top: 15px;
    font-weight: 700;
    cursor: pointer;
}
button:hover { transform: scale(1.03); }
.msg { margin-top: 10px; padding: 10px; border-radius: 8px; font-size: 14px; }
.msg.ok { background: #e7ffed; border: 1px solid #b5e8b3; color: #246d28; }
.msg.err { background: #ffe7e7; border: 1px solid #f0c2c2; color: #8a1b1b; }

.table { margin-top: 20px; overflow: auto; border-radius: 10px; border: 1px solid #eee; }
table { width: 100%; border-collapse: collapse; font-size: 13px; }
th, td { padding: 8px 10px; border-bottom: 1px solid #eee; text-align: left; }
th { background: #fff; color: #b71c1c; }

/* --- HERO SECTION --- */
.hero {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 25px rgba(0,0,0,.08);
    padding: 25px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.flag {
    width: 200px;
    height: 120px;
    position: relative;
    margin: 0 auto 15px;
    border: 2px solid #222;
    border-radius: 4px;
    overflow: hidden;
    animation: wave 2s infinite ease-in-out;
}
.flag::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 50%;
    width: 100%;
    background: #ff0000;
}
.flag::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    height: 50%;
    width: 100%;
    background: #fff;
}
@keyframes wave {
    0%,100% { transform: rotate(1deg); }
    50% { transform: rotate(-1deg); }
}
.hero-char {
    font-size: 60px;
    color: #b71c1c;
    animation: float 3s infinite ease-in-out;
}
@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.hero-text {
    font-weight: 700;
    font-size: 16px;
    color: #d32f2f;
    margin-top: 10px;
}
.hero-sub {
    font-size: 13px;
    color: #555;
}
.slogan {
    margin-top: 20px;
    background: #fff5f5;
    padding: 10px;
    border-radius: 8px;
    color: #b71c1c;
    font-weight: 600;
    font-size: 14px;
}
@media(max-width:950px){.container{grid-template-columns:1fr;}}
</style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>🇮🇩 Aplikasi Biodata - Mapel PBO</h1>
        <p class="subtitle">Oleh: <strong>Lionel Keffas</strong> • Kelas 10 RPL 1 • SMK Plus Pelita Nusantara</p>

        <form method="post">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>Mata Pelajaran</label>
            <input type="text" name="mapel" value="Pemrograman Berorientasi Objek (PBO)" required>

            <label>Jenis Kelamin</label>
            <div class="radios">
                <label><input type="radio" name="jk" value="Laki-laki" required> Laki-laki</label>
                <label><input type="radio" name="jk" value="Perempuan"> Perempuan</label>
            </div>

            <label>Alamat</label>
            <textarea name="alamat" rows="3" required></textarea>

            <label>Agama</label>
            <select name="agama" required>
                <option value="">-- Pilih Agama --</option>
                <option>Islam</option>
                <option>Kristen</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Buddha</option>
                <option>Konghucu</option>
            </select>

            <button type="submit" name="simpan">Kirim & Simpan</button>
        </form>

        <?php if($msg): ?>
        <div class="msg <?=($msg=='Data berhasil disimpan!')?'ok':'err'?>"><?= $msg ?></div>
        <?php endif; ?>

        <?php if(isset($_POST['simpan']) && $msg=='Data berhasil disimpan!'): ?>
        <div class="msg ok">
            <strong>Data Tersimpan:</strong><br>
            Nama: <?= $nama ?><br>
            Mapel: <?= $mapel ?><br>
            JK: <?= $jk ?><br>
            Alamat: <?= $alamat ?><br>
            Agama: <?= $agama ?>
        </div>
        <?php endif; ?>

        <div class="table">
            <table>
                <thead><tr><th>No</th><th>Data</th></tr></thead>
                <tbody>
                <?php if(!$data): ?>
                    <tr><td colspan="2" style="color:#777;">Belum ada data tersimpan.</td></tr>
                <?php else: $i=1; foreach($data as $d): ?>
                    <tr><td><?= $i++ ?></td><td><?= $d ?></td></tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>

        <div class="slogan">💪 Semangat Belajar untuk Indonesia Merdeka! 🇮🇩</div>
    </div>

    <div class="hero">
        <div class="flag"></div>
        <div class="hero-char">🫡</div>
        <div class="hero-text">Pahlawan Kemerdekaan</div>
        <div class="hero-sub">Berjuang dengan ilmu, membangun masa depan!</div>
    </div>
</div>
</body>
</html>
