<?php
require_once __DIR__ . '/../models/Faq.php';

class FaqController
{
    public function index()
    {
        $faqModel = new Faq();
        $faqs = $faqModel->getAll();
        require_once __DIR__ . '/../views/product/faq.php';
    }
}