<?php

namespace App\Controller;

use App\Repository\BannerRepository;
use App\ServiceInterface\SettingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BannerController extends AbstractController
{
    private BannerRepository $bannerRepository;
    private SettingServiceInterface $settingService;

    public function __construct(BannerRepository $bannerRepository , SettingServiceInterface $settingService)
    {
        $this->bannerRepository = $bannerRepository;
        $this->settingService = $settingService;
    }

    public function banner()
    {
        $bannerCacheLifetime = $this->settingService->get('app.banner_cache_lifetime');

        return $this->render('components/partials/banner.html.twig', array(
            'banners' => $this->bannerRepository->findRandomBanner(3),
        ))->setSharedMaxAge($bannerCacheLifetime);
    }
}
