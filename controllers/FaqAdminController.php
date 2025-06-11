<?php
require_once './models/Faq.php';
require_once __DIR__ . '/BaseAdminController.php';

class FaqAdminController extends BaseAdminController
{
    public function index()
    {
        $faqModel = new Faq();
        $faqs = $faqModel->getAll();
        require_once './views/admin/faq_list.php';
    }

    public function create()
    {
        $faqModel = new Faq();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = $_POST['question'];
            $answer = $_POST['answer'];

            $data = [
                'question' => $question,
                'answer' => $answer
            ];

            if ($faqModel->create($data)) {
                header('Location: index.php?controller=FaqAdmin');
                exit;
            } else {
                $error = "Không thể thêm câu hỏi. Vui lòng thử lại.";
            }
        }

        require './views/admin/faq_create.php';
    }

    public function update()
    {
        $faqModel = new Faq();
        $id = $_GET['id'];
        $faq = $faqModel->findById($id);
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = $_POST['question'];
            $answer = $_POST['answer'];

            $data = [
                'question' => $question,
                'answer' => $answer
            ];

            if ($faqModel->update($id, $data)) {
                header('Location: index.php?controller=FaqAdmin');
                exit;
            } else {
                $error = "Không thể cập nhật câu hỏi. Vui lòng thử lại.";
            }
        }

        require './views/admin/faq_update.php';
    }

    public function delete()
    {
        $faqModel = new Faq();
        $id = $_GET['id'];
        $faqModel->delete($id);
        header('Location: index.php?controller=FaqAdmin');
        exit;
    }
}

