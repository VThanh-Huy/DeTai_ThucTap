function openCreateModal() {
    document.getElementById('createModal').style.display = 'block';
    document.getElementById('createForm').reset();
}

function closeCreateModal() {
    document.getElementById('createModal').style.display = 'none';
}

function openEditModal(kh) {
    document.getElementById('editModal').style.display = 'block';

    document.getElementById('edit_ten_kh').value = kh.ten_kh;
    document.getElementById('edit_email').value = kh.email;
    document.getElementById('edit_sdt').value = kh.sdt;
    document.getElementById('edit_user_id').value = kh.user_id;

    document.getElementById('editForm').action =
        `/admin/khachhang/${kh.id_kh}`;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function openDeleteModal(id) {
    document.getElementById('deleteModal').style.display = 'block';
    document.getElementById('deleteForm').action =
        `/admin/khachhang/${id}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
