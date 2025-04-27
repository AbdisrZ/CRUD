document.addEventListener('DOMContentLoaded', function() {
    // Tangani penghapusan pasien
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            
            if (confirm('Apakah Anda yakin ingin menghapus pasien ini?')) {
                fetch('process/delete_pasien.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = 'index.php?success=Pasien berhasil dihapus';
                    } else {
                        alert('Gagal menghapus pasien: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus pasien');
                });
            }
        });
    });

    // Validasi form tambah pasien
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const phoneInput = this.querySelector('input[type="tel"]');
            if (phoneInput && !/^[0-9]{10,15}$/.test(phoneInput.value)) {
                e.preventDefault();
                alert('Nomor telepon harus terdiri dari 10-15 digit angka');
                phoneInput.focus();
            }
            
            const ageInput = this.querySelector('input[name="umur"]');
            if (ageInput && (ageInput.value < 0 || ageInput.value > 120)) {
                e.preventDefault();
                alert('Umur harus antara 0-120 tahun');
                ageInput.focus();
            }
        });
    });
});