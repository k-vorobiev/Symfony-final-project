<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerRepository;
use App\ServiceInterface\SettingServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    private CategoryRepository $categoryRepository;
    private SettingServiceInterface $settingService;
    private ProductRepository $productRepository;
    private SellerRepository $sellerRepository;
    private PaginatorInterface $paginator;

    public function __construct(CategoryRepository $categoryRepository, SellerRepository $sellerRepository, ProductRepository $productRepository, SettingServiceInterface $settingService, PaginatorInterface $paginator)
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingService = $settingService;
        $this->productRepository = $productRepository;
        $this->sellerRepository = $sellerRepository;
        $this->paginator = $paginator;
    }

    #[Route('/catalog', name: 'app_catalog')]
    public function catalog(Request $request)
    {
        $filter = $request->query->all();
        $products = $this->paginator->paginate(
            $this->productRepository->findFilteredProducts($filter),
            $request->query->getInt('page', 1),
            8,
            array('wrap-queries'=>true)
        );

        if (!$products) {
            throw $this->createNotFoundException('Отсуствуют товары');
        }

        $sellers = $this->sellerRepository->findAll();

        return $this->render('pages/catalog.html.twig', [
            'title' => 'Каталог',
            'products' => $products,
            'sellers' => $sellers,
        ]);
    }

    #[Route('/catalog/category/{id}', name: 'app_category')]
    public function categoryPage($id, Request $request)
    {
        $filter = $request->query->all();
        $products = $this->paginator->paginate(
            $this->productRepository->findFilteredProducts($filter, $id),
            $request->query->getInt('page', 1),
            8,
            array('wrap-queries'=>true),
        );

        if (!$products) {
            throw $this->createNotFoundException('Отсуствуют товары');
        }

        $sellers = $this->sellerRepository->findAll();

        return $this->render('pages/catalog.html.twig', [
            'title' => 'Каталог категории',
            'products' => $products,
            'sellers' => $sellers,
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