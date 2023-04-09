<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\ServiceInterface\SettingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private CategoryRepository $categoryRepository;
    private SettingServiceInterface $settingService;

    public function __construct(CategoryRepository $categoryRepository, SettingServiceInterface $settingService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingService = $settingService;
    }

    #[Route('/catalog/category/{slug}', name: 'app_category')]
    public function categoryPage($slug)
    {
        $category = $this->categoryRepository->findAllActiveCategoryProducts($slug);

        if (!$category) {
            throw $this->createNotFoundException(sprintf('Категория: %s не найдена', $slug));
        }

        return $this->render('pages/catalog.html.twig', [
            'title' => 'Каталог категории ' . $slug,
            'products' => $category->getProducts(),
        ]);
    }

    public function category()
    {
        $categoryCacheLifetime = $this->settingService->get('app.category_cache_lifetime');

        return $this->render('components/partials/categories.html.twig', array(
            'categories' => $this->categoryRepository->findAllActiveCategories(),
        ))->setSharedMaxAge($categoryCacheLifetime);
    }
}
