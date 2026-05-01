function showSection(sectionID) {
    document.querySelectorAll('.content, .homecontent')
        .forEach(section => section.style.display = 'none');

    const activeSection = document.getElementById(sectionID);
    if (activeSection) {
        activeSection.style.display = 'block';
    }

    document.querySelectorAll('.navbarbuttons')
        .forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('onclick').includes(sectionID)) {
                btn.classList.add('active');
            }
        });
}

function navigateSection(sectionID) {
    const url = new URL(window.location);
    url.searchParams.set('section', sectionID);
    window.history.pushState({}, '', url);

    showSection(sectionID);
}

window.onload = function () {
    const params = new URLSearchParams(window.location.search);
    const section = params.get('section') || defaultSection || 'home';
    showSection(section);

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');

        if (toast) {
            toast.classList.remove('toast-hidden');

            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => {
                    toast.classList.add('toast-hidden');
                    toast.style.opacity = '1';
                }, 500);
            }, 3000);
        }

        window.history.replaceState({}, document.title, window.location.pathname);
    }

    const clearBtn = document.getElementById('clrbtn');
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            const form = clearBtn.closest('form');
            if (form) form.reset();
        });
    }

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#studentTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }

    const deleteForm = document.querySelector('#delete form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this student?')) {
                e.preventDefault();
            }
        });
    }
};

window.onpopstate = function () {
    const params = new URLSearchParams(window.location.search);
    const section = params.get('section') || 'home';
    showSection(section);
};