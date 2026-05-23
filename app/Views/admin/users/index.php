<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Users</h4>
    <a href="<?= site_url('/admin/users/create') ?>" class="btn btn-primary">Create User</a>
</div>

<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Role</th>
            <th>Active</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $u): ?>
            <tr>
              <td><?= esc($u['id']) ?></td>
              <td><?= esc($u['email']) ?></td>
              <td><?= esc($u['name']) ?></td>
              <td><?= esc($u['role']) ?></td>
              <td><?= $u['is_active'] ? 'Yes' : 'No' ?></td>
              <td class="text-end">
                <a href="<?= site_url('/admin/users/edit/' . $u['id']) ?>" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                <a href="<?= site_url('/admin/users/delete/' . $u['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus user ini?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
