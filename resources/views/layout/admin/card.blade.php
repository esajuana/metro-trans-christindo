<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Transaksi</p>
                    <h6 class="mb-0">{{ number_format($transaksi, 0, ',', '.')}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-car fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Mobil</p>
                    <h6 class="mb-0">{{ $mobil }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">User</p>
                    <h6 class="mb-0">{{ $user }}</h6>
                </div>
            </div>
        </div>

        {{-- <!-- Card Kalender Penyewaan -->
        <div class="col-12">
            <div class="bg-light rounded p-4">
                <h6 class="mb-4">Kalender Penyewaan Mobil</h6>
                <div id="calendar"></div>
            </div>
        </div> --}}
    </div>
</div>

{{-- <script>
   document.addEventListener('DOMContentLoaded', function() {
    var checkFullCalendar = setInterval(function() {
        if (typeof FullCalendar !== 'undefined') {
            clearInterval(checkFullCalendar);

            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error("Element #calendar tidak ditemukan!");
                return;
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                events: "{{ route('admin.kalender.data') }}",
                eventDidMount: function(info) {
                    console.log("Event Loaded:", info.event);
                }
            });

            calendar.render();
        } else {
            console.log("Menunggu FullCalendar...");
        }
    }, 500);
});

</script> --}}


    