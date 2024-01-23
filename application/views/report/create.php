<h3 align="center">Buat Laporan</h3>
<ul>
	<form id="form-report">
		<pre>
    <label for="fr-foto">Foto Orang Hilang </label>
    <input type="file" accept="image/*" id="fr-foto" name="photo" placeholder="Masukan Foto" required><br>
    <label for="fr-name">Nama Orang Hilang </label>
    <input type="text" id="fr-name" class="itext" name="name" placeholder="Masukan Nama"><br>
    <label for="fr-umur">Umur Orang Hilang </label>
    <input type="number" id="fr-umur" class="itext" name="age" placeholder="Masukan Umur"><br>
    <label for="fr-date">Tanggal Mulai Hilang  </label>
    <input  type="date" id="fr-date" class="itext" name="lost_date" placeholder="Masukan Tanggal Hilang" required><br>
    <label for="fr-ket">Keterangan Orang Hilang</label>
    <textarea name="description" id="fr-ket" class="itext" cols="30" rows="10"></textarea><br>
    <input onclick="create_report()" type="button" value=" Kirim ">
    </pre>
	</form>
