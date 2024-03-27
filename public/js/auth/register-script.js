const nama = document.getElementById("name");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password_confirmation = document.getElementById("password_confirmation");
const button = document.querySelector(".next");

function checkAndChangeButtonColor(
    userName,
    userEmail,
    userPassword,
    userPasswordConf
) {
    const isName = userName.length > 1;

    const isEmailValid =
        userEmail.includes("@gmail.com") ||
        userEmail.includes("@yahoo.com") ||
        userEmail.includes("@sipinjam.com");

    const isPasswordValid = userPassword.length > 6;
    const isPasswordConfValid = userPasswordConf.length > 6;

    if (isName && isEmailValid && isPasswordValid && isPasswordConfValid) {
        button.removeAttribute("disabled");
        button.style.backgroundColor = "#5465ff";
        button.style.color = "white";
        button.style.cursor = "pointer";
        button.style.transitionDuration = "300ms";

        button.addEventListener("mouseover", function () {
            button.style.backgroundColor = "rgba(84, 101, 255, 0.8)";
        });

        button.addEventListener("mouseout", function () {
            button.style.backgroundColor = "#5465ff";
        });
    } else {
        button.setAttribute("disabled", true);
        button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
        button.style.color = "rgba(0, 0, 0, 0.5)";
        button.style.cursor = "not-allowed";

        button.addEventListener("mouseover", function () {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
        });

        button.addEventListener("mouseout", function () {
            button.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
        });
    }
}

nama.addEventListener("input", function (event) {
    const nameValue = event.target.value;
    checkAndChangeButtonColor(
        nameValue,
        email.value,
        password.value,
        password_confirmation.value
    );
});

email.addEventListener("input", function (event) {
    const emailValue = event.target.value;
    checkAndChangeButtonColor(
        nama.value,
        emailValue,
        password.value,
        password_confirmation.value
    );
});

password.addEventListener("input", function (event) {
    const passwordValue = event.target.value;
    checkAndChangeButtonColor(
        nama.value,
        email.value,
        passwordValue,
        password_confirmation.value
    );
});

password_confirmation.addEventListener("input", function (event) {
    const passwordConfValue = event.target.value;
    checkAndChangeButtonColor(
        nama.value,
        email.value,
        password.value,
        passwordConfValue
    );
});

// =========================================\

const nik = document.getElementById("nik");
const no_telp = document.getElementById("no_telp");
const nama_instansi = document.getElementById("nama_instansi");
const nama_organisasi = document.getElementById("nama_organisasi");
const instansi = document.getElementById("instansi_id");
const buttonRegister = document.querySelector(".btn-submit");

function checkAndChangeButtonColorStep(
    userNik,
    userNoTelp,
    userNamaOrganisasi,
    userInstansi
) {
    const isNik = userNik.length > 1;
    const isNoTelp = userNoTelp.length > 1;
    const isNamaOrganisasi = userNamaOrganisasi.length > 0;
    const isInstansi = userInstansi.length > 0;

    if (isNik && isNoTelp && isNamaOrganisasi && isInstansi) {
        buttonRegister.removeAttribute("disabled");
        buttonRegister.style.backgroundColor = "#5465ff";
        buttonRegister.style.color = "white";
        buttonRegister.style.cursor = "pointer";
        buttonRegister.style.transitionDuration = "300ms";

        buttonRegister.addEventListener("mouseover", function () {
            buttonRegister.style.backgroundColor = "rgba(84, 101, 255, 0.8)";
        });

        buttonRegister.addEventListener("mouseout", function () {
            buttonRegister.style.backgroundColor = "#5465ff";
        });
    } else {
        buttonRegister.setAttribute("disabled", true);
        buttonRegister.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
        buttonRegister.style.color = "rgba(0, 0, 0, 0.5)";
        buttonRegister.style.cursor = "not-allowed";

        buttonRegister.addEventListener("mouseover", function () {
            buttonRegister.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
        });

        buttonRegister.addEventListener("mouseout", function () {
            buttonRegister.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
        });
    }
}

nik.addEventListener("input", function (event) {
    const nikValue = event.target.value;
    checkAndChangeButtonColorStep(
        nikValue,
        instansi.value,
        no_telp.value,
        nama_organisasi.value
    );
});

no_telp.addEventListener("input", function (event) {
    const noTelpValue = event.target.value;
    checkAndChangeButtonColorStep(
        nik.value,
        instansi.value,
        noTelpValue,
        nama_organisasi.value
    );
});

nama_organisasi.addEventListener("input", function (event) {
    const namaOrganisasiValue = event.target.value;
    checkAndChangeButtonColorStep(
        nik.value,
        instansi.value,
        no_telp.value,
        namaOrganisasiValue
    );
});

instansi.addEventListener("input", function (event) {
    const instansiValue = event.target.value;
    checkAndChangeButtonColorStep(
        nik.value,
        instansiValue,
        no_telp.value,
        nama_organisasi.value
    );
});
