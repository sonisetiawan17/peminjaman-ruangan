let currentStep = 1;

function showStep(step) {
    document.querySelectorAll(".step").forEach((s) => {
        s.style.display = "none";
    });
    document.querySelector(`.step${step}`).style.display = "block";

    document.getElementById("prevBtn").disabled = step === 1;
    document.getElementById("nextBtn").style.display =
        step === 2 ? "none" : "inline";
    document.getElementById("submitBtn").style.display =
        step === 2 ? "inline" : "none";
}

function nextStep() {
    if (currentStep < 2) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

showStep(currentStep);

// ==============================================

const nama = document.getElementById("name");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password_confirmation = document.getElementById("password_confirmation");
const button = document.getElementById("nextBtn");

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
const alamat = document.getElementById("alamat");
const nama_organisasi = document.getElementById("nama_organisasi");
const instansi = document.getElementById("instansi");
const buttonRegister = document.getElementById("submitBtn");

// function checkAndChangeButtonColor(
//     userNik,
//     userNoTelp,
//     userAlamat,
//     userNamaOrganisasi,
//     userInstansi
// ) {
//     const userNik = userNik.length > 15;
//     const userNoTelp = userNoTelp.length > 10;
//     const userAlamat = userAlamat.length > 6;
//     const userNamaOrganisasi = userNamaOrganisasi.length > 0;
//     const userInstansi = userInstansi.length > 0;

//     if (
//         userNik &&
//         userNoTelp &&
//         userAlamat &&
//         userNamaOrganisasi &&
//         userInstansi
//     ) {
//         buttonRegister.style.backgroundColor = "#5465ff";
//         buttonRegister.style.color = "white";
//         buttonRegister.style.cursor = "pointer";
//         buttonRegister.style.transitionDuration = "300ms";

//         buttonRegister.addEventListener("mouseover", function () {
//             buttonRegister.style.backgroundColor = "rgba(84, 101, 255, 0.8)";
//         });

//         buttonRegister.addEventListener("mouseout", function () {
//             buttonRegister.style.backgroundColor = "#5465ff";
//         });
//     } else {
//         buttonRegister.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
//         buttonRegister.style.color = "rgba(0, 0, 0, 0.5)";
//         buttonRegister.style.cursor = "not-allowed";

//         buttonRegister.addEventListener("mouseover", function () {
//             buttonRegister.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
//         });

//         buttonRegister.addEventListener("mouseout", function () {
//             buttonRegister.style.backgroundColor = "rgba(44, 62, 80, 0.1)";
//         });
//     }
// }

nik.addEventListener("input", function (event) {
    const nikValue = event.target.value;
    checkAndChangeButtonColor(
        nikValue,
        no_telp.value,
        alamat.value,
        nama_organisasi.value,
        instansi.value
    );
});

no_telp.addEventListener("input", function (event) {
    const noTelpValue = event.target.value;
    checkAndChangeButtonColor(
        nik.value,
        noTelpValue,
        alamat.value,
        nama_organisasi.value,
        instansi.value
    );
});

alamat.addEventListener("input", function (event) {
    const alamatValue = event.target.value;
    checkAndChangeButtonColor(
        nik.value,
        no_telp.value,
        alamatValue,
        nama_organisasi.value,
        instansi.value
    );
});

nama_organisasi.addEventListener("input", function (event) {
    const namaOrganisasiValue = event.target.value;
    checkAndChangeButtonColor(
        nik.value,
        no_telp.value,
        alamatValue,
        namaOrganisasiValue,
        instansi.value
    );
});

instansi.addEventListener("input", function (event) {
    const instansiValue = event.target.value;
    checkAndChangeButtonColor(
        nik.value,
        no_telp.value,
        alamatValue,
        nama_organisasi.value,
        instansiValue
    );
});
