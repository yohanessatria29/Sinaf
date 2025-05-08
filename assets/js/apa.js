$(document).ready(function () {
	$(function () {
		$("#table1").DataTable();

		$(".select2").select2();
		$("[data-mask]").inputmask();
		$("#datepicker").datepicker({ autoclose: true });
	});

	$('[name="propinsi"]').change(function () {
		$("#kota_id").removeAttr("readonly"); //turns required off
		//  $('#kota_id').val('');

		$.ajax({
			url: "../pengajuan/dropdown5/" + $(this).val(),
			dataType: "json",
			type: "GET",
			success: function (data) {
				//
				// console.log(data);
				addOption($('[name="kota"]'), data, "id_kota", "nama_kota");
			},
		});
	});

	//  $('[name="kota"]').change(function() {
	//        $('#kecamatan').val('');
	//           $.ajax({
	//        url: "<?php echo site_url('register/dropdown6')?>/" + $('#propinsi').val()+"/"+ $(this).val(),
	//        dataType: "json",
	//        type: "GET",
	//        success: function(data) { //
	//       addOption($('[name="kecamatan"]'), data, 'id_camat', 'nama_camat');
	//        }
	//     });

	//  });

	function check() {
		if (
			document.getElementById("kata_sandi").value ===
			document.getElementById("kata_sandi_confirm").value
		) {
			document.getElementById("message").innerHTML =
				"<font color='green'>Password Sama</font>";
			document.getElementById("submit").disabled = false;
		} else {
			document.getElementById("message").innerHTML =
				"<font color='red'>Password Tidak Sama</font>";
			document.getElementById("submit").disabled = true;
		}
	}

	function addOption(ele, data, key, val) {
		//alert(data.length);
		$("option", ele).remove();

		ele.append(new Option("Pilih Kab Kota", ""));
		$(data).each(function (index) {
			//alert(eval('data[index].' + nama));
			ele.append(
				new Option(eval("data[index]." + val), eval("data[index]." + key))
			);
		});
	}

	function cekEmail(values, arrayEmail) {
		var str = arrayEmail;
		var res = str.split(",");
		res.forEach(myFunction);

		function myFunction(value, index, array) {
			if (values == value) {
				alert("Email Sudah Dipakai!");
				document.getElementById("exampleInputEmail1").value = "";
			}
		}
	}
});
