function salert() {
    const mycomp = document.getElementsByClassName("form-control");
    var valid = false;
    console.log(mycomp);
    for (i = 0; i < mycomp.length; i++) {
        if (mycomp[i].value == "") {
            valid = true;
            break;
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

function filecheck() {
    const fileInput = document.getElementById("fileform");
    var filePath = fileInput.value;
    var allowedExtensions = /(\.pdf)$/i;
    if (!allowedExtensions.exec(filePath)) {
        Swal.fire({
            icon: "error",
            title: "Maaf",
            text: "Format File Tidak Didukung",
        });
        fileInput.value = "";
        return false;
    } else if (fileInput.files[0].size / 1024 > 1024) {
        Swal.fire({
            icon: "error",
            title: "Maaf",
            text: "Ukuran Terlalu Besar",
        });
        fileInput.value = "";
        return false;
    }
}

function salert1(params) {
    const mycomp = document.getElementsByClassName("form-control " + params);
    console.log(mycomp);
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
                    document.getElementById("forminput" + params).submit();
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
    const d = new Date();
    const today = moment(d.getTime()).format("YYYY-MM-DD HH:mm:ss");
    document.getElementById("ambil_tanggal" + params).value = today;
    document.getElementById("headertgl" + params).innerHTML =
        '<i class="fas fa-calendar me-1"></i> ' + today;
}

function setdatetoday2() {
    const d = new Date();
    const today = moment(d.getTime()).format("YYYY-MM-DD HH:mm:ss");
    document.getElementById("ambil_tanggalx").value = today;
    document.getElementById("headertglx").innerHTML =
        '<i class="fas fa-calendar me-1"></i> ' + today;
}
