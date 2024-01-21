<h3 align="center">Detail</h3>
<!-- jika ada menampilkan data -->
<?php if ($data) : ?>
    <div>

        <div style="display: flex;">
            <?php if (loggedIn()) : ?>
                <?php if ($this->session->id == $data['user_id']) : ?>
                    <div class="delete" data-id="<?= $data['id'] ?>" onclick="hapus(this)">Hapus</div>
                <?php endif; ?>
            <?php endif ?>
            <div class="time"><?= $data['created_at'] ?></div>
        </div>
        <img class="user-image" align="middle" src="<?= base_url() ?>/images/user/<?= $data['photo'] ?>" alt="Foto <?= $data['name'] ?>">
        <div class="detail">
            <p>
                Nama : <?= $data['name'] ?><br>
                Umur : <?= $data['age'] ?> Tahun<br>
                Tanggal Hilang : <?= $data['lost_date'] ?><br>
            </p>
        </div>
        <div class="ket">
            <?= $data['description'] ?>
        </div>
    </div>
    <!-- jika data tidak ada, maka hasilnya seperti ini -->
<?php else : ?>
    <p>Orang Tidak Ditemukan</p>
<?php endif ?>