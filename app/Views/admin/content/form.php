<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-8 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="section-title"><?= esc($title ?? 'Content Editor') ?></h4>
                    <p class="section-copy">Editor ini disiapkan untuk tim admin mengelola konten legal, informasional, dan halaman publik dengan kualitas presentasi yang rapi.</p>
                </div>

                <form action="<?= site_url('/admin/content/' . $action) ?>" method="post">
                    <?= csrf_field() ?>
                    <?php if (!empty($page['id'])): ?>
                        <input type="hidden" name="id" value="<?= esc($page['id']) ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Page Key</label>
                        <input type="text" name="page_key" class="form-control form-control-lg" value="<?= esc($page['page_key']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" value="<?= esc($page['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Body</label>
                        <textarea id="body" name="body" class="form-control" rows="16"><?= esc($page['body']) ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Konten</button>
                        <a href="<?= site_url('/admin/content') ?>" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-4 grid-margin stretch-card">
        <div class="card card-shell">
            <div class="card-body">
                <h4 class="section-title">Editor Notes</h4>
                <p class="section-copy mb-3">Panduan singkat agar konten yang masuk tetap mudah diaudit dan siap tayang.</p>
                <div class="border rounded-4 p-3 mb-3">
                    <div class="fw-semibold mb-1">Gunakan page key stabil</div>
                    <div class="text-muted small">Contoh: `privacy_policy`, `terms_of_service`, atau `about_us` supaya routing dan audit lebih konsisten.</div>
                </div>
                <div class="border rounded-4 p-3 mb-3">
                    <div class="fw-semibold mb-1">Jaga struktur heading</div>
                    <div class="text-muted small">Gunakan heading dan paragraf yang rapi agar halaman legal tetap nyaman dibaca dan mudah diupdate.</div>
                </div>
                <div class="border rounded-4 p-3">
                    <div class="fw-semibold mb-1">Review berkala</div>
                    <div class="text-muted small">Konten hukum dan kebijakan sebaiknya ditinjau ulang secara berkala saat produk, data flow, atau kebijakan bisnis berubah.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#body',
    height: 520,
    menubar: false,
    branding: false,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table paste help wordcount',
    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link table | removeformat | code preview',
    content_style: 'body { font-family: Manrope, Arial, sans-serif; font-size: 14px; line-height: 1.7; padding: 1rem; }'
  });
</script>

<?= $this->endSection() ?>
