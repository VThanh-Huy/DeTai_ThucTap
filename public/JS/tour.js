let currentTour = null;

// thêm
function openCreateModal() {
    document.getElementById("createModal").style.display = "block";
}

function closeCreateModal() {
    document.getElementById("createModal").style.display = "none";
}

function initDiaDiemByMien(tour = null) {
    const mienSelect = document.getElementById("mienSelect");
    const diaDiemBox = document.getElementById("diaDiemBox");

    mienSelect.onchange = function () {
        let id_mien = this.value;
        diaDiemBox.innerHTML = "";

        if (!id_mien) return;

        fetch(`/admin/dia-diem-by-mien/${id_mien}`)
            .then((res) => res.json())
            .then((data) => {
                let selected = [];
                if (tour && tour.dia_diems) {
                    selected = tour.dia_diems.map((dd) => dd.id_dd);
                }

                data.forEach((dd) => {
                    const checked = selected.includes(dd.id_dd)? "checked": "";

                    diaDiemBox.innerHTML += `
                        <label>
                            <input type="checkbox"
                                   name="dia_diem[]"
                                   value="${dd.id_dd}"
                                   ${checked}>
                            ${dd.ten_dia_diem}
                        </label>
                    `;
                });
            });
    };
}

// model sửa
function openEditModal(tour) {
    document.getElementById("editModal").style.display = "block";

    currentTour = tour;

    edit_ten_tour.value = tour.ten_tour;
    edit_gia_tien.value = tour.gia_tien;
    edit_so_ngay.value = tour.so_ngay;
    edit_mo_ta.value = tour.mo_ta;

    document.getElementById("editForm").action = `/admin/tour/${tour.id_tour}`;
    initDiaDiemByMien(tour);

    if (tour.dia_diems && tour.dia_diems.length > 0) {
        mienSelect.value = tour.dia_diems[0].id_mien;
        mienSelect.dispatchEvent(new Event("change"));
    }

}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

// model xóa
function openDeleteModal(id) {
    document.getElementById("deleteModal").style.display = "block";
    document.getElementById("deleteForm").action = `/admin/tour/${id}`;
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

// chi tiết
function openDetailModal(tour) {
    currentTour = tour;

    document.getElementById("detailModal").style.display = "block";

    document.getElementById("detail_ten_tour").innerText = tour.ten_tour;
    document.getElementById("detail_gia").innerText =
        new Intl.NumberFormat().format(tour.gia_tien) + "đ";

    document.getElementById("detail_so_ngay").innerText =
        tour.so_ngay + " ngày";
    document.getElementById("detail_so_cho").innerText = tour.so_cho ?? "—";
    document.getElementById("detail_ngay").innerText = tour.ngay_bat_dau ?? "—";
    document.getElementById("detail_mo_ta").innerText = tour.mo_ta ?? "";

    const mienSpan = document.getElementById("detail_mien");

    if (tour.dia_diems && tour.dia_diems.length > 0 && tour.dia_diems[0].mien) {
        mienSpan.innerText = tour.dia_diems[0].mien.ten_mien;
    } else {
        mienSpan.innerText = "Chưa xác định";
    }

    const ul = document.getElementById("detail_dia_diem");
    ul.innerHTML = "";

    if (tour.dia_diems && tour.dia_diems.length > 0) {
        tour.dia_diems.forEach((dd) => {
            ul.innerHTML += `<li>${dd.ten_dia_diem}</li>`;
        });
    } else {
        ul.innerHTML = "<li>Chưa có địa điểm</li>";
    }
}

function closeDetailModal() {
    document.getElementById("detailModal").style.display = "none";
}

// nút trong model chi tiết
document.addEventListener("DOMContentLoaded", function () {
    const btnEdit = document.getElementById("btnEditTour");
    const btnDelete = document.getElementById("btnDeleteTour");

    if (btnEdit) {
        btnEdit.onclick = function () {
            if (!currentTour) return;
            closeDetailModal();
            openEditModal(currentTour);
        };
    }

    if (btnDelete) {
        btnDelete.onclick = function () {
            if (!currentTour) return;
            closeDetailModal();
            openDeleteModal(currentTour.id_tour);
        };
    }
});
