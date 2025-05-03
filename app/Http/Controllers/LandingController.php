<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PricesList;
use App\Models\Product;
use App\Models\Brand;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

class LandingController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Moora Phone Cell - Official Store');
        SEOTools::setDescription('TERBUKTI TERMURAH & TERLENGKAP');
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        return view('landing.index');
    }

    public function events()
    {
        SEOTools::setTitle('Moora Phone Cell - Events');
        SEOTools::setDescription('Event Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/events'));
        SEOTools::setCanonical(url('/events'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        return view('landing.event');
    }

    public function credits()
    {
        SEOTools::setTitle('Moora Phone Cell - Simulasi Kredit');
        SEOTools::setDescription('Simulasi Kredit Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/credits'));
        SEOTools::setCanonical(url('/credits'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        return view('landing.credit');
    }

    public function priceList($slug)
    {
        $pricelists = PricesList::where('slug', $slug)->get();

        if ($pricelists->isEmpty()) {
            abort(404); // jika tidak ditemukan
        }

        return view('landing.pricelist', compact('pricelists'));
    }

    public function product()
    {
        SEOTools::setTitle('Moora Phone Cell - Produk');
        SEOTools::setDescription('Produk Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/product'));
        SEOTools::setCanonical(url('/product'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        return view('landing.products');
    }

    public function products()
    {
        SEOTools::setTitle('Moora Phone Cell - Semua Produk');
        SEOTools::setDescription('Semua Produk Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/products'));
        SEOTools::setCanonical(url('/products'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        $products = Product::where('is_active', true)->latest()->get();

        return view('landing.allProducts', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        SEOTools::setTitle('Moora Phone Cell - Produk ' .$product->name);
        SEOTools::setDescription('Produk Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/product/' . $product->name));
        SEOTools::setCanonical(url('/product/' . $slug));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);


        return view('landing.product-detail', compact('product'));
    }

    public function brands()
    {
        SEOTools::setTitle('Moora Phone Cell - Semua Brand');
        SEOTools::setDescription('Semua Brand Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/brands'));
        SEOTools::setCanonical(url('/brands'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        $brands = Brand::withCount('products')->where('is_active', true)->get();

        return view('landing.allBrands', compact('brands'));
    }

    public function brandDetail($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $products = $brand->products()->where('is_active', true)->latest()->get();

        SEOTools::setTitle('Moora Phone Cell - Brand ' . $brand->name);
        SEOTools::setDescription('Brand Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/brand/product/' . $brand->slug));
        SEOTools::setCanonical(url('/brand/product/' . $slug));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        return view('landing.brand-detail', compact('brand', 'products'));
    }

    public function productsByCategory($category)
    {
        $products = \App\Models\Product::all()->filter(function ($product) use ($category) {
            if (!is_array($product->variations)) {
                $variations = json_decode($product->variations, true);
            } else {
                $variations = $product->variations;
            }

            if (!$variations || !is_array($variations)) return false;

            // Ambil harga termurah
            $lowestPrice = collect($variations)->pluck('price')->min();

            return match ($category) {
                'entry' => $lowestPrice <= 4000000,
                'mid' => $lowestPrice > 4000000 && $lowestPrice <= 7000000,
                'flagship' => $lowestPrice > 7000000,
                default => false,
            };
        });

        SEOTools::setTitle('Moora Phone Cell - Produk ' . $category);
        SEOTools::setDescription('Produk Moora Phone Cell');
        SEOTools::opengraph()->setUrl(url('/products/category/' . $category));
        SEOTools::setCanonical(url('/products/category/' . $category));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addKeyword(['Moora Phone Cell', 'MooraPhone', 'Moora', 'Moora Phone Cell Official', 'Moora Phone Cell Official Store']);

        return view('landing.productByCategory', [
            'category' => $category,
            'products' => $products,
        ]);
    }


}
