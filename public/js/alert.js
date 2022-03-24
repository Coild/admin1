function salert() {
    const mycomp = document.getElementsByClassName("form-control");
    var valid = false;
    for (i = 0; i < mycomp.length; i++) {
        if (mycomp[i].value == "") {
            valid = true;
        }
    }
    if (valid) {
        valid = false;
        Swal.fire({
            icon: "error",
            title: "Tidak Valid",
            text: "Sebagian Data Kosong!",
        });
    } else {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: "Apakah data sudah benar?",
                text: "Data yang sudah disimpan tidak dapat dirubah!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("forminput").submit();
                    swalWithBootstrapButtons.fire(
                        "Tersimpan!",
                        "Data berhasil disimpan.",
                        "success"
                    );
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        "Dibatalkan",
                        "Silahkan tinjau kembali data yang dimasukkan :)",
                        "error"
                    );
                }
            });
    }
}
function salert1(params) {
    let cek;
    if (params == 1) {
        cek = "1";
    } else if (params == 2) {
        cek = "2";
    } else if (params == 3) {
        cek = "3";
    }
    const mycomp = document.getElementsByClassName("form-control " + cek);
    var valid = false;
    console.log(mycomp);
    for (i = 0; i < mycomp.length; i++) {
        if (mycomp[i].value == "") {
            valid = true;
        }
    }
    if (valid) {
        valid = false;
        Swal.fire({
            icon: "error",
            title: "Tidak Valid",
            text: "Sebagian Data Kosong!",
        });
    } else {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: "Apakah data sudah benar?",
                text: "Data yang sudah disimpan tidak dapat dirubah!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("forminput" + cek).submit();
                    swalWithBootstrapButtons.fire(
                        "Tersimpan!",
                        "Data berhasil disimpan.",
                        "success"
                    );
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        "Dibatalkan",
                        "Silahkan tinjau kembali data yang dimasukkan :)",
                        "error"
                    );
                }
            });
    }
}

function setdatetoday() {
    const d = new Date();
    const today = moment(d.getTime()).format("YYYY-MM-DD HH:mm:ss");
    document.getElementById("ambil_tanggal").value = today;
    document.getElementById("headertgl").innerHTML =
        '<i class="fas fa-calendar me-1"></i> ' + today;
}

function setdatetoday1(params) {
    let cek;
    if (params == 1) {
        cek = "1";
    } else if (params == 2) {
        cek = "2";
    } else if (params == 3) {
        cek = "3";
    }
    const d = new Date();
    const today = moment(d.getTime()).format("YYYY-MM-DD HH:mm:ss");
    document.getElementById("ambil_tanggal" + cek).value = today;
    document.getElementById("headertgl" + cek).innerHTML =
        '<i class="fas fa-calendar me-1"></i> ' + today;
}
