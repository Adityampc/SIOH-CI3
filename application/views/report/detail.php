<h3 align="center">Detail</h3>
<?php if ($data) : ?>
    <ul>
        <li>
            <div class="time"><?= $data['created_at'] ?></div>
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
        </li>
    </ul>
<?php else : ?>
    <p>Orang Tidak Ditemukan</p>
<?php endif ?>