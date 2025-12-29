let currentTour = null;

// thêm
function openCreateModal() {
    document.getElementById("createModal").style.display = "block";

    initCreateDiaDiem();

    const soNgayInput = document.getElementById("create_so_ngay");
    soNgayInput.onchange = function () {
        renderCreateLichTrinh(this.value);
    };
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
                    const checked = selected.includes(dd.id_dd)
                        ? "checked"
                        : "";

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
function renderCreateLichTrinh(soNgay) {
    const box = document.getElementById("createLichTrinhBox");
    box.innerHTML = "";

    for (let i = 1; i <= soNgay; i++) {
        box.innerHTML += `
            <div class="mb-2">
                <label>Ngày ${i}</label>
                <textarea class="form-control"
                          name="lich_trinh[${i}]"
                          rows="2"></textarea>
            </div>
        `;
    }
}

function initCreateDiaDiem() {
    const mienSelect = document.getElementById("createMienSelect");
    const box = document.getElementById("createDiaDiemBox");

    mienSelect.onchange = function () {
        box.innerHTML = "";
        if (!this.value) return;

        fetch(`/admin/dia-diem-by-mien/${this.value}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(dd => {
                    box.innerHTML += `
                        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="dia_diem[]"
                                       value="${dd.id_dd}">
                                <label class="form-check-label">
                                    ${dd.ten_dia_diem}
                                </label>
                            </div>
                        </div>
                    `;
                });
            });
    };
}

// tự động sinh input theo ngày
function renderLichTrinhInputs(soNgay, lichTrinh = {}) {
    const box = document.getElementById("lichTrinhBox");
    box.innerHTML = "";

    for (let i = 1; i <= soNgay; i++) {
        box.innerHTML += `
            <div class="mb-2">
                <label>Ngày ${i}</label>
                <textarea 
                    name="lich_trinh[${i}]" 
                    class="form-control"
                    rows="2"
                >${lichTrinh[i] ?? ""}</textarea>
            </div>
        `;
    }
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

    // sửa lịch trình
    renderLichTrinhInputs(tour.so_ngay, tour.lich_trinh ?? {});
    edit_so_ngay.onchange = function () {
        renderLichTrinhInputs(this.value);
    };

    // sửa địa điểm
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
    // Hướng dẫn viên
    const hdvSpan = document.getElementById("detail_hdv");
    if (tour.huong_dan_vien) {
        hdvSpan.innerText = tour.huong_dan_vien.ten_hdv;
    } else {
        hdvSpan.innerText = "Chưa có";
    }

    // Hình ảnh
    const img = document.getElementById("detail_image");
    if (tour.hinh_anh) {
        img.src = `/images/tours/${tour.hinh_anh}`;
        img.style.display = "block";
    } else {
        img.style.display = "none";
    }

    if (tour.id_hdv) {
        document.getElementById("edit_id_hdv").value = tour.id_hdv;
    }
    const lichTrinhBox = document.getElementById("detail_lich_trinh");
    lichTrinhBox.innerHTML = "";

    if (tour.lich_trinh && Object.keys(tour.lich_trinh).length > 0) {
        Object.entries(tour.lich_trinh).forEach(([ngay, noiDung]) => {
            lichTrinhBox.innerHTML += `
            <p><strong>Ngày ${ngay}:</strong> ${noiDung}</p>
        `;
        });
    } else {
        lichTrinhBox.innerHTML = `<p class="text-muted">Chưa có lịch trình</p>`;
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
