/*!
    * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 



function buttonGantiPass(){
    // console.log(p);
    var link = "formGantiPass";
    
    if (grecaptcha.getResponse()) {
        // console.log(link);
        if (document.getElementById('inputEmail').value == '' || document.getElementById('inputPassword').value == '') {
            Swal.fire({
                title: "Oppss!",
                text: "Harap Isi Semua Form!",
                icon: "warning"
            });
        } else {
            Swal.fire({
                title: "Ganti Password?",
                text: "Yakin Ingin Mengganti Password?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ganti",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(link).submit();
                }
            });    
        }
        
    } else {
        document.getElementById("art").innerText =
            "Please complete the CAPTCHA.";
    }

}


window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

