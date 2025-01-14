// Fungsi untuk validasi form dengan menonaktifkan pengiriman form jika ada field yang kosong
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // ambil semua form yang ingin diterapkan fungsi validasi
        var forms = document.getElementsByClassName('needs-validation');
        // berikan keterangan pada form dan cegah pengiriman form
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();