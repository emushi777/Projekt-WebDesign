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

    // Profile dropdown
    const profileBtn = document.getElementById('profile-btn');
    const profileDropdown = document.getElementById('profile-dropdown');

    if(profileBtn){
        profileBtn.addEventListener('click', function(e){
            if(!isLoggedIn){
                window.location.href = 'login.php';
            } 
            else{
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            }
        });
    }

    document.addEventListener('click', function() {
        if(profileDropdown){
            profileDropdown.classList.remove('active');
        }
    });
};