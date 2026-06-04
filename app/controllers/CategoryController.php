<?php

require_once './app/config/database.php';
require_once './app/models/CategoryModel.php';

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->categoryModel = new CategoryModel($db);
    }

    /* =========================
       LIST CATEGORY
    ========================== */

    public function list()
    {
        SessionHelper::requireAdmin();
        $categories = $this->categoryModel->getCategories();
        require './app/views/category/list.php';
    }

    /* =========================
       ADD CATEGORY
    ========================== */

    public function add()
    {
        SessionHelper::requireAdmin();
        require './app/views/category/add.php';
    }

    /* =========================
       SAVE CATEGORY
    ========================== */

    public function save()
    {
        SessionHelper::requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $this->categoryModel->addCategory(
                $name,
                $description
            );
            header('Location: /NguyenDuongBao_0154/Category/list');
        }
    }

    /* =========================
       EDIT CATEGORY
    ========================== */

    public function edit($id)
    {
        SessionHelper::requireAdmin();
        $category = $this->categoryModel->getCategoryById($id);
        require './app/views/category/edit.php';
    }

    /* =========================
       UPDATE CATEGORY
    ========================== */

    public function update()
    {
        SessionHelper::requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $this->categoryModel->updateCategory(
                $id,
                $name,
                $description
            );
            header('Location: /NguyenDuongBao_0154/Category/list');
        }
    }

    /* =========================
       DELETE CATEGORY
    ========================== */

    public function delete($id)
    {
        SessionHelper::requireAdmin();
        $this->categoryModel->deleteCategory($id);
        header('Location: /NguyenDuongBao_0154/Category/list');
    }
}
