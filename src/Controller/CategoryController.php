<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\ServiceInterface\SettingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private CategoryRepository $categoryRepository;
    private SettingServiceInterface $settingService;

    public function __construct(CategoryRepository $categoryRepository, SettingServiceInterface $settingService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingService = $settingService;
    }

    public function category()
    {
        $categoryCacheLifetime = $this->settingService->get('app.category_cache_lifetime');

        return $this->render('components/partials/categories.html.twig', array(
            'categories' => $this->categoryRepository->findAllActiveCategories(),
        ))->setSharedMaxAge($categoryCacheLifetime);
    }
}
