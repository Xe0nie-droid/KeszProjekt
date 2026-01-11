const form = document.getElementById("addForm");
const msgBox = document.getElementById("msgBox");
const clearBtn = document.getElementById("clear");

function showMsg(text, type = "ok") {
    msgBox.textContent = text;
    msgBox.className = "msg " + type;

    setTimeout(() => {
        msgBox.textContent = "";
        msgBox.className = "msg";
    }, 3000);
}

// KÜLDÉS
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("report.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(text => {
        if (text.includes("Sikeres")) {
            showMsg("✅ Sikeres felvétel", "ok");
            form.reset();
        } else {
            showMsg("❌ " + text, "err");
        }
    })
    .catch(() => {
        showMsg("❌ Szerver hiba", "err");
    });
});

