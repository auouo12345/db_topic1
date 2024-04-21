function check() {
    var account = document.forms["register"]["account"].value;
    var password = document.forms["register"]["password"].value;
    var checkPassword = document.forms["register"]["checkPassword"].value;
    var name = document.forms["register"]["name"].value;
    var grade = document.forms["register"]["grade"].value;

    if (account.length !== 8) {
        alert("請輸入正確學號");
        return false;
    } else if (password.length === 0 || name.length === 0 || grade.length === 0) {
        alert("欄位不可為空")
        return false;
    } else if (password !== checkPassword) {
        alert("請確認密碼是否輸入正確");
        return false;
    }

    return true;
}
function goBack() {
    window.location.href = "index.html";
}

function updateTime() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const timeString = `${hours}<span class="unit">:</span>${minutes}<span class="unit"></span>`;
    document.querySelector('.clock .time').innerHTML = timeString;
}

updateTime(); // 頁面載入時更新時間
setInterval(updateTime, 1000); // 每秒更新一次時間

const clockFrame = document.querySelector('.clock .frame');
setInterval(() => {
    const hoursRotation = `rotate(calc((360deg / 12) * (new Date().getHours() % 12) + (360deg / 12) * (new Date().getMinutes() / 60)))`;
    const minutesRotation = `rotate(calc((360deg / 60) * new Date().getMinutes()))`;
    clockFrame.querySelector('.hour').style.transform = hoursRotation;
    clockFrame.querySelector('.minute').style.transform = minutesRotation;
}, 1000);