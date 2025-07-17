<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-50">
  <div class="flex min-h-screen">
    <?php $this->load->view('admin/layout/sidebar'); ?>
    <div class="flex-1 flex flex-col">
      <?php $this->load->view('admin/layout/navbar'); ?>
      <main class="flex-1 p-6">
        <?php $this->load->view($page); ?>
      </main>
      <?php $this->load->view('admin/layout/footer'); ?>
    </div>
  </div>
</body>
</html>