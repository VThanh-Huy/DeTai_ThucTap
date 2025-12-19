function openCreateModal() {
    document.getElementById('createModal').style.display = 'block';
}

function closeCreateModal() {
    document.getElementById('createModal').style.display = 'none';
}


function openEditModal(tour) {
    document.getElementById('editModal').style.display = 'block';

    edit_ten_tour.value = tour.ten_tour;
    edit_gia_tien.value = tour.gia_tien;
    edit_so_ngay.value = tour.so_ngay;
    edit_dia_diem.value = tour.dia_diem;

    document.getElementById('editForm').action =
        `/admin/tour/${tour.id_tour}`;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function openDeleteModal(id) {
    document.getElementById('deleteModal').style.display = 'block';
    document.getElementById('deleteForm').action =
        `/admin/tour/${id}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}


