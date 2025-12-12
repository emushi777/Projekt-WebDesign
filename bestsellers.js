window.onload = () => {
    const notifBtn = document.getElementById('notif-btn');
    const notifList = document.getElementById('notif-list');

    if (!notifBtn || !notifList) return;

    notifBtn.addEventListener('click', (e) => {
        e.stopPropagation(); 
        notifList.classList.toggle('show'); 
    });

    document.addEventListener('click', () => {
        notifList.classList.remove('show'); 
    });
};