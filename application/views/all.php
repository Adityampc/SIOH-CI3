<h3 align="center">Berita</h3>
<ul>
    <?php if (count($result) == 0) : ?>
        Orang Tidak Ditemukan <?= $query ?>
    <?php endif ?>
    <?php foreach ($result as $r) : ?>
        <li>
            <div class="time"><?= $r['created_at'] ?></div>
            <img class="user-image" align="middle" src="<?= base_url() ?>/images/user/<?= $r['photo'] ?>" alt="Foto <?= $r['name'] ?>">
            <div class="detail">
                <p>
                    Nama : <?= $r['name'] ?><br>
                    Umur : <?= $r['age'] ?> Tahun<br>
                    Tanggal Hilang : <?= $r['lost_date'] ?><br>
                </p>
            </div>
            <div class="ket">
                <?= $r['description'] ?>
            </div>
        </li>

    <?php endforeach ?>
</ul>