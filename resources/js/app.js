import './bootstrap';

// ============================================================
// LOGIN PAGE — Toggle Password + Loading State
// ============================================================
function initLoginPage() {
    const toggleBtn = document.getElementById('togglePassword');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                `;
            }
        });
    }

    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="inline-block w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                <span>Memverifikasi...</span>
            `;
        });
    }
}

// ============================================================
// SIDEBAR MOBILE TOGGLE
// ============================================================
function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const toggle  = document.getElementById('menuToggle');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !toggle || !overlay) return;

    const openSidebar = () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
        });
        document.body.style.overflow = 'hidden';
    };

    const closeSidebar = () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    };

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.contains('-translate-x-full') ? openSidebar() : closeSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });

    let lastWidth = window.innerWidth;
    window.addEventListener('resize', () => {
        const width = window.innerWidth;
        if (width >= 1024 && lastWidth < 1024) closeSidebar();
        lastWidth = width;
    });
}

// ============================================================
// DROPDOWN ACTIONS (⋮)
// ============================================================
function initDropdowns() {
    document.querySelectorAll('[data-dropdown-toggle]').forEach((toggle) => {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const wrapper = toggle.closest('[data-dropdown]');
            const menu    = wrapper?.querySelector('[data-dropdown-menu]');
            if (!menu) return;

            document.querySelectorAll('[data-dropdown-menu]').forEach((m) => {
                if (m !== menu) m.classList.add('hidden');
            });

            menu.classList.toggle('hidden');
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('[data-dropdown]')) {
            document.querySelectorAll('[data-dropdown-menu]').forEach((m) => m.classList.add('hidden'));
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('[data-dropdown-menu]').forEach((m) => m.classList.add('hidden'));
        }
    });
}

// ============================================================
// MODAL KONFIRMASI HAPUS
// ============================================================
function initConfirmDelete() {
    const modal     = document.getElementById('modalHapus');
    const form      = document.getElementById('formHapus');
    const namaEl    = document.getElementById('confirmUserName');
    const hapusBtns = document.querySelectorAll('[data-hapus-toggle]');
    const closeBtns = document.querySelectorAll('[data-close-confirm]');

    if (!modal || !form) return;

    const openModal = (url, nama) => {
        form.action = url || '';
        if (namaEl) namaEl.textContent = nama || 'pengguna ini';

        document.querySelectorAll('[data-dropdown-menu]').forEach((m) => m.classList.add('hidden'));

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    };

    hapusBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            openModal(btn.dataset.hapusUrl, btn.dataset.hapusNama);
        });
    });

    closeBtns.forEach((b) => b.addEventListener('click', closeModal));

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'flex') closeModal();
    });
}

// ============================================================
// USERS PAGE — Modal, Reset Password, Realtime Filter
// ============================================================
function initUsersPage() {
    const modal         = document.getElementById('modalUser');
    const modalTitle    = document.getElementById('modalUserTitle');
    const form          = document.getElementById('formUser');
    const formMethod    = document.getElementById('formMethodUser');
    const btnTambah     = document.getElementById('btnTambahUser');
    const closeButtons  = document.querySelectorAll('[data-close-modal-user]');

    const inputNama     = document.getElementById('inputNamaUser');
    const inputEmail    = document.getElementById('inputEmailUser');
    const inputPassword = document.getElementById('inputPasswordUser');
    const inputPasswordConfirm = document.getElementById('inputPasswordConfirm');
    const inputRole     = document.getElementById('inputRoleUser');
    const passwordHint  = document.getElementById('passwordHint');

    const modalReset    = document.getElementById('modalResetPassword');
    const formReset     = document.getElementById('formResetPassword');
    const resetUserName = document.getElementById('resetUserName');
    const closeReset    = document.querySelectorAll('[data-close-modal-reset]');

    if (!modal || !form) return;

    function attachEditListeners() {
        document.querySelectorAll('[data-edit-toggle-user]').forEach((btn) => {
            btn.addEventListener('click', () => {
                try {
                    const data = JSON.parse(btn.dataset.user);
                    document.querySelectorAll('[data-dropdown-menu]').forEach((m) => m.classList.add('hidden'));
                    openModal('edit', data);
                } catch (err) {
                    console.error('Gagal parse data user:', err);
                }
            });
        });
    }

    function attachResetListeners() {
        document.querySelectorAll('[data-reset-toggle]').forEach((btn) => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('[data-dropdown-menu]').forEach((m) => m.classList.add('hidden'));
                openResetModal(btn.dataset.resetId, btn.dataset.resetNama);
            });
        });
    }

    function openModal(mode = 'create', data = null) {
        if (mode === 'edit' && data) {
            modalTitle.textContent = 'Edit Pengguna';
            if (formMethod) formMethod.value = 'PUT';
            form.action = `/pengguna/${data.id}`;

            inputNama.value  = data.name || '';
            inputEmail.value = data.email || '';
            inputRole.value  = data.role || 'user';

            inputPassword.value = '';
            inputPasswordConfirm.value = '';
            inputPassword.required = false;
            inputPasswordConfirm.required = false;
            if (passwordHint) passwordHint.textContent = '(kosongkan jika tidak diubah)';
        } else {
            modalTitle.textContent = 'Tambah Pengguna';
            if (formMethod) formMethod.value = 'POST';
            form.action = form.dataset.storeUrl || form.action;

            form.reset();
            inputPassword.required = true;
            inputPasswordConfirm.required = true;
            if (passwordHint) passwordHint.textContent = '';
        }

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        form.reset();
    }

    function openResetModal(id, nama) {
        if (formReset) formReset.action = `/pengguna/${id}/reset-password`;
        if (resetUserName) resetUserName.textContent = nama || 'pengguna ini';
        if (formReset) formReset.reset();

        modalReset.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeResetModal() {
        modalReset.style.display = 'none';
        document.body.style.overflow = '';
        if (formReset) formReset.reset();
    }

    btnTambah?.addEventListener('click', () => openModal('create'));
    closeButtons.forEach((b) => b.addEventListener('click', closeModal));
    closeReset.forEach((b) => b.addEventListener('click', closeResetModal));

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    modalReset?.addEventListener('click', (e) => {
        if (e.target === modalReset) closeResetModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        if (modal.style.display === 'flex') closeModal();
        if (modalReset?.style.display === 'flex') closeResetModal();
    });

    attachEditListeners();
    attachResetListeners();

    // ---------- Realtime Filter ----------
    const filterForm  = document.getElementById('userFilterForm');
    const container   = document.getElementById('userTableContainer');
    const overlay     = document.getElementById('tableLoadingOverlay');
    const searchInput = document.getElementById('searchUser');
    const filterRole  = document.getElementById('filterRole');
    const btnReset    = document.getElementById('btnResetFilterUser');

    if (!filterForm || !container) return;

    const ajaxUrl = filterForm.dataset.ajaxUrl || filterForm.action;
    let currentController = null;
    let debounceTimer = null;

    const showLoading = () => {
        if (overlay) overlay.style.display = 'flex';
        container.classList.add('opacity-50');
    };

    const hideLoading = () => {
        if (overlay) overlay.style.display = 'none';
        container.classList.remove('opacity-50');
    };

    function updateResetButton() {
        if (!btnReset) return;
        const hasFilter =
            (searchInput?.value || '').trim() !== '' ||
            (filterRole?.value || '') !== '';
        btnReset.classList.toggle('hidden', !hasFilter);
    }

    async function fetchUsers(params) {
        if (currentController) currentController.abort();
        currentController = new AbortController();

        showLoading();

        try {
            const url = new URL(ajaxUrl, window.location.origin);
            url.search = params.toString();

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                signal: currentController.signal,
            });

            if (!response.ok) throw new Error('Network error');

            const data = await response.json();
            container.innerHTML = data.html;

            const newUrl = ajaxUrl + (params.toString() ? '?' + params.toString() : '');
            window.history.pushState({}, '', newUrl);

            if (typeof initDropdowns === 'function')     initDropdowns();
            if (typeof initConfirmDelete === 'function') initConfirmDelete();

            attachEditListeners();
            attachResetListeners();
        } catch (err) {
            if (err.name !== 'AbortError') {
                console.error('Gagal fetch users:', err);
            }
        } finally {
            hideLoading();
        }
    }

    function applyFilter() {
        const params = new URLSearchParams();
        if (searchInput?.value) params.set('q', searchInput.value);
        if (filterRole?.value)  params.set('role', filterRole.value);

        const currentUrl = new URL(window.location.href);
        const sort      = currentUrl.searchParams.get('sort');
        const direction = currentUrl.searchParams.get('direction');
        if (sort)      params.set('sort', sort);
        if (direction) params.set('direction', direction);

        fetchUsers(params);
    }

    function debouncedApply() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(applyFilter, 300);
    }

    function resetFilter() {
        if (searchInput) searchInput.value = '';
        if (filterRole)  filterRole.value  = '';
        fetchUsers(new URLSearchParams());
        updateResetButton();
    }

    searchInput?.addEventListener('input', () => {
        updateResetButton();
        debouncedApply();
    });

    filterRole?.addEventListener('change', () => {
        updateResetButton();
        applyFilter();
    });

    btnReset?.addEventListener('click', resetFilter);

    filterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        applyFilter();
    });

    window.addEventListener('popstate', () => {
        const params = new URLSearchParams(window.location.search);
        if (searchInput) searchInput.value = params.get('q') || '';
        if (filterRole)  filterRole.value  = params.get('role') || '';
        updateResetButton();
        fetchUsers(params);
    });

    updateResetButton();
}

// ============================================================
// LAPORAN PAGE — Filter + Export Preview
// ============================================================
function initLaporanPage() {
    const filterForm = document.getElementById('laporanFilterForm');
    if (!filterForm) return;

    // Auto-submit saat tanggal / mobil / status berubah
    const autoSubmitSelectors = ['dari', 'sampai', 'mobil_id', 'status'];

    autoSubmitSelectors.forEach((id) => {
        const el = document.getElementById(id);
        if (!el) return;

        el.addEventListener('change', () => {
            filterForm.submit();
        });
    });

    // Tombol "Lihat Formulir" — buka di tab baru
    document.querySelectorAll('[data-laporan-show]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const url = btn.dataset.laporanShow;
            if (url) window.open(url, '_blank');
        });
    });

    // Tombol "Export PDF" / "Export Word" — konfirmasi dulu
    document.querySelectorAll('[data-export-action]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const type = btn.dataset.exportAction; // 'pdf' atau 'word'
            const nama = btn.dataset.exportNama || 'data';
            const url  = btn.dataset.exportUrl;

            if (!url) return;

            window.location.href = url;
        });
    });
}

// ============================================================
// MOBIL PAGE — CRUD + Upload Foto
// ============================================================
function initMobilPage() {
    const modal        = document.getElementById('modalMobil');
    const modalTitle   = document.getElementById('modalMobilTitle');
    const form         = document.getElementById('formMobil');
    const formMethod   = document.getElementById('formMethodMobil');
    const btnTambah    = document.getElementById('btnTambahMobil');
    const closeButtons = document.querySelectorAll('[data-close-modal-mobil]');
    const editButtons  = document.querySelectorAll('[data-edit-toggle-mobil]');

    const inputNama        = document.getElementById('inputNamaMobil');
    const inputPlat        = document.getElementById('inputPlatMobil');
    const inputMerk        = document.getElementById('inputMerkMobil');
    const inputTipe        = document.getElementById('inputTipeMobil');
    const inputTahun       = document.getElementById('inputTahunMobil');
    const inputKursi       = document.getElementById('inputKursiMobil');
    const inputTransmisi   = document.getElementById('inputTransmisiMobil');
    const inputBahanBakar  = document.getElementById('inputBahanBakarMobil');
    const inputWarna       = document.getElementById('inputWarnaMobil');
    const inputStatus      = document.getElementById('inputStatusMobil');
    const inputKondisi     = document.getElementById('inputKondisiMobil');

    // Upload foto
    const inputFoto        = document.getElementById('inputFotoMobil');
    const fotoPreview      = document.getElementById('fotoPreview');
    const fotoPlaceholder  = document.getElementById('fotoPlaceholder');

    if (!modal || !form) return;

    function resetFotoPreview() {
        if (fotoPreview) {
            fotoPreview.src = '';
            fotoPreview.classList.add('hidden');
        }
        if (fotoPlaceholder) fotoPlaceholder.classList.remove('hidden');
        if (inputFoto) inputFoto.value = '';
    }

    function setFotoPreview(src) {
        if (fotoPreview && fotoPlaceholder) {
            fotoPreview.src = src;
            fotoPreview.classList.remove('hidden');
            fotoPlaceholder.classList.add('hidden');
        }
    }

    inputFoto?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validasi ukuran
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file melebihi 2MB.');
            this.value = '';
            resetFotoPreview();
            return;
        }

        const reader = new FileReader();
        reader.onload = (ev) => setFotoPreview(ev.target.result);
        reader.readAsDataURL(file);
    });

    function openModal(mode = 'create', data = null) {
        if (mode === 'edit' && data) {
            modalTitle.textContent = 'Edit Mobil';
            if (formMethod) formMethod.value = 'PUT';
            form.action = `/mobil/${data.id}`;

            inputNama.value       = data.nama || '';
            inputPlat.value       = data.plat || '';
            inputMerk.value       = data.merk || '';
            inputTipe.value       = data.tipe || '';
            inputTahun.value      = data.tahun || '';
            inputKursi.value      = data.kursi || '';
            inputTransmisi.value  = data.transmisi || 'Manual';
            inputBahanBakar.value = data.bahan_bakar || '';
            inputWarna.value      = data.warna || '';
            inputStatus.value     = data.status || 'Tersedia';
            inputKondisi.value    = data.kondisi || 'Baik';

            if (data.foto) {
                setFotoPreview(`/storage/${data.foto}`);
            } else {
                resetFotoPreview();
            }
        } else {
            modalTitle.textContent = 'Tambah Mobil';
            if (formMethod) formMethod.value = 'POST';
            form.action = form.dataset.storeUrl || form.action;

            form.reset();
            inputTahun.value = new Date().getFullYear();
            inputKursi.value = 7;
            resetFotoPreview();
        }

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        form.reset();
        resetFotoPreview();
    }

    btnTambah?.addEventListener('click', () => openModal('create'));

    editButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            try {
                const data = JSON.parse(btn.dataset.mobil);
                openModal('edit', data);
            } catch (err) {
                console.error('Gagal parse data mobil:', err);
            }
        });
    });

    closeButtons.forEach((b) => b.addEventListener('click', closeModal));

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'flex') closeModal();
    });
}

// ============================================================
// COPY LINK — Global Helper (dipanggil dari onclick="copyLink(this)")
// ============================================================
window.copyLink = function (btn) {
    const url = btn?.dataset?.copyUrl;
    if (!url) {
        console.warn('copyLink: data-copy-url kosong');
        return;
    }

    const span = btn.querySelector('span');
    const originalText = span?.textContent || 'Copy Link';

    navigator.clipboard.writeText(url).then(() => {
        if (span) {
            span.textContent = '✓ Tersalin';
            setTimeout(() => {
                span.textContent = originalText;
            }, 2000);
        }
    }).catch((err) => {
        console.error('Gagal copy link:', err);
        alert('Gagal menyalin link. Silakan copy manual:\n' + url);
    });
};

// ============================================================
// AUTO INIT
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    initLoginPage();
    initSidebar();
    initDropdowns();
    initConfirmDelete();

    // Halaman spesifik
    if (document.getElementById('userFilterForm')) initUsersPage();
    if (document.getElementById('laporanFilterForm')) initLaporanPage();
    if (document.getElementById('modalMobil')) initMobilPage();
});
