function openCreateModal() {
    document.getElementById('createModal').style.display = 'block';
    document.getElementById('createForm').reset();
}

function closeCreateModal() {
    document.getElementById('createModal').style.display = 'none';
}

function openEditModal(hdv) {
    document.getElementById('editModal').style.display = 'block';

    edit_ten_hdv.value = hdv.ten_hdv;
    edit_email.value = hdv.email;
    edit_ngay_sinh.value = hdv.ngay_sinh;
    edit_sdt.value = hdv.sdt;
    edit_nam_bat_dau.value = hdv.nam_bat_dau;
    edit_ngon_ngu.value = hdv.ngon_ngu;
    edit_kinh_nghiem.value = hdv.kinh_nghiem;

    document.getElementById('editForm').action =
        `/admin/huongdanvien/${hdv.id_hdv}`;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function openDeleteModal(id) {
    document.getElementById('deleteModal').style.display = 'block';
    document.getElementById('deleteForm').action =
        `/admin/huongdanvien/${id}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
