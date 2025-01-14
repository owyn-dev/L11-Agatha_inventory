(function () {
    const THEME_KEY = "theme";

    const body = document.body;
    const theme = localStorage.getItem(THEME_KEY);

    if (theme) {
        document.documentElement.setAttribute("data-bs-theme", theme);
    }
})();
