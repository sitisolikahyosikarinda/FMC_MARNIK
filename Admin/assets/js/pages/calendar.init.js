document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        // Konfigurasi kalender
        plugins: ['dayGrid'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {
            // Panggil endpoint PHP untuk mengambil data dari database
            url: 'apps-calendar.php',
            method: 'GET'
        }
    });

    calendar.render();

    // Setelah halaman dimuat, ambil data events dan tambahkan ke dalam kalender
    function fetchEvents() {
        return new Promise(function(resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'apps-calendar.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    resolve(JSON.parse(xhr.responseText));
                } else {
                    reject(xhr.statusText);
                }
            };
            xhr.onerror = function() {
                reject(xhr.statusText);
            };
            xhr.send();
        });
    }

    document.getElementById('form-event').addEventListener('submit', function (ev) {
        ev.preventDefault();

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add-event.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Jika data berhasil disimpan, perbarui tampilan kalender
                    fetchEvents().then(function(events) {
                        // Hapus semua event yang ada
                        calendar.getEvents().forEach(function(event) {
                            event.remove();
                        });
                        // Tambahkan event baru
                        events.forEach(function(eventData) {
                            calendar.addEvent(eventData);
                        });
                        // Render ulang kalender
                        calendar.render();
                    }).catch(function(error) {
                        console.error('Error fetching events:', error);
                    });
                } else {
                    console.error('Gagal menyimpan event ke dalam database:', response.error);
                }
            } else {
                console.error('Terjadi kesalahan saat menyimpan event ke dalam database.');
            }
        };
        xhr.send(formData);
    });
});
