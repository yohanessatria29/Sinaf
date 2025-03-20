<div class="card">
    <div class="card-header">
        <strong>Nama Verifikator: </strong> Anu
    </div>
    <div class="card-body">
        <form role="form" method="post" class="login-form" name="form_valdation">
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Pilih BAB</label>
                </div>
                <div class="col-lg-8 col-6">
                    <?=form_dropdown('bab', dropdown_sina_ep(6), $bab, 'id="bab" class="form-select" required');?>
                </div>
                <div class="col-lg-2 col-3">
                    <button type="submit" class="btn btn-success w-100">Cari</button>
                </div>
            </div>
        </form>

        <table class="table table-striped display text-center" id="table_ep">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bab</th>
                    <th>Standar</th>
                    <th>Kriteria</th>
                    <th>Elemen Penilaian</th>
                    <th>Uraian</th>
                    <th>Skor Capaian Surveior</th>
                    <th>Skor Maksimal</th>
                    <th>Persentase Capaian Surveior</th>
                    <th>Fakta Dan Analisis</th>
                    <th>Rekomendasi Hasil Survei</th>
                    <th>Skor Capaian Verifikator</th>
                    <th>Persentase Capaian Verifikator</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<link rel="stylesheet" href="<?php echo base_url('assets/temp');?>/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url('assets/temp');?>/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/buttons.flash.min.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/jszip.min.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/temp/js_x');?>/buttons.print.min.js"></script>

<script>
    $( window ).on( "load", function() {
        $('.nav-item').find('a.active').removeClass('active');
        document.getElementById("elemen-tab").classList.add('active');
    });

    $( document ).ready(function() {
        $('#table_ep').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "scrollX": true
        });
    })
</script>