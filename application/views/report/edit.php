<h3 align="center">Ubah Laporan</h3>
<ul>
	<form id="form-report">
		<pre>
    <label for="fr-foto">Foto Orang Hilang </label>
    <input type="file" accept="image/*" id="fr-foto" name="photo" placeholder="Masukan Foto"><br>
    <label for="fr-name">Nama Orang Hilang </label>
    <input type="text" id="fr-name" class="itext" name="name" value="<?= $data['name'] ?>" placeholder="Masukan Nama"><br>
    <label for="fr-umur">Umur Orang Hilang </label>
    <input type="number" id="fr-umur" class="itext" name="age" value="<?= $data['age'] ?>" placeholder="Masukan Umur"><br>
    <label for="fr-date">Tanggal Mulai Hilang  </label>
    <input  type="date" id="fr-date" class="itext" name="lost_date" value="<?= $data['lost_date'] ?>" placeholder="Masukan Tanggal Hilang" required><br>
    <label for="fr-ket">Keterangan Orang Hilang</label>
    <textarea name="description" id="fr-ket" class="itext" cols="30" rows="10"><?= $data['description'] ?></textarea><br>
    <input onclick="update_report(<?= $data['id'] ?>)" type="button" value="Kirim ">
    </pre>
	</form>
