function initDataTable(tableId) {
    const tableElement = document.getElementById(tableId);
    if (!tableElement) {
        console.error("Table with ID " + tableId + " not found.");
        return;
    }

    const headerRow = tableElement.querySelector("thead tr");
    if (!headerRow) {
        console.error("Table header not found.");
        return null;
    }

    let dataTable = new simpleDatatables.DataTable(tableElement);

    function adaptPageDropdown() {
        const selector = dataTable.wrapper.querySelector(".dataTable-selector");
        if (selector) {
            selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
            selector.classList.add("form-select");
        }
    }

    function adaptPagination() {
        const paginations = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list");

        for (const pagination of paginations) {
            pagination.classList.add(...["pagination", "pagination-primary"]);
        }

        const paginationLis = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list li");
        for (const paginationLi of paginationLis) {
            paginationLi.classList.add("page-item");
        }

        const paginationLinks = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list li a");
        for (const paginationLink of paginationLinks) {
            paginationLink.classList.add("page-link");
        }
    }

    const refreshPagination = () => {
        adaptPagination();
    };

    dataTable.on("datatable.init", () => {
        adaptPageDropdown();
        refreshPagination();
    });


    dataTable.on("datatable.update", refreshPagination);
    dataTable.on("datatable.sort", refreshPagination);

    dataTable.on("datatable.page", adaptPagination);

    return dataTable;
}
