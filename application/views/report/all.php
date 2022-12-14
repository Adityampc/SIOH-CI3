<h3 align="center">Berita</h3>
<div style="text-align: center;">
    <strong>
        <?php if (count($result) == 0) : ?>
            <?php if ($query) : ?>
                Orang Tidak Ditemukan <?= $query ?>
            <?php else : ?>
                Tidak Ada Laporan
            <?php endif ?>
        <?php endif ?>
    </strong>
</div>
<ul>
    <?php foreach ($result as $r) : ?>
        <li class="list-orang">
            <div style="display: flex;">
                <?php if (loggedIn()) : ?>
                    <?php if ($this->session->id == $r['user_id']) : ?>
                        <div class="delete" data-id="<?= $r['id'] ?>" onclick="hapus(this)">Hapus</div>
                    <?php endif; ?>
                <?php endif ?>
                <div class="time"><?= $r['created_at'] ?></div>
            </div>
            <div onclick="load_middle_content('/report/<?= $r['id'] ?>')" style="cursor:pointer">

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
            </div>
        </li>

    <?php endforeach ?>
</ul>