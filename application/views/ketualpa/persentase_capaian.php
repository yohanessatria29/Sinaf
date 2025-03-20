<div class="card">
    <div class="card-body">
        <table class="table table-striped text-center" id="table_pc">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bab</th>
                    <th>Skor Capaian Surveior</th>
                    <th>Skor Maksimal Surveior</th>
                    <th>Persentase Capaian Surveior (%)</th>
                    <th>Skor Capaian Verifikator</th>
                    <th>Skor Maksimal Verifikator</th>
                    <th>Persentase Capaian Verifikator (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data_pc)) : ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">No data available in this table.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $( window ).on( "load", function() {
        $('.nav-item').find('a.active').removeClass('active');
        document.getElementById("persentase-tab").classList.add('active');
    });
</script>