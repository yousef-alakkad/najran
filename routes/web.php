<?php

use Illuminate\Support\Facades\Route;



// Route::get('/testemail', [App\Http\Controllers\MemberController::class, 'testEmail']);

Route::get('/MedicalForum', function(){
    return view('ads');
});
Route::get('/', function(){
    return redirect()->to('/registration');
})->name('ind');

Route::get('email',function (){
    $members = \App\Models\member::where('registration_type','!=',1)->skip(1325)->limit(1920)->get();
    foreach($members as $member){
        $member->update([
            'send_email'=>0
        ]);
    }
    // $link='';
    // $name='';
    // $member = \App\Models\member::first();
    // return view('email.qrcode',compact('link','member'));
});

// export Registered Members
Route::get('export-all-registered', [App\Http\Controllers\HomeController::class, 'exportAllRegistered']);


Route::get('export-all-registered-in-workshops', [App\Http\Controllers\HomeController::class, 'exportAllRegisteredInWorkShops']);


//Route::get('/registration', [App\Http\Controllers\MemberController::class, 'registrationView']);
Route::get('/work-registration', [App\Http\Controllers\MemberController::class, 'registrationView']);

Route::get('/company-registration/{lang?}', [App\Http\Controllers\MemberController::class, 'companyRegistrationView']);
Route::post('/saveMembersCompanyData', [App\Http\Controllers\MemberController::class, 'saveCompanyData'])->name('companyMember.save');

Route::post('/saveMembersData', [App\Http\Controllers\MemberController::class, 'save'])->name('saveMembersData');


//Route::get('/medical-forum-registration', [App\Http\Controllers\MemberController::class, 'medicalRegistrationView']);
Route::get('/registration/{lang?}', [App\Http\Controllers\MemberController::class, 'medicalRegistrationView']);
Route::post('/registration', [App\Http\Controllers\MemberController::class, 'saveMedicalData'])->name('forum-registration');

Route::get('/resend-badge', [App\Http\Controllers\MemberController::class, 'resendBadge']);
Route::post('/resend-badge', [App\Http\Controllers\MemberController::class, 'resendBadgePost'])->name('resend-badge');

Route::get('/edit-link', [App\Http\Controllers\MemberController::class, 'editLink']);
Route::post('/edit-link', [App\Http\Controllers\MemberController::class, 'editLinkPost'])->name('edit-link');

Route::get('/edit-registration/{code}', [App\Http\Controllers\MemberController::class, 'editRegistration']);
Route::post('/edit-registration/{code}', [App\Http\Controllers\MemberController::class, 'editRegistrationPost'])->name('edit-registration');

// Link For Payment Datails
Route::get('/bank-details/{code}', [App\Http\Controllers\MemberController::class, 'bankDetailsView']);
Route::post('/bank-details/{code}', [App\Http\Controllers\MemberController::class, 'savebankDetailsView']);
// Badge
Route::get('/badge/{code}', [App\Http\Controllers\MemberController::class, 'badgeView']);
Route::get('/badgepdf/{code}', [App\Http\Controllers\MemberController::class, 'download_pdf']);
// Check Email
Route::get('checkEmail/{email}', [App\Http\Controllers\MemberController::class, 'checkEmail']);

Auth::routes(["register" => false]);
//Attend By Qrcode
Route::get('/attendVisitor/{code}', [App\Http\Controllers\Admin\AttendController::class, 'storeByCode']);
//Resend Visa
Route::get('resendVisa/{id}', [App\Http\Controllers\HomeController::class, 'resendVisa']);
// Export Excel For Festival Attending
Route::get('export/{date}', [App\Http\Controllers\HomeController::class, 'exportByDate']);
// Export Excel For WorkShops Attending
Route::get('export-workshop/{id}', [App\Http\Controllers\HomeController::class, 'exportByWorkShop']);
// Export Excel For Interested Memeber Of Workshops
Route::get('export-interested-in-workshop/{id}', [App\Http\Controllers\HomeController::class, 'exportInterestedInWorkShop']);
// Get All Users
Route::get('/getAllUsers', [App\Http\Controllers\HomeController::class, 'getUsers'])->name('getUsers');
Route::delete('/deleteUser/{id}', [App\Http\Controllers\HomeController::class, 'destroyUser']);
// Get All Registered Memebers
Route::get('/registeredMemebers', [App\Http\Controllers\HomeController::class, 'getData'])->name('registeredMembers');
Route::get('/registeredMemebers2', [App\Http\Controllers\HomeController::class, 'getData2'])->name('registeredMembers2');
Route::get('/registeredMemebers3', [App\Http\Controllers\HomeController::class, 'getData3'])->name('registeredMembers3');
Route::get('/registeredCompanyMemebers', [App\Http\Controllers\HomeController::class, 'getCompanyData'])->name('registeredCompanyMembers');
Route::get('/registeredExhebs', [App\Http\Controllers\HomeController::class, 'getExhebsData'])->name('registeredExhebs');
Route::delete('/deleteMember/{id}', [App\Http\Controllers\HomeController::class, 'destroy']);
Route::get('/show-visitor/{id}', [App\Http\Controllers\HomeController::class, 'showVisitor']);
// Get All Remittance Memebers
Route::get('/remittance', [App\Http\Controllers\HomeController::class, 'index2']);
Route::get('/remittanceMemebers', [App\Http\Controllers\HomeController::class, 'getRemittance'])->name('MembersRemittance');
Route::delete('/deleteRemittance/{id}', [App\Http\Controllers\HomeController::class, 'destroyRemittance']);
Route::get('/approve/{id}', [App\Http\Controllers\HomeController::class, 'approve']);
// Get Visa Info
Route::get('/visaMembers', [App\Http\Controllers\HomeController::class, 'getVisaMembers'])->name('getVisaMembers');
// Get Workshop Info
Route::get('/workShopInfo', [App\Http\Controllers\Admin\WorkShopController::class, 'getData'])->name('getWorkShopData');
Route::delete('/deleteWorkShop/{id}', [App\Http\Controllers\Admin\WorkShopController::class, 'destroy']);
Route::put('/edit-workshop/{id}', [App\Http\Controllers\Admin\WorkShopController::class, 'editWorkShop']);
// Get All Data For Printing
Route::get('/all', [App\Http\Controllers\HomeController::class, 'getAll'])->name('allRegistration');
Route::get('/print/printBadge/{withImage}/{code}', [\App\Http\Controllers\Admin\VisitorController::class,'printBadge']);
Route::group(['prefix'=>'admin','middleware'=>['auth']],function (){

    Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/create/visitor', [\App\Http\Controllers\Admin\VisitorController::class,'index'])->name('createVisitros');
    Route::post('/create/visitor', [\App\Http\Controllers\Admin\VisitorController::class,'store']);
    Route::get('/show/visitors', [\App\Http\Controllers\Admin\VisitorController::class,'showVisitors'])->name('showVisitors');
    Route::get('/show/visitors2', [\App\Http\Controllers\Admin\VisitorController::class,'showVisitors2'])->name('showVisitors2');
    Route::get('/show/visitors3', [\App\Http\Controllers\Admin\VisitorController::class,'showVisitors3'])->name('showVisitors3');
    Route::get('/send-reminder/visitors/{type}', [\App\Http\Controllers\Admin\VisitorController::class,'sendReminderVisitors'])->name('sendReminderVisitors');

    Route::get('/create/workshop-visitor', [\App\Http\Controllers\Admin\VisitorController::class,'indexExheb'])->name('createExhebs');;
    Route::post('/create/workshop-visitor', [\App\Http\Controllers\Admin\VisitorController::class,'storeExheb']);
    Route::get('/show/workshop-visitor', [\App\Http\Controllers\Admin\VisitorController::class,'showExheb'])->name('showExhebs');
    Route::get('/show/company-visitor', [\App\Http\Controllers\Admin\VisitorController::class,'showCompany'])->name('company');

    Route::get('/remittance', [App\Http\Controllers\HomeController::class, 'index2']);


    Route::get('/attend', [App\Http\Controllers\Admin\AttendController::class, 'index']);
    Route::post('/attend', [App\Http\Controllers\Admin\AttendController::class, 'store']);

    Route::get('/attendWorkShop', [App\Http\Controllers\Admin\AttendController::class, 'indexWorkShop']);
    Route::post('/attendWorkShop', [App\Http\Controllers\Admin\AttendController::class, 'storeWorkShop']);


    Route::get('/attend&print', [App\Http\Controllers\Admin\AttendController::class, 'attendAndPrintView']);
    Route::post('/attend&print', [App\Http\Controllers\Admin\AttendController::class, 'saveAttendAndPrint']);



    Route::get('/attends-per-day', [App\Http\Controllers\Admin\AttendController::class, 'attendPerDay']);
    Route::get('/attends-per-workshop', [App\Http\Controllers\Admin\AttendController::class, 'attendPerWorkShop']);

    Route::delete('/attend/{id}',[App\Http\Controllers\Admin\AttendController::class, 'destroy'])->name('attends.destroy');

    Route::get('/interested-in-workshop', [App\Http\Controllers\Admin\AttendController::class, 'intersetedInWorkShop']);
    Route::get('/view-interested-in-workshop/{id}', [App\Http\Controllers\Admin\AttendController::class, 'viewIntersetedInWorkShop']);
    Route::get('/getBrowseInterestedInWorkshop/{id}', [App\Http\Controllers\Admin\AttendController::class, 'getBrowseInterestedInWorkshop']);

    Route::get('/BrowseEventAttenders/{date}',[App\Http\Controllers\Admin\AttendController::class, 'BrowseAttenders']);
    Route::get('/getBrowseEventAttendersData/{date}',[App\Http\Controllers\Admin\AttendController::class, 'getEventData']);


    Route::get('/BrowseWorkShopAttenders/{id}',[App\Http\Controllers\Admin\AttendController::class, 'BrowseWorkShopAttenders']);
    Route::get('/getBrowseWorkShopAttendersData/{id}',[App\Http\Controllers\Admin\AttendController::class, 'getBrowseWorkShopAttendersData']);

    Route::delete('/attend-workshop/{id}',[App\Http\Controllers\Admin\AttendController::class, 'destroyWorkshop'])->name('attends-workshop.destroy');

    Route::get('/print/visitor', [\App\Http\Controllers\Admin\VisitorController::class,'print']);
    Route::get('/print/printBadge/{withImage}/{code}', [\App\Http\Controllers\Admin\VisitorController::class,'printBadge']);


    Route::get('/visa', [App\Http\Controllers\HomeController::class, 'visaIndex']);
    Route::post('/addVisa/{id}', [App\Http\Controllers\HomeController::class, 'addVisa']);

    Route::get('/workshop', [App\Http\Controllers\Admin\WorkShopController::class, 'index']);
    Route::post('/workshop', [App\Http\Controllers\Admin\WorkShopController::class, 'store']);

    Route::get('/allUsers',[App\Http\Controllers\HomeController::class, 'allUsers']);




    Route::get('/create/manager', [\App\Http\Controllers\Admin\VisitorController::class,'createManager']);
    Route::get('/create/speak', [\App\Http\Controllers\Admin\VisitorController::class,'createSpeak']);
    Route::post('/reg/exheb', [\App\Http\Controllers\Admin\VisitorController::class,'storeExheb']);
    Route::post('/reg/manager', [\App\Http\Controllers\Admin\VisitorController::class,'storeManager']);
    Route::post('/reg/speak', [\App\Http\Controllers\Admin\VisitorController::class,'storeSpeak']);


});

Route::get('/e-test',function (){
    return view('email.test',['link'=>'asd','name'=>'asd']);
});
