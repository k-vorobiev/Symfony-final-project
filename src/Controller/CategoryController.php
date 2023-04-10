<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\ServiceInterface\SettingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private CategoryRepository $categoryRepository;
    private SettingServiceInterface $settingService;
    private ProductRepository $productRepository;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository, SettingServiceInterface $settingService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingService = $settingService;
        $this->productRepository = $productRepository;
    }

    #[Route('/catalog/category/{slug}', name: 'app_category')]
    public function categoryPage($slug)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->findFilteredProducts($slug);

        if (!$category) {
            throw $this->createNotFoundException(sprintf('Категория: %s не найдена', $slug));
        }

        return $this->render('pages/catalog.html.twig', [
            'title' => 'Каталог категории ' . $category->getName(),
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
