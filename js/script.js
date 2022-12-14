"use strict"

load_news_list();
load_middle_content();

function load_news_list() {
    fetch('/all?limit=5&type=json')
        .then(response => response.json())
        .then(data => {
            let news_list = document.getElementById('new-report');
            let list = '';
            data.forEach(element => {
                list += `<li><a href="javascript:void(0)" title="${element.name} Umur ${element.age} Tahun" onclick="load_middle_content('/report/${element.id}')">${element.name} - ${element.age} Tahun</a></li>`;
            });
            if (list.length < 1) list = '<div style="text-align:center;"><strong>Tidak Ada Laporan</strong></div>';
            news_list.innerHTML = list;
        })
}
function load_middle_content(url = '/all') {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            let news_list = document.getElementById('middle-content');
            news_list.innerHTML = data;
        })
}

function create_report() {
    const formData = new FormData();
    const photo = document.querySelector('input[type="file"]');
    const itext = document.querySelectorAll('[class="itext"]');
    let err = false;
    itext.forEach(element => {
        if (element.value.length == 0) {
            err = true;
        }
        formData.append(element.name, element.value)
    });
    if (err) {
        alert("Mohon Isi Semua Kolom");
        return;
    }
    if (photo.files.length == 0) {
        alert('Mohon Masukkan Foto')
        return
    }
    formData.append('photo', photo.files[0])
    fetch('/report', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            if (result.statusCode == 200) {
                photo.value = '';
                itext.forEach(element => {
                    element.value = '';
                });
                load_news_list()
            }
        })
        .catch(error => {
            alert("Ada masalah saat memproses data")
        });
}

function hapus(el) {
    if (!confirm(`Hapus data ini?`)) return;
    fetch('/report/' + el.dataset.id, {
        method: 'DELETE',
    })
        .then(response => response.json())
        .then(result => {
            if (result.statusCode == 200) {
                el.parentElement.parentElement.remove();
                if (document.querySelectorAll('.list-orang').length < 1) {
                    load_middle_content();
                    load_news_list();
                }
            }
        })
        .catch(error => {
            alert("Ada masalah saat memproses data")
        });
}