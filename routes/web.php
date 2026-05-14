<?php

use App\Http\Controllers\inventoryController as inventory;
use App\Http\Controllers\categoryController as category;
use App\Http\Controllers\adminDashboardController as dashboard;
use App\Http\Controllers\userProfileController as userProfile;
use App\Http\Controllers\landingSectionController as landingSection;
use App\Http\Controllers\indexController as index;
use App\Http\Controllers\labelsController as labels;
use App\Http\Controllers\innerSectionController as innerSection;
use App\Http\Controllers\directoryController as directory;
use App\Http\Controllers\queryController as query;

use Illuminate\Support\Facades\Route;

# Front page modules
Route::get('/', [index::class, 'index']);
Route::get('listing/{inventory}/{category}/{sub}',[index::class,'fetchItems']);
Route::get('p/{key}',[index::class,'labelPage']);
Route::any('admin/fetch-spotlight-item-from-id', [index::class, 'fetchSpotlightItems']);
Route::any('admin/fetch-dynamic-item-from-id', [index::class, 'fetchDynamicItems']);
Route::get('search/{queryString?}',[index::class,'search']);
Route::get('{categorySlug}',[index::class,'categoryPage']);


# Cron job modules to auto enable/disable offers
// Route::get('/autoEnable', [offers::class, 'autoEnable']);
// Route::get('/autoDisable', [offers::class, 'autoDisable']);


# Admin Modules
Route::get('admin/dashboard',  [dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {

    # Fetching all activity.
    Route::get('/admin/all-activity', [dashboard::class, 'allActivity']);

    # The inventory module
    Route::get('/admin/inventory', [inventory::class, 'index']);
    Route::get('/admin/add-inventory', [inventory::class, 'addInventory']);
    Route::get('/admin/edit-inventory/{id}', [inventory::class, 'editInventory']);
    Route::post('/admin/edit-inventory', [inventory::class, 'submitInventoryChanges'])->name('edit.inventory');
    Route::post('/admin/submitInventory', [inventory::class, 'submitInventory'])->name('submit.inventory');
    Route::get('/admin/view-inventory/{id}', [inventory::class, 'viewInventory']);
    Route::get('/admin/change-inventory-status/{status}/{id}', [inventory::class, 'changeInventoryStatus']);
    Route::get('/admin/delete-inventory/{id}', [inventory::class, 'deleteInventory']);
    
    # Offers Module, Deprecating as of now.
    // Route::get('/admin/offers', [offers::class, 'index']);
    // Route::post('/admin/submitOffers', [offers::class, 'submitOffers'])->name('submit.offers');
    // Route::post('/admin/editOffers', [offers::class, 'editOffers'])->name('edit.offers');
    // Route::get('admin/change-offer-status/{status}/{id}', [offers::class, 'changeOfferStatus']);
    // Route::get('admin/delete-offers/{id}', [offers::class, 'deleteOffers']);

    # Profile module
    Route::get('/admin/my-profile', [userProfile::class, 'index']);
    Route::post('/admin/my-profile', [userProfile::class, 'updateProfile'])->name('update.profile');
    Route::get('/admin/add-user', [userProfile::class, 'addNewUserRender']);
    Route::post('/admin/add-user', [userProfile::class, 'addNewUser'])->name('add.newUser');
    
    # Landing Section Module
    Route::get('/admin/landing-section', [landingSection::class, 'index']);
    Route::post('/admin/configureNavTab', [landingSection::class, 'configureNavTab'])->name('configure.tab');
    Route::post('/admin/configureLandingHeadings', [landingSection::class, 'configureLandingHeadings'])->name('configure.headings');
    Route::post('/admin/add-her-bg', [landingSection::class, 'heroBg'])->name('add.hero-bg');

    # Label section Module
    Route::get('/admin/labels', [labels::class, 'index']);
    Route::post('/admin/submit-labels', [labels::class, 'submitLabels'])->name('submit.labels');
    Route::post('/admin/edit-labels', [labels::class, 'editLabel'])->name('edit.labels');
    Route::get('/admin/change-label-status/{status}/{id}', [labels::class, 'changeLabelStatus']);
    Route::get('/admin/delete-label/{id}', [labels::class, 'deleteLabel']);
    Route::post('/admin/fetch-id-specific-records', [labels::class, 'fetchAjax']);
    Route::post('/admin/assign-labels', [labels::class, 'assignLabels'])->name('assign.labels');

    # Inner Sections
    Route::get('/admin/inner-sections', [innerSection::class, 'index']);
    Route::post('/admin/submit-section', [innerSection::class, 'submitSection'])->name('submit.section');
    Route::post('/admin/edit-section', [innerSection::class, 'editSection'])->name('edit.section');
    Route::get('/admin/change-section-status/{status}/{id}', [innerSection::class, 'editStatusSection']);
    Route::get('/admin/delete-section/{id}', [innerSection::class, 'deleteSection']);
    Route::post('admin/fetch-inventory-to-assign/', [innerSection::class, 'fetchToAssign']);
    Route::post('admin/assign-inventory/', [innerSection::class, 'assignInventory'])->name('assign.inventory');

    # Customer query module
    Route::get('/admin/queries', [query::class, 'index']);
    Route::post('/admin/submit-query', [query::class, 'submit'])->name('submit.query');
    Route::post('/admin/submit-contact', [query::class, 'submitContact'])->name('submit.contact');
    Route::get('/admin/delete-query/{id}', [query::class, 'deleteItem']);

    # Directory module
    Route::get('admin/directory', [directory::class, 'index']);
    Route::post('admin/directory', [directory::class, 'insertEntryFromAdmin'])->name('submit.insertEntryFromAdmin');
    Route::post('admin/directory/edit', [directory::class, 'editEntryFromAdmin'])->name('edit.insertEntryFromAdmin');
    Route::get('admin/delete-directory-item/{id}', [directory::class, 'deleteItem']);

    # Category Module
    Route::any('/admin/categories/delete-category/{id}', [category::class, 'deleteCategory']);
    Route::any('/admin/categories/change-status/{id}/{status}', [category::class, 'changeStatus']);
    Route::post('/admin/categories', [category::class, 'create'])->name('add.category');
    Route::get('/admin/categories', [category::class, 'index']);
    Route::post('/admin/submit-subcategories', [category::class, 'submitSubCategories'])->name('submit.sub-categories');
    Route::get('/admin/collections/{id}', [category::class, 'getCollections']);
});

require __DIR__.'/auth.php';


