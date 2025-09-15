<?php
session_start();
// ---  المدخلات الموجودة   ---
$products = [
[
        'id' => 1,
        'name' => 'Wireless Mouse',
        'description' => 'High precision ',
        'price' => 15.5,
        'category' => 'book'
        ]
        ,
[
        'id' => 2,
        'name' => 'Book: PHP ',
        'description' => 'Learn PHP ',
        'price' => 15,
        'category' => 'Home'
]
];
$categories = ['Electronics', 'Home', 'Clothing', 'Book'];
$errors = [];
$submittedData = [];
$successMessage = "";
// المعالجة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedData = [
        'name' => trim($_POST['name'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'price' => trim($_POST['price'] ?? ''),
        'category' => trim($_POST['category'] ?? '')
    ];

    // التحقق
    if ($submittedData['name'] === '') {
        $errors['name'] = "Product name is required";
    }
    if ($submittedData['description'] === '') {
        $errors['description'] = "Description is required";
    }
    if ($submittedData['price'] === '' || !is_numeric($submittedData['price']) || $submittedData['price'] <= 0) {
        $errors['price'] = "Valid price is required";
    }
    if (!in_array($submittedData['category'], $categories)) {
        $errors['category'] = "Invalid category";
    }

    // اذا الوضع تمام نفذ الكود
    if (empty($errors)) {
        $newId = count($products) + 1;
        $products[] = [
            'id' => $newId,
            'name' => htmlspecialchars($submittedData['name']),
            'description' => htmlspecialchars($submittedData['description']),
            'price' => (float)$submittedData['price'],
            'category' => htmlspecialchars($submittedData['category'])
        ];
        $successMessage = "Product added successfully!";
        $submittedData = []; 
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>! قائمة المنتجات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <center>
<div class="container py-5">
    <h1 class="mb-4">! قائمة المنتجات </h1>

    <!-- رسائل التنبيه -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">Please fix the errors below</div>
    <?php endif; ?>
    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?= $successMessage ?></div>
    <?php endif; ?>

    <!-- جدول المنتجات -->
    <table class="table table-striped mb-5">
        <thead>
        <tr>
            <th>الترقيم</th><th>الاسم</th><th>الوصف</th><th>التصنيف ($)</th><th>السمر</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['name'] ?></td>
                <td><?= $p['description'] ?></td>
                <td><?= number_format($p['price'], 2) ?></td>
                <td><?= $p['category'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- الفورم -->
    <h2>اضافة منتج</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">اسم المنتج</label>
            <input type="text" name="name" 
                   class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                   value="<?= htmlspecialchars($submittedData['name'] ?? '') ?>">
            <div class="invalid-feedback"><?= $errors['name'] ?? '' ?></div>
        </div>
<br>

        <div class="mb-3">
            <label class="form-label">الوصف</label>
            <input   type="text"name="description"
                      class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"><?= htmlspecialchars($submittedData['description'] ?? '') ?></textarea>
            <div class="invalid-feedback"><?= $errors['description'] ?? '' ?></div>
        </div>
<br>

        <div class="mb-3">
            <label class="form-label">التصنيف</label>
            <input type="text" name="price"
                   class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>"
                   value="<?= htmlspecialchars($submittedData['price'] ?? '') ?>">
            <div class="invalid-feedback"><?= $errors['price'] ?? '' ?></div>
        </div>

<br>
        <div class="mb-3">
            <label class="form-label">السمر</label>
            <select name="category" class="form-control <?= isset($errors['category']) ? 'is-invalid' : '' ?>">
                <option value="">--------------اختر------------</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c ?>" <?= (isset($submittedData['category']) && $submittedData['category'] === $c) ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= $errors['category'] ?? '' ?></div>
        </div>
<br>
<div class="mb-3">
       <center> <h1><button  type="submit" style="backround-color:red; color :blue;border:red;" class="btn btn-primary w-100"><h3>! اضافة المنتج </h3></button></h1></center>
    </div>
</form>
</div>
</center>
</body>
</html>
