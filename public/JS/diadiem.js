function openCreateModal() {
    document.getElementById('createModal').style.display = 'block';
    document.getElementById('createForm').reset();
}

function closeCreateModal() {
    document.getElementById('createModal').style.display = 'none';
}

function openEditModal(dd) {
    document.getElementById('editModal').style.display = 'block';

    document.getElementById('edit_ten_dia_diem').value = dd.ten_dia_diem;
    document.getElementById('edit_id_mien').value = dd.id_mien;

    document.getElementById('editForm').action =
        `/admin/dia_diem/${dd.id_dd}`;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function openDeleteModal(id) {
    document.getElementById('deleteModal').style.display = 'block';
    document.getElementById('deleteForm').action =
        `/admin/dia-diem/${id}`;
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
