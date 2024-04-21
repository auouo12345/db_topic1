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