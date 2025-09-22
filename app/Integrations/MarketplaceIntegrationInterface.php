<?php

namespace App\Integrations;

interface MarketplaceIntegrationInterface
{
    public function getProducts();

    public function syncProduct(array $productData);

    public function getOrders();

    public function getSalesReport();
}
