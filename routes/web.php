<?php

// socialite route
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/', 'FrontController@index')->name('front.index');
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');
Route::get('/edit/user/', 'HomeController@editUser')->name('edit.user');
Route::post('/update/user/', 'HomeController@updateUser')->name('update.user');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');

// Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// Admin Section
// categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@storecategory')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@Deletecategory');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@Editcategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@Updatecategory');

// brands
Route::get('admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\BrandController@storebrand')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\BrandController@DeleteBrand');
Route::get('edit/brand/{id}', 'Admin\Category\BrandController@EditBrand');
Route::post('update/brand/{id}', 'Admin\Category\BrandController@UpdateBrand');

// sub categories
Route::get('admin/sub/category', 'Admin\Category\SubCategoryController@subcategories')->name('sub.categories');
Route::post('admin/store/subcategory', 'Admin\Category\SubCategoryController@storesubcat')->name('store.subcategory');
Route::get('delete/subcategory/{id}', 'Admin\Category\SubCategoryController@DeleteSubcat');
Route::get('edit/subcategory/{id}', 'Admin\Category\SubCategoryController@EditSubcat');
Route::post('update/subcategory/{id}', 'Admin\Category\SubCategoryController@UpdateSubcat');

// mini categories
Route::get('admin/mini/category', 'Admin\Category\MiniCategoryController@minicategories')->name('mini.categories');
Route::post('admin/store/minicategory', 'Admin\Category\MiniCategoryController@storeminicat')->name('store.minicategory');
Route::get('delete/minicategory/{id}', 'Admin\Category\MiniCategoryController@Deleteminicat');
Route::get('edit/minicategory/{id}', 'Admin\Category\MiniCategoryController@Editminicat');
Route::post('update/minicategory/{id}', 'Admin\Category\MiniCategoryController@Updateminicat');

// coupons
Route::get('admin/sub/coupon', 'Admin\Category\CouponController@coupon')->name('admin.coupon');
Route::post('admin/store/coupon', 'Admin\Category\CouponController@storecoupon')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\Category\CouponController@DeleteCoupon');
Route::get('edit/coupon/{id}', 'Admin\Category\CouponController@EditCoupon');
Route::post('update/coupon/{id}', 'Admin\Category\CouponController@UpdateCoupon');

// newslaters
Route::get('admin/newslater', 'Admin\Category\CouponController@Newslater')->name('admin.newslater');
Route::get('delete/newslater/{id}', 'Admin\Category\CouponController@DeleteNewslater');
Route::get('admin/email/subscriber/', 'Admin\Category\CouponController@EmailSubscriber')->name('email.subscriber');
Route::post('admin/email/subscriber/success', 'Admin\Category\CouponController@EmailSuccess')->name('email.subscriber.success');

// For Show Sub category with Ajax
Route::get('get/subcategory/{category_id}', 'Admin\ProductController@GetSubcat');
Route::get('get/minicategory/{subcategory_id}', 'Admin\ProductController@GetMinicat');


//Product All Route
Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');
Route::post('admin/store/product', 'Admin\ProductController@store')->name('store.product');
Route::get('inactive/product/{id}','Admin\ProductController@inactive');
Route::get('active/product/{id}','Admin\ProductController@active');
Route::get('delete/product/{id}','Admin\ProductController@delete');
Route::get('view/product/{id}','Admin\ProductController@ViewProduct');
Route::get('edit/product/{id}','Admin\ProductController@EditProduct');
Route::post('update/product/withoutimage/{id}','Admin\ProductController@UpdateProductWithoutImage');
Route::post('update/product/image/{id}','Admin\ProductController@UpdateProductImage');

// Blog admin all
Route::get('blog/category/list', 'Admin\PostController@BlogCatList')->name('add.blog.categorylist');
Route::post('admin/store/blog', 'Admin\PostController@BlogCatStore')->name('store.blog.category');
Route::get('delete/blogcategory/{id}','Admin\PostController@DeleteBlogCat');
Route::get('edit/blogcategory/{id}','Admin\PostController@EditBlogCat');
Route::post('update/blogcategory/{id}','Admin\PostController@UpdateBlogCat');

Route::get('admin/add/post', 'Admin\PostController@Create')->name('add.blogpost');
Route::get('admin/all/post', 'Admin\PostController@index')->name('all.blogpost');
Route::post('admin/store/post', 'Admin\PostController@Store')->name('store.post');
Route::get('delete/post/{id}','Admin\PostController@DeletePost');
Route::get('edit/post/{id}','Admin\PostController@EditPost');
Route::post('update/post/{id}','Admin\PostController@UpdatePost');

// frontend routes
Route::post('store/newslater', 'FrontController@store_newslater')->name('store.newslatter');

// add wishlist
Route::get('add/wishlist/{id}', 'WishlistController@addWishlist');
Route::get('user/wishlist/', 'CartController@wishlist')->name('user.wishlist');

// add to cart
Route::get('add/cart/{id}', 'CartController@addCart');

Route::get('check', 'CartController@check');

Route::get('product/cart', 'CartController@ShowCart')->name('show.cart');

Route::get('remove/cart/{rowId}', 'CartController@removeCart');

Route::post('update/cart/item/', 'CartController@updateCart')->name('update.cartitem');

Route::get('delete/cart/all', 'CartController@removeAllCart');

Route::get('cart/product/view/{id}', 'CartController@ViewProduct');

Route::post('insert/into/cart/', 'CartController@insertCart')->name('insert.into.cart');

Route::get('user/checkout/', 'CartController@Checkout')->name('user.checkout');

Route::post('user/apply/coupon/', 'CartController@ApplyCoupon')->name('apply.coupon');

Route::get('coupon/remove/', 'CartController@RemoveCoupon')->name('coupon.remove');

// product details && add to cart
Route::get('/product/details/{id}/{product_name}', 'ProductController@ProductView');
Route::post('/cart/product/add/{id}', 'ProductController@AddCart');

// blog post 
Route::get('blog/post', 'BlogController@Blog')->name('blog.post');

Route::get('language/english', 'BlogController@English')->name('language.english');
Route::get('language/nepali', 'BlogController@Nepali')->name('language.nepali');
Route::get('blog/single/{id}/{title}', 'BlogController@show');

// payment step
Route::get('payment/page', 'CartController@PaymentPage')->name('payment.step');
Route::post('user/payment/process', 'PaymentController@Payment')->name('payment.process');
Route::post('user/stripe/charge', 'PaymentController@StripeCharge')->name('stripe.charge');
Route::post('user/oncash/charge', 'PaymentController@OnCash')->name('oncash.charge');
Route::post('user/bank/charge', 'PaymentController@OnBank')->name('bank.charge');

// product detail with category
Route::get('products/{id}', 'ProductController@ProductsView');
Route::get('allsubcategory/{id}', 'ProductController@SubcategoryView');
Route::get('catalog/{id}', 'ProductController@CategoryView');

// admin order
Route::get('admin/pending/order', 'Admin\OrderController@NewOrder')->name('admin.neworder');
Route::get('admin/view/order/{id}', 'Admin\OrderController@ViewOrder');

Route::get('admin/payment/accept/{id}', 'Admin\OrderController@PaymentAccept');
Route::get('admin/payment/cancel/{id}', 'Admin\OrderController@PaymentCancel');
Route::get('admin/accept/payment', 'Admin\OrderController@AcceptPayment')->name('admin.accept.payment');
Route::get('admin/cancel/order', 'Admin\OrderController@CancelOrder')->name('admin.cancel.order');
Route::get('admin/process/order', 'Admin\OrderController@ProcessOrder')->name('admin.process.order');
Route::get('admin/success/delivery', 'Admin\OrderController@SuccessDelivery')->name('admin.success.delivery');
Route::get('admin/delivery/process/{id}', 'Admin\OrderController@DeliveryProcess');
Route::post('admin/delivery/done', 'Admin\OrderController@DeliveryDone')->name('admin.delivery.done');
Route::post('admin/invoice/verify', 'Admin\OrderController@InvoiceVerify')->name('admin.invoice.verify');

// user order
Route::get('user/view/order/{id}', 'HomeController@ViewOrder');

/// SEO Setting Route
Route::get('admin/seo', 'Admin\OrderController@seo')->name('admin.seo');
Route::post('admin/seo/update', 'Admin\OrderController@UpdateSeo')->name('update.seo');

// order report route
Route::get('admin/today/order', 'Admin\ReportController@TodayOrder')->name('today.order');
Route::get('admin/today/delivery', 'Admin\ReportController@TodayDelivery')->name('today.delivery');
Route::get('admin/this/month', 'Admin\ReportController@ThisMonth')->name('this.month');
Route::get('admin/search/report', 'Admin\ReportController@SearchReport')->name('search.report');
Route::post('admin/search/by/year', 'Admin\ReportController@SearchByYear')->name('search.by.year');
Route::post('admin/search/by/month', 'Admin\ReportController@SearchByMonth')->name('search.by.month');
Route::post('admin/search/by/date', 'Admin\ReportController@SearchByDate')->name('search.by.date');
Route::get('admin/sold/product', 'Admin\ReportController@SoldProduct')->name('admin.stock.sell');

// Order tracking 
Route::post('order/tracking', 'FrontController@OrderTracking')->name('order.tracking');

// admin role route
Route::get('admin/all/user', 'Admin\UserRoleController@UserRole')->name('admin.all.user');
Route::get('admin/create/admin', 'Admin\UserRoleController@UserCreate')->name('create.admin');
Route::post('admin/store/admin', 'Admin\UserRoleController@UserStore')->name('store.admin');
Route::get('edit/admin/{id}', 'Admin\UserRoleController@UserEdit');
Route::get('delete/admin/{id}', 'Admin\UserRoleController@UserDelete');
Route::post('admin/update/admin', 'Admin\UserRoleController@UserUpdate')->name('update.admin');

//Admin Site Setting Route
Route::get('admin/site/setting', 'Admin\SettingController@SiteSetting')->name('admin.site.setting');
Route::post('admin/sitesetting', 'Admin\SettingController@UpdateSiteSetting')->name('update.sitesetting');

// Contact Page Routes
Route::get('contact/page', 'ContactController@Contact')->name('contact.page');
Route::post('contact/form', 'ContactController@ContactForm')->name('contact.form');

Route::get('admin/all/message', 'Admin\PostController@AllMessage')->name('all.message');
Route::get('show/contact/message/{id}', 'Admin\PostController@ContactMessage');

// Product Search Route 
Route::post('product/search', 'CartController@Search')->name('product.search');



// retrun order 
Route::get('success/list', 'PaymentController@SuccessList')->name('success.orderlist');
Route::post('request/return/', 'PaymentController@RequestReturn');

Route::get('admin/return/request/', 'Admin\ReturnController@ReturnRequest')->name('admin.return.request');
Route::get('admin/approve/return/{id}', 'Admin\ReturnController@ApproveReturn');
Route::get('admin/all/return/', 'Admin\ReturnController@AllReturn')->name('admin.all.return');

// Order Stock
Route::get('admin/product/stock', 'Admin\UserRoleController@ProductStock')->name('admin.product.stock');
Route::get('admin/stock/empty', 'Admin\UserRoleController@EmptyStock')->name('admin.stock.empty');
Route::post('admin/update/stock/qty', 'Admin\UserRoleController@EmptyStockUpdate')->name('update.stock.quantity');

// user cancel order
Route::get('user/order/update/status/{id}', 'PaymentController@CancelOrder');

// terms & condition
Route::get('terms_conditions', 'FrontController@terms_conditions');

//Product All Route
Route::get('admin/vendor/all', 'Admin\VendorController@index')->name('all.vendor');
Route::get('admin/vendor/add', 'Admin\VendorController@create')->name('add.vendor');
Route::post('admin/store/vendor', 'Admin\VendorController@store')->name('store.vendor');
Route::get('admin/delete/vendor/{id}','Admin\VendorController@delete');
Route::get('admin/view/vendor/{id}','Admin\VendorController@show');
Route::get('admin/edit/vendor/{id}','Admin\VendorController@edit');
Route::post('admin/update/vendor/{id}','Admin\VendorController@update');

// for realtime notification
Route::get('admin/notification/clear', 'AdminController@ClearNotification')->name('clear.notification');
Route::post('admin/notification/read', 'AdminController@ReadNotification');
Route::get('/admin/myevent','AdminController@ajax_notification');
Route::post('/admin/countNotification', 'AdminController@countNotification');

// ajax filter in product grid view
Route::post('/filter/price', 'ProductController@price_filter');

// get user previous delivery address
Route::get('delivery/address', 'CartController@PreviousAddress');