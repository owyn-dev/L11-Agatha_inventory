(function () {
    const THEME_KEY = "theme";

    // Fungsi untuk mengatur tema
    function setTheme(theme, persist = false) {
        // Setel atribut tema pada elemen root HTML
        document.documentElement.setAttribute("data-bs-theme", theme);

        // Jika persist true, simpan tema di localStorage
        if (persist) {
            localStorage.setItem(THEME_KEY, theme);
        }
    }

    // Fungsi untuk inisialisasi tema
    function initTheme() {
        const storedTheme = localStorage.getItem(THEME_KEY);

        if (storedTheme) {
            setTheme(storedTheme);  // Terapkan tema yang disimpan
        } else {
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
            const defaultTheme = prefersDark ? "dark" : "light";
            setTheme(defaultTheme, true);  // Terapkan tema default jika tidak ada yang disimpan
        }
    }

    // Fungsi untuk menerapkan ulang tema saat Livewire melakukan pembaruan
    function reapplyTheme() {
        const storedTheme = localStorage.getItem(THEME_KEY) || "light";
        setTheme(storedTheme);  // Terapkan tema yang disimpan di localStorage
    }

    // Fungsi untuk mengubah tema saat tombol diklik
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute("data-bs-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        setTheme(newTheme, true);  // Simpan perubahan tema di localStorage
    }

    // Inisialisasi tema ketika halaman dimuat pertama kali
    window.addEventListener("DOMContentLoaded", initTheme);

    // Pastikan tema diterapkan saat Livewire pertama kali dimuat
    document.addEventListener("livewire:load", initTheme);
    document.addEventListener("livewire:navigate", reapplyTheme);

    // Event listener untuk tombol toggle tema
    const themeToggleButton = document.getElementById("theme-toggle");
    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah navigasi default dari anchor
            toggleTheme();  // Panggil fungsi untuk mengubah tema
        });
    }
})();
