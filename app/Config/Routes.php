<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
// $routes->add('sidebar' , 'home::sidebar');


/**
 * @var RouteCollection $routes
 */ {
    $routes->get('/dash', 'Home::dashboard');
    $routes->get('/login', 'Home::login');
    $routes->get('/profile', 'Home::profile');

    // $routes->get('/forget_password', 'Home::forget_password');
    $routes->get('/dashboard', 'DashboardController::index');
    $routes->get('/borrower', 'BorrowerController::index');
    $routes->get('/forgot-password', 'Users::forgot_password_fp');
    $routes->get('/add-book', 'Book::bookManagementView');
    $routes->post('book/add-book', 'Book::addBook');
    $routes->get('book/fetch-book', 'Book::fetchBooks');
    $routes->post('book/delete-book', 'Book::deleteBook');
    $routes->get('book/get-book/(:num)', 'Book::getBook/$1');
    $routes->post('book/update-book/(:num)', 'Book::updateBook/$1');

    $routes->get('/add-borrower', 'Borrowing::borrowerManagementView');
    $routes->post('borrower/add-borrower', 'Borrowing::addBorrower');
    $routes->get('borrower/add-borrower', 'Borrowing::fetchBorrowers');
    $routes->post('borrower/delete-borrower', 'Borrowing::deleteBorrower');

     $routes->post('book/update-quantity/(:num)', 'Book::updateQuantity/$1');

     $routes->get('/add-borrower', 'Borrowing::borrowerManagementView');
     $routes->post('borrower/add-borrower', 'Borrowing::addBorrower');
     $routes->get('borrower/add-borrower', 'Borrowing::fetchBorrowers');
     $routes->post('borrower/delete-borrower', 'Borrowing::deleteBorrower');

    //  $route->get('borrower/get-borrower/(:num)','Borrowing:: get_borrower/$1');
    $routes->get('borrower/get-borrower/(:num)', 'Borrowing::getBorrower/$1');
    $routes->post('borrower/update-borrower/(:num)', 'Borrowing::updateBorrower/$1');

    // $routes->get('/blacklist', 'Borrowing::blackListView');
    // $routes->get('borrower/fetch-blacklisted-borrowers', 'Borrowing::fetchBlacklistedBorrowers');

    $routes->get('/black-list', 'Borrowing::overdueListView');
    // $routes->get('check-overdue-borrowers', 'Borrowing::checkOverdueBorrowers');
    $routes->get('borrowing/check-overdue-borrowers', 'Borrowing::checkOverdueBorrowers');


    // $routes->post('/black-list', 'Borrowing::updateReturnDate');

    // $routes->post('/update-return-date/(:num)', 'Borrowing::updateReturnDate/$1');
    $routes->post('borrower/update-actual-return-date/(:num)', 'Borrowing::updateActualReturnDate/$1');
    $routes->get('getLocalDateTime', 'Borrowing::getLocalDateTime');
    $routes->get('borrowing/fetch-all-names', 'Borrowing::fetchAllNames'); 


    $routes->get('book/fetch-book-by-category/(:num)', 'Book::fetchBookByCategory/$1');



    
    $routes->get('home', 'UserInterface::index'); 






    // $routes->post('/add-book', 'Book::add_book');
    // $routes->get('/get-data', 'Book::fetch');


    // $routes->delete('/delete-book/(:num)', 'Book::delete/$1');
    // $routes->get('/get-book/(:num)', 'Book::getBook/$1');
    // $routes->post('/edit-book/(:num)', 'Book::edit/$1');

    //routes for CommentController
    // $routes->post('submit-comment', 'CommentController::submitComment');
    // $routes->get('fetch-comments', 'CommentController::fetchComments');

    // $routes->post('review/submit', 'ReviewController::submitReview');
    // $routes->get('scan_book', 'Admin::sidebar');

    $routes->get('/reviews', 'ReviewController::index');
    $routes->post('/reviews/save', 'ReviewController::save');

    $routes->get('scan_book', 'Home::scanBook');

    $routes->post('submit-comment', 'CommentController::submitComment');
    $routes->get('load-comments', 'CommentController::loadComments');
    $routes->post('test', 'ReviewController::store');
    $routes->get('getReview', 'ReviewController::getReviews');



    $routes->get('/profilee', 'Users::profile');
    $routes->get('/edit-profile', 'Users::editProfile');
    $routes->post('/update-profile', 'Users::updateProfile');
    $routes->get('/show-profile', 'Users::profile');

    $routes->post('/user/uploadProfilePicture', 'Users::uploadProfilePicture');
    // app/Config/Routes.php

    $routes->post('user/update/(:num)', 'Users::updateProfile');

    $routes->get('register', 'Users::reg');
    $routes->post('register', 'Users::newregister');

    $routes->get('login', 'Users::log');
    $routes->post('login', 'Users::index');



    // $routes->get('book/(:num)', 'Book::showBook/$1');

}
