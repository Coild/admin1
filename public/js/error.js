var invalidChars = [
    "-",
    "+",
    "e",
    "E",
    ",",
];

var inputBox = document.getElementById("inputnumber");
inputBox.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox2 = document.getElementById("inputnumber2");
inputBox2.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox3 = document.getElementById("inputnumber3");
inputBox3.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox4 = document.getElementById("inputnumber4");
inputBox4.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox5 = document.getElementById("inputnumber5");
inputBox5.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox6 = document.getElementById("inputnumber6");
inputBox6.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox7 = document.getElementById("inputnumber7");
inputBox7.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox8 = document.getElementById("inputnumber8");
inputBox8.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox9 = document.getElementById("inputnumber9");
inputBox9.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox10 = document.getElementById("inputnumber10");
inputBox10.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox11 = document.getElementById("inputnumber11");
inputBox11.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});
var inputBox12 = document.getElementById("inputnumber12");
inputBox12.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox13 = document.getElementById("inputnumber13");
inputBox13.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox14 = document.getElementById("inputnumber14");
inputBox14.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox15 = document.getElementById("inputnumber15");
inputBox15.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox16 = document.getElementById("inputnumber16");
inputBox16.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

var inputBox17 = document.getElementById("inputnumber17");
inputBox17.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});

function validatePassword(params) {
    const mycomp = document.getElementsByClassName("form-control " + params);
    const pass1 = document.getElementsByClassName("form-control " + params + " pass1");
    const pass2 = document.getElementsByClassName("form-control " + params + " pass2");
    // console.log("pass " + pass1[0].value + " " + pass2[0].value);
    // console.log("length "+pass1.length + " "+pass2.length);
    var valid = false;
    var pesan = "";
    var errors = [];
    for (i = 0; i < mycomp.length; i ++) {
        console.log(mycomp[i].value);
        if (mycomp[i].value.length > 200) {
            pesan = "Data terlalu panjang";
            break;
        }
        if (mycomp[i].value == "") {
            valid = true;
            break;
        }
    }
    if (valid) {
        valid = false;

        Swal.fire({icon: "error", title: "Data tidak sesuai", text: "Sebagian Data Kosong!"});

    } else if (pesan != "") {
        Swal.fire({icon: "error", title: "Tidak Valid", text: pesan});
    } else {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        if (!(pass1[0].value === pass2[0].value)) {
            Swal.fire({icon: "error", title: "Password", text: "Password tidak sama"});
        } else if (pass1[0].value == pass2[0].value) {
            if (pass1[0].value.length < 8) {
                errors.push("Password kurang dari 8 karakter");
            }
            if (pass1[0].value.search(/[a-z]/g) < 0) {
              console.log('kecil');
                errors.push("password minimal mengandung sebuah huruf kecil");
            }
            if (pass1[0].value.search(/[A-Z]/g) < 0) {
              console.log('besar');
                errors.push("password minimal mengandung sebuah huruf besar");
            }
            if (pass1[0].value.search(/[0-9]/) < 0) {
                errors.push("password minimal mengandung satu digit angka");
            }
            if (errors.length > 0) { // alert(errors.join("\n"));
              console.log(errors);
                Swal.fire({icon: "error", title: "Password", text: errors});
            } else {
                console.log("simpan");
                swalWithBootstrapButtons.fire({
                    title: "Apakah data sudah benar?",
                    text: "Data yang sudah disimpan dapat diubah!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Simpan",
                    cancelButtonText: "Batal",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("forminput" + params).submit();
                        swalWithBootstrapButtons.fire("Tersimpan!", "Data pegawai berhasil disimpan.", "success");
                    } else if (
                        /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire("Dibatalkan", "Silahkan tinjau kembali data yang dimasukkan :)", "error");
                    }
                });
            }
        }
    }
}

function resetPassword(params) {
    const mycomp = document.getElementsByClassName("form-control " + params);
    // console.log("pass " + pass1[0].value + " " + pass2[0].value);
    // console.log("length "+pass1.length + " "+pass2.length);
    var valid = false;
    pesan = "";
    var errors = [];
    console.log(mycomp[0].value);
    if (mycomp[0].value.length > 200) {
        pesan = "Data terlalu panjang";
    }
    if (mycomp[0].value == "") {
        valid = true;
    }

    if (valid) {
        valid = false;
        Swal.fire({icon: "error", title: "Data tidak sesuai", text: "Sebagian Data Kosong!"});

    } else if (pesan != "") {
        Swal.fire({icon: "error", title: "Tidak Valid", text: pesan});
    } else {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        if (mycomp[0].value.length < 8) {
            errors.push("Password kurang dari 8 karakter");
        }
        if (mycomp[0].value.search(/[a-z]/g) < 0) {
          if (mycomp[0].value.search(/[A-Z]/g) < 0) {
            errors.push("password minimal mengandung sebuah huruf kecil, besar");
          } else {
            errors.push("password minimal mengandung sebuah huruf kecil");
          }
            
        }
        if (mycomp[0].value.search(/[A-Z]/g) < 0) {
            errors.push("password minimal mengandung sebuah huruf besar");
        }
        if (mycomp[0].value.search(/[0-9]/) < 0) {
            errors.push("password minimal mengandung satu digit angka");
        }
        if (errors.length > 0) { // alert(errors.join("\n"));
            Swal.fire({icon: "error", title: "Password", text: errors});
        } else {
            console.log("simpan");
            swalWithBootstrapButtons.fire({
                title: "Apakah data sudah benar?",
                text: "Data yang sudah disimpan dapat diubah!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("forminput" + params).submit();
                    swalWithBootstrapButtons.fire("Tersimpan!", "Data pegawai berhasil disimpan.", "success");
                } else if (
                    /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire("Dibatalkan", "Silahkan tinjau kembali data yang dimasukkan :)", "error");
                }
            });
        }

    }
}
