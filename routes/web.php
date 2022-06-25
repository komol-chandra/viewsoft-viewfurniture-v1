<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.home');

Route::get('/admin/userbarchart', [App\Http\Controllers\Admin\DashboardController::class, 'barChat']);
Route::get('/admin/percentage/{value}', [App\Http\Controllers\Admin\DashboardController::class, 'percentage']);

Route::get('/admin/profile', [App\Http\Controllers\Admin\DashboardController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin/profile-update', [App\Http\Controllers\Admin\DashboardController::class, 'adminProfileUpdate'])->name('admin.ProfileUpdate');
Route::post('/admin/profile-update', [App\Http\Controllers\Admin\DashboardController::class, 'adminProfileUpdateSubmit'])->name('admin.ProfileUpdate');

Route::post('/admin/admin-update-password', [App\Http\Controllers\Admin\DashboardController::class, 'adminUpdatePassword'])->name('admin.adminUpdatePassword');

Route::post('/admin/email-update', [App\Http\Controllers\Admin\DashboardController::class, 'adminEmailUpdate'])->name('admin.email.update');

Route::get('/admin/logout', [App\Http\Controllers\Admin\DashboardController::class, 'logout'])->name('admin.logout');
// login controller
Route::get('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'loginSubmit'])->name('admin.login');
// settings controller
Route::get('/admin/company-information', [App\Http\Controllers\Admin\SettingsController::class, 'companyInformation'])->name('admin.companyInformation');
Route::post('/admin/company-information', [App\Http\Controllers\Admin\SettingsController::class, 'companyInformationSubmit'])->name('admin.companyInformation');

Route::get('/admin/seo-information', [App\Http\Controllers\Admin\SettingsController::class, 'seoInformation'])->name('admin.seoInformation');
Route::post('/admin/seo-information', [App\Http\Controllers\Admin\SettingsController::class, 'seoInformationSubmit'])->name('admin.seoInformation');

Route::get('/admin/social-information', [App\Http\Controllers\Admin\SettingsController::class, 'socialInformation'])->name('admin.socialInformation');
Route::post('/admin/social-information', [App\Http\Controllers\Admin\SettingsController::class, 'socialInformationSubmit'])->name('admin.socialInformation');
// slider Create
Route::get('/admin/slider/create', [App\Http\Controllers\Admin\SliderController::class, 'create'])->name('admin.slider.create');
Route::post('/admin/slider/store', [App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.slider.create');
Route::post('/admin/slider/update', [App\Http\Controllers\Admin\SliderController::class, 'update'])->name('admin.slider.update');
Route::get('/admin/slider/index', [App\Http\Controllers\Admin\SliderController::class, 'index'])->name('admin.slider.index');

Route::get('/admin/slider/active/{id}', [App\Http\Controllers\Admin\SliderController::class, 'active']);
Route::get('/admin/slider/deactive/{id}', [App\Http\Controllers\Admin\SliderController::class, 'deactive']);
Route::get('/admin/slider/edit/{id}', [App\Http\Controllers\Admin\SliderController::class, 'edit']);
Route::get('/admin/slider/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'delete']);
// Banner Section
Route::get('/admin/banner/create', [App\Http\Controllers\Admin\BannerController::class, 'create'])->name('admin.banner.create');
Route::post('/admin/banner/store', [App\Http\Controllers\Admin\BannerController::class, 'store'])->name('admin.banner.create');
Route::post('/admin/banner/update', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('admin.banner.update');
Route::get('/admin/banner/index', [App\Http\Controllers\Admin\BannerController::class, 'index'])->name('admin.banner.index');

Route::get('/admin/ads/create', [App\Http\Controllers\Admin\AdsController::class, 'create'])->name('admin.ads.create');
Route::post('/admin/ads/create', [App\Http\Controllers\Admin\AdsController::class, 'store'])->name('admin.ads.create');
Route::post('/admin/ads/update', [App\Http\Controllers\Admin\AdsController::class, 'update'])->name('admin.ads.update');
Route::get('/admin/ads/index', [App\Http\Controllers\Admin\AdsController::class, 'index'])->name('admin.ads.index');
Route::get('/admin/ads/active/{id}', [App\Http\Controllers\Admin\AdsController::class, 'active']);
Route::get('/admin/ads/deactive/{id}', [App\Http\Controllers\Admin\AdsController::class, 'deactive']);
Route::get('/admin/ads/edit/{id}', [App\Http\Controllers\Admin\AdsController::class, 'edit']);
Route::get('/admin/ads/delete/{id}', [App\Http\Controllers\Admin\AdsController::class, 'delete']);

Route::get('/admin/shop-category/index', [App\Http\Controllers\Admin\ShopCategoryController::class, 'index'])->name('admin.shop-category.index');
Route::get('/admin/shop-category/create', [App\Http\Controllers\Admin\ShopCategoryController::class, 'create'])->name('admin.shop-category.create');
Route::post('/admin/shop-category/store', [App\Http\Controllers\Admin\ShopCategoryController::class, 'store'])->name('admin.shop-category.store');
Route::get('/admin/shop-category/status/{id}', [App\Http\Controllers\Admin\ShopCategoryController::class, 'status'])->name('admin.shop-category.status');

Route::get('/admin/color/index', [App\Http\Controllers\Admin\ColorController::class, 'index'])->name('admin.color.index');
Route::get('/admin/color/status/{id}', [App\Http\Controllers\Admin\ColorController::class, 'status'])->name('admin.color.status');
Route::get('/admin/color/create', [App\Http\Controllers\Admin\ColorController::class, 'create'])->name('admin.color.create');
Route::post('/admin/color/store', [App\Http\Controllers\Admin\ColorController::class, 'store'])->name('admin.color.store');

Route::get('/admin/material/index', [App\Http\Controllers\Admin\MaterialsController::class, 'index'])->name('admin.material.index');
Route::get('/admin/material/status/{id}', [App\Http\Controllers\Admin\MaterialsController::class, 'status'])->name('admin.material.status');
Route::get('/admin/material/create', [App\Http\Controllers\Admin\MaterialsController::class, 'create'])->name('admin.material.create');
Route::post('/admin/material/store', [App\Http\Controllers\Admin\MaterialsController::class, 'store'])->name('admin.material.store');

Route::get('/admin/finished-color/index', [App\Http\Controllers\Admin\FinishedColorController::class, 'index'])->name('admin.finished-color.index');
Route::get('/admin/finished-color/status/{id}', [App\Http\Controllers\Admin\FinishedColorController::class, 'status'])->name('admin.finished-color.status');
Route::get('/admin/finished-color/create', [App\Http\Controllers\Admin\FinishedColorController::class, 'create'])->name('admin.finished-color.create');
Route::post('/admin/finished-color/store', [App\Http\Controllers\Admin\FinishedColorController::class, 'store'])->name('admin.finished-color.store');
//shop section
Route::get('/admin/about-shop-page-info/index', [App\Http\Controllers\Admin\OptionController::class, 'index'])->name('admin.about-shop-page-info.index');
Route::get('/admin/about-shop-page-info/status/{id}', [App\Http\Controllers\Admin\OptionController::class, 'status'])->name('admin.about-shop-page-info.status');
Route::get('/admin/about-shop-page-info/create', [App\Http\Controllers\Admin\OptionController::class, 'create'])->name('admin.about-shop-page-info.create');
Route::post('/admin/about-shop-page-info/store', [App\Http\Controllers\Admin\OptionController::class, 'store'])->name('admin.about-shop-page-info.store');
Route::get('/admin/about-shop-page-info/edit/{id}', [App\Http\Controllers\Admin\OptionController::class, 'edit'])->name('admin.about-shop-page-info.edit');
Route::put('/admin/about-shop-page-info/update/{id}', [App\Http\Controllers\Admin\OptionController::class, 'update'])->name('admin.about-shop-page-info.update');

// customer custom choose
Route::get('/admin/customer-custom-choose-request', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'index'])->name('admin.customer-custom-choose-request');
Route::get('/admin/customer-custom-choose-request-view/{id}', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'show'])->name('admin.customer-custom-choose-request-view');
Route::get('/admin/customer-custom-choose-request-status/{id}', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'status'])->name('admin.customer-custom-choose-request-status');

Route::get('/admin/section-product-report', [App\Http\Controllers\Admin\ReportController::class, 'sectionProductReport'])->name('admin.section-product-report');
Route::get('/admin/banner/active/{id}', [App\Http\Controllers\Admin\BannerController::class, 'active']);
Route::get('/admin/banner/deactive/{id}', [App\Http\Controllers\Admin\BannerController::class, 'deactive']);
Route::get('/admin/banner/edit/{id}', [App\Http\Controllers\Admin\BannerController::class, 'edit']);
Route::get('/admin/banner/delete/{id}', [App\Http\Controllers\Admin\BannerController::class, 'delete']);
//review
Route::get('/admin/review/index', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.review.index');
Route::get('/admin/review/status/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'status'])->name('admin.review.status');
// web site message routes
Route::get('/admin/website-message/index', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.website-message.index');
Route::get('/admin/website-message/status/{id}', [App\Http\Controllers\Admin\MessageController::class, 'status'])->name('admin.website-message.status');
// user message routes
Route::get('/admin/user-message/index', [App\Http\Controllers\Admin\MessageController::class, 'userMessageIndex'])->name('admin.user-message.index');
Route::get('/admin/user-message/replay/{id}', [App\Http\Controllers\Admin\MessageController::class, 'userMessageReplay'])->name('admin.user-message.replay');
Route::post('/admin/user-message/replay', [App\Http\Controllers\Admin\MessageController::class, 'userMessageReplayStore'])->name('admin.user-message.replay');
Route::get('/admin/user-message/view/{id}', [App\Http\Controllers\Admin\MessageController::class, 'userMessageView'])->name('admin.user-message.view');
//shopping charge
Route::get('/admin/shopping-charge/index', [App\Http\Controllers\Admin\ShoppingChargeController::class, 'index'])->name('admin.shopping-charge.index');
Route::get('/admin/shopping-charge/edit/{id}', [App\Http\Controllers\Admin\ShoppingChargeController::class, 'edit'])->name('admin.shopping-charge.edit');
Route::put('/admin/shopping-charge/update/{id}', [App\Http\Controllers\Admin\ShoppingChargeController::class, 'update'])->name('admin.shopping-charge.update');
// about us contact us privacy policy etc
Route::get('/admin/about-us/update', [App\Http\Controllers\Admin\AboutUsController::class, 'update'])->name('admin.about-us.update');
Route::post('/admin/about-us/update', [App\Http\Controllers\Admin\AboutUsController::class, 'updateSubmit'])->name('admin.about-us.update');
Route::get('/admin/contact-us/update', [App\Http\Controllers\Admin\AboutUsController::class, 'contactUsPage'])->name('admin.contact-us.update');
Route::get('/admin/privacy-policy/update', [App\Http\Controllers\Admin\AboutUsController::class, 'privacyPolicy'])->name('admin.privacy-policy.update');
Route::get('/admin/terms-conditions/update', [App\Http\Controllers\Admin\AboutUsController::class, 'termsCondition'])->name('admin.terms-conditions.update');
// category
Route::get('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
Route::post('/admin/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.create');
Route::post('/admin/category/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
Route::get('/admin/category/index', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
Route::get('/admin/category/active/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'active']);
Route::get('/admin/category/deactive/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deactive']);
Route::get('/admin/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
Route::get('/admin/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete']);
// Sub category
Route::get('/admin/subcategory/create', [App\Http\Controllers\Admin\SubCategoryController::class, 'create'])->name('admin.subcategory.create');
Route::post('/admin/subcategory/create', [App\Http\Controllers\Admin\SubCategoryController::class, 'store'])->name('admin.subcategory.create');
Route::post('/admin/subcategory/update', [App\Http\Controllers\Admin\SubCategoryController::class, 'update'])->name('admin.subcategory.update');
Route::get('/admin/subcategory/index', [App\Http\Controllers\Admin\SubCategoryController::class, 'index'])->name('admin.subcategory.index');
Route::get('/admin/subcategory/active/{id}', [App\Http\Controllers\Admin\SubCategoryController::class, 'active']);
Route::get('/admin/subcategory/deactive/{id}', [App\Http\Controllers\Admin\SubCategoryController::class, 'deactive']);
Route::get('/admin/subcategory/edit/{id}', [App\Http\Controllers\Admin\SubCategoryController::class, 'edit']);
Route::get('/admin/subcategory/delete/{id}', [App\Http\Controllers\Admin\SubCategoryController::class, 'delete']);
// Re Sub category
Route::get('/admin/resubcategory/create', [App\Http\Controllers\Admin\ResubCategoryController::class, 'create'])->name('admin.resubcategory.create');
Route::post('/admin/resubcategory/create', [App\Http\Controllers\Admin\ResubCategoryController::class, 'store'])->name('admin.resubcategory.create');
Route::post('/admin/resubcategory/update', [App\Http\Controllers\Admin\ResubCategoryController::class, 'update'])->name('admin.resubcategory.update');
Route::get('/admin/resubcategory/index', [App\Http\Controllers\Admin\ResubCategoryController::class, 'index'])->name('admin.resubcategory.index');
Route::get('/admin/resubcategory/active/{id}', [App\Http\Controllers\Admin\ResubCategoryController::class, 'active']);
Route::get('/admin/resubcategory/deactive/{id}', [App\Http\Controllers\Admin\ResubCategoryController::class, 'deactive']);
Route::get('/admin/resubcategory/edit/{id}', [App\Http\Controllers\Admin\ResubCategoryController::class, 'edit']);
Route::get('/admin/resubcategory/delete/{id}', [App\Http\Controllers\Admin\ResubCategoryController::class, 'delete']);
// Re Re Sub category
Route::get('/admin/re-resubcategory/create', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'create'])->name('admin.re-resubcategory.create');
Route::post('/admin/re-resubcategory/create', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'store'])->name('admin.re-resubcategory.create');
Route::post('/admin/re-resubcategory/update', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'update'])->name('admin.re-resubcategory.update');
Route::get('/admin/re-resubcategory/index', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'index'])->name('admin.re-resubcategory.index');
Route::get('/admin/re-resubcategory/active/{id}', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'active']);
Route::get('/admin/re-resubcategory/deactive/{id}', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'deactive']);
Route::get('/admin/re-resubcategory/edit/{id}', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'edit']);
Route::get('/admin/re-resubcategory/delete/{id}', [App\Http\Controllers\Admin\ReResubCategoryController::class, 'delete']);
// re re re subcategory
Route::get('/admin/re-re-resubcategory/create', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'create'])->name('admin.re-re-resubcategory.create');
Route::post('/admin/re-re-resubcategory/create', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'store'])->name('admin.re-re-resubcategory.create');
Route::post('/admin/re-re-resubcategory/update', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'update'])->name('admin.re-re-resubcategory.update');
Route::get('/admin/re-re-resubcategory/index', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'index'])->name('admin.re-re-resubcategory.index');
Route::get('/admin/re-re-resubcategory/active/{id}', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'active']);
Route::get('/admin/re-re-resubcategory/deactive/{id}', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'deactive']);
Route::get('/admin/re-re-resubcategory/edit/{id}', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'edit']);
Route::get('/admin/re-re-resubcategory/delete/{id}', [App\Http\Controllers\Admin\ReReResubCategoryController::class, 'delete']);
// brand
Route::get('/admin/brand/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('admin.brand.create');
Route::post('/admin/brand/create', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('admin.brand.create');
Route::post('/admin/brand/update', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('admin.brand.update');
Route::get('/admin/brand/index', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brand.index');
Route::get('/admin/brand/active/{id}', [App\Http\Controllers\Admin\BrandController::class, 'active']);
Route::get('/admin/brand/deactive/{id}', [App\Http\Controllers\Admin\BrandController::class, 'deactive']);
Route::get('/admin/brand/edit/{id}', [App\Http\Controllers\Admin\BrandController::class, 'edit']);
Route::get('/admin/brand/delete/{id}', [App\Http\Controllers\Admin\BrandController::class, 'delete']);
//blog routes
Route::get('/admin/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blog.create');
Route::get('/admin/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blog.edit');
Route::get('/admin/blog/index', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blog.index');
Route::post('/admin/blog/store', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blog.store');
Route::post('/admin/blog/update/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('admin.blog.update');
Route::get('/admin/blog/active/{id}', [App\Http\Controllers\Admin\BlogController::class, 'active']);
Route::get('/admin/blog/deactive/{id}', [App\Http\Controllers\Admin\BlogController::class, 'deactive']);
Route::get('/admin/blog/delete/{id}', [App\Http\Controllers\Admin\BlogController::class, 'delete']);
//approve vendor
Route::get('/admin/unapproved-vendor/index', [App\Http\Controllers\Admin\VendorApproveController::class, 'index'])->name('admin.unapproved-vendor.index');
Route::get('/admin/approve-vendor-status/approve/{id}', [App\Http\Controllers\Admin\VendorApproveController::class, 'approve'])->name('admin.approve-vendor-status.approve');
Route::get('/admin/unapproved-vendor/view/{id}', [App\Http\Controllers\Admin\VendorApproveController::class, 'show'])->name('admin.unapproved-vendor.view');
// approve product
Route::get('/admin/commissionlist/index', [App\Http\Controllers\Admin\OrderCommissionController::class, 'index'])->name('admin.commissionlist.index');
// order Cossission
Route::get('/admin/approve/product', [App\Http\Controllers\Admin\ApproveProductController::class, 'index'])->name('admin.approve.product');
Route::get('/admin/allreject/product', [App\Http\Controllers\Admin\ApproveProductController::class, 'rejectproduct'])->name('admin.reject.product');
Route::get('/admin/all-approved/product', [App\Http\Controllers\Admin\ApproveProductController::class, 'approvedProduct'])->name('admin.all-approved.product');
Route::get('/admin/all-approved/active/{id}', [App\Http\Controllers\Admin\ApproveProductController::class, 'active']);
Route::get('/admin/all-approved/deactive/{id}', [App\Http\Controllers\Admin\ApproveProductController::class, 'deactive']);
Route::get('/admin/product/approve/{id}', [App\Http\Controllers\Admin\ApproveProductController::class, 'approve']);
Route::get('/admin/reject/product/{id}', [App\Http\Controllers\Admin\ApproveProductController::class, 'reject']);
Route::get('/admin/product/edit/{id}', [App\Http\Controllers\Admin\ApproveProductController::class, 'edit']);
Route::post('/admin/product/update', [App\Http\Controllers\Admin\ApproveProductController::class, 'update'])->name('admin.product.update');
Route::get('admin/delete/product/{id}', [App\Http\Controllers\Admin\ApproveProductController::class, 'delete']);
// approve shop
Route::get('/admin/approve/allshop', [App\Http\Controllers\Admin\ApproveShopController::class, 'index'])->name('admin.approve.allshop');
Route::post('/admin/approvewithcommision/allshop', [App\Http\Controllers\Admin\ApproveShopController::class, 'approveWithCommission']);
Route::get('/admin/allshop/edit/{id}', [App\Http\Controllers\Admin\ApproveShopController::class, 'edit']);
Route::post('/admin/allshop/update', [App\Http\Controllers\Admin\ApproveShopController::class, 'update']);
Route::get('/admin/allshop/approve/{id}', [App\Http\Controllers\Admin\ApproveShopController::class, 'approve']);
Route::get('/admin/all-order/list', [App\Http\Controllers\Admin\OrderController::class, 'sectionWishOrder'])->name('admin.order.list');
Route::get('/admin/neworder/list', [App\Http\Controllers\Admin\OrderController::class, 'allneworder'])->name('admin.order.new');
Route::get('/admin/processing/order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'Processingstatus']);
Route::get('admin/order/deliver/{id}', [App\Http\Controllers\Admin\OrderController::class, 'deleverorder']);
Route::get('/admin/reject/order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'rehjectorder']);
Route::get('admin/order/return/{id}', [App\Http\Controllers\Admin\OrderController::class, 'returnorder']);
Route::get('/admin/rejectorder/list', [App\Http\Controllers\Admin\OrderController::class, 'allrejectorder'])->name('admin.order.reject');
Route::get('/admin/alldeleverorder/list', [App\Http\Controllers\Admin\OrderController::class, 'alldeleverorder'])->name('admin.order.alldeleverorder');
Route::get('/admin/processingorder/list', [App\Http\Controllers\Admin\OrderController::class, 'processingorder'])->name('admin.order.new');
Route::get('admin/invoice/order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'invoiceOrder']);
Route::get('admin/update/order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'updateOrder']);
Route::post('admin/update/order', [App\Http\Controllers\Admin\OrderController::class, 'updateOrderSubmit']);
//Report Routes
Route::get('/admin/orderreport', [App\Http\Controllers\Admin\ReportController::class, 'orderReport'])->name('admin.orderreport');
Route::post('/admin/orderreport', [App\Http\Controllers\Admin\ReportController::class, 'Report'])->name('admin.orderreport');
Route::get('/admin/productreport', [App\Http\Controllers\Admin\ReportController::class, 'productReport'])->name('admin.productreport');
Route::post('/admin/productreport', [App\Http\Controllers\Admin\ReportController::class, 'productWiseReport'])->name('admin.productreport');
//vendor wish Report Routes
Route::get('/admin/vendor-wish-order', [App\Http\Controllers\Admin\VendorWishOrderReportController::class, 'main'])->name('admin.vendor-wish-order');
Route::get('/admin/user-list', [App\Http\Controllers\Admin\FrontendUserReportController::class, 'user'])->name('admin.user.list');
Route::get('/admin/vendor-list', [App\Http\Controllers\Admin\FrontendUserReportController::class, 'vendor'])->name('admin.vendor.list');
Route::get('/admin/category-wish-sell', [App\Http\Controllers\Admin\CategoryWishSellReportController::class, 'main']);
Route::get('/admin/category-product/{id}', [App\Http\Controllers\Admin\CategoryWishSellReportController::class, 'view']);
Route::get('/admin/best-sell-report', [App\Http\Controllers\Admin\BestSellProductReportController::class, 'main']);
Route::get('/admin/user-area-report', [App\Http\Controllers\Admin\UserRegistrationAreaReportController::class, 'main']);
// backend vendor payment request and pay amount
Route::get('/admin/payment-request-list', [App\Http\Controllers\Admin\VendorPaymentController::class, 'index'])->name('admin.payment-request-list');
Route::get('/admin/payment-request-view/{id}', [App\Http\Controllers\Admin\VendorPaymentController::class, 'view']);
Route::post('/admin/payment-request-pay/{id}', [App\Http\Controllers\Admin\VendorPaymentController::class, 'pay']);
Route::get('/admin/payment-request-pay/{id}', [App\Http\Controllers\Admin\VendorPaymentController::class, 'payView']);
Route::get('/admin/payment-request-reject/{id}', [App\Http\Controllers\Admin\VendorPaymentController::class, 'reject']);
// customer custom choose
Route::get('/admin/customer-custom-choose-request', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'index'])->name('admin.customer-custom-choose-request');
Route::get('/admin/customer-custom-choose-request-view/{id}', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'show'])->name('admin.customer-custom-choose-request-view');
Route::get('/admin/custom-choose-request-order/{id}', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'customOrderCreate'])->name('admin.custom-choose-request-order');
Route::post('/admin/custom-choose-request-order', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'customOrderStore'])->name('admin.custom-choose-request-order');
Route::get('/admin/customer-custom-choose-request-status/{id}', [App\Http\Controllers\Admin\CustomerChoiseRequestedController::class, 'status'])->name('admin.customer-custom-choose-request-status');
//Cuppon
Route::get('/admin/cuppon/create', [App\Http\Controllers\Admin\CupponController::class, 'create'])->name('admin.cuppon.create');
Route::post('/admin/cuppon/create', [App\Http\Controllers\Admin\CupponController::class, 'store'])->name('admin.cuppon.create');
Route::post('/admin/cuppon/update', [App\Http\Controllers\Admin\CupponController::class, 'update'])->name('admin.cuppon.update');
Route::get('/admin/cuppon/index', [App\Http\Controllers\Admin\CupponController::class, 'index'])->name('admin.cuppon.index');
Route::get('/admin/cuppon/active/{id}', [App\Http\Controllers\Admin\CupponController::class, 'active']);
Route::get('/admin/cuppon/deactive/{id}', [App\Http\Controllers\Admin\CupponController::class, 'deactive']);
Route::get('/admin/cuppon/edit/{cuppon}', [App\Http\Controllers\Admin\CupponController::class, 'edit']);
Route::get('/admin/cuppon/delete/{id}', [App\Http\Controllers\Admin\CupponController::class, 'delete']);
