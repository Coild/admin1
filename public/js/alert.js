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
                    if (params == 1) {
                        document.getElementById("forminput").submit();
                    } else if (params == 2) {
                    }
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
