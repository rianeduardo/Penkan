document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openCreateCard');
    const modal = document.getElementById('createCardModal');
    const closeBtn = document.getElementById('closeCreateCard');
    if (openBtn && modal) {
        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'block';
        });
    }
    if (closeBtn && modal) {
        closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'none';
        });
    }
    window.addEventListener('click', function (e) {
        if (e.target === modal) modal.style.display = 'none';
    });
});
