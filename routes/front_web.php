<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//Cache Clear
Route::get('/clear-app', function () {
    Artisan::call('optimize:clear');
    return redirect('/');
});
//------------------------------- google, facebook login ------------------------//
Route::get('auth/facebook', [App\Http\Controllers\FacebookLoginController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [App\Http\Controllers\FacebookLoginController::class, 'loginWithFacebook']);
Route::get('auth/google', [App\Http\Controllers\GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [App\Http\Controllers\GoogleSocialiteController::class, 'handleCallback']);
//------------------------------- google, facebook login end ------------------------//

// ------------------------------  user login and register routes ----------------------------------//
Route::get('/register', [App\Http\Controllers\Frontend\LoginController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Frontend\LoginController::class, 'registerStore'])->name('register');
Route::get('/phone/verify/{id}/{hash}', [App\Http\Controllers\Frontend\LoginController::class, 'emailverify']);
Route::post('/email/verify/submit', [App\Http\Controllers\Frontend\LoginController::class, 'emailverifySubmit'])->name('email.verify');
Route::get('/login', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Frontend\LoginController::class, 'loginSubmit'])->name('user.login');
Route::get('/forget-password', [App\Http\Controllers\Frontend\LoginController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forget-password', [App\Http\Controllers\Frontend\LoginController::class, 'forgetPasswordSubmit'])->name('forgetPassword');
Route::get('forget-password/verify/{id}/{verify_id}', [App\Http\Controllers\Frontend\LoginController::class, 'forgetCodeVerify']);
Route::post('forget-password/verify/store', [App\Http\Controllers\Frontend\LoginController::class, 'forgetCodeVerifyStore']);
Route::post('/user/register', [App\Http\Controllers\Frontend\UserController::class, 'register']);
// ------------------------------  user login and register routes end ----------------------------------//

//------------------------------------ auth user routes --------------------------//
Route::get('/logout', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'logout'])->name('logout');
Route::get('/dashboard', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'dashboard'])->name('customer.dashboard');
Route::get('/dashboard/order', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'customerOrder'])->name('customer.order');
Route::get('/dashboard/order/view/{id}', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'customerOrderView'])->name('customer.order-view');
Route::get('/dashboard/order/invoice/{id}', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'printInvoice'])->name('customer.order-invoice');
Route::get('/password-change', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'passwordChange'])->name('customer.passwordChange');
Route::post('/password-change', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'passwordChangeStore'])->name('customer.passwordChange');
Route::get('/profile', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'profile'])->name('customer.profile');
Route::post('/profile', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'profileUpdate'])->name('customer.profile');
Route::get('/user/vendor-request', [App\Http\Controllers\Frontend\VendorController::class, 'create'])->name('user.vendor.create');
Route::post('user/vendor-store', [App\Http\Controllers\Frontend\VendorController::class, 'store'])->name('user.vendor-store');
Route::get('/vendor-bank-info', [App\Http\Controllers\Frontend\VendorController::class, 'bankInfo'])->name('vendor-bank-info');
Route::post('/vendor-bank-info', [App\Http\Controllers\Frontend\VendorController::class, 'updateBankInfo']);
Route::get('/vendor/edit', [App\Http\Controllers\Frontend\VendorController::class, 'edit'])->name('vendor.edit');
Route::post('/vendor/edit', [App\Http\Controllers\Frontend\VendorController::class, 'editUpdate'])->name('vendor.edit');
Route::get('/vendor/dashboard', [App\Http\Controllers\Frontend\VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
Route::get('/vendor/order', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'vendorRequestedOrder'])->name('vendor.order');
Route::get('/vendor/order/view/{id}', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'invoicevendorOrder']);
Route::get('/vendor/myorder', [App\Http\Controllers\Frontend\VendorController::class, 'myorder']);
Route::get('/vendor/shop', [App\Http\Controllers\Frontend\ShopController::class, 'index'])->name('vendor.shop');
Route::post('/vendor/shop', [App\Http\Controllers\Frontend\ShopController::class, 'store'])->name('vendor.shop');
Route::get('vendor/shop/edit/{id}', [App\Http\Controllers\Frontend\ShopController::class, 'edit']);
Route::post('vendor/shop/update', [App\Http\Controllers\Frontend\ShopController::class, 'update']);
Route::get('vendor/shop/delete/{id}', [App\Http\Controllers\Frontend\ShopController::class, 'delete']);
Route::get('/vendor/shop/product/{id}', [App\Http\Controllers\Frontend\ShopController::class, 'shopProduct']);
Route::get('/vendor/shopwiseproduct', [App\Http\Controllers\Frontend\ProductController::class, 'shopwiseproduct']);
Route::get('/vendor/shopwise/product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'getshopwiseproduct']);
Route::get('/vendor/product-create', [App\Http\Controllers\Frontend\ProductController::class, 'create'])->name('vendor.product.create');
Route::post('/vendor/product-create', [App\Http\Controllers\Frontend\ProductController::class, 'createstore'])->name('vendor.product.create');
Route::get('/vendor/payment/history', [App\Http\Controllers\Frontend\VendorPaymentController::class, 'paymentHistory'])->name('vendor.payment.history');
Route::post('/vendor/payment/request', [App\Http\Controllers\Frontend\VendorPaymentController::class, 'paymentRequest']);
Route::get('/vendor/sku_combination/product', [App\Http\Controllers\Frontend\ProductController::class, 'sku_combination'])->name('products.sku_combination');
Route::get('/vendor/sku_combination_edit/product', [App\Http\Controllers\Frontend\ProductController::class, 'sku_combination_edit'])->name('products.sku_combination_edit');
Route::get('/vendor/product', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('vendor.product');
Route::post('/vendor/product', [App\Http\Controllers\Frontend\ProductController::class, 'store'])->name('vendor.product');
Route::get('vendor/product/edit/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'editproduct']);
Route::get('/vendor/get/shop/edit/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'edit']);
Route::post('/vendor/product/update', [App\Http\Controllers\Frontend\ProductController::class, 'update'])->name('update.vendor.product');
Route::get('/vendor/product/delete/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'delete']);
Route::post('/customer/custom-choose', [App\Http\Controllers\Frontend\CustomChoiseRequestedController::class, 'store'])->name('customer.custom-choose');
//---------------------------------------- auth user routes end -------------------------------------//

//-----------------------------      frontend routes      -----------------------------------------//
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'home'])->name('home.index');
Route::get('/about-us', [App\Http\Controllers\Frontend\FrontendController::class, 'aboutUs']);
Route::get('/contact-us', [App\Http\Controllers\Frontend\FrontendController::class, 'contactUs']);
Route::get('/privacy-policy', [App\Http\Controllers\Frontend\FrontendController::class, 'privacyPolicy']);
Route::get('/terms-conditions', [App\Http\Controllers\Frontend\FrontendController::class, 'termsCondition']);
Route::get('/admin/product-upload-policy/update', [App\Http\Controllers\Admin\AboutUsController::class, 'productUploadPolicy'])->name('admin.product-upload-policy.update');
Route::get('/blogs', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blogs');
Route::get('/blogs-view/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blogs-view');
Route::get('/api/user-color', [App\Http\Controllers\Frontend\BlogController::class, 'getColor']);
Route::get('/api/user-com-info', [App\Http\Controllers\Frontend\BlogController::class, 'getCompany']);
Route::post('/subcription/store', [App\Http\Controllers\Frontend\SubcriptionController::class, 'store'])->name('subcription.store');

Route::get('/products/{slug}/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'productDetails']);
Route::get('/track-order', [App\Http\Controllers\Frontend\FrontendController::class, 'trackCustomerOrder']);
Route::get('/product/varient', [App\Http\Controllers\Frontend\FrontendController::class, 'provarient'])->name('products.variant_price');
//-----------------------------------Shop routes end here --------------------------------/
Route::get('/shop', [App\Http\Controllers\Frontend\ProductShopController::class, 'index'])->name('shop');
Route::get('/filter-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filterShop']);
Route::get('/11-offer', [App\Http\Controllers\Frontend\ProductShopController::class, 'offer11Store'])->name('11-offer');
Route::get('/filter-11-offer-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filter11OfferShop']);
Route::get('/22-offer', [App\Http\Controllers\Frontend\ProductShopController::class, 'offer22Store'])->name('22-offer');
Route::get('/filter-22-offer-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filter22OfferShop']);
Route::get('/special-offer', [App\Http\Controllers\Frontend\ProductShopController::class, 'offerSpecialStore']);
Route::get('/filter-special-offer-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filterSpecialOfferShop']);
Route::get('/vendor-shop/{id}', [App\Http\Controllers\Frontend\ProductShopController::class, 'vendorWishShop']);
Route::get('/filter-shop-wise-product', [App\Http\Controllers\Frontend\FilterProductController::class, 'filterShopWise']);
Route::get('/category/{slug}/{id}', [App\Http\Controllers\Frontend\ProductShopController::class, 'categoryWishProduct']);
Route::get('/filter-category-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filterCategoryShop']);
Route::get('/sub-category/{slug}/{id}', [App\Http\Controllers\Frontend\ProductShopController::class, 'subCategoryWishProduct']);
Route::get('/filter-sub-category-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filterSubCategoryShop']);
Route::get('/re-sub-category/{slug}/{id}', [App\Http\Controllers\Frontend\ProductShopController::class, 'reSubCategoryWishProduct']);
Route::get('/filter-re-sub-category-shop', [App\Http\Controllers\Frontend\FilterProductController::class, 'filterReSubCategoryShop']);
Route::get('/api/user-info', [App\Http\Controllers\Frontend\FilterProductController::class, 'getUser']);
Route::get('/api/user-admin', [App\Http\Controllers\Frontend\FilterProductController::class, 'dd']);
Route::get('/product-search', [App\Http\Controllers\Frontend\ProductShopController::class, 'searchProduct']);
Route::get('/section/{key}', [App\Http\Controllers\Frontend\ProductShopController::class, 'sectionWishProduct']);
Route::get('/all-vendors', [App\Http\Controllers\Frontend\FrontendController::class, 'allVendor'])->name('all-vendors');

//----------------------------------------- Shop routes end here -----------------------------/

//------------------------------wishlist,add to cart, checkout routes end -------------------------//

Route::get('/add-to-wishlist', [App\Http\Controllers\Frontend\WishListController::class, 'store']);
Route::get('/wishlist', [App\Http\Controllers\Frontend\WishListController::class, 'index']);
Route::get('/delete-wishlist/item/{rowId}', [App\Http\Controllers\Frontend\WishListController::class, 'destroy']);
//cart related routes
Route::get('/addtocart', [App\Http\Controllers\Frontend\CartController::class, 'addToCart']);
Route::get('/getcart', [App\Http\Controllers\Frontend\CartController::class, 'getCartItem']);
Route::get('/getcartcount', [App\Http\Controllers\Frontend\CartController::class, 'getCartCount']);
Route::get('/getflyingcart', [App\Http\Controllers\Frontend\CartController::class, 'getFlyingCartItem']);
Route::get('/getcartData', [App\Http\Controllers\Frontend\CartController::class, 'getcartData']);
Route::get('/main/getcart/page', [App\Http\Controllers\Frontend\CartController::class, 'getMainCartItem']);
Route::get('/getcartQuantity', [App\Http\Controllers\Frontend\CartController::class, 'getCartQuantity']);
Route::get('/deletecart/item/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'removeFrommainCart']);
Route::get('/products/cart', [App\Http\Controllers\Frontend\CartController::class, 'cart']);
Route::get('/increase/item/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'qtyIncrease']);
Route::get('/increaseByOne/item/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'qtyIncreaseByOne']);
Route::get('/decreaseByOne/item/{rowId}', [App\Http\Controllers\Frontend\CartController::class, 'qtyDecreaseByOne']);
// custom choose product related routes
Route::get('/dashboard/custom-choose-product', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'customChooseProduct'])->name('customer.custom-choose-product');
Route::get('/dashboard/custom-choose-product/view/{id}', [App\Http\Controllers\Frontend\CustomerDashboardController::class, 'customChooseProductView'])->name('customer.custom-choose-product.view');
//custom checkout
Route::get('/dashboard/custom-choose-checkout/{id}', [App\Http\Controllers\Frontend\CustomCheckoutController::class, 'checkout'])->name('customer.custom-choose-checkout');
Route::get('/dashboard/custom-choose-checkout/page/{id}', [App\Http\Controllers\Frontend\CustomCheckoutController::class, 'getCheckoutCartItem'])->name('customer.custom-choose-checkout.page');
Route::post('/custom-choose-checkout/save', [App\Http\Controllers\Frontend\CustomCheckoutController::class, 'save'])->name('custom-choose-checkout.save');
//checkout
Route::get('/products/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'checkout']);
Route::get('/main/checkout/page', [App\Http\Controllers\Frontend\CheckoutController::class, 'getCheckoutCartItem']);
Route::get('/cupon/check/{cupon}', [App\Http\Controllers\Frontend\CheckoutController::class, 'cuponCheck']);
Route::post('/checkout/save', [App\Http\Controllers\Frontend\CheckoutController::class, 'save'])->name('checkout.save');
Route::get('/checkout/payment/{order_id}', [App\Http\Controllers\Frontend\CheckoutController::class, 'paymentMethods']);
Route::post('/pay', [App\Http\Controllers\Frontend\CheckoutController::class, 'pay'])->name('pay');
//------------------------------checkout routes end -------------------------//
//------------------------------ api routes --------------------//
Route::get('/get/shop/type/{shop_id}', [App\Http\Controllers\Api\ApiController::class, 'getShop']);
Route::get('/get/product/details/{product_id}', [App\Http\Controllers\Api\ApiController::class, 'getProductdetails']);
Route::get('/get/product/customchoose/{product_id}', [App\Http\Controllers\Api\ApiController::class, 'customChooseData']);
Route::get('/get/subcategory/all/{cate_id}', [App\Http\Controllers\Api\ApiController::class, 'getSubcategory']);
Route::get('/get/resubcategory/all/{subcate_id}', [App\Http\Controllers\Api\ApiController::class, 'getReSubcategory']);
Route::get('/get/reresubcategory/all/{resubcate_id}', [App\Http\Controllers\Api\ApiController::class, 'getReReSubcategory']);
Route::get('/get/rereresubcategory/all/{resubcate_id}', [App\Http\Controllers\Api\ApiController::class, 'getreReReSubcategory']);
Route::get('/get/district/all/{division_id}', [App\Http\Controllers\Api\ApiController::class, 'getDistrict']);
Route::get('/ads_click/{id}', [App\Http\Controllers\Api\ApiController::class, 'adsClick']);
Route::get('/check-cookie/{ip}', [App\Http\Controllers\Api\ApiController::class, 'checkCookie']);
//------------------------------ api routes end --------------------//
