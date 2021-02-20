<?php
declare(strict_types=1);

namespace Orba\RandomCat\Plugin;

use Magento\Catalog\Block\Product\Image;
use Magento\Catalog\Block\Product\ImageFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\State;
use Orba\RandomCat\Api\Data\RandomCatImageInterface;

class RandomImage
{
    /**
     * @var RandomCatImageInterface
     */
    private $randomCatImage;

    /**
     * @var Http
     */
    private $request;

    /**
     * @param RandomCatImageInterface $randomCatImage
     * @param Http $request
     */
    public function __construct(
        RandomCatImageInterface $randomCatImage,
        Http $request

    ) {
        $this->randomCatImage = $randomCatImage;
        $this->request = $request;
    }

    /**
     * @param ImageFactory $imageFactory
     * @param Image $image
     * @return Image
     */
    public function afterCreate(
        ImageFactory $imageFactory,
        Image $image
    ): Image {
        if ($this->request->getFullActionName() == 'catalog_category_view') {
            $image->setData('image_url', $this->randomCatImage->getRandomCatImage());
        }

        return $image;
    }
}
